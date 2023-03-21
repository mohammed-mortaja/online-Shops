<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\Store;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = Store::all();

        //$categories = Category::orderBy('id', 'desc')->paginate(5);
        $categories = Category::with('store')->orderBy('id', 'desc')->paginate(5);

        return response()->view('dashboard.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stores = Store::all();
        return response()->view('dashboard.category.create', compact('stores'));
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
            'name' => 'required|max:15|min:3',

            // 'image'=>"required|image|max:2048|mimes:png,jpg,jpeg,pdf",

        ], [
            'name' => 'الاسم  مطلوب',
        ]);
        if (!$validator->fails()) {
            $categories = new Category();
            $categories->name = $request->get('name');
            $categories->store_id = $request->get('store_id');

            if(request()->hasFile('image')){

                $image = $request->file('image');
                $imageName = time().'image.'. $image->getClientOriginalExtension();
                $image->move('storage/images/category',$imageName);
                $categories->image = $imageName;
                }




            $isSaved = $categories->save();
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
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // الحصول على التصنيف المطلوب بناءً على ال ID المعطى
        $categories = Category::findOrFail($id);

        // استرداد قائمة المتاجر من قاعدة البيانات
        $stores = Store::all();

        // تمرير البيانات إلى واجهة التعديل
        //return view('dashboard.category.edit', ['categories' => $categories, 'stores' => $stores]);
         return view('dashboard.category.edit', compact('categories' , 'stores'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validator = validator($request->all(), [
            'name' => 'required|max:15|min:3',

            // 'image'=>"required|image|max:2048|mimes:png,jpg,jpeg,pdf",

        ], [
            'name' => 'الاسم  مطلوب',
        ]);
        if (!$validator->fails()) {
            $categories = Category::findOrFail($id);
            $categories->name = $request->get('name');
            $categories->store_id = $request->get('store_id');

            if (request()->hasFile('image')) {
                // Delete the previous image
                if (file_exists(public_path('storage/images/category/' . $categories->image))) {
                    unlink(public_path('storage/images/category/' . $categories->image));
                }

                $image = $request->file('image');
                $imageName = time() . 'image.' . $image->getClientOriginalExtension();

                $image->move('storage/images/category', $imageName);

                $categories->image = $imageName;
            }




            $isUpdate = $categories->save();
            return ['redirect' => route('categories.index')];

            if ($isUpdate) {


                return response()->json(['icon' => 'success', 'title' => 'تمت الإضافة بنجاح'], 200);
            } else {
                return response()->json(['icon' => 'error', 'title' => 'فشلت عملية الاضافة '], 400);
            }
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $categories = Category::findOrFail($id);
        $categories->sub_categories()->Delete();

        if ($categories->image && file_exists(public_path('storage/images/category/' . $categories->image))) {
            unlink(public_path('storage/images/category/' . $categories->image));
        }


        $deleted = Category::destroy($id);

        if ($deleted) {
            return response()->json(['icon' => 'success', 'title' => 'تم الحذف  بنجاح'], 200);
        } else {
            return response()->json(['icon' => 'error', 'title' => 'حدث خطأ ما أثناء الحذف'], 400);
        }
    }
}
