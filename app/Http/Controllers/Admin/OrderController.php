<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OrderRequest;
use App\Models\Admin\BagOption;
use App\Models\Admin\CarBrand;
use App\Models\Admin\CarModel;
use App\Models\Admin\Category;
use App\Models\Admin\GuestAddress;
use App\Models\Admin\Order;
use App\Models\Admin\OrderDetail;
use App\Models\Admin\Product;
use App\Models\Admin\ProductDiscount;
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
            $query->where(function($q) use ($request) {
                $q->whereHas('userAddress', function($subQuery) use ($request) {
                    $subQuery->where('full_name', 'like', '%' . $request->customer_name . '%');
                })
                    ->orWhereHas('guestAddress', function($subQuery) use ($request) {
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
        $seatCovers = Category::with('products')->get();
        $seatCounts = SeatCount::all();
        $car_brands = CarBrand::all();
        return view('admin.orders.create',
            compact('users','states','seatCovers','seatCounts','car_brands')
        );
    }

    public function store(OrderRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
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
                $order->save();

                $totalPrice = 0;


                foreach ($request->seat_cover as $index => $seatCoverId) {

                    $bagBrice = $this->getBagPrice($seatCoverId,$request->bag_option[$index]);
                    $talbisaPrice = $this->getTalbisaPrice($seatCoverId,$request->seat_count[$index]);

                    $unitPrice = $bagBrice + $talbisaPrice;
                    $count =$request->talbisa_count[$index];
                    $countPrice = $unitPrice * $count;

                    $orderDetail = new OrderDetail();

                    $orderDetail->order_id = $order->id;
                    $orderDetail->color_id = $request->cover_color[$index];
                    $orderDetail->seat_cover_id = $seatCoverId;
                    $orderDetail->seat_count_id = $request->seat_count[$index];
                    $orderDetail->brand_id = $request->car_brand[$index];
                    $orderDetail->model_id = $request->car_model[$index];
                    $orderDetail->made_years = $request->made_year[$index];
                    $orderDetail->bag_option = $request->bag_option[$index];
                    $orderDetail->talbisa_quantity = $count;
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
                $tax_amount = ($totalPrice + $shippingCost - $promoDiscount) * ($tax_rate /100);
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

                return response()->json([
                    'success' => true,
                    'req'=>$request->cover_color,
                    'message' => 'تم إنشاء الطلب بنجاح',
                ]);
            });
        } catch (\Exception $e) {
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

            $states = ShippingRate::all();
            $seatCovers = Category::with('products')->get();
            $seatCounts = SeatCount::all();
            $carBrands = CarBrand::all();
            $carModels = CarModel::all()->groupBy('brand_id');

            // جلب الألوان الخاصة بكل نوع تلبيسة
            $coverColors = Product::all()->groupBy('category_id');

            return view('admin.orders.edit', compact(
                'order',
                'coverColors',
                'user',
                'address',
                'states',
                'seatCounts',
                'seatCovers',
                'carBrands',
                'carModels',
            )
            );
        }
        return redirect(route('admin.orders.index'));
    }

    public function getProductField(Request $request)
    {
        $index = $request->get('index');
        $products = Product::all();
        return view('admin.orders.partials.product-field', compact('index', 'products'));
    }

    public function update(OrderRequest $request, Order $order)
    {
        try {
            return DB::transaction(function () use ($request,$order) {
                $user = null;
                $isGuest = false;

                if ($request->user_id) {
                    $user = User::findOrFail($request->user_id);
                } else {
                    $isGuest = true;
                }


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
                $order->save();

                $totalPrice = 0;


                foreach ($request->seat_cover as $index => $seatCoverId) {

                    $bagBrice = $this->getBagPrice($seatCoverId,$request->bag_option[$index]);
                    $talbisaPrice = $this->getTalbisaPrice($seatCoverId,$request->seat_count[$index]);

                    $unitPrice = $bagBrice + $talbisaPrice;
                    $count =$request->talbisa_count[$index];
                    $countPrice = $unitPrice * $count;

                    $orderDetail = new OrderDetail();

                    $orderDetail->order_id = $order->id;
                    $orderDetail->color_id = $request->cover_color[$index];
                    $orderDetail->seat_cover_id = $seatCoverId;
                    $orderDetail->seat_count_id = $request->seat_count[$index];
                    $orderDetail->brand_id = $request->car_brand[$index];
                    $orderDetail->model_id = $request->car_model[$index];
                    $orderDetail->made_years = $request->made_year[$index];
                    $orderDetail->bag_option = $request->bag_option[$index];
                    $orderDetail->talbisa_quantity = $count;
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
                $tax_amount = ($totalPrice + $shippingCost - $promoDiscount) * ($tax_rate /100);
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

                return response()->json([
                    'success' => true,
                    'req'=>$request->cover_color,
                    'message' => 'تم إنشاء الطلب بنجاح',
                ]);
            });
        } catch (\Exception $e) {
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
                $product = $orderDetail->product;
                $product->quantity += $orderDetail->product_quantity;
                $product->save();
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

    private function getBagPrice($seat_cover_id,$bagOption)
    {
        if($bagOption==1){
        return  BagOption::where('category_id',$seat_cover_id)->first()->bag_price;
        }else{
            return 0;
        }
    }

    private function getTalbisaPrice($coverId,$countId)
    {
        return SeatPrice::where('category_id',$coverId)->where('seat_count_id',$countId)->first()->price;

    }

}


