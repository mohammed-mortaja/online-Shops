<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $owners = Owner::orderBy('id', 'desc')->paginate(5);
        return response()->view('dashboard.owner.index', compact('owners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::all();
        return response()->view('dashboard.owner.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = validator($request->all() , [
            'first_name' => 'required|max:15|min:3',
            'last_name' => 'required|max:15|min:3' ,
            'mobile' => 'required' ,
            'email' => 'required|email|unique:owners,email',
            // 'image'=>"required|image|max:2048|mimes:png,jpg,jpeg,pdf",

        ] ,[
            'first_name' => 'الاسم الاول مطلوب',
            'last_name' => 'الاسم الثاني مطلوب',
        ]);
        if (!$validator->fails()) {
            $owners = new Owner();
            $owners->email = $request->get('email');
            $owners->payment_required = $request->get('payment_required');
            $owners->payment_paid = $request->get('payment_paid');
            $owners->payment_not_paid = $request->get('payment_not_paid');
            $owners->password = Hash::make($request->get('password'));
            $isSaved = $owners->save();
            if ($isSaved) {
                $users = new User();

                if (request()->hasFile('image')) {

                    $image = $request->file('image');

                    $imageName = time() . 'image.' . $image->getClientOriginalExtension();

                    $image->move('storage/images/Owner', $imageName);

                    $users->image = $imageName;
                }
                // $roles = Role::findOrFail($request->get('role_id'));
                // $owners->assignRole($roles);
                $users->name = $request->get('first_name') . " " . $request->get('last_name');
                $users->mobile = $request->get('mobile');
                $users->gender = $request->get('gender');
                $users->address = $request->get('address');
                $users->city_id = $request->get('city_id');


                $users->actor()->associate($owners);
                $isSaved = $users->save();

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
        $owners = Owner::findOrFail($id);

        return response()->view('dashboard.owner.edit', compact('owners'));
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

        $validator = validator($request->all() , [
            // 'first_name' => 'required',
            // 'last_name' => 'required' ,
            'mobile' => 'required' ,
            'email' => 'required|email' ,
            // 'image'=>"required|image|max:2048|mimes:png,jpg,jpeg,pdf",

        ] ,[
            'first_name' => 'الاسم الاول مطلوب',
            'last_name' => 'الاسم الثاني مطلوب',
        ]);

        if (!$validator->fails()) {
            $owners = Owner::findOrFail($id);
            $owners->email = $request->get('email');
            $isSaved = $owners->save();
            if ($isSaved) {
                $users = $owners->user;
                $users->name = $request->get('name');
                $users->mobile = $request->get('mobile');
                $users->gender = $request->get('gender');
                $users->address = $request->get('address');
                $users->actor()->associate($owners);
                $isUpdated = $users->save();
                if ($isUpdated) {
                    return ['redirect' => route('owners.index')];
                }
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
        $owners = Owner::findOrFail($id);
        $users = $owners->user;
        $deleteUser = User::destroy($users->id);
        $deleteOwner = Owner::destroy($id);
        return response()->json(['icon' => 'success', 'title' => 'Deleted is Successfully'], $owners ? 200 : 400);
    }
}
