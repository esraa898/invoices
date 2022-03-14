<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class section extends Model
{
    use HasFactory;
    protected $fillable= ['section_name','description','created_by'];





    public function products(){
        return $this->hasMany(product::class ,'section_id','id');
    }
    public static function rules(){
      $validations= [
            'section_name'=>'required|unique:sections|max:200',
            'description'=>'required|max:200',
        ];
        return $validations;
    }
    public  static function messages()
{
    return [
        
         'section_name.required'=>'يرجي ادخال اسم القسم',
            'section_name.unique'=>'خطا القسم مسجل بصفحتنا',
            'description.required'=>'يرجي ادخال البيانات '
    ];
}
}
