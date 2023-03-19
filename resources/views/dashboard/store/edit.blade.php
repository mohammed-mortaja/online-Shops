@extends('dashboard.parent')

@section('title', 'لمتجر')





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
                            <h3 class="card-title  float-left">تعديل لمتجر</h3>
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
                                            placeholder=" أدخل اسم المتجر  " value="{{$stores->name}}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="status">  الحالة  </label>
                                        <input type="text" name="status" class="form-control" id="status"
                                            placeholder="أدخل حالة المتجر"  value="{{$stores->status}}" >
                                    </div>

                                </div>


                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="logo_image">شعار المتجر</label>
                                        <input type="file" name="logo_image" class="form-control" id="logo_image" placeholder="أدخل صورة شعار المتجر" data-preview="#logo_image_preview" onchange="previewImage(event)">
                                        <img src="{{ asset('storage/images/store/' . $stores->logo_image) }}" id="logo_image_preview" alt="شعار المتجر" height="60">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="cover_image">غلاف المتجر</label>
                                        <input type="file" name="cover_image" class="form-control" id="cover_image" placeholder="أدخل صورة غلاف المتجر" data-preview="#cover_image_preview" onchange="previewImage(event)">
                                        @if ($stores->cover_image)
                                            <img src="{{ asset('storage/images/store/' . $stores->cover_image) }}" id="cover_image_preview" alt="غلاف المتجر" height="60">
                                        @endif
                                    </div>
                                </div>

                                <script>
                                    function previewImage(event) {
                                        var previewImage = event.target.getAttribute('data-preview');
                                        var image = document.querySelector(previewImage);
                                        image.src = URL.createObjectURL(event.target.files[0]);
                                    }
                                </script>


                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="city_id">اسم المدينة</label>
                                        <select class="form-control" name="city_id" style="width: 100%;" id="city_id" aria-label=".form-select-sm example">
                                            @foreach ($cities as $city)
                                                <option value="{{ $city->id }}" @if($city->id == old('city_id', $stores->city_id)) selected @endif>{{ $city->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>



                                    <div class="form-group col-md-6">
                                        <label for="adress"> العنوان </label>
                                        <input type="text" name="address" class="form-control" id="address"
                                            placeholder="أدخل عنوان المتجر  " value="{{ $stores->address }}">
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="form-group col-md-6">
                                        <label for="phone_number"> رقم الجوال </label>
                                        <input type="text" name="phone_number" class="form-control" id="phone_number" placeholder="أدخل رقم المتجر  " value="{{ $stores->phone_number }}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="desc">  الوصف </label>
                                        <input type="text" name="desc" class="form-control" id="desc"
                                            placeholder="ادخل وصف للمتجر" value="{{ $stores->description}}">
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <button type="button" onclick="performUpdate({{ $stores->id }})"
                                            class="btn btn-lg btn-success">تعديل</button>

                                        <a href="{{ route('stores.index') }}" type="submit"
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
            // formData.append('role_id', document.getElementById('role_id').value);
            formData.append('status', document.getElementById('status').value);
            formData.append('logo_image', document.getElementById('logo_image').files[0]);
            formData.append('cover_image', document.getElementById('cover_image').files[0]);
            formData.append('city_id', document.getElementById('city_id').value);
            formData.append('address', document.getElementById('address').value);
            formData.append('desc', document.getElementById('desc').value);
            formData.append('phone_number',document.getElementById('phone_number').value);

            storeRoute('/dashboard/admin/stores_update/' + id, formData);

        }
    </script>
@endsection

