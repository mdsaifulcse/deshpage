<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Models\SubMenu;
use App\Models\SubSubMenu;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Menu;
use MyHelper,DB,Validator;
use App\Models\Page;
use Spatie\Permission\Models\Permission;

class MenuController extends Controller
{
     public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allData=Menu::orderBy('serial_num','DESC')->paginate(20);

        return view('admin.menu.index',compact('allData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $max_serial=Menu::max('serial_num');
        $permissions = Permission::orderBy('id','DESC')->pluck('name', 'name');
        return view('admin.menu.create',compact('max_serial','permissions'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try{
            $input = $request->all();

            if(isset($input['page'])){
                $page=Page::select('name','name_bn')->where('link',$input['page'])->first();
                $input['name']=$page['name'];
                $input['name_bn']=$page['name_bn'];
                $input['url']="page/".$input['page'];

            }


            $validator = Validator::make($input, [
                'name'=> 'required',
                'url'=> 'required',
                'icon' => 'mimes:jpeg,jpg,bmp,png'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $input['slug']=json_encode($request->slug);

            if ($request->hasFile('icon')){
                $input['icon']=MyHelper::photoUpload($request->file('icon'),'images/menu/icon/',32);
                $input['big_icon']=MyHelper::photoUpload($request->file('icon'),'images/menu/big-icon/',128);
            }

            Menu::create($input);

            $bug=0;
            }catch(\Exception $e){
                $bug=$e->errorInfo[1];
            }

           if($bug==0)
           {
            return redirect(route('menu.index'))->with('success','Menu Successfully Save');
           }else{
            return redirect()->back()->with('error','Something Error Found ! ');
           }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $max_serial=Menu::max('serial_num');
        $data=Menu::findOrFail($id);
        $permissions = Permission::orderBy('id','DESC')->pluck('name', 'name');

        return view('admin.menu.edit',compact('data','max_serial','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $data=Menu::findOrFail($id);

        $validator = Validator::make($input, [
                    'name'    => 'required',
                    'url'          => 'required',
                    'icon' => 'mimes:jpeg,jpg,bmp,png'
                ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input['slug']=json_encode($request->slug);
        try{

            if ($request->hasFile('icon')){
                $input['icon']=MyHelper::photoUpload($request->file('icon'),'images/menu/icon/',32);
                $input['big_icon']=MyHelper::photoUpload($request->file('icon'),'images/menu/big-icon/',128);
                if (file_exists($data->icon)){ unlink($data->icon);  }
                if (file_exists($data->big_icon)){ unlink($data->big_icon);  }
            }

            $data->update($input);


            $bug=0;
            }catch(\Exception $e){
                $bug=$e->errorInfo[1];
            }
             if($bug==0){
            return redirect()->back()->with('success','Successfully Inserted');
            }else{
                return redirect()->back()->with('error','Something Error Found ! ');
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data=Menu::findOrFail($id);
        DB::beginTransaction();
       try{

           $submenus=SubMenu::whereIn('menu_id',[$id])->delete();

           $subSubMenus=SubSubMenu::whereIn('menu_id',[$id])->delete();

            $data->delete();
            $bug=0;
//           if (file_exists($data->icon)){ unlink($data->icon); }
//           if (file_exists($data->big_icon)){ unlink($data->big_icon); }
            $error=0;

           DB::commit();
        }catch(\Exception $e){
           DB::rollback();
            $bug=$e->errorInfo[1];
            $error=$e->errorInfo[2];
        }
        if($bug==0){
       return redirect()->back()->with('success','Successfully Deleted!');
        }elseif($bug==1451){
       return redirect()->back()->with('error','This Data is Used anywhere ! ');

        }
        elseif($bug>0){
       return redirect()->back()->with('error','Some thing error found !');

        }
    }


    public function page(){
        $max_serial=Menu::max('serial_num');
        $page=Page::where('status',1)->pluck('name','link');
        return view('backend.menu.pageMenu',compact('max_serial','page'));
    }





}
