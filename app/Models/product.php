<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $fillable=['product_name','section_id','description'];
    public  function section(){

        return $this->belongsTo(section::class,'section_id','id');
    }
    public static function rules(){
        $validations= [
              'product_name'=>'required|max:200',
              'description'=>'max:200',
              
          ];
          return $validations;
      }
      public  static function messages()
  {
      return [
           'product_name.required'=>'يرجي ادخال اسم المنتج',
           'producy_name.max'=>'لقد وصلت للجد الادني من الحروف ',
              'description.max'=>'لقد وصلت للجد الادني من الحروف ',
             
      ];
  }
}
