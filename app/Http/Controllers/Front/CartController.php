<?php

namespace App\Http\Controllers\Front;

use App\Http\Requests\AddToCartRequest;
use App\Models\Admin\Accessory;
use App\Models\Admin\BagOption;
use App\Models\Admin\CarBrand;
use App\Models\Admin\CarModel;
use App\Models\Admin\Category;
use App\Models\Admin\CoverColor;
use App\Models\Admin\Order;
use App\Models\Admin\SeatCount;
use App\Models\Admin\SeatPrice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{   // إضافة المنتج إلى السلة
    public function addToCart(AddToCartRequest $request)
    {
        try {
            $validated = $request->validated();

            if ($validated['product_type'] === 'accessory') {
                $itemData = $this->prepareAccessoryData($validated);
            } else {
                $itemData = $this->prepareTalbisaProductData($validated);
            }

            // إذا كان المنتج موجود بالفعل، قم بتحديث الكمية بدلاً من إضافة عنصر جديد
            if (Cart::has($itemData['id'])) {
                $existingItem = Cart::get($itemData['id']);
                $newQuantity = $existingItem->quantity + $itemData['quantity'];

                Cart::update($itemData['id'], [
                    'quantity' => [
                        'relative' => false,
                        'value' => $newQuantity
                    ]
                ]);
            } else {
                Cart::add($itemData);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'تم إضافة المنتج للسلة بنجاح',
                'cart_count' => Cart::getTotalQuantity(),
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'حدث خطأ أثناء إضافة المنتج للسلة: ' . $e->getMessage()
            ], 422);
        }
    }


    // تحديث كمية المنتج في السلة صفحة الشوبينج كارت
    public function updateCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');
        $product = Product::find($productId);


        $freeProducts = 0;

        // جلب نوع العميل
        $customerOfferType = auth()->check() ? auth()->user()->customer_type : 'regular'; // نوع العميل الافتراضي هو "reqular"

        // الحصول على العرض المناسب من الـ Accessor
        $offer = $product->getOfferDetails($customerOfferType);

        // التأكد إذا كان المنتج يحتوي على عرض
        if ($offer && $quantity >= $offer->offer_quantity) {
            // حساب عدد المنتجات المجانية التي يستحقها العميل
            $freeProducts = floor($quantity / $offer->offer_quantity) * $offer->free_quantity;
        }

        // تحديث السلة بالمنتج والكميات المجانية
        Cart::update($productId, [
            'quantity' => [
                'relative' => false,
                'value' => $quantity
            ],
            'price' => $product->discounted_price,
            'attributes' => [
                'free_quantity' => $freeProducts // إضافة الكمية المجانية في attributes
            ]
        ]);

        return response()->json([
            'success' => true,
            'message' => 'تم تحديث السلة بنجاح.',
            'free_quantity' => $freeProducts,
        ]);
    }

    // تفاصيل محتويات السلة كاملة بصفحة الشوبينج كارت
    public function shoppingCartDetails(Order $order = null)
    {
        $cartItems = Cart::getContent();
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
        $totalPrice = Cart::getTotal();

        return view('front.shopping_cart', compact(['formattedItems', 'totalPrice', 'totalQuantity', 'order']));
    }


    // الحصول على تفاصيل عربة السلة في السايد مينيو
    public function getCartDetails()
    {
        // جلب نوع العميل
        $customerOfferType = auth()->check() ? auth()->user()->customer_type : 'regular'; // نوع العميل الافتراضي هو "reqular"

        $items = Cart::getContent()->map(function ($item) use ($customerOfferType) {
            $product = Product::find($item->id);

            // تجاهل المنتجات التي لم يتم العثور عليها وحذفها من العربة
            if (!$product) {
                Cart::remove($item->id); // حذف المنتج من العربة
                return null;
            }

            $quantity = $item->quantity;
            $freeProducts = 0;

            // جلب نوع العميل
            $customerOfferType = auth()->check() ? auth()->user()->customer_type : 'regular'; // نوع العميل الافتراضي هو "reqular"

            // الحصول على العرض المناسب من الـ Accessor
            $offer = $product->getOfferDetails($customerOfferType);

            // التأكد إذا كان المنتج يحتوي على عرض
            if ($offer && $quantity >= $offer->offer_quantity) {
                // حساب عدد المنتجات المجانية التي يستحقها العميل
                $freeProducts = floor($quantity / $offer->offer_quantity) * $offer->free_quantity;
            }

            // تحديث بيانات العنصر مع خصم السعر
            $item->price = $product->discounted_price;
            $item->id = $product->id;
            $item->name = $product->name;
            $item->attributes['url'] = route('product.show', $product->id);

            // التحقق من وجود صورة وإذا لم توجد إضافة صورة افتراضية
            $item->attributes['image'] = $product?->images?->first()?->path ?? 'path/to/default_image.png';
            $item->attributes['free_quantity'] = $freeProducts; // إضافة عدد المنتجات المجانية

            return $item;
        })->filter(); // فلترة العناصر التي تم حذفها (null)

        $totalQuantity = Cart::getTotalQuantity();

        // حساب الإجمالي مع التعامل الآمن مع المنتجات المحذوفة
        $totalPrice = $items->sum(function ($item) {
            return $item->price * $item->quantity;
        });


        // إذا كان هناك طلب مخزن في الجلسة
        $order = session('order_id') ? Order::find(session('order_id')) : null;

        return response()->json([
            'order' => $order,
            'items' => $items->values()->toArray(), // تحويل العناصر إلى Array
            'totalQuantity' => $totalQuantity,
            'totalPrice' => $totalPrice,
        ]);
    }


    // حذف المنتج من السلة
    public function removeFromCart($id)
    {
        Cart::remove($id);

        return response()->json(['success' => true, 'message' => 'Product removed from cart successfully.']);
    }

