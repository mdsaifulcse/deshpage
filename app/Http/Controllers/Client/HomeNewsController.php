<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Biggapon;
use App\Models\Category;
use App\Models\News;
use App\Models\User;
use App\Models\VisitorTrack;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Null_;

class HomeNewsController extends Controller
{
    public function index(News $news, Request $request)
    {

//        $newses=News::with('newsCategory','newsSubCategory')->where('published_status',News::PUBLISHED)
//            ->orderBy('id','DESC');

//        with('newsCategory','newsSubCategory')->where('published_status',News::PUBLISHED)
//            ->orderBy('id','DESC');

        $newses=new News;
        //$newses=$newses->with('newsCategory','newsSubCategory')->where('published_status',News::PUBLISHED);


        $coverNews=[];

        $homeNews=$newses->with('newsCategory','newsSubCategory')->where('published_status',News::PUBLISHED)
            ->where(['show_at_homepage'=>News::YES])
            ->orderBy('id','DESC')->take(15)->get();

        $allLatestNews=$newses->orWhere(['is_cover_news'=>News::NO,'show_at_homepage'=>News::NO])->orderBy('id','DESC')->take(10)->get();

        $educations=$newses->with('newsCategory','newsSubCategory')->where('published_status',News::PUBLISHED)
            ->where('published_status',News::PUBLISHED)->orderBy('id','DESC')
            ->categoryNews('newsCategory','categories','link','education')->take(4)->get();

        $technologies=$newses->with('newsCategory','newsSubCategory')->where('published_status',News::PUBLISHED)
            ->where('published_status',News::PUBLISHED)->orderBy('id','DESC')
            ->categoryNews('newsCategory','categories','link','technology')->take(9)->get();

        $entertainments=$newses->with('newsCategory','newsSubCategory')->where('published_status',News::PUBLISHED)
            ->categoryNews('newsCategory','categories','link','entertainment')->take(4)->get();

        $healths=$newses->with('newsCategory','newsSubCategory')->where('published_status',News::PUBLISHED)
            ->where('published_status',News::PUBLISHED)->orderBy('id','DESC')
            ->categoryNews('newsCategory','categories','link','health')->take(6)->get();

        $probashs=$newses->with('newsCategory','newsSubCategory')->where('published_status',News::PUBLISHED)
            ->where('published_status',News::PUBLISHED)->orderBy('id','DESC')
            ->categoryNews('newsCategory','categories','link','lifestyle')->take(6)->get();


        $literatures=$newses->with('newsCategory','newsSubCategory')->where('published_status',News::PUBLISHED)
            ->where('published_status',News::PUBLISHED)->orderBy('id','DESC')
            ->categoryNews('newsCategory','categories','link','shahitto ')->take(6)->get();

        $interviews=$newses->with('newsCategory','newsSubCategory')->where('published_status',News::PUBLISHED)
            ->where('published_status',News::PUBLISHED)->orderBy('id','DESC')
            ->categoryNews('newsCategory','categories','link','interview')->take(6)->get();

        $mostReadNews=$newses->with('newsCategory','newsSubCategory','mostReadNews')
                    ->whereHas('mostReadNews',function ($q){
                        $q->orderBy("most_read_news.read_number",'DESC');
                    })->take(10)->get();

        $sideA=Biggapon::where(['status'=>Biggapon::ACTIVE,'show_on_page'=>Biggapon::HOME_PAGE])->orderBy('serial_num','DESC')->take(5)->get();


        \MyHelper::countVisitor($request);

        return view('client.index',compact('coverNews','homeNews','allLatestNews','mostReadNews','educations','technologies',
            'entertainments','healths','probashs','literatures','interviews','sideA'));
    }

    public function newsAuthor($userId,Request $request)
    {

        $author=User::with('profile')->findOrFail($userId);

        $authorNews=News::with('newsCategory','newsSubCategory')->where(['published_status'=>News::PUBLISHED,'show_at_homepage'=>News::YES,'news_author_id'=>$userId])
            ->orderBy('id','DESC')->take(20)->get();

        \MyHelper::countVisitor($request);
        return view('client.author-news',compact('author','authorNews'));
    }


    public function searchResult(Request $request)
    {
        \MyHelper::countVisitor($request);
        $results='';
        $userPlay='';

        if (isset($request->user_play) &&  $request->user_play!=''){
            $userPlay=$request->user_play;

            $results=News::with('newsCategory','newsSubCategory')
                ->orderBy('id','DESC')->where(['published_status'=>News::PUBLISHED])
                ->where('title','LIKE',"%{$request->user_play}%")
                ->orWhere('meta_description','LIKE',"%{$request->user_play}%")
                ->orWhere('topic','LIKE',"%{$request->user_play}%")
                ->orWhere('description','LIKE',"%{$request->user_play}%")
                ->paginate(20);

            return view('client.search-result',compact('results','userPlay'));

        }else{
            return redirect()->back();
        }

    }


}
