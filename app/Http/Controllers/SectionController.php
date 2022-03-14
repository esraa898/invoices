<?php

namespace App\Http\Controllers;


use App\Http\Requests\Section\StoreSectionRequest;
use App\Http\Requests\Section\UpdateSectionRequest;
use App\Http\Requests\Sections\DeleteSectionRequest ;
use App\Models\section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {

       $sections= section::all();

        return view('sections.sections',compact('sections'));
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
    public function store(StoreSectionRequest $request)
    {   
           section::create([
               'section_name'=> $request->section_name,
               'description'=> $request->description,
               'created_by'=> Auth::user()->name,
           ]);
           session()->flash('done','تم اضافه القسم بنجاح ');
           return redirect('/sections');
       }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSectionRequest $request)
    {
        $section= section::find($request->id);
        $section->update([
            'section_name'=>$request->section_name,
            'description' => $request->description
        ]);
        session()->flash('done','تم تعديل الفسم بنجاح ');
        return redirect('/sections');
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request )
    {
       $section = section::find($request->id);
       $section->delete();
       session()->flash('done','تم حذف الفسم بنجاح ');
       return redirect('/sections');
    }
}
