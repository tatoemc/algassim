@extends('layouts.master')
@section('css')
    <!---Internal  Prism css-->
    <link href="{{ URL::asset('assets/plugins/prism/prism.css') }}" rel="stylesheet">
    <!---Internal Input tags css-->
    <link href="{{ URL::asset('assets/plugins/inputtags/inputtags.css') }}" rel="stylesheet">
    <!--- Custom-scroll -->
    <link href="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
@endsection
@section('title')
    تعديل ولي الامر
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">اوياء الامور</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    تعديل ولي الامر</span>
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
                                            <li><a href="#tab4" class="nav-link active" data-toggle="tab">تعديل ولي امر</a></li>
                                        
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body main-content-body-right border">
                                    <div class="tab-content">

                                        <div class="tab-pane active" id="tab4">
                                            <div class="table-responsive mt-15">
                                          {!! Form::model($sponsor, ['route'=>['sponsors.update',$sponsor->id] ,'method' => 'PUT', 'files' => 'ture']) !!}
                                                <table class="table table-striped" style="text-align:center">
                                                    <tbody>
                                                      <tr>
                                                            <th scope="row">الاسم</th>
                                                            <th scope="row">البريد الالكتروني</th>
                                                            <th scope="row">رقم الهاتف</th>
                                                            <th scope="row">رقم الحساب</th>
                                                           
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                            <input type="text" name="name" value="{{$sponsor->user->name}}">
                                                            </td>
                                                            
                                                            <td>
                                                            <input type="text" name="email" value="{{$sponsor->user->email}}">
                                                            </td>

                                                            <td>
                                                            <input type="text" name="phone" value="{{$sponsor->user->phone}}">
                                                            </td>

                                                            <td>
                                                            <input type="text" name="bank_account" value="{{$sponsor->user->bank_account}}" >
                                                            </td>
        
                                                        </tr>

                                                        <tr>
                                                            
                                                            <th scope="row">الرقم الوطني</th>
                                                            <th scope="row">العنوان</th>
                                                            <th scope="row" colspan="2">ملاحظات</th>
                                                            
                                                        </tr>

                                                        <tr>
                                                            <td>
                                                            <input type="text" name="ssn" value="{{$sponsor->user->ssn}}">
                                                            </td>

                                                            <td>
                                                            <select class="form-control" name="add">
	                                                         <option value='الخرطوم'{{ $sponsor->add == 'الخرطوم' ? 'selected' : ''}}> الخرطوم </option>
	                                                         <option value='بحري'{{ $sponsor->add == 'بحري' ? 'selected' : ''}}> بحري </option>  
	                                                         <option value='ام درمان'{{ $sponsor->add == 'ام درمان' ? 'selected' : ''}}> ام درمان </option>  
                                                              </select> 
                                                            </td>
                                                            <td>
                                                        <input type="textarea" name="note" value="{{$sponsor->user->note}}" cols="30" rows="30">
                                                        </td>

                                                        </tr>

                                                        <tr>
                                                        <td colspan="3">
                                                        <label for="images" class="control-label">الصورة</label>
                                                        <input type="file" name="images" class="dropify" accept=".jpg, .png, image/jpeg, image/png" data-height="70" />
                                                        </td>
                                                        </tr>

                                                        <tr>
                                                        <td> {{ Form::submit('حفظ', ['class'=>'btn btn-success btn-block'] )}}</td>
                                                         <td> {{ Html::linkRoute('sponsors.show','الغاء',array($sponsor->id),array('class'=>'btn btn-danger btn-block')) }}</td>
                                                        </tr>
                                                                            
                                                    </tbody>
                                                </table>
                                             {!! Form::close() !!}
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
                                                       4
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


    
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    
     
@endsection
