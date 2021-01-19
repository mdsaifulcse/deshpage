<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

use DB,Auth,Validator,MyHelper,Route;

class SubCategoryController extends Controller
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

        $input = $request->all();
        if (is_null($request->link))
        {
            $link = str_replace(' , ', '-', $input['sub_category_name']);
            $link = str_replace(', ', '-', $link);
            $link = str_replace(' ,', '-', $link);
            $link = str_replace(',', '-', $link);
            $link = str_replace('/', '-', $link);
            $link = rtrim($link, ' ');
            $link = str_replace(' ', '-', $link);
            $link = str_replace('.', '', $link);
            $link = substr($link, 0, 50);
            $link = strtolower($link);
            $input['link'] = $link;
        }

        $validator = Validator::make($input, [
            'sub_category_name' => 'required',
            'link' => 'required|unique:sub_categories',
            'category_id' => 'required|exists:categories,id'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $input['created_by']=\Auth::user()->id;

        try{

            if ($request->hasFile('icon_photo')) {
                $input['icon_photo']=\MyHelper::photoUpload($request->file('icon_photo'),'images/sub-categories/',120,100);
            }


            SubCategory::create($input);
            $bug=0;
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
        }
        if($bug==0){
            return redirect()->back()->with('success','Data Successfully Inserted');
        }elseif($bug==1062){
            return redirect()->back()->with('error','The name has already been taken.');
        }else{
            return redirect()->back()->with('error','Something Error Found ! ');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $allData=SubCategory::leftJoin('categories','sub_categories.category_id','=','categories.id')
            ->select('sub_categories.*','categories.category_name','categories.id as category_id')
            ->where('sub_categories.category_id',$id)->orderBy('sub_categories.id','DESC')->paginate(80);

        $category=Category::findOrFail($id);
        $max_serial=SubCategory::where('category_id',$id)->max('serial_num');

        return view('admin.categories.sub-category',compact('allData','category','max_serial'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $subCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $input = $request->all();

        $validator = Validator::make($input, [
            'sub_category_name' => 'required',
            'link' => "required|unique:sub_categories,link,$id",
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error','Something Error found.');
        }
        $data=SubCategory::findOrFail($id);
        $input['updated_by']=\Auth::user()->id;
        try{

            if ($request->hasFile('icon_photo')) {

                $input['icon_photo']=\MyHelper::photoUpload($request->file('icon_photo'),'images/sub-categories/',120,100);

                if($data->icon_photo!=null and file_exists($data->icon_photo)){
                    unlink($data->icon_photo);
                }
            }


            $data->update($input);
            $bug=0;
        }catch(\Exception $e){
            $bug = $e->errorInfo[1];
        }
        if($bug==0){
            return redirect()->back()->with('success','Data Successfully Updated');
        }elseif($bug==1062){
            return redirect()->back()->with('error','The name has already been taken.');
        }else{
            return redirect()->back()->with('error','Something Error Found ! ');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data=SubCategory::findOrFail($id);
        try{
            $data->delete();
            $bug=0;
            $error=0;
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
            $error=$e->errorInfo[2];
        }
        if($bug==0){
            return redirect()->back()->with('success','Data has been Successfully Deleted!');
        }elseif($bug==1451){
            return redirect()->back()->with('error','This Data is Used anywhere ! ');

        }
        elseif($bug>0){
            return redirect()->back()->with('error','Some thing error found !');

        }
    }
}
