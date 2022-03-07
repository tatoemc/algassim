@extends('layouts.master')
@section('css')
    <!--  Owl-carousel css-->
    <link href="{{ URL::asset('assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet" />
    <!-- Maps css -->
    <link href="{{ URL::asset('assets/plugins/jqvmap/jqvmap.min.css') }}" rel="stylesheet">
@endsection

@section('title')
      الرئيسية
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <div>
                <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">مرحباً بك {{ Auth::user()->name }}</h2>

            </div>
        </div>
         <div class="main-dashboard-header-right">
            <div>
                 @can('isGuardian')
                <label class="tx-13">Online Sales</label>
                <h5>0000</h5><br>
                 @endcan
                 @can('isSponsor')
                 <label class="tx-13">Online Sales</label>
                <h5>563,275</h5>
                 @endcan
            </div>
        </div>
    </div>
    <!-- /breadcrumb -->
@endsection
@section('content')
 @if (session()->has('add_payment'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم اضافة الدفعية،سيتم مراجعتها",
                    type: "success"
                })
            }
        </script>
    @endif

    <!-- row -->
    <div class="row row-sm">
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-primary-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">عدد الايتام</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ number_format(\App\Models\Orphan::count('id')) }}</h4>
                               
                            </div>
                            <span class="float-right my-auto mr-auto">
                                <i class="fas fa-arrow-circle-up text-white"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-danger-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">الايتام الغير مكفولين</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">             
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ number_format(\App\Models\Orphan::where('stauts', 0)->count('id')) }}</h4>
                                
                            </div>
                            <span class="float-right my-auto mr-auto">
                                <i class="fas fa-arrow-circle-down text-white"></i>
                                <span class="text-white op-7"> {{number_format($persent1,2)}}%</span>
                            </span>
                        </div>
                    </div>
                </div>
                <span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-success-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">الايتام المكفولين</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ number_format(\App\Models\Orphan::where('stauts', 1)->count('id')) }}</h4>
                                
                            </div>
                            <span class="float-right my-auto mr-auto">
                                <i class="fas fa-arrow-circle-up text-white"></i>
                                <span class="text-white op-7"> {{number_format($persent2,2)}}%</span>
                            </span>
                        </div>
                    </div>
                </div>
                <span id="compositeline3"
                    class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-warning-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">اجمالي الكفالات</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ number_format(\App\Models\Sponserform::sum('amount')) }}</h4>
                                
                            </div>
                            <span class="float-right my-auto mr-auto">
                                <i class="fas fa-arrow-circle-up text-white"></i>
                                <span class="text-white op-7"></span>
                            </span>
                        </div>
                    </div>
                </div>
                <span id="compositeline4" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
            </div>
        </div>
    </div>
    <!-- row closed -->

    <!-- row opened  -->
    @can('isGuardian')
    <div class="row row-md">
        <div class="col-xl-10 col-md-12 col-lg-6">
            <div class="card">
                <div class="card-header pb-1">
                    <h3 class="card-title mb-2">الدفعيات</h3>
                    <p class="tx-12 mb-0 text-muted">الايتام الذين تقوم بكفالتهم</p>
                </div>
                <div class="product-timeline card-body pt-2 mt-1">
                   <div class="table-responsive">
                                                <table class="table table-hover" style=" text-align: center;">
                                                    <thead>
                                                        <tr>
                                                            <th class="border-bottom-0">الرقم</th>
                                                            <th class="border-bottom-0">اسم اليتيم</th>
															<th class="border-bottom-0">الصورة</th>
                                                            <th class="border-bottom-0">اسم ولي الامر</th>
                                                            <th colspan="2" class="border-bottom-0">عمليات</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                   
                                                        @foreach ($guardian->sponserforms as $sponserform)
                                                            <tr>
															   <td>{{$sponserform->orphan->id}}</td>
                                                               <td>{{$sponserform->orphan->name}}</td>
															   <td>
															   <img class="avatar-lg rounded-circle ml-3 my-auto" src="{{ asset('images/' . $sponserform->orphan->images) }}">
															   </td>
                                                               <td>{{$sponserform->orphan->user->name}}</td>
															   <td><a href="{{ route('orphans.show', $sponserform->orphan->id) }}"><i class="text-success fas fa-eye"></i>&nbsp;&nbsp;عرض اليتيم </a></td>
                                                                
                                                               <td>
                                                               {!! Form::open(['route'=>['payments.create'], 'method'=>'POST' ] ) !!}
                                                               {{csrf_field()}}
                                                                {{ method_field('get') }}
                                                               <input type="hidden" name="id" value="{{$sponserform->orphan->id}}">
                                                               {!! Form::submit('دفع', ['class'=> 'btn btn-primary btn-sm' ]) !!}
                                                               {!! Form::close() !!}
                                                               </td>
                                                               <td>
                                                               {!! Form::open(['route'=>['getPayment'], 'method'=>'POST' ] ) !!}
                                                               {{csrf_field()}}
                                                                {{ method_field('get') }}
                                                               <input type="hidden" name="id" value="{{$sponserform->orphan->id}}">
                                                               {!! Form::submit('عرض الدفعيات', ['class'=> 'btn btn-primary btn-sm' ]) !!}
                                                               {!! Form::close() !!}
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
    @endcan
	 @can('isSponsor')
    <div class="row row-md">
       
        <div class="col-xl-10 col-md-12 col-lg-10">
            <div class="card">
                <div class="card-header pb-1">
                    <h3 class="card-title mb-2">اطفالك :</h3>
                </div>
                <div class="product-timeline card-body pt-2 mt-1">
                     <div>
                                        <div class="mt-1">
                                            <div class="table-responsive">
                                                <table class="table table-hover" style=" text-align: center;">
                                                    <thead>
                                                        <tr>
                                                            <th class="border-bottom-0">الرقم</th>
                                                            <th class="border-bottom-0">الاسم</th>
															 <th class="border-bottom-0">الصورة</th>
															<th class="border-bottom-0">الحالة</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
													  
                                                        @foreach ($orphans as $orphan)
                                                            <tr>
															   <td>{{$orphan->id}}</td>
                                                               <td>{{$orphan->name}}</td>
															   <td>
															   <img class="avatar-lg rounded-circle ml-3 my-auto" src="{{ asset('images/' . $orphan->images) }}">
															   </td>
															    <td>
                                                                 @if ($orphan->stauts == 0) <span class="text-danger">غير مكفول</span>
																 @elseif($orphan->stauts == 1)
																 <span class="text-success">مكفول</span>
                                                                @endif
																</td>
															   <td><a href=" {{ route('orphans.show', $orphan->id) }}"><i class="text-success fas fa-eye"></i>&nbsp;&nbsp;عرض </a></td>

                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <p class="b-0 tx-13 text-muted mb-0">User ID: #1234
                                        </div>
                                    </div>
                </div>
            </div>
        </div>
		
    </div>
    @endcan
    <!-- row close -->
    </div>
    </div>
    <!-- Container closed -->
@endsection
@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <!-- Moment js -->
    <script src="{{ URL::asset('assets/plugins/raphael/raphael.min.js') }}"></script>
    <!--Internal  Flot js-->
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js') }}"></script>
    <script src="{{ URL::asset('assets/js/dashboard.sampledata.js') }}"></script>
    <script src="{{ URL::asset('assets/js/chart.flot.sampledata.js') }}"></script>
    <!--Internal Apexchart js-->
    <script src="{{ URL::asset('assets/js/apexcharts.js') }}"></script>
    <!-- Internal Map -->
    <script src="{{ URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <script src="{{ URL::asset('assets/js/modal-popup.js') }}"></script>
    <!--Internal  index js -->
    <script src="{{ URL::asset('assets/js/index.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.vmap.sampledata.js') }}"></script>
@endsection
