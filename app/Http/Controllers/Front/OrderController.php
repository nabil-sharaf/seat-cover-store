<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
use App\Models\Admin\Accessory;
use App\Models\Admin\BagOption;
use App\Models\Admin\CarBrand;
use App\Models\Admin\CarModel;
use App\Models\Admin\Category;
use App\Models\Admin\CoverColor;
use App\Models\Admin\GuestAddress;
use App\Models\Admin\Order;
use App\Models\Admin\OrderDetail;
use App\Models\Admin\Product;
use App\Models\Admin\PromoCode;
use App\Models\Admin\SeatCount;
use App\Models\Admin\SeatPrice;
use App\Models\Admin\Setting;
use App\Models\Admin\ShippingRate;
use App\Models\Front\UserAddress;
use App\Models\User;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index()
    {
        $states = ShippingRate::all();
        $cartItems = Cart::getContent();
        if (count($cartItems) == 0) {
            return redirect()->route('home.index')->with('error', ' قم بإضافة منتجاتك في السلة أولا');
        }
        // الحصول على محتويات السلة
        $formattedItems = $cartItems->map(function ($item) {
            $color = CoverColor::find($item->attributes['color_id']);
            $seatCount = SeatCount::find($item->attributes['seat_count_id']);
            $brand = CarBrand::find($item->attributes['brand_id']);
            $model = CarModel::find($item->attributes['model_id']);

            return [
                'id' => $item->id,
                'name' => $item->name,
                'price' => $item->price,
                'quantity' => $item->quantity,
                'total' => $item->price * $item->quantity,
                'details' => [
                    'color' => $color ? $color->name . ' ' . $color->tatriz_color : 'غير محدد',
                    'seat_count' => $seatCount ? $seatCount->name : 'غير محدد',
                    'brand' => $brand ? $brand->brand_name : 'غير محدد',
                    'model' => $model ? $model->model_name : 'غير محدد',
                    'made_year' => $item->attributes['made_years'],
                    'bag_option' => $item->attributes['bag_option'] ? 'نعم ' : 'لا ',
                    'base_price' => $item->attributes['base_price'],
                    'bag_price' => $item->attributes['bag_price'],
                    'image' => $item->attributes['image'],
                ],
                'original_ids' => [
                    'color_id' => $item->attributes['color_id'],
                    'seat_count_id' => $item->attributes['seat_count_id'],
                    'brand_id' => $item->attributes['brand_id'],
                    'model_id' => $item->attributes['model_id'],
                    'category_id' => $item->attributes['category_id'],
                    'product_type' => $item->attributes['product_type']
                ]
            ];
        });
        $totalQuantity = Cart::getTotalQuantity();
        $totalPrice = floatval(Cart::getTotal());
        $tax_rate = (Setting::getValue('tax_rate') / 100);
        $taxAmount = $totalPrice * $tax_rate;


        return view('front.checkout', compact(['formattedItems', 'totalPrice', 'totalQuantity', 'states', 'taxAmount', 'tax_rate']));
    }

    public function indexEdit(Order $order)
    {

        // التحقق من أن المستخدم الحالي هو صاحب الطلب
        if ($order->user_id) {
            if ($order->user_id !== auth()->user()?->id) {

                session()->forget('editing_order_id');
                // منع التعديل وإرجاع رسالة
                return redirect()->back()->with('error', 'لا يمكنك تعديل هذا الطلب.');
            }
        }
        if ($order->status->id != 1) {
            session()->forget('editing_order_id');
            return redirect()->route('home.index')->with('error', 'لا يمكنك تعديل الطلب حاليا.');
        }

        $states = ShippingRate::all();
        $cartItems = Cart::getContent();
        if (count($cartItems) == 0) {
            return redirect()->route('home.index')->with('error', ' قم بإضافة منتجاتك في السلة أولا');
        }
        $formattedItems = $cartItems->map(function ($item) {
            $color = CoverColor::find($item->attributes['color_id']);
            $seatCount = SeatCount::find($item->attributes['seat_count_id']);
            $brand = CarBrand::find($item->attributes['brand_id']);
            $model = CarModel::find($item->attributes['model_id']);

            return [
                'id' => $item->id,
                'name' => $item->name,
                'price' => $item->price,
                'quantity' => $item->quantity,
                'total' => $item->price * $item->quantity,
                'details' => [
                    'color' => $color ? $color->name . ' ' . $color->tatriz_color : 'غير محدد',
                    'seat_count' => $seatCount ? $seatCount->name : 'غير محدد',
                    'brand' => $brand ? $brand->brand_name : 'غير محدد',
                    'model' => $model ? $model->model_name : 'غير محدد',
                    'made_year' => $item->attributes['made_years'],
                    'bag_option' => $item->attributes['bag_option'] ? 'نعم ' : 'لا ',
                    'base_price' => $item->attributes['base_price'],
                    'bag_price' => $item->attributes['bag_price'],
                    'image' => $item->attributes['image'],
                ],
                'original_ids' => [
                    'color_id' => $item->attributes['color_id'],
                    'seat_count_id' => $item->attributes['seat_count_id'],
                    'brand_id' => $item->attributes['brand_id'],
                    'model_id' => $item->attributes['model_id'],
                    'category_id' => $item->attributes['category_id'],
                    'product_type' => $item->attributes['product_type']
                ]
            ];
        });
        $totalQuantity = Cart::getTotalQuantity();
        $totalPrice = floatval(Cart::getTotal());
        $tax_rate = (Setting::getValue('tax_rate') / 100);
        $taxAmount = $totalPrice * $tax_rate;


        return view('front.checkout', compact(['formattedItems', 'totalPrice', 'totalQuantity', 'order', 'states','tax_rate','taxAmount']));
    }


    public function show(Order $order)
    {
        $id = \auth()->user()?->id ?? '';

        // التحقق من أن المستخدم الحالي هو صاحب الطلب
        if ($order->user_id) {
            if ($order->user_id !== $id) {
                // منع التعديل وإرجاع رسالة
                return redirect()->route('home.index')->with('error', 'لا يمكنك عرض هذا الطلب.');
            }
        }

        $address = UserAddress::where('user_id', $id)->first();
        return view('front.show-order', compact('order', 'address'));
    }

    public function store(CheckoutRequest $request)
    {
        try {
            DB::beginTransaction();

            // التحقق من وجود منتجات في السلة
            if (Cart::isEmpty()) {
                throw new \Exception('السلة فارغة');
            }

            $user = null;
            $isGuest = !auth()->check();

            if (!$isGuest) {
                $user = auth()->user();
            }

            $order = new Order();

            // معالجة معلومات العنوان
            if ($isGuest) {

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

            // تهيئة قيم الطلب
            $order->total_price = 0;
            $order->promo_discount = 0;
            $order->total_after_discount = 0;
            $order->final_total = 0;
            $order->tax_amount = 0;
            $order->save();

            $totalPrice = 0;

            // معالجة منتجات السلة
            foreach (Cart::getContent() as $item) {
                $orderDetail = new OrderDetail();

                if ($item->attributes['product_type'] !== 'accessory') {
                    if ($item->attributes['product_type'] === 'earth') {
                        $bagPrice = $this->getBagPrice($item->attributes['category_id'], $item->attributes['bag_option']);
                    } else {
                        $bagPrice = 0;
                    }

                    $productPrice = $this->getTalbisaPrice($item->attributes['category_id'], $item->attributes['seat_count_id']);
                    $orderDetail->category_id = $item->attributes['category_id'];
                    $orderDetail->accessory_id = null;
                } else {
                    $bagPrice = 0;
                    $productPrice = $this->getAccessoryPrice($item->attributes['accessory_id']);
                    $orderDetail->category_id = null;
                    $orderDetail->accessory_id = $item->attributes['accessory_id'];

                    // التحقق من توفر الكمية للإكسسوارات
                    $accessory = Accessory::find($item->attributes['accessory_id']);
                    if (!$accessory || $accessory->quantity < $item->quantity) {
                        throw new \Exception('الكمية المطلوبة غير متوفرة من: ' . ($accessory ? $accessory->name : 'المنتج'));
                    }

                    $accessory->quantity -= $item->quantity;
                    $accessory->save();
                }

                $unitPrice = $bagPrice + $productPrice;
                $totalItemPrice = $unitPrice * $item->quantity;

                $orderDetail->order_id = $order->id;
                $orderDetail->parent_id = $item->attributes['parent_id'] ?? null;
                $orderDetail->product_type = $item->attributes['product_type'];
                $orderDetail->color_id = $item->attributes['color_id'] ?? null;
                $orderDetail->seat_count_id = $item->attributes['seat_count_id'] ?? null;
                $orderDetail->brand_id = $item->attributes['brand_id'] ?? null;
                $orderDetail->model_id = $item->attributes['model_id'] ?? null;
                $orderDetail->made_years = $item->attributes['made_years'] ?? null;
                $orderDetail->bag_option = $item->attributes['bag_option'] ?? null;
                $orderDetail->quantity = $item->quantity;
                $orderDetail->unit_price = $unitPrice;
                $orderDetail->total_price = $totalItemPrice;
                $orderDetail->save();

                $totalPrice += $totalItemPrice;
            }

            // معالجة كود الخصم
            if ($request->filled('promo_code')) {
                $promoCode = $this->validateAndApplyPromoCode(
                    $request->promo_code,
                    $totalPrice,
                    $user,
                    $order
                );
                $promoDiscount = $promoCode['discount'];
            } else {
                $promoDiscount = 0;
            }

            // حساب الضريبة والإجمالي النهائي
            $tax_rate = Setting::getValue('tax_rate');
            $tax_amount = ($totalPrice - $promoDiscount) * ($tax_rate / 100);

            // تحديث قيم الطلب النهائية
            $order->update([
                'total_price' => $totalPrice,
                'promo_discount' => $promoDiscount,
                'total_after_discount' => $totalPrice - $promoDiscount,
                'tax_amount' => $tax_amount,
                'final_total' => $totalPrice + $tax_amount + $shippingCost - $promoDiscount
            ]);

            // تفريغ السلة بعد نجاح العملية
            Cart::clear();

            DB::commit();
            session()->flash('success', 'تم إنشاء الطلب بنجاح');
            return response()->json([
                'success' => true,
                'order_id' => $order->id
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }

// دالة مساعدة للتحقق من كود الخصم وتطبيقه
    private function validateAndApplyPromoCode($code, $totalPrice, $user, $order)
    {
        $promoCode = PromoCode::where('code', $code)
            ->where('active', 1)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->first();

        if (!$promoCode) {
            throw new \Exception('كود الخصم غير صالح أو منتهي الصلاحية.');
        }

        if ($user) {
            $promoCodeUsed = DB::table('user_promocode')
                ->where('user_id', $user->id)
                ->where('promo_code_id', $promoCode->id)
                ->first();


            if (session()->has('editing_order_id')) {
                $editingOderId = session('editing_order_id');
                if ($promoCodeUsed && ($promoCodeUsed->order_id != $editingOderId)) {
                    throw new \Exception('لقد استخدمت هذا الكود من قبل.');
                }
            } else {
                if ($promoCodeUsed) {
                    throw new \Exception('لقد استخدمت هذا الكود من قبل.');
                }
            }

        }

        if ($totalPrice < $promoCode->min_amount) {
            throw new \Exception('يجب أن يكون إجمالي الطلب أكبر من ' . $promoCode->min_amount . ' لاستخدام هذا الكوبون.');
        }

        $discount = $promoCode->discount_type === 'percentage'
            ? ($totalPrice * $promoCode->discount) / 100
            : $promoCode->discount;

        // حفظ استخدام الكود
        DB::table('user_promocode')->insert([
            'user_id' => $user ? $user->id : null,
            'promo_code_id' => $promoCode->id,
            'order_id' => $order->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $order->update(['promocode_id' => $promoCode->id]);

        return [
            'promo_code' => $promoCode,
            'discount' => $discount
        ];
    }

    public function edit(Order $order)
    {
        // تفريغ السلة الحالية
        Cart::clear();

        if (!$order) {
            return redirect()->route('cart.show')->with('error', 'الطلب غير موجود.');
        }

        // التحقق من أن المستخدم الحالي هو صاحب الطلب
        if ($order->user_id) {
            if ($order->user_id !== auth()->user()?->id) {
                return redirect()->back()->with('error', 'لا يمكنك تعديل هذا الطلب.');
            }
        }

        if ($order->status->id != 1) {
            session()->forget('editing_order_id');
            return redirect()->route('home.index')->with('error', 'لا يمكنك تعديل الطلب حاليا.');
        }

        // إضافة المنتجات من الطلب إلى السلة
        foreach ($order->orderDetails as $detail) {
            if ($detail->product_type === 'accessory') {
                $itemData = $this->prepareAccessoryDataFromOrder($detail);
            } else {
                $itemData = $this->prepareTalbisaDataFromOrder($detail);
            }

            Cart::add($itemData);
        }

        // حفظ معرّف الطلب الجاري تعديله في الجلسة
        session()->put('editing_order_id', $order->id);

        // إعادة التوجيه إلى صفحة سلة التسوق مع تخزين الطلب في سلة البيانات
        return redirect()->route('home.shop-cart', $order->id);
    }

    protected function prepareAccessoryDataFromOrder($detail): array
    {
        $accessory = Accessory::findOrFail($detail->accessory_id);

        // إنشاء معرف فريد للإكسسوار
        $uniqueId = "acc_{$detail->accessory_id}";

        return [
            'id' => $uniqueId,
            'name' => $accessory->name,
            'price' => $detail->unit_price,
            'quantity' => $detail->quantity,
            'attributes' => [
                'product_type' => 'accessory',
                'accessory_id' => $detail->accessory_id,
                'category_id' => $detail->category_id,
                'color_id' => null,
                'seat_count_id' => null,
                'brand_id' => null,
                'model_id' => null,
                'made_years' => null,
                'bag_option' => null,
                'base_price' => $detail->unit_price,
                'bag_price' => 0,
                'image' => $accessory->images ? $accessory->images[0] : '',
                'parent_id' => $detail->parent_id ?? null,
            ]
        ];
    }

    protected function prepareTalbisaDataFromOrder($detail): array
    {
        $category = Category::findOrFail($detail->category_id);
        $coverColor = CoverColor::findOrFail($detail->color_id);

        $bag_price = 0;
        if ($detail->bag_option == 1) {
            $bag_price = BagOption::where('category_id', $detail->category_id)->first()->bag_price ?? 0;
        }


        // إنشاء معرف فريد للمنتج
        $idParts = [
            $detail->product_type,
            $detail->category_id,
            $detail->color_id,
            $detail->seat_count_id,
            $detail->brand_id,
            $detail->model_id,
            $detail->made_years,
            $detail->bag_option ? '1' : '0'
        ];

        $uniqueId = md5(implode('_', $idParts));

        return [
            'id' => $uniqueId,
            'name' => $category->name,
            'price' => $detail->unit_price,
            'quantity' => $detail->quantity,
            'attributes' => [
                'color_id' => $detail->color_id,
                'seat_count_id' => $detail->seat_count_id,
                'brand_id' => $detail->brand_id,
                'model_id' => $detail->model_id,
                'made_years' => $detail->made_years,
                'bag_option' => $detail->bag_option ?? null,
                'category_id' => $detail->category_id,
                'product_type' => $detail->product_type,
                'base_price' => ($detail->unit_price - $bag_price),
                'bag_price' => $bag_price,
                'image' => $coverColor->image ?? '',
                'accessory_id' => null,
                'parent_id' => $detail->parent_id ?? null
            ]
        ];
    }

    public function update(CheckoutRequest $request, Order $order)
    {
        try {
            DB::beginTransaction();

            // التحقق من أن المستخدم الحالي هو صاحب الطلب
            if ($order->user_id && $order->user_id !== auth()->user()?->id) {
                return redirect()->route('home.index')->with('error', 'لا يمكنك عرض هذا الطلب.');
            }

            if ($order->status->id != 1) {
                session()->forget('editing_order_id');
                return redirect()->route('home.index')->with('error', 'لا يمكنك تعديل الطلب حاليا.');
            }

            // التحقق من وجود منتجات في السلة
            if (Cart::isEmpty()) {
                throw new \Exception('السلة فارغة');
            }

            $isGuest = !$order->user;
            $user = $isGuest ? null : $order->user;

            // معالجة معلومات العنوان
            if ($isGuest) {
                $guest = GuestAddress::updateOrCreate(
                    ['id' => $order->guest_address_id],
                    [
                        'full_name' => $request->full_name,
                        'phone' => $request->phone,
                        'address' => $request->address,
                        'city' => $request->city,
                        'state' => $request->state,
                    ]
                );
            } else {
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

            //حذف المنتجات السابقة في الاوردر ديتيلز
            foreach ($order->orderDetails as $detail) {
                if ($detail->product_type == 'accessory') {
                    $accessory = Accessory::findOrFail($detail->accessory_id);
                    $accessory->quantity += $detail->quantity;
                    $accessory->save();
                }
            }
            $order->orderDetails()->delete();


            // إضافة تكلفة الشحن
            $shippingCost = ShippingRate::where('state', $request->state)->first()->shipping_cost;

            $totalPrice = 0;

            // معالجة منتجات السلة
            $items = Cart::getContent();
            foreach ($items as $item) {
                $orderDetail = new OrderDetail();

                if ($item->attributes['product_type'] !== 'accessory') {
                    if ($item->attributes['product_type'] === 'earth') {
                        $bagPrice = $this->getBagPrice($item->attributes['category_id'], $item->attributes['bag_option']);
                    } else {
                        $bagPrice = 0;
                    }

                    $productPrice = $this->getTalbisaPrice($item->attributes['category_id'], $item->attributes['seat_count_id']);
                    $orderDetail->category_id = $item->attributes['category_id'];
                    $orderDetail->accessory_id = null;
                } else {
                    $bagPrice = 0;
                    $productPrice = $this->getAccessoryPrice($item->attributes['accessory_id']);
                    $orderDetail->category_id = null;
                    $orderDetail->accessory_id = $item->attributes['accessory_id'];

                    // التحقق من توفر الكمية للإكسسوارات
                    $accessory = Accessory::find($item->attributes['accessory_id']);
                    if (!$accessory || $accessory->quantity < $item->quantity) {
                        throw new \Exception('الكمية المطلوبة غير متوفرة من: ' . ($accessory ? $accessory->name : 'المنتج'));
                    }

                    $accessory->quantity -= $item->quantity;
                    $accessory->save();
                }

                $unitPrice = $bagPrice + $productPrice;
                $totalItemPrice = $unitPrice * $item->quantity;

                $orderDetail->order_id = $order->id;
                $orderDetail->parent_id = $item->attributes['parent_id'] ?? null;
                $orderDetail->product_type = $item->attributes['product_type'];
                $orderDetail->color_id = $item->attributes['color_id'] ?? null;
                $orderDetail->seat_count_id = $item->attributes['seat_count_id'] ?? null;
                $orderDetail->brand_id = $item->attributes['brand_id'] ?? null;
                $orderDetail->model_id = $item->attributes['model_id'] ?? null;
                $orderDetail->made_years = $item->attributes['made_years'] ?? null;
                $orderDetail->bag_option = $item->attributes['bag_option'] ?? null;
                $orderDetail->quantity = $item->quantity;
                $orderDetail->unit_price = $unitPrice;
                $orderDetail->total_price = $totalItemPrice;
                $orderDetail->save();

                $totalPrice += $totalItemPrice;
            }

            // معالجة كود الخصم
            if ($request->filled('promo_code')) {
                $promoCode = $this->validateAndApplyPromoCode(
                    $request->promo_code,
                    $totalPrice,
                    $user,
                    $order
                );
                $promoDiscount = $promoCode['discount'];
            } else {
                $promoDiscount = 0;
            }

            // حساب الضريبة والإجمالي النهائي
            $tax_rate = Setting::getValue('tax_rate');
            $tax_amount = ($totalPrice - $promoDiscount) * ($tax_rate / 100);

            // تحديث قيم الطلب النهائية
            $order->update([
                'total_price' => $totalPrice,
                'shipping_cost' => $shippingCost,
                'promo_discount' => $promoDiscount,
                'total_after_discount' => $totalPrice - $promoDiscount,
                'tax_amount' => $tax_amount,
                'final_total' => $totalPrice + $tax_amount + $shippingCost - $promoDiscount
            ]);

            // تفريغ السلة بعد نجاح العملية
            Cart::clear();
            session()->forget('editing_order_id');
            session()->flash('success', 'تم تعديل الطلب بنجاح');

            DB::commit();

            return response()->json([
                'success' => true,
                'order_id' => $order->id
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }
    private function calculateDiscount(User $user, $totalPrice)
    {
        if ($user->is_vip) {
            // تحقق من صلاحية فترة VIP
            if ($user->vip_start_date <= now() && $user->vip_end_date >= now()) {
                return $totalPrice * ($user->discount / 100);
            }
            // إذا انتهت فترة VIP، قم بتحديث نوع العميل
            $user->is_vip = null;
            $user->discount = null;
            $user->save();
            return 0;
        }
        return 0;
    }

    public function checkCoupon(Request $request)
    {

        $couponCode = $request->input('promo_code');
        $orderTotal = $request->input('total_order'); // إجمالي الطلب
        $user_id = $request->input('user_id');

        if (!$user_id) {
            return response()->json(['error' => 'كوبونات الخصم للأعضاء المسجلين فقط']);
        }

        // ابحث عن الكوبون بناءً على الكود المدخل
        $coupon = PromoCode::where('code', $couponCode)
            ->where('active', 1)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->first();

        // التحقق من وجود الكوبون
        if (!$coupon) {
            return response()->json(['valid' => false, 'error' => 'كود الخصم غير صحيح أو غير صالح']);
        }

        // تحقق إذا كان المستخدم قد استخدم الكوبون من قبل
        $couponUsed = DB::table('user_promocode')
            ->where('user_id', $user_id)
            ->where('promo_code_id', $coupon->id)
            ->first();

        // إذا كان المستخدم يقوم بتعديل الطلب
        if (session()->has('editing_order_id')) {
            $editingOrderId = session('editing_order_id');

            if ($couponUsed && $couponUsed->order_id != $editingOrderId) {
                return response()->json(['valid' => false, 'error' => 'لقد قمت باستخدام هذا الكوبون في طلب آخر من قبل']);
            }
        } else {
            // إذا كان المستخدم يقوم بإنشاء طلب جديد
            if ($couponUsed) {
                return response()->json(['valid' => false, 'error' => 'لقد قمت باستخدام هذا الكوبون من قبل']);
            }
        }


        // التحقق من الحد الأدنى لقيمة الطلب
        if ($orderTotal < $coupon->min_amount) {
            return response()->json(['error' => 'إجمالي الطلب أقل من الحد الأدنى لتطبيق الكوبون']);
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

    public function getShippingCost($state)
    {
        $shippingCost = ShippingRate::where('id', $state)->first()->shipping_cost;

        return response()->json(['shipping_cost' => $shippingCost]);
    }


    public function clearCartSession()
    {
        Cart::clear();
        \session()->forget('editing_order_id');
        return redirect()->route('home.index')->with('success',' تم إلغاء وضع تعديل الاوردر الخاص بك');
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
