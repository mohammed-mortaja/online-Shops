@extends('dashboard.parent')
@section('sub-title' ,   ' انشاء  المنتج')

@section('title', 'المنتج ')





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
                            <h3 class="card-title float-left"> انشاء  المنتج </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="create_form">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="product_name">اسم المنتج </label>
                                        <input type="text" name="product_name" class="form-control" id="product_name"
                                            placeholder=" أدخل اسم المنتج   ">
                                    </div>

                                </div>
                                <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="product_prise">سعر المنتج </label>
                                        <input type="number" name="product_prise" class="form-control" id="product_prise"
                                            placeholder=" أدخل سعر المنتج   ">
                                    </div>
                                </div>


                                <div class="row">

                                    <div class="form-group col-md-6">
                                        <label for="image"> صورة  المنتج </label>
                                        <input type="file" name="image" class="form-control" id="image"
                                            placeholder="أدخل صورة  المنتج   ">
                                    </div>



                                </div>



                                {{-- <div class="row"> --}}
                                    <div class="form-group col-md-6">
                                        <label for="sub_category_id">اسم التصنيف الفرعي</label>
                                        <select class="form-control" name="sub_category_id" style="width: 100%;" id="sub_category_id"
                                            aria-label=".form-select-sm example">
                                            @foreach ($sub_categories as $sub_category)
                                                <option value="{{ $sub_category->id }}">{{ $sub_category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>





                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="button" onclick="performStore()"
                                        class="btn btn-lg btn-success">حفظ</button>

                                    <a href="{{ route('products.index') }}" type="submit"
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
        $('.sub_category_id').select2({
              theme: 'bootstrap4'
            });


        function performStore() {
            let formData = new FormData();
            formData.append('product_name', document.getElementById('product_name').value);
            formData.append('product_prise', document.getElementById('product_prise').value);
            formData.append('image', document.getElementById('image').files[0]);
            formData.append('sub_category_id', document.getElementById('sub_category_id').value);


            store('/dashboard/admin/products', formData);
        }
    </script>
@endsection
