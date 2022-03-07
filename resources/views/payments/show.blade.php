@extends('layouts.master')
@section('css')
    <!---Internal  Prism css-->
    <link href="{{ URL::asset('assets/plugins/prism/prism.css') }}" rel="stylesheet">
    <!---Internal Input tags css-->
    <link href="{{ URL::asset('assets/plugins/inputtags/inputtags.css') }}" rel="stylesheet">
    <!--- Custom-scroll -->
    <link href="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css') }}" rel="stylesheet">
@endsection
@section('title')
    تفاصيل الدفعية
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الدفعيات </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    تفاصيل الدفعية</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- row opened -->
    <div class="row row-sm">

        <div class="col-xl-12">
            <!-- div -->
            <div class="card mg-b-20" id="tabs-style2">
                <div class="card-body">
                    <div class="text-wrap">
                        <div class="example">
                            <div class="panel panel-primary tabs-style-2">
                                <div class=" tab-menu-heading">
                                    <div class="tabs-menu1">
                                        <!-- Tabs -->
                                        <ul class="nav panel-tabs main-nav-line">
                                            <li><a href="#tab4" class="nav-link active" data-toggle="tab"> رقم الدفعية : {{$payment->id}}</a></li>
                                            <li><a href="#tab6" class="nav-link" data-toggle="tab">المرفقات</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body main-content-body-right border">
                                    <div class="tab-content">

                                        <div class="tab-pane active" id="tab4">
                                            <div class="table-responsive mt-15">

                                                <table class="table table-striped" style="text-align:right">
                                                    <tbody>
                                                        <tr>   
                                                            <th scope="row">رقم اليتيم</th>
                                                            <th scope="row">اسم اليتيم</th>
                                                            <th scope="row">اسم الكافل </th>
                                                       </tr>
                                                        <tr>  
                                                        <td>{{$payment->id}}</td>
                                                        <td>{{$payment->orphan->name}}</td>
                                                        <td>{{$payment->guardian->user->name}}</td>
                                                        
                                                       </tr>
                                                        <tr>   
                                                            <th scope="row">نوع الكفالة</th>
                                                           <th scope="row">طريقة الدفع</th>
                                                           <th scope="row">قيمة الكفالة</th>
                                                       </tr>
                                                       <tr>  
                                                        <td>{{$payment->sponserform->kafal_type}}</td>
                                                        <td>{{$payment->sponserform->payment_type}}</td>
                                                        <td>{{number_format($payment->sponserform->amount)}}</td>
                                                       
                                                       </tr>
                                                       @if ($payment->stauts == 0)
                                                       </tr>
                                                        <td colspan="3">عمليات</td>
                                                       </tr>
                                                       </tr>
                                                        <td>
                                                        <a class="modal-effect btn btn-lg btn-info" data-effect="effect-scale"
                                                        data-id="{{ $payment->id }}" data-toggle="modal" href="#Pay">تأكيد الدفع</a>
                                                        
                                                        </td>
                                                       </tr>
                                                        @endif
                                                         @if ($payment->stauts == 0)
                                                          <span class="text-danger">لم يتم التأكيد الدفع</span>
                                                        @elseif($payment->stauts == 1)
                                                          <span class="text-success">تم تأكيد الدفع</span>
                                                        @endif
                                                       
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>

                        
                                        <div class="tab-pane" id="tab6">
                                            <!--المرفقات-->
                                            <div class="card card-statistics">
                                                <div class="table-responsive mt-15">
                                                    <table class="table center-aligned-table mb-0 table table-hover"
                                                        style="text-align:center">
                                                        
                                                    <tbody>
                                                        <tr>
                                                        <td>
                                                        <img src="{{ asset('images/payments/' . $payment->images )}}">
                                                        </td>
                                                        </tr>
                                                        </tbody>
                                                    </tbody>
                                                    </table>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /div -->
        </div>

    </div>
    <!-- /row -->
<!-- Pay -->
    <div class="modal" id="Pay">
       <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">عملية الدفع</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                {!! Form::model($payment, ['route'=>['payments.update',$payment->id] ,'method' => 'PUT']) !!}
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p>هل انت متأكد من تنفيذ العملية ؟</p><br>
                        <input type="hidden" name="id" id="id" value="">
                        <input type="hidden" name="type" id="type" value="1">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">الغاء</button>
                        <button type="submit" class="btn btn-success">تاكيد</button>
                    </div>
            </div>
            {!! Form::close() !!}
        </div>
</div><!-- End Basic modal -->
    
@endsection
@section('js')
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Internal Jquery.mCustomScrollbar js-->
    <script src="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <!-- Internal Input tags js-->
    <script src="{{ URL::asset('assets/plugins/inputtags/inputtags.js') }}"></script>
    <!--- Tabs JS-->
    <script src="{{ URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js') }}"></script>
    <script src="{{ URL::asset('assets/js/tabs.js') }}"></script>
    <!--Internal  Clipboard js-->
    <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.js') }}"></script>
    <!-- Internal Prism js-->
    <script src="{{ URL::asset('assets/plugins/prism/prism.js') }}"></script>

<script>
    $('#Pay').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
    })

</script>

@endsection
