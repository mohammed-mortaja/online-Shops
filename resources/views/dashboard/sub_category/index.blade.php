@extends('dashboard.parent')
@section('title', 'التصنيف الفرعي' )

@section('main-title', 'عرض التصنيف الفرعي ')
@section('sub-title', 'عرض التصنيف الفرعي')

@section('styles')
    <style>

    </style>
@endsection

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            {{-- <h3 class="card-title">المتجر</h3> --}}
                            <a href="{{ route('sub_categories.create') }}" type="submit" class="btn btn-lg btn-success">إضافة تصنيف
                                الفرعي جديد</a>
                            <div class="card-tools">

                            </div>
                            <br>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover table-bordered table-striped text-nowrap text-center">
                                <thead>
                                    <tr class="bg-info">
                                        <th>رقم  التصنيف الفرعي</th>
                                        <th>غلاف  التصنيف الفرعي </th>
                                        <th>اسم  التصنيف الفرعي </th>                                      
                                        <th> اسم  التصنيف الاساسي </th>
                                        <th>الاعدادات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sub_categories as $sub_category)
                                        <tr>
                                             <td>{{ $sub_category->id }}</td>
                                             <td>
                                                <img class="img-circle img-bordered-sm "
                                                src="{{ asset('storage/images/sub_category/' . $sub_category->image) }}"
                                                    {{-- src="{{  $sub_category->image ? asset('storage/images/sub_category/' . $sub_category->image) : asset('storage/images/sub_category/default-image.jpg') }}" --}}
                                                    width="50" height="50" alt="User Image">


                                                    
                                            </td>
                                            
                                            <td>{{ $sub_category->name }}</td>                           
                                            <td>{{ $sub_category->category ? $sub_category->category->name:"non value"}}</td>
                                            
                                                <td>
                                                    <div class="btn group">
                                                            <a href="{{ route('sub_categories.edit', $sub_category->id) }}" class="btn btn-primary"
                                                                title="Edit">
                                                                تعديل
                                                            </a>
                                                            <a href="#" onclick="performDestroy({{ $sub_category->id }} , this)"
                                                                class="btn btn-danger" title="Delete">
                                                                حذف
                                                            </a>
                                                    </div>
                                                </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="span text-center" style="margin-top: 20px; margin-bottom:10px">

                                </span>

                            </div>
                            <!-- /.card-body -->
                            <br>
                            {{-- {{ $categorys->links() }} --}}
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
    </section>


@endsection

@section('script')

    <script>
        function performDestroy(id, referance) {
            let url = '/dashboard/admin/sub_categories/' + id;
            confirmDestroy(url, referance);
            
        }
    </script>

@endsection
