@extends('dashboard.parent')
@section('title', 'المنتج' )

{{-- @section('main-title', 'عرض التصنيف الفرعي ') --}}
@section('sub-title', 'المنتج')

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
                            <a href="{{ route('products.create') }}" type="submit" class="btn btn-lg btn-success">اضافة منتج</a>
                            <div class="card-tools">

                            </div>
                            <br>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover table-bordered table-striped text-nowrap text-center">
                                <thead>
                                    <tr class="bg-info">
                                        <th>رقم المنتج</th>
                                        <th>صورة المنتج</th>
                                        <th>اسم المنتج</th>
                                        <th>سعر المنتج</th>
                                        <th> اسم  التصنيف الفرعي </th>
                                        <th>الاعدادات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                             <td>{{ $product->id }}</td>
                                             <td>
                                                <img class="img-circle img-bordered-sm "
                                                src="{{ asset('storage/images/product/' . $product->image) }}"
                                                    {{-- src="{{  $product->image ? asset('storage/images/product/' . $product->image) : asset('storage/images/product/default-image.jpg') }}" --}}
                                                    width="50" height="50" alt="User Image">



                                            </td>

                                            <td>{{ $product->product_name}}</td>
                                            <td>{{ $product->product_prise }}</td>
                                            <td>{{ $product->subCategory ? $product->subCategory->name : "non value"}}</td>
                                            

                                                <td>
                                                    <div class="btn group">
                                                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary"
                                                                title="Edit">
                                                                تعديل
                                                            </a>
                                                            <a href="#" onclick="performDestroy({{ $product->id }} , this)"
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
                            {{ $products->links() }}
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
            let url = '/dashboard/admin/products/' + id;
            confirmDestroy(url, referance);

        }
    </script>

@endsection
