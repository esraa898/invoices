<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class invoices extends Model
{
    use SoftDeletes;
    use HasFactory;
    
    protected $fillable= ['invoice_number','invoice_date','due_date','product','section_id','discount','total','status','rate_vat','Amount_collection','Amount_commission' ,'value_vat','value_status','note','payment_date'];


     
public function sections(){


    return $this->belongsTo(section::class,'section_id','id');
}

public function invoicedetails(){

    return $this->hasOne(invoicesdetails::class,'id_invoice','id');
}




}
