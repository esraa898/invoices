<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoices_attachement extends Model
{
    use HasFactory;
    protected $fillable= ['file_name','id_invoice','created_by','created_at'];


    public function getImageAttribute(){
        return asset('Attachements/'.$this->file_name);
    }
}
