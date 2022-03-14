@extends('layouts.master')
@section('title')
 الفواتير
@endsection
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection

@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto"> الفواتير </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"> / قائمة الفواتير </span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row">
				<div class="col-xl-12">
						<div class="card">
                        @if ($errors->any())
		             
                     <div class="alert alert-danger">
                         <ul>
                             @foreach($errors->all() as $error )
                             <li>
                                  {{$error}} 
                             </li>
                                     @endforeach
                         </ul>
                           
                    </div>
            
    
               @endif
                        @if (session()->has('delete'))
                 <div class="alert alert-success">
                    {{session()->get('delete')}}     
                </div>

           @endif
           @if (session()->has('Add'))
                 <div class="alert alert-success">
                    {{session()->get('Add')}}     
                </div>

           @endif
							<div class="card-header pb-0">
							<div class="d-flex justify-content-between">
                               
								</div>
							</div>
							<div class="card-body">
							<div class="d-md-flex">
	<div class="panel panel-primary tabs-style-2">
	<div class=" tab-menu-heading">
		<div class="tabs-menu1">
			<!-- Tabs -->
			<ul class="nav panel-tabs main-nav-line">
				<li><a href="#tab4" class="nav-link active" data-toggle="tab">معلومات الفاتوره </a></li>
				<li><a href="#tab5" class="nav-link" data-toggle="tab">حالات الدفع</a></li>
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
                                                        <tr>
                                                            <th scope="row">رقم الفاتورة :</th>
                                                            <td>{{ $invoices->invoice_number }}</td>
                                                            <th scope="row">تاريخ الاصدار :</th>
                                                            <td>{{ $invoices->invoice_date }}</td>
                                                            <th scope="row">تاريخ الاستحقاق :</th>
                                                            <td>{{ $invoices->due_date }}</td>
                                                            <th scope="row">القسم :</th>
                                                            <td>{{ $invoices->sections->section_name }}</td>
                                                        </tr>
														<tr>
                                                            <th scope="row">المنتج :</th>
                                                            <td>{{ $invoices->product }}</td>
                                                            <th scope="row">مبلغ التحصيل :</th>
                                                            <td>{{ $invoices->Amount_collection }}</td>
                                                            <th scope="row">مبلغ العمولة :</th>
                                                            <td>{{ $invoices->Amount_commission }}</td>
                                                            <th scope="row">الخصم :</th>
                                                            <td>{{ $invoices->discount }}</td>
                                                        </tr>


                                                        <tr>
                                                            <th scope="row">نسبة الضريبة :</th>
                                                            <td>{{ $invoices->rate_vat }}</td>
                                                            <th scope="row">قيمة الضريبة :</th>
                                                            <td>{{ $invoices->value_vat }}</td>
                                                            <th scope="row">الاجمالي مع الضريبة :</th>
                                                            <td>{{ $invoices->total }}</td>
                                                            <th scope="row">الحالة الحالية :</th>

                                                            @if ($invoices->value_status == 1)
                                                                <td><span
                                                                        class="badge badge-pill badge-success">{{ $invoices->status }}</span>
                                                                </td>
                                                            @elseif($invoices->value_status ==2)
                                                                <td><span
                                                                        class="badge badge-pill badge-danger">{{ $invoices->status }}</span>
                                                                </td>
                                                            @else
                                                                <td><span
                                                                        class="badge badge-pill badge-warning">{{ $invoices->status }}</span>
                                                                </td>
                                                            @endif
                                                        </tr>

                                                        <tr>
                                                            <th scope="row">ملاحظات :</th>
                                                            <td>{{ $invoices->note }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
											</div>
</div>
		






			<div class="tab-pane" id="tab5">
			<div class="table-responsive mt-15">

<table class="table table-striped" style="text-align:center">
	<tbody>
	<thead>
                                                            <tr class="text-dark">
                                                                <th scope="col">م</th>
                                                                <th scope="col">اسم الملف</th>
                                                                <th scope="col">قام بالاضافة</th>
                                                                <th scope="col">تاريخ الاضافة</th>
                                                                <th scope="col">العمليات</th>
																<th scope="col">  وقت الاضافه</th>
																<th scope="col">اسم العميل </th>
																
                                                            </tr>
                                                        </thead>
                                                        

		@foreach($details as $key => $detail)	
			<tr>
		
			                                                  <td>{{ ++ $key }}</td>
                                                                <td>{{ $detail->invoice_number }}</td>
                                                                <td>{{ $detail->product }}</td>
                                                                <td>{{ $invoices->sections->section_name }}</td>
                                                                @if ($detail->Value_Status == 1)
                                                                    <td><span
                                                                            class="badge badge-pill badge-success">{{ $$detail>status }}</span>
                                                                    </td>
                                                                @elseif($detail->value_status ==2)
                                                                    <td><span
                                                                            class="badge badge-pill badge-danger">{{ $detail->status }}</span>
                                                                    </td>
                                                                @else
                                                                    <td><span
                                                                            class="badge badge-pill badge-warning">{{ $detail->status }}</span>
                                                                    </td>
                                                                @endif
                                                                <td>{{ $detail->Payment_date }}</td>
                                                                <td>{{ $detail->note }}</td>
                                                                <td>{{ $detail->created_at }}</td>
                                                                <td>{{ $detail->user }}</td>
		
		</tr>
		@endforeach
	
	</tbody>
</table>
</div>
</div>
			
			<div class="tab-pane" id="tab6">
            <div class="card card-statistics">
                                               
                                                    <div class="card-body">
                                                        <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
                                                        <h5 class="card-title">اضافة مرفقات</h5>
                                                        <form method="post" action="{{url('attachment') }}"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" id="customFile"
                                                                    name="file_name" required>
                                                                <input type="hidden" id="customFile" name="invoice_number"
                                                                    value="{{ $invoices->invoice_number }}">
                                                                <input type="hidden" id="invoice_id" name="invoice_id"
                                                                    value="{{ $invoices->id }}">
                                                                <label class="custom-file-label" for="customFile">حدد
                                                                    المرفق</label>
                                                            </div><br><br>
                                                            <button type="submit" class="btn btn-primary btn-sm "
                                                                name="uploadedFile">تاكيد</button>
                                                        </form>
                                                    </div>
                                                
                                                <br>
            <div class="table-responsive mt-15">

<table class="table table-striped" style="text-align:center">
	<tbody>
	<thead>
                                                            <tr class="text-dark">
                                                                <th scope="col">م</th>
                                                                <th scope="col">اسم الملف</th>
                                                                <th scope="col">قام بالاضافة</th>
                                                                <th scope="col">تاريخ الاضافة</th>
                                                                <th scope="col colspan=3">العمليات</th>
																
													
																
                                                            </tr>
                                                        </thead>
                                                        

		@foreach($attachements as $key => $attach)	
			<tr>
		
                <td>{{ ++ $key }}</td>
                <td>{{ $attach->file_name}}</td>
                <td>{{ $attach->created_by}}</td>
		        <td>{{ $attach->created_at }}</td>
              
               <td> <a class="btn btn-outline-success btn-sm"    href="{{ url('viewfile') }}/{{ $invoices->invoice_number }}/{{ $attach->file_name }}"
                                                                            role="button"><i class="fas fa-eye"></i>&nbsp;
                                                                            عرض</a>

                                                                        <a class="btn btn-outline-info btn-sm"
                                                                            href="{{ url('download') }}/{{ $invoices->invoice_number }}/{{ $attach->file_name }}"
                                                                            role="button"><i
                                                                                class="fas fa-download"></i>&nbsp;
                                                                            تحميل</a>
</td>
<td>
             
                                                                            <button class="btn btn-outline-danger btn-sm"
                                                                                data-toggle="modal"
                                                                                data-file_name="{{ $attach->file_name }}"
                                                                                data-invoice_number="{{ $attach->invoice_number }}"
                                                                                data-id_file="{{ $attach->id }}"
                                                                                data-target="#delete_file">حذف</button>
                                                                       
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

								
							</div><!-- bd -->
						</div><!-- bd -->
					</div>
				</div>
                   <!-- delete -->
    <div class="modal fade" id="delete_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">حذف المرفق</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('delete_file') }}" method="post">

                    @csrf
                    <div class="modal-body">
                        <p class="text-center">
                        <h6 style="color:red"> هل انت متاكد من عملية حذف المرفق ؟</h6>
                        </p>

                        <input type="hidden" name="id_file" id="id_file" value="">
                        <input type="hidden" name="file_name" id="file_name" value="">
                        <input type="hidden" name="invoice_number" id="invoice_number" value="">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                        <button type="submit" class="btn btn-danger">تاكيد</button>
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
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
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