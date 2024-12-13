<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OrderRequest;
use App\Models\Admin\Accessory;
use App\Models\Admin\BagOption;
use App\Models\Admin\CarBrand;
use App\Models\Admin\CarModel;
use App\Models\Admin\Category;
use App\Models\Admin\GuestAddress;
use App\Models\Admin\Order;
use App\Models\Admin\OrderDetail;
use App\Models\Admin\CoverColor;
use App\Models\Admin\AccessoryDiscount;
use App\Models\Admin\PromoCode;
use App\Models\Admin\SeatCount;
use App\Models\Admin\SeatPrice;
use App\Models\Admin\Setting;
use App\Models\Admin\ShippingRate;
use App\Models\Admin\UserAddress;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use mysql_xdevapi\Exception;

class OrderController extends Controller
{

    public function index(Request $request)
    {
        $query = Order::query();

        if ($request->has('status') && !empty($request->status)) {
            $query->where('status_id', $request->status);
        }

        if ($request->has('sort')) {
            $query->orderBy($request->sort, 'asc');
        } else {
            $query->orderBy('id', 'desc');

        }
        // البحث بالتاريخ
        if ($request->has('date') && $request->date != '') {
            $query->whereDate('created_at', $request->date);
        }
        // البحث باسم العميل
        if ($request->has('customer_name') && $request->customer_name != '') {
            $query->where(function ($q) use ($request) {
                $q->whereHas('userAddress', function ($subQuery) use ($request) {
                    $subQuery->where('full_name', 'like', '%' . $request->customer_name . '%');
                })
                    ->orWhereHas('guestAddress', function ($subQuery) use ($request) {
                        $subQuery->where('full_name', 'like', '%' . $request->customer_name . '%');
                    });
            });
        }

        $orders = $query->with('orderDetails', 'user')->paginate(get_pagination_count());

        return view('admin.orders.index', compact('orders'));
    }

