@extends('dashboard.parent')
@section('sub-title' , 'تعديل مشرف ')

@section('title', 'المشرف')





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
                            <h3 class="card-title  float-left">تعديل المشرف</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="create_form">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="name">الاسم </label>
                                        <input type="text" name="name" class="form-control" id="name"
                                            placeholder=" أدخل اسم المشرف  " value="{{ $admins->name }}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="adress"> العنوان </label>
                                        <input type="text" name="address" class="form-control" id="address"
                                            placeholder="أدخل عنوان المشرف  " value="{{ $admins->address }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="email"> الايميل </label>
                                        <input type="email" name="email" class="form-control" id="email"
                                            value="{{ $admins->email }}" placeholder="أدخل ايميل المشرف  ">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="mobile"> رقم الجوال </label>
                                        <input type="text" name="mobile" class="form-control" id="mobile"
                                            placeholder="أدخل ايميل المشرف  " value="{{ $admins->mobile }}">
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="gender"> الجنس</label>
                                        <select class="form-control" name="gender" style="width: 100%;" id="gender"
                                            aria-label=".form-select-sm example">
                                            <option selected
                                                value="{{ $admins->gender == 'male' ? 'male' : 'female' }}">
                                                {{ $admins->gender == 'male' ? 'ذكر' : 'انثى' }} </option>
                                            <option value="{{ $admins->gender == 'male' ? 'female' : 'male' }}">
                                                {{ $admins->gender == 'male' ? 'انثى' : 'ذكر' }}
                                            </option>
                                        </select>
                                    </div>

                                </div>
                                <div class="row">
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <button type="button" onclick="performUpdate({{ $admins->id }})"
                                            class="btn btn-lg btn-success">تعديل</button>

                                        <a href="{{ route('admins.index') }}" type="submit"
                                            class="btn btn-lg btn-secondary">إلغاء</a>
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


$('.city_id').select2({
      theme: 'bootstrap4'
    });

        function performUpdate(id) {
            let formData = new FormData();
            formData.append('name', document.getElementById('name').value);
            formData.append('mobile', document.getElementById('mobile').value);
            formData.append('email', document.getElementById('email').value);
            formData.append('gender', document.getElementById('gender').value);
            formData.append('address', document.getElementById('address').value);
            storeRoute('/dashboard/admin/admins_update/' + id, formData);

        }
    </script>
@endsection
