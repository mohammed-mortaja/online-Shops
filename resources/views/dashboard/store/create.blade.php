@extends('dashboard.parent')

@section('title', 'المتجر')





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
                            <h3 class="card-title float-left">انشاء المتجر</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="create_form">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="name">اسم المتجر </label>
                                        <input type="text" name="name" class="form-control" id="name"
                                            placeholder=" أدخل اسم المتجر  ">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="status"> الحالة</label>
                                        <select class="form-control" name="gender" style="width: 100%;" id="status"
                                            aria-label=".form-select-sm example">
                                            {{-- <option selected> {{ $owners->user->job_title }} </option> --}}
                                            <option value="active"> فعال </option>
                                            <option value="inactive">غير فعال</option>
                                        </select>
                                    </div>



                                </div>


                                <div class="row">

                                    <div class="form-group col-md-6">
                                        <label for="logo_image"> شعار المتجر </label>
                                        <input type="file" name="logo_image" class="form-control" id="logo_image"
                                            placeholder="أدخل صورة شعار المتجر  ">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="cover_image"> غلاف المتجر </label>
                                        <input type="file" name="cover_image" class="form-control" id="cover_image"
                                            placeholder="أدخل صورة غلاف المتجر  ">
                                    </div>

                                </div>



                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="city_id">اسم المدينة</label>
                                        <select class="form-control" name="city_id" style="width: 100%;" id="city_id"
                                            aria-label=".form-select-sm example">
                                            @foreach ($cities as $city)
                                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="adress"> العنوان </label>
                                        <input type="text" name="address" class="form-control" id="address"
                                            placeholder="أدخل عنوان المتجر  ">
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="form-group col-md-6">
                                        <label for="phone_number"> رقم الجوال </label>
                                        <input type="text" name="phone_number" class="form-control" id="phone_number"
                                            placeholder="أدخل رقم المتجر  ">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="desc">وصف لمتجر </label>
                                            <textarea class="form-control" style="resize: none;" id="desc" name="desc" rows="4"
                                            placeholder=" أدخل وصف للمتجر  " cols="50"></textarea>
                                    </div>
                                </div>



                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="button" onclick="performStore()"
                                        class="btn btn-lg btn-success">حفظ</button>

                                    <a href="{{ route('stores.index') }}" type="submit"
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
            formData.append('name', document.getElementById('name').value);
            // formData.append('role_id', document.getElementById('role_id').value);
            formData.append('status', document.getElementById('status').value);
            formData.append('logo_image', document.getElementById('logo_image').files[0]);
            formData.append('cover_image', document.getElementById('cover_image').files[0]);
            formData.append('city_id', document.getElementById('city_id').value);
            formData.append('address', document.getElementById('address').value);
            formData.append('desc', document.getElementById('desc').value);
            formData.append('phone_number', document.getElementById('phone_number').value);

            store('/dashboard/admin/stores', formData);
        }
    </script>
@endsection
