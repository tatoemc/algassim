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
    تفاصيل ولي الامر
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">اوياء الامور</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    تفاصيل ولي الامر</span>
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


    @if (session()->has('Add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Add') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif



    @if (session()->has('delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('delete') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
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
                                            <li><a href="#tab4" class="nav-link active" data-toggle="tab">1</a></li>
                                            <li><a href="#tab5" class="nav-link" data-toggle="tab">الايتام</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body main-content-body-right border">
                                    <div class="tab-content">

                                        <div class="tab-pane active" id="tab4">
                                            <div class="table-responsive mt-15">

                                                <table class="table table-striped" style="text-align:center">
                                                    <tbody>
                                                        </tr>
                                                        <td colspan="5">
                                                            <img alt="user-img" class="avatar avatar-xl brround"
                                                                src="{{ asset('images/' . $sponsor->user->images) }}">

                                                        </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">الرقم</th>
                                                            <th scope="row">الاسم</th>
                                                            <th scope="row">الحالة</th>
                                                            <th scope="row">النوع </th>
                                                            <th scope="row">تاريخ الميلاد</th>


                                                        </tr>
                                                        <tr>
                                                            <td>{{ $id }}</td>
                                                            <td>{{ $sponsor->user->name }}</td>
                                                            <td>
                                                                @if ($sponsor->stauts == 0)
                                                                    <span class="text-danger">غير مفعل</span>
                                                                @elseif($sponsor->user->stauts == 1)
                                                                    <span class="text-success">مفعل</span>
                                                                @endif
                                                            </td>
                                                            <td>{{ $sponsor->user->gender }}</td>
                                                            <td>{{ $sponsor->user->email }}</td>
                                                        <tr>
                                                            <th scope="row">العنوان</th>
                                                            <th>الرقم الوطني</th>
                                                            <td>رقم الهاتف</td>
                                                            <td>الحساب البنكي</td>
                                                        </tr>
                                                        <tr>
                                                            <td>{{ $sponsor->user->add }}</td>
                                                            <th>{{ $sponsor->user->ssn }}</th>
                                                            <td>{{ $sponsor->user->phone }}</td>
                                                            <td>{{ $sponsor->user->bank_account }}</td>

                                                        </tr>
                                                        @can('isAdmin')
                                                            <tr>
                                                                <th scope="row">تاريخ الاضافة</th>
                                                                <th scope="row">اخر تعديل</th>
                                                            </tr>
                                                            <tr>
                                                                <td>{{ $sponsor->user->created_at }}</td>
                                                                <td>{{ $sponsor->user->updated_at }}</td>
                                                                <td>
                                                                {!! Form::open(['route'=>['sponsors.destroy', $sponsor->id], 'method'=>'DELETE' ] ) !!}
                                                                {!! Form::submit('حذف', ['class'=> 'btn btn-danger btn-block' ]) !!}
                                                                {!! Form::close() !!}
                                                                </td>
                                                            </tr>
                                                        @endcan
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>

                                        <div class="tab-pane" id="tab5">
                                            <div class="table-responsive mt-15">
                                                <table class="table center-aligned-table mb-0 table-hover"
                                                    style="text-align:center">
                                                    <thead>
                                                        <tr class="text-dark">
                                                            <th>الاسم</th>
                                                            <th>النوع</th>
                                                            <th>الحالة</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($orphans as $orphan)
                                                            <tr>
                                                                <td>{{ $orphan->name }} </td>
                                                                <td>{{ $orphan->gender }} </td>
                                                                <td>
                                                                    @if ($orphan->stauts == 0)
                                                                        <span class="text-danger">غير مكفول</span>
                                                                    @elseif($orphan->stauts == 1)
                                                                        <span class="text-success">مكفول</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('orphans.show', $orphan->id) }}"
                                                                        class="btn btn-primary btn-sm">عرض</a>
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
                </div>
            </div>
            <!-- /div -->
        </div>

    </div>
    <!-- /row -->


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

@endsection
