<?php

namespace App\Http\Controllers;

use App\Models\invoices_attachement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoicesAttachementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'file_name'=> 'mimes:pdf,jpeg,png,jpg',
        ],[
            'file_name.mimes'=>'صيغة المرفق يحجب ان تكون pdf ,jpeg, jpg ,png'
        ]);
        $file= $request->file('file_name');
        $file_name= $file->getClientOriginalName();
        $attachement= new Invoices_attachement();
        $attachement->file_name=$file_name;
        $attachement->invoice_id =$request->invoice_id;
        $attachement->invoice_number=$request->invoice_number;
        $attachement->created_by =Auth::user()->name;
        $attachement->save();
        $image_name=$request->file_name->getClientOriginalName();
        $request->file_name->move(public_path('Attachements/'.$request->invoice_number),$image_name);
      

     session()->flash('Add','نم اضافه المرفق بنجاح');
          return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoices_attachement  $invoices_attachement
     * @return \Illuminate\Http\Response
     */
    public function show(invoices_attachement $invoices_attachement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoices_attachement  $invoices_attachement
     * @return \Illuminate\Http\Response
     */
    public function edit(invoices_attachement $invoices_attachement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoices_attachement  $invoices_attachement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoices_attachement $invoices_attachement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices_attachement  $invoices_attachement
     * @return \Illuminate\Http\Response
     */
    public function destroy(invoices_attachement $invoices_attachement)
    {
        //
    }
}
