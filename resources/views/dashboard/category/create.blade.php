@extends('dashboard.parent')
@section('sub-title' , 'انشاء تصنيف')

@section('title', 'التصنيف')





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
                            <h3 class="card-title float-left">انشاء التصنيف</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="create_form">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="name">اسم التصنيف </label>
                                        <input type="text" name="name" class="form-control" id="name"
                                            placeholder=" أدخل اسم التصنيف  ">
                                    </div>





                                </div>


                                <div class="row">

                                    <div class="form-group col-md-6">
                                        <label for="image"> شعار التصنيف </label>
                                        <input type="file" name="image" class="form-control" id="image"
                                            placeholder="أدخل صورة شعار التصنيف  ">
                                    </div>



                                </div>



                                {{-- <div class="row"> --}}
                                    <div class="form-group col-md-6">
                                        <label for="store_id">اسم المتجر</label>
                                        <select class="form-control" name="store_id" style="width: 100%;" id="store_id"
                                            aria-label=".form-select-sm example">
                                            @foreach ($stores as $store)
                                                <option value="{{ $store->id }}">{{ $store->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>





                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="button" onclick="performStore()"
                                        class="btn btn-lg btn-success">حفظ</button>

                                    <a href="{{ route('categories.index') }}" type="submit"
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
        // $('.store_id').select2({
        //       theme: 'bootstrap4'
        //     });


        function performStore() {
            let formData = new FormData();
            formData.append('name', document.getElementById('name').value);
            formData.append('image', document.getElementById('image').files[0]);
            formData.append('store_id', document.getElementById('store_id').value);


            store('/dashboard/admin/categories', formData);
        }
    </script>
@endsection