    public function create()
    {
        $users = User::all();
        $states = ShippingRate::all();
        $categories = Category::with('coverColors')->get();
        $seatCounts = SeatCount::all();
        $car_brands = CarBrand::all();
        $accessories = Accessory::with('discount')->get();
        return view('admin.orders.create',
            compact('users', 'states', 'categories', 'seatCounts', 'car_brands', 'accessories')
        );
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $user = null;
            $isGuest = false;

            if ($request->user_id) {
                $user = User::findOrFail($request->user_id);
            } else {
                $isGuest = true;
            }

            $order = new Order();

            if ($isGuest) {
                // حفظ معلومات الزائر في الطلب
                $guest = new GuestAddress();
                $guest->full_name = $request->full_name;
                $guest->phone = $request->phone;
                $guest->address = $request->address;
                $guest->city = $request->city;
                $guest->state = $request->state;
                $guest->save();
                $order->guest_address_id = $guest->id;
            } else {
                $order->user_id = $user->id;
                // انشاء  أو تحديث عنوان المستخدم
                $userAddress = UserAddress::updateOrCreate(

                    ['user_id' => $user->id],
                    [
                        'full_name' => $request->full_name,
                        'phone' => $request->phone,
                        'address' => $request->address,
                        'city' => $request->city,
                        'state' => $request->state,
                    ]
                );
                $order->user_address_id = $userAddress->id;
            }

            // إضافة تكلفة الشحن
            $shippingCost = ShippingRate::where('state', $request->state)->first()->shipping_cost;

            $order->shipping_cost = $shippingCost;

            $order->total_price = 0;
            $order->promo_discount = 0;
            $order->total_after_discount = 0;
            $order->final_total = 0;
            $order->tax_amount = 0;
            $order->save();

            $totalPrice = 0;

            foreach ($request->products as $index => $productId) {
                $parentCategory = $request->product_category[$index];
                $productType = $request->product_type[$index];
                $count = $request->product_count[$index];

                $orderDetail = new OrderDetail();

                if ($productType !== 'accessory') {

                    if ($productType === 'earth') {
                        $bagPrice = $this->getBagPrice($productId, $request->bag_option[$index]);
                    } else {
                        $bagPrice = 0;
                    }

                    $productPrice = $this->getTalbisaPrice($productId, $request->seat_count[$index]);
                    $orderDetail->category_id = $productId;
                    $orderDetail->accessory_id = null;

                } else {
                    $bagPrice = 0;
                    $productPrice = $this->getAccessoryPrice($productId);
                    $orderDetail->category_id = null;
                    $orderDetail->accessory_id = $productId;

                    //خصم الكمية من الاكسسوارارت
                    $accessoryModel = Accessory::find($productId);
                    if ($accessoryModel) {
                        // إنقاص الكمية
                        if ($accessoryModel->quantity < $count) {
                            return response()->json([
                                'success' => false,
                                'message' => 'الكمية المطلوبة غير موجودة في الستوك من: ' . $accessoryModel->name,
                            ], 422); // HTTP 400: Bad Request

                        } else {
                            $accessoryModel->quantity -= $count;
                            $accessoryModel->save();
                        };
                    } else {
                        // في حال لم يتم العثور على Accessory
                        throw new Exception("Accessory not found with ID: " . $productId);
                    }


                }

                $unitPrice = $bagPrice + $productPrice;
                $countPrice = $unitPrice * $count;
                $orderDetail->order_id = $order->id;
                $orderDetail->parent_id = $parentCategory;
                $orderDetail->product_type = $productType;
                $orderDetail->color_id = $request->cover_color[$index] ?? null;
                $orderDetail->seat_count_id = $request->seat_count[$index] ?? null;
                $orderDetail->brand_id = $request->car_brand[$index] ?? null;
                $orderDetail->model_id = $request->car_model[$index] ?? null;
                $orderDetail->made_years = $request->made_year[$index] ?? null;
                $orderDetail->bag_option = $request->bag_option[$index] ?? null;
                $orderDetail->quantity = $count;
                $orderDetail->unit_price = $unitPrice;
                $orderDetail->total_price = $countPrice;

                $orderDetail->save();

                $totalPrice += $countPrice;

            }

            // التحقق من كود الخصم
            if ($request->filled('promo_code')) {
                $promoCode = PromoCode::where('code', $request->promo_code)
                    ->where('active', 1)
                    ->where('start_date', '<=', now())
                    ->where('end_date', '>=', now())
                    ->first();

                if (!$promoCode) {
                    throw new \Exception('كود الخصم غير صالح أو منتهي الصلاحية.');
                }

                $promoCodeUsed = DB::table('user_promocode')
                    ->where('user_id', $user ? $user->id : null)
                    ->where('promo_code_id', $promoCode->id)
                    ->exists();

                if ($promoCodeUsed) {
                    throw new \Exception('لقد استخدمت هذا الكود من قبل.');
                }

                if ($totalPrice < $promoCode->min_amount) {
                    throw new \Exception('يجب أن يكون إجمالي الطلب أكبر من ' . $promoCode->min_amount . ' لاستخدام هذا الكوبون.');
                }

                $promoDiscount = $promoCode->discount_type === 'percentage'
                    ? ($totalPrice * $promoCode->discount) / 100
                    : $promoCode->discount;
            } else {
                $promoDiscount = 0;
            }

            $tax_rate = Setting::getValue('tax_rate');
            $tax_amount = ($totalPrice  - $promoDiscount) * ($tax_rate / 100);
            $order->total_price = $totalPrice;
            $order->promo_discount = $promoDiscount;
            $order->total_after_discount = $totalPrice - $promoDiscount;
            $order->tax_amount = $tax_amount;
            $order->final_total = $totalPrice + $tax_amount + $shippingCost - $promoDiscount;
            $order->save();

            if ($promoDiscount) {
                DB::table('user_promocode')->insert([
                    'user_id' => $user ? $user->id : null,
                    'promo_code_id' => $promoCode->id,
                    'order_id' => $order->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $order->update(['promocode_id' => $promoCode->id]);
            }

            DB::commit();
            return response()->json([
                'success' => true,
                'req' => $request->cover_color,
                'message' => 'تم إنشاء الطلب بنجاح',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }


    public function edit(Order $order)
    {
        if ($order->status->id == 1) { // تعديل الطلب في حالة اذا لم  يتم شحنه


            $order->load('orderDetails', 'user', 'promocode', 'userAddress', 'guestAddress');
            $user = $order->user;
            $address = $order->userAddress ?? $order->guestAddress;

            $accessories = Accessory::with('discount')->get();
            $states = ShippingRate::all();
            $categories = Category::with('coverColors')->get();
            $earthCategories = Category::where('product_type', 'earth')->whereNotNull('parent_id')->get();
            $seatCategories = Category::where('product_type', 'seat')->whereNotNull('parent_id')->get();
            $seatCounts = SeatCount::all();
            $carBrands = CarBrand::all();
            $carModels = CarModel::all()->groupBy('brand_id');

            // جلب الألوان الخاصة بكل نوع تلبيسة
            $coverColors = CoverColor::all()->groupBy('category_id');

            return view('admin.orders.edit', compact(
                    'order',
                    'coverColors',
                    'user',
                    'address',
                    'states',
                    'seatCounts',
                    'categories',
                    'carBrands',
                    'carModels',
                    'accessories',
                    'earthCategories',
                    'seatCategories',
                )
            );
        }
        return redirect(route('admin.orders.index'));
    }


    public function update(Request $request, Order $order)
    {
        try {
            DB::beginTransaction();

            $user = $order->user ?? null;
            $guestAddressId = $order->guest_address_id ?? null;


            if ($guestAddressId) {
                // حفظ معلومات الزائر في الطلب
                $guest = GuestAddress::find($guestAddressId);
                if (!$guest) {
                    $guest = new GuestAddress();
                }
                $guest->full_name = $request->full_name;
                $guest->phone = $request->phone;
                $guest->address = $request->address;
                $guest->city = $request->city;
                $guest->state = $request->state;
                $guest->save();
            } else {
                // انشاء  أو تحديث عنوان المستخدم
                $userAddress = UserAddress::updateOrCreate(

                    ['user_id' => $user?->id],
                    [
                        'full_name' => $request->full_name,
                        'phone' => $request->phone,
                        'address' => $request->address,
                        'city' => $request->city,
                        'state' => $request->state,
                    ]
                );
                $order->user_address_id = $userAddress->id;
            }

            // إضافة تكلفة الشحن
            $shippingCost = ShippingRate::where('state', $request->state)->first()->shipping_cost;

            $order->shipping_cost = $shippingCost;

            // حذف تفاصيل الطلب القديمة
            // إعادة الكمية للاكسسوارات قبل الحذف
            foreach ($order->orderDetails as $detail) {
                if ($detail->accessory_id) {
                    $accessory = Accessory::find($detail->accessory_id);
                    if ($accessory) {
                        $accessory->quantity += $detail->quantity;
                        $accessory->save();
                    }
                }
            }
            $order->orderDetails()->delete();


            $totalPrice = 0;

            foreach ($request->products as $index => $productId) {
                $parentCategory = $request->product_category[$index];
                $productType = $request->product_type[$index];
                $count = $request->product_count[$index];

                $orderDetail = new OrderDetail();

                if ($productType !== 'accessory') {

                    if ($productType === 'earth') {
                        $bagPrice = $this->getBagPrice($productId, $request->bag_option[$index]);
                    } else {
                        $bagPrice = 0;
                    }

                    $productPrice = $this->getTalbisaPrice($productId, $request->seat_count[$index]);
                    $orderDetail->category_id = $productId;
                    $orderDetail->accessory_id = null;

                } else {
                    $bagPrice = 0;
                    $productPrice = $this->getAccessoryPrice($productId);
                    $orderDetail->category_id = null;
                    $orderDetail->accessory_id = $productId;

                    //خصم الكمية من الاكسسوارارت
                    $accessoryModel = Accessory::find($productId);
                    if ($accessoryModel) {
                        // إنقاص الكمية
                        if ($accessoryModel->quantity < $count) {
                            return response()->json([
                                'success' => false,
                                'message' => 'الكمية المطلوبة غير موجودة في الستوك من: ' . $accessoryModel->name,
                            ], 422); // HTTP 400: Bad Request

                        } else {
                            $accessoryModel->quantity -= $count;
                            $accessoryModel->save();
                        };
                    } else {
                        // في حال لم يتم العثور على Accessory
                        throw new Exception("Accessory not found with ID: " . $productId);
                    }

                }

                $unitPrice = $bagPrice + $productPrice;
                $countPrice = $unitPrice * $count;
                $orderDetail->order_id = $order->id;
                $orderDetail->parent_id = $parentCategory;
                $orderDetail->product_type = $productType;
                $orderDetail->color_id = $request->cover_color[$index] ?? null;
                $orderDetail->seat_count_id = $request->seat_count[$index] ?? null;
                $orderDetail->brand_id = $request->car_brand[$index] ?? null;
                $orderDetail->model_id = $request->car_model[$index] ?? null;
                $orderDetail->made_years = $request->made_year[$index] ?? null;
                $orderDetail->bag_option = $request->bag_option[$index] ?? null;
                $orderDetail->quantity = $count;
                $orderDetail->unit_price = $unitPrice;
                $orderDetail->total_price = $countPrice;

                $orderDetail->save();

                $totalPrice += $countPrice;

            }

            // التحقق من كود الخصم
            if ($request->filled('promo_code')) {
                // حذف الكود القديم إن وجد
                if ($order->promocode_id) {
                    DB::table('user_promocode')
                        ->where('order_id', $order->id)
                        ->delete();
                }

                $promoCode = PromoCode::where('code', $request->promo_code)
                    ->where('active', 1)
                    ->where('start_date', '<=', now())
                    ->where('end_date', '>=', now())
                    ->first();

                if (!$promoCode) {
                    throw new \Exception('كود الخصم غير صالح أو منتهي الصلاحية.');
                }

                $promoCodeUsed = DB::table('user_promocode')
                    ->where('user_id', $user ? $user->id : null)
                    ->where('promo_code_id', $promoCode->id)
                    ->where('order_id', '!=', $order->id)
                    ->exists();

                if ($promoCodeUsed) {
                    throw new \Exception('لقد استخدمت هذا الكود من قبل.');
                }

                if ($totalPrice < $promoCode->min_amount) {
                    throw new \Exception('يجب أن يكون إجمالي الطلب أكبر من ' . $promoCode->min_amount . ' لاستخدام هذا الكوبون.');
                }

                $promoDiscount = $promoCode->discount_type === 'percentage'
                    ? ($totalPrice * $promoCode->discount) / 100
                    : $promoCode->discount;

                DB::table('user_promocode')->insert([
                    'user_id' => $user ? $user->id : null,
                    'promo_code_id' => $promoCode->id,
                    'order_id' => $order->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $order->promocode_id = $promoCode->id;
            } else {
                $promoDiscount = 0;
                $order->promocode_id = null;
                // حذف الكود القديم إن وجد
                DB::table('user_promocode')
                    ->where('order_id', $order->id)
                    ->delete();
            }


            $tax_rate = Setting::getValue('tax_rate');
            $tax_amount = ($totalPrice - $promoDiscount) * ($tax_rate / 100);
            $order->total_price = $totalPrice;
            $order->promo_discount = $promoDiscount;
            $order->total_after_discount = $totalPrice - $promoDiscount;
            $order->tax_amount = $tax_amount;
            $order->final_total = $totalPrice + $tax_amount + $shippingCost - $promoDiscount;
            $order->save();

            if ($promoDiscount) {
                DB::table('user_promocode')->insert([
                    'user_id' => $user ? $user->id : null,
                    'promo_code_id' => $promoCode->id,
                    'order_id' => $order->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $order->update(['promocode_id' => $promoCode->id]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'req' => $request->cover_color,
                'message' => 'تم إنشاء الطلب بنجاح',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }

    public function show(Order $order)
    {
        $order->load('orderDetails', 'user', 'userAddress', 'guestAddress');
        $address = $order->userAddress ?? $order->guestAddress;
        return view('admin.orders.show', compact('order', 'address'));
    }


    public function updateStatus(Order $order, Request $request)
    {
        $request->validate([
            'status' => 'required|integer|in:1,2,3,4',
        ]);

        // Update the order status
        $order->status_id = $request->input('status');
        $order->save();

        if ($request->input('status') == 4) {

            foreach ($order->orderDetails as $orderDetail) {
                if ($orderDetail->accessory_id) {
                    $accessory = $orderDetail->accessory;
                    $accessory->quantity += $orderDetail->quantity;
                    $accessory->save();
                }
            }

        }

        return response()->json(['success' => 'تم تعديل حالة الطلب بنجاح']);
    }


    public function checkCoupon(Request $request)
    {

        $couponCode = $request->input('promo_code');
        $orderTotal = $request->input('total_order'); // إجمالي الطلب
        $user_id = $request->input('user_id');

        if (!$user_id) {
            return response()->json(['error' => 'كوبونات الخصم للأعضاء المسجلين فقط'], 400);
        }

        // ابحث عن الكوبون بناءً على الكود المدخل
        $coupon = PromoCode::where('code', $couponCode)
            ->where('active', 1)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->first();


        // التحقق من وجود الكوبون
        if (!$coupon) {
            return response()->json(['error' => 'كود الخصم غير صحيح أو غير صالح'], 400);
        }

        // تحقق إذا كان المستخدم قد استخدم الكوبون من قبل
        $couponUsed = DB::table('user_promocode')
            ->where('user_id', $user_id)
            ->where('promo_code_id', $coupon->id)
            ->exists();

        if ($couponUsed) {
            return response()->json(['valid' => false, 'error' => 'لقد قمت باستخدام هذا الكوبون من قبل'], 400);
        }

        // التحقق من الحد الأدنى لقيمة الطلب
        if ($orderTotal < $coupon->min_amount) {
            return response()->json(['error' => 'إجمالي الطلب أقل من الحد الأدنى لتطبيق الكوبون'], 400);
        }

        // حساب الخصم بناءً على نوع الكوبون
        $discount = 0;
        if ($coupon->discount_type == 'percentage') {
            $discount = ($coupon->discount / 100) * $orderTotal;
        } elseif ($coupon->discount_type == 'fixed') {
            $discount = $coupon->discount;
        }

        // نرجع إجمالي الطلب بعد الخصم
        return response()->json([
            'success' => 'تم تطبيق الكوبون بنجاح',
            'discount' => $discount,
        ]);
    }

    public function updateCopoun(Request $request)
    {

        $couponCode = $request->input('promo_code');
        $orderTotal = $request->input('total_order'); // إجمالي الطلب

        // ابحث عن الكوبون بناءً على الكود المدخل
        $coupon = PromoCode::where('code', $couponCode)
            ->where('active', 1)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->first();


        // التحقق من وجود الكوبون
        if (!$coupon) {
            return response()->json(['error' => 'كود الخصم غير صحيح او غير صالح'], 400);
        }

        // التحقق من الحد الأدنى لقيمة الطلب
        if ($orderTotal < $coupon->min_amount) {
            return response()->json(['error' => 'إجمالي الطلب أقل من الحد الأدنى لتطبيق الكوبون'], 400);
        }

        // حساب الخصم بناءً على نوع الكوبون
        $discount = 0;
        if ($coupon->discount_type == 'percentage') {
            $discount = ($coupon->discount / 100) * $orderTotal;
        } elseif ($coupon->discount_type == 'fixed') {
            $discount = $coupon->discount;
        }

        // نرجع إجمالي الطلب بعد الخصم
        return response()->json([
            'success' => 'تم تعديل قيمة خصم الكوبون ',
            'discount' => $discount,
        ]);
    }

    public function getShippingCost($state)
    {
        $shippingCost = ShippingRate::where('state', $state)->first()->shipping_cost;

        return response()->json(['shipping_cost' => $shippingCost]);
    }

    private function getBagPrice($seat_cover_id, $bagOption)
    {
        if ($bagOption == 1) {
            return BagOption::where('category_id', $seat_cover_id)->first()->bag_price;
        } else {
            return 0;
        }
    }

    private function getTalbisaPrice($coverId, $countId)
    {
        return SeatPrice::where('category_id', $coverId)->where('seat_count_id', $countId)->first()->price;
    }

    private function getAccessoryPrice($productId)
    {
        return Accessory::where('id', $productId)->first()->discounted_price;
    }

}


