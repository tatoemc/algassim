@extends('layouts.master')
@section('css')
<!-- Internal Nice-select css  -->
<link href="{{URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet" />
@section('title')
 الدفعيات
@stop


@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">الدفعيات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                كل الدفعيات</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-lg-12 col-md-12">

        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>خطا</strong>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-right">
                        <a class="btn btn-primary btn-sm" href="{{ url('home') }}">رجوع</a>
                    </div>
                </div><br>

                <div>

                 <div class="product-timeline card-body pt-2 mt-1">
                   <div class="table-responsive">
                                                <table class="table table-hover" style=" text-align: center;">
                                                    <thead>
                                                        <tr>
                                                            <th class="border-bottom-0">رقم الدفعية</th>
                                                            <th class="border-bottom-0">الشهر</th>
															<th class="border-bottom-0">الصورة</th>
                                                            <th class="border-bottom-0">قيمة الكفالة</th>
                                                            <th class="border-bottom-0">المستند</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                   
                                                        @foreach ($orphans->payments as $payment)
                                                            <tr>
															   <td>{{$payment->id}}</td>
                                                               <td>{{ date( 'M j Y', strtotime($payment->created_at)) }}</td>
                                                               <td>{{number_format($payment->sponserform->amount)}}</td>
                                                                <td>
                                                                @if ($payment->stauts == 0)
                                                                 <span class="text-danger">لم يتم التأكيد</span>
                                                                  @elseif($payment->stauts == 1)
                                                                <span class="text-success">تم التأكيد</span>
                                                                @endif
                                                                </td>
                                                                @if ($payment->images)
                                                                <td>
															    <img class="avatar-lg rounded-circle ml-3 my-auto" src="{{ asset('images/payments/' . $payment->images) }}">
                                                                 @endif
															    </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                </div>

                </div>  
               
        </div>
    </div>
</div>




</div>
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')

<!-- Internal Nice-select js-->
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/jquery.nice-select.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/nice-select.js')}}"></script>

<!--Internal  Parsley.min js -->
<script src="{{URL::asset('assets/plugins/parsleyjs/parsley.min.js')}}"></script>
<!-- Internal Form-validation js -->
<script src="{{URL::asset('assets/js/form-validation.js')}}"></script>
@endsection