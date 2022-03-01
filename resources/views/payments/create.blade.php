@extends('layouts.master')
@section('css')
<!-- Internal Nice-select css  -->
<link href="{{URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet" />
@section('title')
 دفع كفالة     
@stop


@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">دفع كفالة</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ اضافة
            </span>
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
                        <a class="btn btn-primary btn-sm" href="{{ url('/home') }}">رجوع</a>
                    </div>
                </div><br>
                <form class="parsley-style-1" autocomplete="off" action="{{route('payments.store')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}} 
                       <div class="">
                        <div class="row mg-b-20">
                            <div class="parsley-input col-md-6" id="fnWrapper">
                                <label>  اسم اليتيم: </label>
                                <input class="form-control form-control-sm mg-b-20" value = "{{$sponserform->orphan->name}}" name="name" type="text" readonly>
                                <input type="hidden" name="orphan_id" value="{{$sponserform->orphan->id}}">
                            </div>

                            <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                <label>  اسم ولي الامر: </label>
                                <input class="form-control form-control-sm mg-b-20" name="sponsor_name"  value = "{{$sponserform->orphan->user->name}}" readonly>
                                <input type="hidden" name="sponsor_id" value="{{$sponserform->orphan->user->id}}">
                            </div>
                        </div>
                    <div class="">
                        <div class="row mg-b-20">
                            <div class="parsley-input col-md-6" id="fnWrapper">
                                <label>  اسم ولي الامر: </label>
                                <input class="form-control form-control-sm mg-b-20" value = "{{$sponserform->kafal_type}}" name="kafal_type" type="text" readonly>
                            </div>

                            <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                              <label> المبلغ: </label>
                                <input class="form-control form-control-sm mg-b-20" name="amount"  value = "{{$sponserform->amount}}" readonly>
                            </div>
                        </div>
                        <div class="row mg-b-20">
                            <div class="parsley-input col-md-6" id="fnWrapper">
                             <label> طريقة الدفع: </label>
                            <label class="rdiobox">
                            <input checked name="rdio1" type="radio" value="2" id="type_div"> <span>كاش</span></label>
                            <input name="rdio2" type="radio" value="1" > <span>بنك</span></label>
                            </div>

                            <div class="col-lg-3 mg-t-20 mg-lg-t-0" id="images">
                            <p class="mg-b-10">تحميل المستند</p>
                            <input type="file" class="form-control" name="images" >
                           </div>

                        </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button class="btn btn-main-primary pd-x-20" type="submit">تاكيد</button>
                    </div>
                </form>
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

<script>
    $(document).ready(function() {

        $('#images').hide();

        $('input[type="radio"]').click(function() {
            if ($(this).attr('id') == 'type_div') {
                $('#images').hide();
               
            } else {
                $('#images').show();
            }
        });
    });

</script>


@endsection