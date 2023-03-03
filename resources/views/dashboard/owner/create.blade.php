@extends('dashboard.parent')

@section('title', 'المالك')





@section('styles')

@endsection

@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title float-left">انشاء المالك</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="create_form">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="first_name">الاسم الأول </label>
                                        <input type="text" name="first_name" class="form-control" id="first_name"
                                            placeholder=" أدخل اسم المالك الأول ">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="last_name">الاسم الأخير </label>
                                        <input type="text" name="last_name" class="form-control" id="last_name"
                                            placeholder="أدخل اسم المالك الأخير ">
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="email"> الايميل </label>
                                        <input type="email" name="email" class="form-control" id="email"
                                            placeholder="أدخل ايميل المالك  ">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="password"> كلمة المرور </label>
                                        <input type="password" name="password" class="form-control" id="password"
                                            placeholder="أدخل كلمة المرور   ">
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="mobile"> رقم الجوال </label>
                                        <input type="text" name="mobile" class="form-control" id="mobile"
                                            placeholder="أدخل رقم المالك  ">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="gender"> الجنس</label>
                                        <select class="form-control" name="gender" style="width: 100%;" id="gender"
                                            aria-label=".form-select-sm example">
                                            {{-- <option selected> {{ $owners->user->job_title }} </option> --}}
                                            <option value="male"> ذكر </option>
                                            <option value="female">أنثى</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="image"> Image </label>
                                        <input type="file" name="image" class="form-control" id="image"
                                            placeholder="Enter Image">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="adress"> العنوان </label>
                                        <input type="text" name="address" class="form-control" id="address"
                                            placeholder="أدخل عنوان المالك  ">
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="role_id"> المسمى الوظيفي </label>
                                        <select class="form-control select22" name="role_id" style="width: 100%;" id="role_id"
                                            aria-label=".form-select-sm example">
                                            {{-- @foreach ($roles as $role)
                                                <option value="{{ $role->id }}"> {{ $role->name }} </option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="city_id">اسم المدينة</label>
                                        <select class="form-control" name="city_id" style="width: 100%;"
                                            id="city_id" aria-label=".form-select-sm example">
                                            @foreach ($cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->name }}</option>

                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="payment_required"> المبلغ المطلوب </label>
                                        <input type="text" name="payment_required" class="form-control" id="payment_required"
                                            placeholder="ادخل الدفعة المطلوبة من التاجر">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="payment_paid"> المبلغ المدفوع  </label>
                                        <input type="text" name="payment_paid" class="form-control" id="payment_paid"
                                            placeholder="أدخل ماتم دفعه من التاجر   ">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="payment_not_paid"> المبلغ المتبقي </label>
                                        <input type="text" name="payment_not_paid" class="form-control" id="payment_not_paid"
                                            placeholder="أدخل المتبقي دفعه من التاجر   ">
                                    </div>

                                </div>





                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="button" onclick="performStore()"
                                        class="btn btn-lg btn-success">حفظ</button>

                                    <a href="{{ route('owners.index') }}" type="submit"
                                        class="btn btn-lg btn-secondary">إلغاء</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    </section>
    <!-- /.content -->

@endsection

@section('script')
    <script>


// $('.city_id').select2({
//       theme: 'bootstrap4'
//     });


        function performStore() {
            let formData = new FormData();
            formData.append('first_name', document.getElementById('first_name').value);
            // formData.append('role_id', document.getElementById('role_id').value);
            formData.append('last_name', document.getElementById('last_name').value);
            formData.append('mobile', document.getElementById('mobile').value);
            formData.append('email', document.getElementById('email').value);
            formData.append('password', document.getElementById('password').value);
            formData.append('gender', document.getElementById('gender').value);
            formData.append('address', document.getElementById('address').value);
            formData.append('payment_required', document.getElementById('payment_required').value);
            formData.append('payment_paid', document.getElementById('payment_paid').value);
            formData.append('payment_not_paid', document.getElementById('payment_not_paid').value);
            formData.append('image', document.getElementById('image').files[0]);
            formData.append('city_id',document.getElementById('city_id').value);

            store('/dashboard/admin/owners', formData);
        }
    </script>
@endsection
