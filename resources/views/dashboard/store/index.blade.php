@extends('dashboard.parent')
@section('title', 'المتجر')

@section('main-title', 'عرض المتجر')
@section('sub-title', 'عرض المتجر')

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
                            <a href="{{ route('stores.create') }}" type="submit" class="btn btn-lg btn-success">إضافة متجر
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
                                        <th>رقم المتجر</th>
                                        <th>شعار المتجر </th>
                                        <th>غلاف المتجر </th>
                                        <th>اسم المتجر </th>
                                        {{-- <th>الادوار </th> --}}
                                        <th> رقم التواصل</th>
                                        <th>المدينة</th>
                                        {{-- <th> مالك المتجر </th> --}}
                                        <th> حالة المتجر </th>
                                        <th>الاعدادات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($stores as $store)
                                        <tr>
                                             <td>{{ $store->id }}</td>
                                             <td>
                                                <img class="img-circle img-bordered-sm "
                                                    src="{{ asset('storage/images/store/' . $store->logo_image) }}"
                                                    width="50" height="50" alt="User Image">
                                            </td>
                                            <td>
                                                <img style="height: 50px; width: fit-content" class=" img-bordered-sm"
                                                    src="{{ asset('storage/images/store/' . $store->cover_image) }}"
                                                    width="50" height="50" alt="User Image">
                                            </td>
                                            <td>{{ $store->name }}</td>
                                            <td>{{ $store->phone_number }}</td>
                                            <td>{{ $store->city->name }}</td>
                                            {{-- <td>{{ $owner->user->name }}</td> --}}
                                            <td>{{ $store->status }}</td>
                                            {{-- <td>
                                                @foreach ($store->getRoleNames() as $role)
                                                    <span class="badge badge-danger"> {{ $role }} </span>
                                                @endforeach
                                            </td> --}}
                                                <td>
                                                    <div class="btn group">
                                                            <a href="{{ route('stores.edit', $store->id) }}" class="btn btn-primary"
                                                                title="Edit">
                                                                تعديل
                                                            </a>
                                                            <a href="#" onclick="performDestroy({{ $store->id }} , this)"
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
                            {{ $stores->links() }}
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
            let url = '/dashboard/admin/stores/' + id;
            confirmDestroy(url, referance);
        }
    </script>

@endsection
