<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use Illuminate\Http\Request;
use App\Models\invoices_attachement;
use Illuminate\Support\Facades\File;

class ArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices= invoices::onlyTrashed()->get();
      return view('invoices.Archive',compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
     $id=   $request->invoice_id;
     $invoice= invoices::withTrashed()->where('id',$id)->restore();
     session()->flash('Add','تم استرجاع الفاتوره بنجاح');
     return redirect('invoices');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id= $request->invoice_id;
        $invoice= invoices::withTrashed()->where('id',$id)->first();
       $detail= invoices_attachement::where('invoice_id',$id)->first();
       if(!empty($detail->invoice_number)){
        File::deleteDirectory(public_path('Attachements/'.$detail->invoice_number));
     }

       $invoice->forceDelete();
       session()->flash('delete',' تم حذف الفاتوره   ');
       return redirect('Archive');
  }

 
}
