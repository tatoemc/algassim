@extends('layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css-rtl/bootstrap-datepicker.css') }}" rel="stylesheet">

@endsection

@section('title')
    اوياء الامور
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">اوليا الامور</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ كل
                    اولياء الامور</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">


        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    @if (session()->has('delete_sponsor'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم حذف ولي الامر بنجاح",
                    type: "success"
                })
            }
        </script>
    @endif
    @section('content')

    @if (session()->has('add_sponsor'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم اضافة ولي الامر بنجاح",
                    type: "success"
                })
            }
        </script>
    @endif
    @section('content')

    @if (session()->has('edit_sponsor'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم تعديل ولي الامر بنجاح",
                    type: "success"
                })
            }
        </script>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <!-- row -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                        <a href="{{ route('sponsors.create') }}" class="btn btn-sm btn-primary" style="color:white"><i
                                class="fas fa-plus"></i>&nbsp; اضافة ولي امر</a>
                
                        <a class="btn btn-sm btn-primary" href="{{ url('sponsors_export') }}"
                            style="color:white"><i class="fas fa-file-download"></i>&nbsp;تصدير اكسيل</a>
                  
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'>
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0"> اسم ولي الامر</th>
                                    <th class="border-bottom-0">النوع</th>
                                    <th class="border-bottom-0">العنوان</th>
                                    <th class="border-bottom-0">الرقم الوطني</th>
                                    <th class="border-bottom-0">الحالة</th>
                                    <th class="border-bottom-0">العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($sponsors->count() > 0)
                                    @foreach ($sponsors as $index => $sponsor)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>

                                            <td>{{ $sponsor->user->name }} </td>
                                            <td>{{ $sponsor->user->gender }}</td>
                                            <td>{{ $sponsor->user->add }}</td>
                                            <td>{{ $sponsor->user->ssn }}</td>
                                            <td>
                                                @if ($sponsor->user->stauts == 0)
                                                    <span class="text-danger">غير مفعل</span>
                                                @elseif($sponsor->user->stauts == 1)
                                                    <span class="text-success">مفعل</span>
                                                @endif


                                            </td>

                                            <td>
                                                <div class="dropdown">
                                                    <button aria-expanded="false" aria-haspopup="true"
                                                        class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                        type="button">العمليات<i
                                                            class="fas fa-caret-down ml-1"></i></button>
                                                    <div class="dropdown-menu tx-13">

                                                        <a class="dropdown-item"
                                                            href=" {{ route('sponsors.edit', $sponsor->id) }}"><i
                                                                class="text-success fas fa-edit"></i>&nbsp;&nbsp;تعديل
                                                        </a>

                                                        <a class="dropdown-item"
                                                            href=" {{ route('sponsors.show', $sponsor->id) }}"><i
                                                                class="text-success fas fa-eye"></i>&nbsp;&nbsp;عرض
                                                        </a>

                                                        <a class="dropdown-item" data-sponsor_id="{{ $sponsor->user_id }}"
                                                            data-toggle="modal" data-target="#delete_sponsor"
                                                            href="#"><i
                                                                class="text-success fas fa-trash-alt"></i>&nbsp;&nbsp;حذف
                                                        </a> 

                                                        <a class="dropdown-item"
                                                            href="print_sponsor/{{ $sponsor->id }}"><i
                                                                class="text-success fas fa-print"></i>&nbsp;&nbsp;طباعة
                                                            
                                                        </a>
                                                    </div>
                                            </td>
                                        </tr>
                                    @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- End Basic modal -->
    </div>
    <!-- حذف ولي الامر -->
    <div class="modal fade" id="delete_sponsor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">حذف ولي الامر</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <form action="{{ route('sponsors.destroy', 'delete') }}" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                </div>
                <div class="modal-body">
                    هل انت متاكد من عملية الحذف ؟
                    <input type="hidden" name="sponsor_id" id="sponsor_id" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                    <button type="submit" class="btn btn-danger">تاكيد</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
    <script src="{{ URL::asset('assets/js/modal.js') }}"></script>
    <script src="{{ URL::asset('assets/js/bootstrap-datepicker.js') }}"></script>

    <script>
        $('#delete_sponsor').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var sponsor_id = button.data('sponsor_id')
            var modal = $(this)
            modal.find('.modal-body #sponsor_id').val(sponsor_id);
        })
    </script>

@endsection