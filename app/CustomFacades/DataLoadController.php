<?php
/**
 * Created by PhpStorm.
 * User: mdsaiful
 * Date: 12/23/2019
 * Time: 11:50 AM
 */
namespace App\CustomFacades;


use App\Models\Category;
use App\Models\District;
use App\Models\Division;
use App\Models\SubCategory;
use App\Models\User;

class DataLoadController
{

    public function newsAuthor()
    {
      return  User::whereHas('roles',function ($q){
            $q->where("name", "News Author");
        })->pluck('name','id');
    }


    public function categoryList()
    {
       return Category::orderBy('serial_num','ASC')->where('status','!=',Category::INACTIVE)->pluck('category_name','id');
    }

    public function subCatList($categoryId)
    {
        if ($categoryId!=null)
        {
            return SubCategory::orderBy('serial_num','ASC')->where(['category_id'=>$categoryId,'status'=>SubCategory::ACTIVE])->pluck('sub_category_name','id');

        }else{

            return SubCategory::orderBy('serial_num','ASC')->where(['status'=>SubCategory::ACTIVE])->pluck('sub_category_name','id');
        }
    }


    public function divisionList()
    {
       return Division::orderBy('serial_num','ASC')->where('status',Division::ACTIVE)->pluck('division','id');
    }

    public function districtList($divisionId=null)
    {
        if ($divisionId!=null)
        {
            return District::orderBy('serial_num','ASC')->where(['division_id'=>$divisionId,'status'=>District::ACTIVE])->pluck('district','id');
        }else{
            return District::orderBy('serial_num','ASC')->where(['status'=>District::ACTIVE])->pluck('district','id');
        }

    }



    public function loadSubCatsByCat($categoryId)
    {
        $subCats=$this->subCatList($categoryId);
        return view('include.load-subcategory',compact('subCats'));

    }



}