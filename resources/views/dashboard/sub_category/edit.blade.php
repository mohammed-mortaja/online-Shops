@extends('dashboard.parent')
@section('sub-title', 'تعديل تصنيف فرعي')

@section('title', 'التصنيف الفرعي')





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
                        <h3 class="card-title  float-left">تعديل التصنيف الفرعي</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form >
                        @csrf
                        <div class="card-body">

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="name">اسم التصنيف الفرعي </label>
                                    <input type="text" name="name" class="form-control" id="name"
                                        placeholder="  أدخل اسم التصنيف الفرعي  " value="{{$sub_categories->name}}">
                                </div>


                            </div>


                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="image">شعار التصنيف الفرعي</label>
                                    <input type="file" name="image" class="form-control" id="image" placeholder="أدخل صورة شعار التصنيف" data-preview="#image_preview" onchange="previewImage(event)">
                                    <img class="img-circle img-bordered-sm " src="{{ asset('storage/images/sub_category/' . $sub_categories->image) }}" id="image_preview" alt="شعار التصنيف" width="70" height="70">
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
                                    <label for="category_id">اسم التصنيف</label>
                                    <select id="category_id" name="category_id"  class="form-control custom-select">
                                        <option selected value="{{ $sub_categories->category->id }}" >{{ $sub_categories->category->name }}</option>
                                        @foreach ($categories as $category )
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                      </select>
                                </div>






                            {{-- <div class="row"> --}}
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="button" onclick="performUpdate({{ $sub_categories->id }})"
                                        class="btn btn-lg btn-success">تعديل</button>

                                    <a href="{{ route('sub_categories.index') }}" type="submit"
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


    $('.category_id').select2({
          theme: 'bootstrap4'
        });

            function performUpdate(id) {
                let formData = new FormData();
                formData.append('name', document.getElementById('name').value);
                formData.append('image', document.getElementById('image').files[0]);
                formData.append('category_id', document.getElementById('category_id').value);

                storeRoute('/dashboard/admin/sub_categories_update/' + id, formData);

            }
        </script>

@endsection

