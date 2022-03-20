<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use Illuminate\Http\Request;
use App\Models\invoicesdetails;
use App\Models\invoices_attachement;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class InvoicesdetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('invoices.invoicesdetails'); 
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
     * @param  \App\Models\invoicesdetails  $invoicesdetails
     * @return \Illuminate\Http\Response
     */
    public function show(invoicesdetails $invoicesdetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoicesdetails  $invoicesdetails
     * @return \Illuminate\Http\Response
     */
    public function edit(invoicesdetails $invoicesdetails)
    {
    echo "here";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoicesdetails  $invoicesdetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoicesdetails $invoicesdetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoicesdetails  $invoicesdetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      $file = invoices_attachement::findorfail($request->id_file);
      $file->forcedelete();
      $path=public_path('Attachements/'.$request->invoice_number.'/'.$request->file_name);
     File::delete($path);
      session()->flash('delete','نم حذف المرفق بنجاح');
        return back();
    }

    public function getdetails($id){


        $invoices = invoices::where('id',$id)->first();
        $details= invoicesdetails::where('id_invoice',$id)->get();
        $attachements= invoices_attachement::where('invoice_id',$id)->get();
       
        return view('invoices.invoicesdetails',compact('invoices','details','attachements'));
    }
    public function viewfile($id,$filename){
        
        $path=public_path('Attachements/'.$id.'/'.$filename);
        return response()->file($path);
        // $files = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoice_number.'/'.$file_name);
        // return response()->file($files);
    }
    public function downloadfile($id,$filename){

        $path=public_path('Attachements/'.$id.'/'.$filename);
        return response()->download($path);

    }
}
