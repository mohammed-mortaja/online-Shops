@extends('dashboard.parent')
@section('sub-title', 'تعديل  المنتج')

@section('title', 'التصنيف المنتج')





@section('styles')

@endsection

@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title  float-left">تعديل المنتج </h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form >
                        @csrf
                        <div class="card-body">

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="product_name">اسم  المنتج </label>
                                    <input type="text" name="product_name" class="form-control" id="product_name"
                                        placeholder="  أدخل اسم المنتج   " value="{{$products->product_name}}">
                                </div>


                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="product_prise">سعر  المنتج </label>
                                    <input type="number" name="product_prise" class="form-control" id="product_prise"
                                        placeholder="  أدخل سعر المنتج   " value="{{$products->product_prise}}">
                                </div>


                            </div>


                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="image">صورة المنتج </label>
                                    <input type="file" name="image" class="form-control" id="image" placeholder="أدخل صورة  المنتج" data-preview="#image_preview" onchange="previewImage(event)">
                                    <img class="img-circle img-bordered-sm " src="{{ asset('storage/images/product/' . $products->image) }}" id="image_preview" alt="شعار المنتج" width="70" height="70">
                                </div>


                            </div>

                            <script>
                                function previewImage(event) {
                                    var previewImage = event.target.getAttribute('data-preview');
                                    var image = document.querySelector(previewImage);
                                    image.src = URL.createObjectURL(event.target.files[0]);
                                }
                            </script>





                                <div class="form-group col-md-6">
                                    <label for="sub_category_id">اسم التصنيف الفرعي</label>
                                    <select id="sub_category_id" name="sub_category_id"  class="form-control custom-select">
                                        <option selected value="{{ $products->SubCategory->id}}" >{{ $products->SubCategory->name }}</option>
                                        @foreach ($sub_categories as $sub_category )
                                        <option value="{{ $sub_category->id }}">{{ $sub_category->name }}</option>
                                        @endforeach
                                      </select>
                                </div>






                            {{-- <div class="row"> --}}
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="button" onclick="performUpdate({{ $products->id }})"
                                        class="btn btn-lg btn-success">تعديل</button>

                                    <a href="{{ route('products.index') }}" type="submit"
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


    $('.sub_category_id').select2({
          theme: 'bootstrap4'
        });

            function performUpdate(id) {
                let formData = new FormData();
                formData.append('product_name', document.getElementById('product_name').value);
                formData.append('product_prise', document.getElementById('product_prise').value);
                formData.append('image', document.getElementById('image').files[0]);
                formData.append('sub_category_id', document.getElementById('sub_category_id').value);

                storeRoute('/dashboard/admin/products_update/' + id, formData);

            }
        </script>

@endsection

