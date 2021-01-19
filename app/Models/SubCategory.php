<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use HasFactory,SoftDeletes;

    const ACTIVE='Active';
    const INACTIVE='Inactive';
    const OTHER='Other';

    protected $table='sub_categories';
    protected $fillable=['category_id','sub_category_name','sub_category_name_bn','link','status','serial_num','icon_photo','short_description','created_by','updated_by'];


}
