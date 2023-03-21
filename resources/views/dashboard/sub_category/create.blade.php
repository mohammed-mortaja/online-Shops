@extends('dashboard.parent')

@section('title', 'التصنيف الفرعي')





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
                            <h3 class="card-title float-left"> انشاء التصنيف الفرعي </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="create_form">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="name">اسم التصنيف الفرعي </label>
                                        <input type="text" name="name" class="form-control" id="name"
                                            placeholder=" أدخل اسم التصنيف الفرعي  ">
                                    </div>

                                   



                                </div>


                                <div class="row">

                                    <div class="form-group col-md-6">
                                        <label for="image"> شعار التصنيف الفرعي </label>
                                        <input type="file" name="image" class="form-control" id="image"
                                            placeholder="أدخل صورة شعار التصنيف الفرعي  ">
                                    </div>

                                    

                                </div>



                                {{-- <div class="row"> --}}
                                    <div class="form-group col-md-6">
                                        <label for="category_id">اسم التصنيف الاساسي</label>
                                        <select class="form-control" name="category_id" style="width: 100%;" id="category_id"
                                            aria-label=".form-select-sm example">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    



                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="button" onclick="performStore()"
                                        class="btn btn-lg btn-success">حفظ</button>

                                    <a href="{{ route('sub_categories.index') }}" type="submit"
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
        $('.category_id').select2({
              theme: 'bootstrap4'
            });


        function performStore() {
            let formData = new FormData();
            formData.append('name', document.getElementById('name').value);            
            formData.append('image', document.getElementById('image').files[0]);  
            formData.append('category_id', document.getElementById('category_id').value);
            

            store('/dashboard/admin/sub_categories', formData);
        }
    </script>
@endsection
