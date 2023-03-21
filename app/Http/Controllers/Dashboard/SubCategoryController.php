<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;


use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        //$categories = Category::orderBy('id', 'desc')->paginate(5);
        $sub_categories = SubCategory::with('category')->orderBy('id', 'desc')->paginate(5);

        return response()->view('dashboard.sub_category.index', compact('sub_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return response()->view('dashboard.sub_category.create', compact('categories'));
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
            $sub_categories = new SubCategory();
            $sub_categories->name = $request->get('name');
            $sub_categories->category_id = $request->get('category_id');

            if(request()->hasFile('image')){

                $image = $request->file('image');
                $imageName = time().'image.'. $image->getClientOriginalExtension();
                $image->move('storage/images/sub_category',$imageName);
                $sub_categories->image = $imageName;
                }




            $isSaved = $sub_categories->save();
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
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // الحصول على التصنيف الفرعي  المطلوب بناءً على ال ID المعطى
        $sub_categories = SubCategory::findOrFail($id);

        // استرداد قائمة التصنيف من قاعدة البيانات
        $categories = Category::all();

        // تمرير البيانات إلى واجهة التعديل

         return view('dashboard.sub_category.edit', compact('sub_categories' , 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validator = validator($request->all(), [
            'name' => 'required|max:29|min:3',

            // 'image'=>"required|image|max:2048|mimes:png,jpg,jpeg,pdf",

        ], [
            'name' => 'الاسم  مطلوب',
        ]);
        if (!$validator->fails()) {
            $sub_categories = SubCategory::findOrFail($id);
            $sub_categories->name = $request->get('name');
            $sub_categories->category_id = $request->get('category_id');

            if (request()->hasFile('image')) {
                // Delete the previous image
                if (file_exists(public_path('storage/images/sub_category/' . $sub_categories->image))) {
                   // unlink(public_path('storage/images/sub_category/' . $sub_categories->image));
                }

                $image = $request->file('image');
                $imageName = time() . 'image.' . $image->getClientOriginalExtension();

                $image->move('storage/images/sub_category', $imageName);

                $sub_categories->image = $imageName;
            }




            $isUpdate = $sub_categories->save();
            return ['redirect' => route('sub_categories.index')];

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
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $sub_categories = SubCategory::findOrFail($id);

        if ($sub_categories->image && file_exists(public_path('storage/images/sub_category/' . $sub_categories->image))) {
            unlink(public_path('storage/images/sub_category/' . $sub_categories->image));
        }


        $deleted = SubCategory::destroy($id);

        if ($deleted) {
            return response()->json(['icon' => 'success', 'title' => 'تم الحذف  بنجاح'], 200);
        } else {
            return response()->json(['icon' => 'error', 'title' => 'حدث خطأ ما أثناء الحذف'], 400);
        }
    }
}
