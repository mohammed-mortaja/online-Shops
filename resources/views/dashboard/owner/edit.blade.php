@extends('dashboard.parent')
@section('sub-title', 'تعديل مالط')

@section('title', 'المالك')





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
                            <h3 class="card-title  float-left">تعديل المالك</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="create_form">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="name">الاسم </label>
                                        <input type="text" name="name" class="form-control" id="name"
                                            placeholder=" أدخل اسم المالك  " value="{{ $owners->name }}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="adress"> العنوان </label>
                                        <input type="text" name="address" class="form-control" id="address"
                                            placeholder="أدخل عنوان المالك  " value="{{ $owners->address }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="email"> الايميل </label>
                                        <input type="email" name="email" class="form-control" id="email"
                                            value="{{ $owners->email }}" placeholder="أدخل ايميل المالك  ">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="mobile"> رقم الجوال </label>
                                        <input type="text" name="mobile" class="form-control" id="mobile"
                                            placeholder="أدخل ايميل المالك  " value="{{ $owners->mobile }}">
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="gender"> الجنس</label>
                                        <select class="form-control" name="gender" style="width: 100%;" id="gender"
                                            aria-label=".form-select-sm example">
                                            <option selected
                                                value="{{ $owners->gender == 'male' ? 'male' : 'female' }}">
                                                {{ $owners->gender == 'male' ? 'ذكر' : 'انثى' }} </option>
                                            <option value="{{ $owners->gender == 'male' ? 'female' : 'male' }}">
                                                {{ $owners->gender == 'male' ? 'انثى' : 'ذكر' }}
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                {{-- <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="payment_required"> المبلغ المطلوب </label>
                                        <input type="text" name="payment_required" class="form-control" id="payment_required"
                                            placeholder="ادخل الدفعة المطلوبة من التاجر" value="{{ $owners->payment_required}}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="payment_paid"> المبلغ المدفوع  </label>
                                        <input type="text" name="payment_paid" class="form-control" id="payment_paid"
                                            placeholder="أدخل ماتم دفعه من التاجر " value="{{ $owners->payment_paid}}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="payment_not_Paid"> المبلغ المتبقي </label>
                                        <input type="text" name="payment_not_Paid" class="form-control" id="payment_not_Paid"
                                            placeholder="أدخل المتبقي دفعه من التاجر "  value="{{ $owners->payment_not_Paid}}">
                                    </div>
                                </div> --}}

                                <div class="row">
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <button type="button" onclick="performUpdate({{ $owners->id }})"
                                            class="btn btn-lg btn-success">تعديل</button>

                                        <a href="{{ route('owners.index') }}" type="submit"
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
    <!-- /.content -->

    </section>
    <!-- /.content -->

@endsection

@section('script')
    <script>


$('.city_id').select2({
      theme: 'bootstrap4'
    });

        function performUpdate(id) {
            let formData = new FormData();
            formData.append('name', document.getElementById('name').value);
            formData.append('mobile', document.getElementById('mobile').value);
            formData.append('email', document.getElementById('email').value);
            formData.append('gender', document.getElementById('gender').value);
            formData.append('address', document.getElementById('address').value);
            // formData.append('payment_required', document.getElementById('payment_required').value);
            // formData.append('payment_paid', document.getElementById('payment_paid').value);
            // formData.append('payment_not_Paid', document.getElementById('payment_not_Paid').value);
            storeRoute('/dashboard/admin/owners_update/' + id, formData);

        }
    </script>
@endsection

