<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisitorTrack;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {


        $visitData=new VisitorTrack;

        $todayVisitor=$visitData->where('visit_date',date('Y-m-d'))->sum('total_visit');

        $todayUniqueVisitor=$visitData->where('visit_date',date('Y-m-d'))
            ->distinct('ip_address')->count('total_visit');


        $currentMonthVisitor=$visitData->whereMonth('visit_date',\Carbon\Carbon::now()->format('m'))->sum('total_visit');

        $currentMonthUniqueVisitor=$visitData->whereMonth('visit_date',\Carbon\Carbon::now()->format('m'))
            ->distinct('ip_address')->count('total_visit');



        return view('admin.dashboard',compact('todayVisitor','todayUniqueVisitor','currentMonthVisitor','currentMonthUniqueVisitor'));
    }
}
