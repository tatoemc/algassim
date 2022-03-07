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
    تفاصيل اليتيم
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الايتام </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    تفاصيل اليتيم</span>
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
    @if (session()->has('edit_orphan'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم تعديل اليتيم بنجاح",
                    type: "success"
                })
            }
        </script>
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
                                            <li><a href="#tab4" class="nav-link active" data-toggle="tab">{{$orphan->name}}</a></li>
                                            <li><a href="#tab5" class="nav-link" data-toggle="tab">بيانات ولي الامر {{$orphan->user->name}}</a></li>
                                            <li><a href="#tab6" class="nav-link" data-toggle="tab">المرفقات</a></li>
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
                                                     <img alt="user-img" class="avatar avatar-xl brround" src="{{ asset('images/' . $orphan->images )}}">
                                                     
                                                     </td>
                                                    </tr>
                                                        <tr>   
                                                            <th scope="row">رقم اليتيم</th>
                                                            <th scope="row">الحالة</th>
                                                            <th scope="row">النوع </th>
                                                             <th scope="row">تاريخ الميلاد</th>
                                                            <th scope="row">المرحلة الدراسية</th>
                                                            
                                                        </tr>
                                                        <tr>  
                                                        <td>{{ $orphan->id }}</td>
                                                        <td>
                                                              @if ($orphan->stauts == 0)
                                                              <span class="text-danger">غير مكفول</span>
                                                              @elseif($orphan->stauts == 1)
                                                                 <span class="text-success">مكفول</span>
                                                                @endif
                                                            </td>
                                                        <td>{{ $orphan->gender }}</td>
                                                        <td>{{ $orphan->b_date }}</td>
                                                        <td>{{ $orphan->schoolLevel }}</td>
                                                       

                                                        <tr>
                                                            <th scope="row">العنوان</th>
                                                            <th >الرقم الوطني</th>
                                                            <td>الحالة الصحية</td>
                                                            <th >تاريخ وفاة الوالد</th>
                                                            <td>عدد الاخوان</td>
                                                          
                                                        </tr>
                                                        <tr>
                                                            <td>{{ $orphan->add }}</td>
                                                            <th>{{ $orphan->ssn }}</th>
                                                            <td>{{ $orphan->helth_state }}</td>
                                                            <th >{{ $orphan->father_deth }}</th>
                                                            <td>{{ $orphan->brother_count }}</td>
                                                        </tr>
                                                         @can('isAdmin')
                                                         <tr>
                                                            <th scope="row">تم اضافة بواسطة</th>
                                                             <th scope="row">تاريخ الاضافة</th>
                                                              <th scope="row">اخر تعديل</th>
                                                        </tr>
                                                        <tr>
                                                            <td>{{ $orphan->user->name }}</td>
                                                            <td>{{ $orphan->created_at }}</td>
                                                            <td>{{ $orphan->user->updated_at }}</td>
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
                                                            <th>رقم الهاتف</th>
                                                            <th>البريد الالكتروني</th>
                                                            <th>العنوان </th>
                                                            <th>الرقم الوطني</th>
                                                            <th>الحساب البنكي</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                            <tr>
                                                                <td>{{ $orphan->user->name }}</td>
                                                                <td>{{ $orphan->user->gender }}</td>
                                                                <td>{{ $orphan->user->phone }}</td>
                                                                 <td>{{ $orphan->user->email }}</td>
                                                                <td>{{ $orphan->user->add }}</td>
                                                                <td>{{ $orphan->user->ssn }}</td>
                                                                <td>{{ $orphan->user->bank_account }}</td>
                                                            </tr>
                                                     
                                                    </tbody>
                                                </table>


                                            </div>
                                        </div>


                                        <div class="tab-pane" id="tab6">
                                            <!--المرفقات-->
                                            <div class="card card-statistics">
                                                شهادة الوفاة
                                                <br>

                                                <div class="table-responsive mt-15">
                                                    <table class="table center-aligned-table mb-0 table table-hover"
                                                        style="text-align:center">
                                                        
                                                        <tbody>
                                                        <tr>
                                                         <a class="btn btn-outline-info btn-sm"
                                                             href="{{ url('download') }}/{{ $orphan->id }}"
                                                                role="button"><i
                                                               class="fas fa-download"></i>&nbsp;
                                                                تحميل</a>
                                                        <td>
                                                        </td>
                                                        <td>
                                                             <img src="{{ asset('certificate/' . $orphan->death_certif )}}">
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
        $('#delete_file').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id_file = button.data('id_file')
            var file_name = button.data('file_name')
            var invoice_number = button.data('invoice_number')
            var modal = $(this)

            modal.find('.modal-body #id_file').val(id_file);
            modal.find('.modal-body #file_name').val(file_name);
            modal.find('.modal-body #invoice_number').val(invoice_number);
        })

    </script>

    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

    </script>

@endsection
