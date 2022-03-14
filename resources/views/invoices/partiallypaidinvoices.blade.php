@extends('layouts.master')
@section('title')
  الفواتير  المدفوعة جزئيا
@endsection
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<!--Internal  Font Awesome -->
<link href="{{URL::asset('assets/plugins/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
<!--Internal   Notify -->
<link href="{{URL::asset('assets/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
<!--Internal  treeview -->
<link href="{{URL::asset('assets/plugins/treeview/treeview.css')}}" rel="stylesheet" type="text/css" />
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
                           
						@if (session()->has('delete'))
					
						<button onclick="not7()" class="btn btn-success mg-t-5">{{session()->get('delete')}} </button>
                      
              

           @endif
		   @if (session()->has('Add'))
                 <div class="alert alert-success">
                    {{session()->get('Add')}}     
                </div>

           @endif
							<div class="card-header pb-0">
							<div class="d-flex justify-content-between">
                                <div class="col-sm-6 col-md-4 col-xl-3">
										<a class="modal-effect btn btn-outline-primary btn-block"   href="{{route('invoices.create')}}">اضافه  فاتوره  </a>
									</div>
								</div>
							</div>

							<div class="card-body">
				<div class="table-responsive">
									<table class="table text-md-nowrap" id="example1">
										<thead>
											<tr>
												<th class=" border-bottom-0">#</th>
												<th class=" border-bottom-0">رقم الفاتوره</th>
												<th class=" border-bottom-0">تاريخ الفاتوره </th>
												<th class=" border-bottom-0">تاريخ الاستحقاق </th>
												<th class=" border-bottom-0">المنتج</th>
												<th class=" border-bottom-0">القسم</th>
												<th class=" border-bottom-0">الخصم</th>
												<th class=" border-bottom-0">نسبه الضريبه</th>
												<th class=" border-bottom-0">قيمه الضريبه</th>
												<th class=" border-bottom-0">الاحمالي </th>
												<th class="border-bottom-0">الحاله</th>
												<th class=" border-bottom-0">ملاحظات</th>
												<th class=" border-bottom-0 ">العمليات</th>
											</tr>
										</thead>
										<tbody>
											@foreach ($invoices as $key=> $invoice)
											<tr>
												<td> {{++ $key}}</td>
												<td>{{$invoice->invoice_number}}</td>
												<td>{{$invoice->invoice_date}}</td>
												<td>{{$invoice->due_date}}</td>
												<td>{{$invoice->product}}</td>
												<td>
                                                    <a href="{{url('invoicesdetails',['id'=>$invoice->id])}}"> 
                                                        {{$invoice->sections->section_name}}
                                                    </a></td>
												<td>{{$invoice->discount}}</td>
												<td>{{$invoice->Amount_collection}}</td>
												<td>{{$invoice->Amount_commission}}</td>
												<td>{{$invoice->total}}</td>
												<td>
													
													
												@if($invoice->value_status == 1)
													<span class="text-success">{{$invoice->status}}</span>
												@elseif($invoice->value_status ==2 )
													<span class="text-danger">{{$invoice->status}}</span>
												@else 
												<span class="text-warning">{{$invoice->status}}</span>
												
												@endif
												
												</td>
												<td>{{$invoice->note}}</td>
												<td>
												

												<div class="dropdown dropright">
													<button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-info btn-sm" data-toggle="dropdown" id="droprightMenuButton" type="button">العمليات<i class="fas fa-caret-right  "></i></button>
													<div aria-labelledby="droprightMenuButton" class="dropdown-menu tx-13">
														<a class="dropdown-item" href="{{url('invoices_edit',['id'=>$invoice->id])}} ">تعديل </a>
														<a class="dropdown-item" href="#" data-invoice_id="{{ $invoice->id }}"
                                                            data-toggle="modal" data-target="#delete_invoice"><i
                                                                class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;حذف
                                                            الفاتورة</a>
														    <a class="dropdown-item"
                                                            href="{{url('status_show',[$invoice->id])}}"><i class=" text-success fas fa-money-bill"></i>&nbsp;&nbsp;تغير حالة الدفع</a>


															<a class="dropdown-item" href="#" data-invoice_id="{{ $invoice->id }}"
                                                            data-toggle="modal" data-target="#Transfer_invoice"><i
                                                                class="text-warning fas fa-exchange-alt"></i>&nbsp;&nbsp;نقل الي
                                                            الارشيف</a>
													</div>
												</div>
											</div>
	

												</td>
											</tr>
										@endforeach
										</tbody>
									</table>
								</div>
								
</div>
</div>
								
		<!-- حذف الفاتوره  -->
				<div class="modal fade" id="delete_invoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">حذف الفاتورة</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <form action="{{ route('invoices.destroy', 'test') }}" method="post">
                      @method('delete') 
                        @csrf
                </div>
                <div class="modal-body">
                    هل انت متاكد من عملية الحذف ؟
                    <input type="hidden" name="invoice_id" id="invoice_id" value="  ">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                    <button type="submit" class="btn btn-danger">تاكيد</button>
                </div>
                </form>
            </div>
        </div>
    </div>
	<div class="modal fade" id="Transfer_invoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ارشفة الفاتورة</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <form action="{{ route('invoices.destroy', 'test') }}" method="post">
                        @method('delete') 
                      @csrf
                </div>
                <div class="modal-body">
                    هل انت متاكد من عملية الارشفة ؟
                    <input type="hidden" name="invoice_id" id="invoice_id" value="">
                    <input type="hidden" name="id_page" id="id_page" value="2">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                    <button type="submit" class="btn btn-success">تاكيد</button>
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
<!-- Internal Treeview js -->
<script src="{{URL::asset('assets/plugins/treeview/treeview.js')}}"></script>
<!--Internal  Notify js -->
<script src="{{URL::asset('assets/plugins/notify/js/notifIt.js')}}"></script>
<script src="{{URL::asset('assets/plugins/notify/js/notifit-custom.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<script>
        $('#delete_invoice').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var invoice_id = button.data('invoice_id')
            var modal = $(this)
            modal.find('.modal-body #invoice_id').val(invoice_id);
        })
    </script>
	<script>
        $('#Transfer_invoice').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var invoice_id = button.data('invoice_id')
            var modal = $(this)
            modal.find('.modal-body #invoice_id').val(invoice_id);
        })
    </script>
@endsection