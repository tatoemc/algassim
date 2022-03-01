@extends('layouts.master')
@section('css')
    <style>
        @media print {
            #print_Button {
                display: none;
            }
        }

    </style>
@endsection
@section('title')
    معاينه طباعة
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">اوليا الامور</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    معاينة طباعة </span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm">
        <div class="col-md-12 col-xl-12">
            <div class=" main-content-body-invoice" id="print">
                <div class="card card-invoice">
                    <div class="card-body">
                        <div class="invoice-header">
                            <h1 class="invoice-title">استمارة ولي امر</h1>
                            <div class="billed-from">
                                <h6>منظمة القاسم للعون الانساني</h6>
                                <p>الخرطوم - السودان - الرياض<br>
                                    Tel No: 249911405218<br>
                                    Email: info@algassim.com</p>
                            </div><!-- billed-from -->
                        </div><!-- invoice-header -->
                        
                        <div class="table-responsive mg-t-40">
                            <table class="table table-invoice border text-md-nowrap mb-0">
                                <thead>
                                    
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="tx-right">الاسم</td>
                                        <td class="tx-primary tx-bold" colspan="2"> {{ $sponsor->user->name }}</td>
                                       
                                    </tr>
                                    <tr>
                                        <td class="tx-right"> البريد الالكتروني ({{ $sponsor->user->email }})</td>
                                        <td class="tx-primary tx-bold" colspan="2">287.50</td>
                                        
                                    </tr>
                                    <tr>
                                        <td class="tx-right"> الهاتف</td>
                                        <td class="tx-primary tx-bold" colspan="2"> {{ $sponsor->user->phone }}</td>
                                       
                                    </tr>
                                     <tr>
                                        <td class="tx-right"> رقم الحساب</td>
                                        <td class="tx-primary tx-bold" colspan="2"> {{ $sponsor->user->bank_account }}</td>
                                       
                                    </tr>
                                     <tr>
                                        <td class="tx-right"> الرقم الوطني</td>
                                        <td class="tx-primary tx-bold" colspan="2"> {{ $sponsor->user->ssn }}</td>
                                       
                                    </tr>
                                    <tr>
                                        <td class="tx-right tx-uppercase tx-bold tx-inverse">السكن</td>
                                        <td class="tx-right" colspan="2">
                                            <h4 class="tx-primary tx-bold">{{ $sponsor->user->add }}</h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="tx-right tx-uppercase tx-bold tx-inverse">النوع</td>
                                        <td class="tx-right" colspan="2">
                                            <h4 class="tx-primary tx-bold">{{ $sponsor->user->gender }}</h4>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        

                        <hr class="mg-b-40">



                        <button class="btn btn-danger  float-left mt-3 mr-2" id="print_Button" onclick="printDiv()"> <i
                                class="mdi mdi-printer ml-1"></i>طباعة</button>
                    </div>
                </div>
            </div>
        </div><!-- COL-END -->
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>


    <script type="text/javascript">
        function printDiv() {
            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }

    </script>

@endsection
