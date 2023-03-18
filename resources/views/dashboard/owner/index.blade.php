@extends('dashboard.parent')
@section('title', 'المالك')

@section('main-title', 'عرض المالك')
@section('sub-title', 'عرض المالك')

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
                            {{-- <h3 class="card-title">المالك</h3> --}}
                            <a href="{{ route('owners.create') }}" type="submit" class="btn btn-lg btn-success">إضافة مالك
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
                                        <th>رقم المالك</th>
                                        <th> الصورة </th>
                                        <th>الأسم </th>
                                        <th>الايميل </th>
                                        {{-- <th>الادوار </th> --}}
                                        <th> رقم الجوال</th>
                                        <th> الجنس </th>
                                        {{-- <th> المبلغ المطلوب </th>
                                        <th> المبلغ المدفوع </th>
                                        <th> المبلغ المتبقي </th> --}}
                                        <th>الاعدادات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($owners as $owner)
                                        <tr>
                                             <td>{{ $owner->id }}</td>
                                            <td>
                                                <img class="img-circle img-bordered-sm"
                                                src="{{ $owner->image ? asset('storage/images/owner/' . $owner->image) : asset('storage/images/owner/default-image.png') }}"
                                                width="50" height="50" alt="User Image">
                                            </td>
                                            <td>{{ $owner ? $owner->name : '' }}</td>
                                            <td>{{ $owner->email }}</td>
                                            <td>{{ $owner ? $owner->mobile : '' }}</td>
                                            <td>{{ $owner->gender == 'male' ? 'ذكر' : 'انثى' }}</td>
                                            {{-- <td>{{ $owner->payment_required }}</td>
                                            <td>{{ $owner->payment_paid }}</td>
                                            <td>{{ $owner->payment_not_Paid }}</td> --}}
                                            {{-- <td>
                                                @foreach ($owner->getRoleNames() as $role)
                                                    <span class="badge badge-danger"> {{ $role }} </span>
                                                @endforeach
                                            </td> --}}
                                                <td>
                                                    <div class="btn group">
                                                            <a href="{{ route('owners.edit', $owner->id) }}" class="btn btn-primary"
                                                                title="Edit">
                                                                تعديل
                                                            </a>
                                                            <a href="#" onclick="performDestroy({{ $owner->id }} , this)"
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
                            {{ $owners->links() }}
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
            let url = '/dashboard/admin/owners/' + id;
            confirmDestroy(url, referance);
        }
    </script>

@endsection
