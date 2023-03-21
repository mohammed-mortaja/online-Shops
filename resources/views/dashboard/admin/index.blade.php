@extends('dashboard.parent')
@section('title', 'المشرف')

{{-- @section('main-title', ' المشرف') --}}
@section('sub-title', 'عرض المشرف')

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
                            {{-- <h3 class="card-title">المشرف</h3> --}}
                            <a href="{{ route('admins.create') }}" type="submit" class="btn btn-lg btn-success">إضافة مشرف
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
                                        <th>رقم المشرف</th>
                                        <th> الصورة </th>
                                        <th>الأسم </th>
                                        <th>الايميل </th>
                                        {{-- <th>الادوار </th> --}}
                                        <th> رقم الجوال</th>
                                        <th> الجنس </th>
                                        <th>الاعدادات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($admins as $admin)
                                        <tr>
                                             <td>{{ $admin->id }}</td>
                                             <td>
                                                <img class="img-circle img-bordered-sm"
                                                     src="{{ $admin->image ? asset('storage/images/admin/' . $admin->image) : asset('storage/images/admin/default-image.png') }}"
                                                     width="50" height="50" alt="User Image">
                                            </td>

                                            <td>{{ $admin ? $admin->name : '' }}</td>
                                            <td>{{ $admin->email }}</td>
                                            {{-- <td>
                                                @foreach ($admin->getRoleNames() as $role)
                                                    <span class="badge badge-danger"> {{ $role }} </span>
                                                @endforeach
                                            </td> --}}
                                            <td>{{ $admin ? $admin->mobile : '' }}</td>
                                            <td>{{ $admin->gender == 'male' ? 'ذكر' : 'انثى' }}</td>
                                            {{-- <td>{{ $admin ? $admin->gender : '' }}</td> --}}
                                                <td>
                                                    <div class="btn group">
                                                            <a href="{{ route('admins.edit', $admin->id) }}" class="btn btn-primary"
                                                                title="Edit">
                                                                تعديل
                                                            </a>
                                                            <a href="#" onclick="performDestroy({{ $admin->id }} , this)"
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
                            {{ $admins->links() }}
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
            let url = '/dashboard/admin/admins/' + id;
            confirmDestroy(url, referance);
        }
    </script>

@endsection
