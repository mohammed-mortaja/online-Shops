<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;

use App\Models\City;
use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::all();

        $stores = Store::orderBy('id', 'desc')->paginate(5);
        return response()->view('dashboard.store.index', compact('stores', 'cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::all();
        return response()->view('dashboard.store.create', compact('cities'));
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
            'phone_number' => 'required',
            // 'image'=>"required|image|max:2048|mimes:png,jpg,jpeg,pdf",

        ], [
            'name' => 'الاسم  مطلوب',
        ]);
        if (!$validator->fails()) {
            $stores = new Store();
            $stores->name = $request->get('name');
            $stores->phone_number = $request->get('phone_number');
            $stores->description = $request->get('description');
            $stores->address = $request->get('address');
            $stores->status = $request->get('status');
            $stores->city_id = $request->get('city_id');

            function uploadImage($request, $fieldName, $storagePath, $prefix = '')
            {
                if ($request->hasFile($fieldName)) {
                    $image = $request->file($fieldName);
                    $imageName = time() . $prefix . '.' . $image->getClientOriginalExtension();
                    $image->move($storagePath, $imageName);
                    return $imageName;
                }
                return null;
            }

            $stores->logo_image = uploadImage($request, 'logo_image', 'storage/images/store', 'logo_image');
            $stores->cover_image = uploadImage($request, 'cover_image', 'storage/images/Store', 'cover_image');


            // if (request()->hasFile('logo_image')) {

            //     $image = $request->file('logo_image');

            //     $imageName = time() . 'logo_image.' . $image->getClientOriginalExtension();

            //     $image->move('storage/images/store', $imageName);

            //     $stores->logo_image = $imageName;
            // }

            // if (request()->hasFile('cover_image')) {

            //     $image = $request->file('cover_image');

            //     $imageName = time() . 'cover_image.' . $image->getClientOriginalExtension();

            //     $image->move('storage/images/Store', $imageName);

            //     $stores->cover_image = $imageName;
            // }

            $isSaved = $stores->save();
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // الحصول على المتجر المطلوب بناءً على ال ID المعطى
        $stores = Store::findOrFail($id);

        // استرداد قائمة المدن من قاعدة البيانات
        $cities = City::all();

        // تمرير البيانات إلى واجهة التعديل
        return view('dashboard.store.edit', ['stores' => $stores, 'cities' => $cities]);
        // return view('dashboard.store.edit', compact('stores' , 'cities'));

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validator = validator($request->all(), [
            'name' => 'required|max:15|min:3',
            'phone_number' => 'required',
            // 'image'=>"required|image|max:2048|mimes:png,jpg,jpeg,pdf",

        ], [
            'name' => 'الاسم  مطلوب',
        ]);
        if (!$validator->fails()) {
            $stores = Store::findOrFail($id);
            $stores->name = $request->get('name');
            $stores->phone_number = $request->get('phone_number');
            $stores->description = $request->get('description');
            $stores->address = $request->get('address');
            $stores->status = $request->get('status');
            $stores->city_id = $request->get('city_id');

            if (request()->hasFile('logo_image')) {
                // Delete the previous image
                if (file_exists(public_path('storage/images/Store/' . $stores->logo_image))) {
                    unlink(public_path('storage/images/Store/' . $stores->logo_image));
                }

                $image = $request->file('logo_image');
                $imageName = time() . 'logo_image.' . $image->getClientOriginalExtension();

                $image->move('storage/images/Store', $imageName);

                $stores->logo_image = $imageName;
            }

            if (request()->hasFile('cover_image')) {
                // Delete the previous image
                if (file_exists(public_path('storage/images/Store/' . $stores->cover_image))) {
                    unlink(public_path('storage/images/Store/' . $stores->cover_image));
                }

                $image = $request->file('cover_image');
                $imageName = time() . 'cover_image.' . $image->getClientOriginalExtension();

                $image->move('storage/images/Store', $imageName);

                $stores->cover_image = $imageName;
            }


            $isUpdate = $stores->save();
            return ['redirect' => route('stores.index')];

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stores = Store::findOrFail($id);

        if ($stores->logo_image && file_exists(public_path('storage/images/store/' . $stores->logo_image))) {
            unlink(public_path('storage/images/store/' . $stores->logo_image));
        }
        if ($stores->cover_image && file_exists(public_path('storage/images/store/' . $stores->cover_image))) {
            unlink(public_path('storage/images/store/' . $stores->cover_image));
        }

        $deleted = Store::destroy($id);

        if ($deleted) {
            return response()->json(['icon' => 'success', 'title' => 'تم الحذف  بنجاح'], 200);
        } else {
            return response()->json(['icon' => 'error', 'title' => 'حدث خطأ ما أثناء الحذف'], 400);
        }
    }
}