// تفريغ العربة
    public function clear()
    {
        Cart::clear();
    }

    // دالة لتحديث أسعار السلة
    public function refreshCartPrices()
    {
        $userType = Auth::user()?->customer_type;

        if ($userType == 'goomla') {
            $this->clear();
        }
    }


    protected function prepareAccessoryData(array $data): array
    {
        $accessory = Accessory::findOrFail($data['accessory_id']);

        // إنشاء معرف فريد للإكسسوار باستخدام رقم الإكسسوار
        $uniqueId = "acc_{$data['accessory_id']}";

        return [
            'id' => $uniqueId,
            'name' => $accessory->name,
            'price' => $accessory->discounted_price,
            'quantity' => $data['product_count'],
            'attributes' => [
                'product_type' => 'accessory',
                'accessory_id' => $data['accessory_id'],
                'category_id' => $accessory->category_id,
                'color_id' => null,
                'seat_count_id' => null ,
                'brand_id' => null,
                'model_id' => null,
                'made_years' => null,
                'bag_option' => null,
                'base_price' => $accessory->discounted_price,
                'bag_price' => 0,
                'image' =>$accessory->images ? $accessory->images[0] :'',
            ]
        ];
    }

    protected function prepareTalbisaProductData(array $data): array
    {
        $category = Category::findOrFail($data['category_id']);
        $coverColor = CoverColor::findOrFail($data['cover_color']);

        // حساب السعر الأساسي
        $basePrice = SeatPrice::where([
            'seat_count_id' => $data['seat_count'],
            'category_id' => $data['category_id']
        ])->firstOrFail()->price;

        // حساب سعر الشنطة إذا تم اختيارها
        $bagPrice = 0;
        if ($data['bag_option'] ?? false) {
            $bagPrice = BagOption::where('category_id', $data['category_id'])
                ->firstOrFail()
                ->bag_price;
        }

        $totalPrice = $basePrice + $bagPrice;

        // إنشاء معرف فريد مركب من خصائص المنتج
        $uniqueId = $this->generateProductUniqueId($data);
        return [
            'id' => $uniqueId,
            'name' => $category->name,
            'price' => $totalPrice,
            'quantity' => $data['product_count'],
            'attributes' => [
                'color_id' => $data['cover_color'],
                'seat_count_id' => $data['seat_count'] ,
                'brand_id' => $data['car_brand'],
                'model_id' => $data['car_model'],
                'made_years' => $data['made_year'],
                'bag_option' => $data['bag_option'] ?? null,
                'category_id' => $data['category_id'],
                'product_type' => $data['product_type'],
                'base_price' => $basePrice,
                'bag_price' => $bagPrice,
                'image' => $coverColor->image,
                'accessory_id'=>null,
            ]
        ];
    }

    protected function generateProductUniqueId(array $data): string
    {
        // إنشاء معرف فريد مركب من جميع الخصائص المهمة
        $idParts = [
            $data['product_type'],
            $data['category_id'],
            $data['cover_color'],
            $data['seat_count'],
            $data['car_brand'],
            $data['car_model'],
            $data['made_year'],
            $data['bag_option'] ?? '0'
        ];

        // دمج جميع الخصائص مع فاصل وتشفيرها لتكوين معرف فريد
        return md5(implode('_', $idParts));
    }
}



