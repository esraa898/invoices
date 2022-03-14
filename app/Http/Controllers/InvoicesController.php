<?php

namespace App\Http\Controllers;

use App\Models\section;
use App\Models\invoices;
use Illuminate\Http\Request;
use App\Models\invoicesdetails;
use Illuminate\Support\Facades\DB;
use App\Models\invoices_attachement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    $invoices= invoices::with('sections',)->get();
         return view('invoices.invoices',compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $sections = section::all();
        return view('invoices.addinvoices',compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       invoices::create([
           'invoice_number' => $request->invoice_number,
           'invoice_date'=> $request->invoice_Date,
           'due_date'=>$request->Due_date,
           'product'=>$request->product,
           'section_id'=>$request->Section,
           'discount'=>$request->Discount,
           'rate_vat'=>$request->Rate_VAT,
           'Amount_collection'=>$request->Amount_collection,
           'Amount_commission'=>$request->Amount_Commission,
           'value_vat'=>$request->Value_VAT,
           'total'=>$request->Total,
           'status'=>'فاتوره غير مدفوعه ',
           'value_status'=> 2,
            'note'=>$request->note,
            

       ]);
     $invoice_id =invoices::latest()->first()->id;
    
       invoicesdetails::create([
           'id_invoice'=>$invoice_id,
           'invoice_number'=>$request->invoice_number,
           'product'=>$request->product,
           'section'=>$request->Section,
           'status'=>'فاتوره غير مدفوعه ',
           'value_status'=> 2,
           'note'=>$request->note,
           'user'=>(Auth::user()->name),
       ]);
     

       if($request->hasFile('pic')){
        $invoice_id =invoices::latest()->first()->id;
        $image=$request->file('pic');
        $file_name=$image->getClientOriginalName();
        $invoice_number=$request->invoice_number;
        $attachement= new invoices_attachement();
        $attachement->file_name=$file_name;
        $attachement->invoice_number=$invoice_number;   
        $attachement->created_by=Auth::user()->name;
        $attachement->invoice_id=$invoice_id;
        $attachement->save();

        $image_name=$request->pic->getClientOriginalName();
        $request->pic->move(public_path('Attachements/'.$invoice_number),$image_name);
      }

     session()->flash('Add','نم اضافه الفاتوره بنجاح');
          return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function show(invoices $invoices)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */ 
    public function edit( $id)
    {
        $sections = section::with('products')->get();
        $invoice= invoices::with('sections','invoicedetails')->find($id);
        return view('invoices.editinvoice',compact('sections','invoice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
       $invoice= invoices::find($request->invoice_id);
       
       $invoice->update([ 
           'invoice_number' => $request->invoice_number,
       'invoice_date'=> $request->invoice_date,
       'due_date'=>$request->due_date,
       'product'=>$request->product,
       'section_id'=>$request->Section,
       'discount'=>$request->discount,
       'rate_vat'=>$request->rate_vat,
       'Amount_collection'=>$request->Amount_collection,
       'Amount_commission'=>$request->Amount_Commission,
       'value_vat'=>$request->value_vat,
       'total'=>$request->total,
       'status'=>'فاتوره غير مدفوعه ',
       'value_status'=> 2,
        'note'=>$request->note,
        

   ]);
   $detail = invoicesdetails::find($request->detail_id);
  $detail->update([
    'id_invoice'=>$request->invoice_id,
    'invoice_number'=>$request->invoice_number,
    'product'=>$request->product,
    'section'=>$request->Section,
    'status'=>'فاتوره غير مدفوعه ',
    'value_status'=> 2,
    'note'=>$request->note,
    'user'=>(Auth::user()->name),
]);

  

     

     session()->flash('Add','تم تعديل  الفاتوره بنجاح');
          return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
     $id= $request->invoice_id;
     $invoice= invoices::where('id',$id)->first();
     
     $detail= invoices_attachement::where('invoice_id',$id)->first();

     if(!$request->id_page ==2 ){
     if(!empty($detail->invoice_number)){
        File::deleteDirectory(public_path('Attachements/'.$detail->invoice_number));
     }
     $invoice->forceDelete();
     session()->flash('delete','  تم حذف الفاتوره ومرفاقاتها  ');
          return redirect('invoices');
    }else{
        $invoice->Delete();
        session()->flash('delete',' تم ارشفه الفاتوره   ');
        return redirect('Archive');
    }
     
    }


    public function getProducts($id){
        $products= DB::table('products')->where('section_id',$id)->pluck('product_name','id');
        return json_encode($products);
        

    }
    public function statusShow($id){
        $sections = section::with('products')->get();
        $invoice= invoices::with('sections','invoicedetails')->find($id);
        return view('invoices.paymentchangeinvoice',compact('sections','invoice'));
       
    }
    public function statusUpdate(request $request ,$id){
        $invoice= invoices::find($id);
         if($request->Status == 'مدفوعة'){

            $invoice->update([
                'value_status'=>1,
                'status'=>$request->Status,
                'payment_date'=> $request->payment_date
            ]);
            
            invoicesdetails::create([
                'id_invoice'=>$request->invoice_id,
    'invoice_number'=>$request->invoice_number,
    'product'=>$request->product,
    'section'=>$request->Section,
    'status'=>$request->Status,
    'value_status'=> 1,
    'payment_date'=> $request->payment_date,
    'note'=>$request->note,
    'user'=>(Auth::user()->name),
            ]);


         }else{
             
            $invoice->update([
                'value_status'=>3,
                'status'=>$request->Status,
                'payment_date'=> $request->payment_date
            ]);
            
            invoicesdetails::create([
                'id_invoice'=>$request->invoice_id,
    'invoice_number'=>$request->invoice_number,
    'product'=>$request->product,
    'section'=>$request->Section,
    'status'=>$request->Status,
    'value_status'=> 3,
    'payment_date'=> $request->payment_date,
    'note'=>$request->note,
    'user'=>(Auth::user()->name),
            ]);


        }

        session()->flash('Add','تم تعديل  الفاتوره بنجاح');
        return back();
    }

    public function invoicePaid(){
        $invoices= invoices::where('value_status',1)->get();

  return view('invoices.paidinvoices',compact('invoices'));
    }
    public function invoiceUnpaid(){
        $invoices= invoices::where('value_status',2)->get();

        return view('invoices.unpaidinvoices',compact('invoices'));
    }
    public function invoicePartiallyPaid(){
        $invoices= invoices::where('value_status',3)->get();

        return view('invoices.partiallypaidinvoices',compact('invoices'));
    }
}
