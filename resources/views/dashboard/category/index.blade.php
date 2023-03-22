@extends('dashboard.parent')
@section('title', 'التصنيف')

{{-- @section('main-title', 'عرض التصنيف') --}}
@section('sub-title', ' التصنيف')

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
                            <a href="{{ route('categories.create') }}" type="submit" class="btn btn-lg btn-success">إضافة تصنيف
                                جديد</a>
                            <div class="card-tools">

                            </div>
                            <br>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover table-bordered table-striped text-nowrap text-center">
                                <thead>
                                    <tr class="bg-info">
                                        <th>رقم التصنيف</th>
                                        <th>غلاف التصنيف </th>
                                        <th>اسم التصنيف </th>
                                        <th> اسم المتجر </th>
                                        <th>الاعدادات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                             <td>{{ $category->id }}</td>
                                             <td>
                                                <img class="img-circle img-bordered-sm "
                                                    src="{{ asset('storage/images/category/' . $category->image) }}"
                                                    width="50" height="50" alt="User Image">
                                            </td>

                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->store ? $category->store->name:"non value"}}</td>

                                                <td>
                                                    <div class="btn group">
                                                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary"
                                                                title="Edit">
                                                                تعديل
                                                            </a>
                                                            <a href="#" onclick="performDestroy({{ $category->id }} , this)"
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
                            {{ $categories->links() }}
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
            let url = '/dashboard/admin/categories/' + id;
            confirmDestroy(url, referance);

        }
    </script>

@endsection
