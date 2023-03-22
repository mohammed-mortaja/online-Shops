<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sub_categories = SubCategory::all();

        
        $products = Product::with('SubCategory')->orderBy('id', 'desc')->paginate(5);

        return response()->view('dashboard.product.index', compact('products','sub_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sub_categories = SubCategory::all();
        return response()->view('dashboard.product.create', compact('sub_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = validator($request->all(), [
            'product_name' => 'required|max:15|min:3',

            // 'image'=>"required|image|max:2048|mimes:png,jpg,jpeg,pdf",

        ], [
            'product_name' => 'الاسم  مطلوب',
        ]);
        if (!$validator->fails()) {
            $products = new Product();
            $products->product_name = $request->get('product_name');
            $products->product_prise = $request->get('product_prise');
            $products->sub_category_id = $request->get('sub_category_id');

            if(request()->hasFile('image')){

                $image = $request->file('image');
                $imageName = time().'image.'. $image->getClientOriginalExtension();
                $image->move('storage/images/product',$imageName);
                $products->image = $imageName;
                }




            $isSaved = $products->save();
            if ($isSaved) {

                return response()->json(['icon' => 'success', 'title' => 'تمت الإضافة بنجاح'], 200);
            } else {
                return response()->json(['icon' => 'error', 'title' => 'فشلت عملية الاضافة '], 400);
            }
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // الحصول على التصنيف الفرعي  المطلوب بناءً على ال ID المعطى
        $products = Product::findOrFail($id);

        // استرداد قائمة التصنيف من قاعدة البيانات
        $sub_categories = SubCategory::all();

        // تمرير البيانات إلى واجهة التعديل

         return view('dashboard.product.edit', compact('products' , 'sub_categories'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validator = validator($request->all(), [
            'product_name' => 'required|max:29|min:3',

            // 'image'=>"required|image|max:2048|mimes:png,jpg,jpeg,pdf",

        ], [
            'product_name' => 'الاسم  مطلوب',
        ]);
        if (!$validator->fails()) {
            $products = Product::findOrFail($id);
            $products->product_name = $request->get('product_name');
            $products->product_prise = $request->get('product_prise');
            $products->sub_category_id = $request->get('sub_category_id');

            if (request()->hasFile('image')) {
                // Delete the previous image
                if (file_exists(public_path('storage/images/product/' . $products->image))) {
                    unlink(public_path('storage/images/product/' . $products->image));
                }

                $image = $request->file('image');
                $imageName = time() . 'image.' . $image->getClientOriginalExtension();

                $image->move('storage/images/product', $imageName);

                $products->image = $imageName;
            }




            $isUpdate = $products->save();
            return ['redirect' => route('products.index')];

            if ($isUpdate) {


                return response()->json(['icon' => 'success', 'title' => 'تمت التعديل بنجاح'], 200);
            } else {
                return response()->json(['icon' => 'error', 'title' => 'فشلت التعديل الاضافة '], 400);
            }
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $products = Product::findOrFail($id);

        if ($products->image && file_exists(public_path('storage/images/product/' . $products->image))) {
            unlink(public_path('storage/images/product/' . $products->image));
        }


        $deleted = Product::destroy($id);

        if ($deleted) {
            return response()->json(['icon' => 'success', 'title' => 'تم الحذف  بنجاح'], 200);
        } else {
            return response()->json(['icon' => 'error', 'title' => 'حدث خطأ ما أثناء الحذف'], 400);
        }
    }
}
