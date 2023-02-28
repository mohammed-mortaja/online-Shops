@extends('dashboard.parent')

@section('title', 'المدينة')

@section('main-title', 'المدينة')

@section('sub-title', 'انشاء المدينة')

@section('styles')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header " >
                        <h3 class="card-title float-left">انشاء مدينة</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="create_form">
                        @csrf
                       <div class="card-body">

                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label for="name">اسم المدينة </label>
                                    <input type="text" name="name" class="form-control"
                                        id="name" placeholder="أدخل اسم المدينة  ">
                                </div>

                            </div>



                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="button"
                                    class="btn btn-lg btn-success">حفظ</button>

                                    <a href="{{ route('cities.index') }}" type="submit"
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

@endsection
