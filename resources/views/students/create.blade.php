@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
			
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row">
               <form action="{{ route('students.store') }}" method="post" autocomplete="off"> 
                        {{ csrf_field() }}
                       
                        <div class="row">
                           

                            <div class="col">
                               <label for="amount" class="control-label">اسم الطالب</label>
                                <input type="text" class="form-control" id="amount" name="name" required>
                            </div>

							<div class="col">
                               <label for="amount" class="control-label">العنوان</label>
                                <input type="text" class="form-control" id="amount" name="add" required>
                            </div>

							<div class="col">
                               <label for="amount" class="control-label">رقم القسم</label>
                                <input type="text" class="form-control" id="amount" name="dept_id" required>
                            </div>
							
                        </div>

                        {{-- 3 --}}
                        <div class="row">
                           
                        </div><br>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">حفظ البيانات</button>
                        </div>


                    </form>
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
@endsection