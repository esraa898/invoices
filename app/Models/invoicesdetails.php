<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoicesdetails extends Model
{
    use HasFactory;
    protected $fillable= [
        'id_invoice','product','section','status','value_status','note','user','invoice_number',
    ];
}
