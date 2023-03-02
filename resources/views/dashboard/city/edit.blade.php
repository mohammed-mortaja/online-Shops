@extends('dashboard.parent')

@section('title', 'المدينة')

@section('main-title', 'المدينة')

@section('sub-title', 'تعديل المدينة')

@section('styles')

@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">تعديل مدينة</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="create_form">
                        @csrf
                       <div class="card-body">

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="name">تعديل اسم المدينة </label>
                                    <input type="text" name="name" class="form-control"
                                        id="name" value="{{$cities->name}}"
                                        placeholder="أدخل اسم المدينة  ">
                                </div>

                            </div>



                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="button" onclick="performUpdate({{$cities->id}})"
                                    class="btn btn-lg btn-success">تعديل</button>


                                    <a href="{{route('cities.index')}}" type="submit"
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
@endsection

@section('script')
<script>
    function performUpdate(id){
        let formData = new FormData();
        formData.append('name',document.getElementById('name').value);
        storeRoute('/dashboard/admin/cities_update/'+id , formData);
    }
    </script>
@endsection
