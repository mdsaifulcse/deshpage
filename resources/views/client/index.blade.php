@extends('client.layouts.master')

@section('title')
    {{\App\Models\Setting::first()->value('company_slogan')}}
    @endsection


@section('style')

    @endsection

@section('content')

    <section class="leadBox paddingTop20 paddingTop65">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 main-content">

                    <div class="row">
                        @forelse($homeNews as $news)

                        <div class="col-sm-4">
                            <div class="single-block">

                                <?php
                                if (isset($news->newsSubCategory))
                                {
                                    $url=$news->newsCategory->link.'/'.$news->newsSubCategory->link.'/'.$news->id.'/'.$news->title;
                                }else{
                                    $url=$news->newsCategory->link.'/'.'news'.'/'.$news->id.'/'.$news->title;
                                }

                                ?>

                                <div class="img-mobile-left">
                                    <div class="img-box">
                                        <a href="{{$url}}">
                                            <img src="{{asset('/client')}}/media/common/placeholder-sm.png" data-src="{{asset($news->feature_medium)}}" alt="{{$news->title}}" class="lazyload img-responsive"></a>
                                    </div>
                                </div>

                                <div class="content-mobile-right">
                                    <div class="details"><h4><a href="{{$url}}">{{$news->title}}</a></h4>
                                    </div>
                                    <div class="meta"><span class="pull-left tags"><i class="fa fa-tags"></i>
                                            <a href="{{url('/topic/'.explode(',', $news->topic)[0])}}">{{explode(',', $news->topic)[0]}}</a></span>
                                        <a href="{{url($news->newsCategory->link)}}" class="pull-right">{{$news->newsCategory->category_name}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @empty

                        @endforelse
                    </div>

                </div>
                <aside class="col-sm-4 aside">
                    <div class="text-center row">
                        @forelse($sideA->where('place',\App\Models\Biggapon::SIDE)->take(1) as $key=>$side)
                            <div class="col-sm-12 paddingBottom20">
                                <div id="{{$key}}">
                                    <a id="{{$key}}" target="_blank" href="{{$side->target_url}}">
                                        <img src="{{asset($side->image)}}" alt="" class="img_ad img-responsive"/>
                                    </a>
                                </div>
                            </div>
                        @empty

                        @endforelse
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box-white">
                                <div class="jagoTab2 TwoTab">

                                    <ul class="nav nav-tabs nav-justified" role="tablist">
                                        <li role="presentation" class="active">
                                            <a href="education.htm#tab21" aria-controls="tab21" role="tab" data-toggle="tab">Latest Upload</a></li>
                                        <li role="presentation"><a href="education.htm#tab22" aria-controls="tab22" role="tab" data-toggle="tab">Most Viewed</a></li>
                                    </ul>

                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active" id="tab21">
                                            <ul class="media-list">
                                                @forelse($allLatestNews as $key=>$latestNews)
                                                    <?php
                                                    if (isset($latestNews->newsSubCategory))
                                                    {
                                                        $url=$latestNews->newsCategory->link.'/'.$latestNews->newsSubCategory->link.'/'.$latestNews->id.'/'.$latestNews->title;
                                                    }else{
                                                        $url=$latestNews->newsCategory->link.'/'.'news'.'/'.$latestNews->id.'/'.$latestNews->title;
                                                    }
                                                    ?>
                                                    <li class="media">
                                                        <div class="media-left">
                                                    <span>
                                                        {{--{{MyHelper::bn_number($key)}}--}}
                                                        {{$key+1}}
                                                    </span>
                                                            <a href="{{url($url)}}">
                                                                <img class="lazyload media-object" src="{{asset('/client')}}/media/common/placeholder-xs.png" data-src="{{asset($latestNews->feature_small)}}" alt="{{$latestNews->title}}">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <h4 class="media-heading"><a href="{{url($url)}}">{{$latestNews->title}}</a></h4>
                                                        </div>
                                                    </li>
                                                @empty
                                                    <h4 class="text-danger text-center">No Record Found !</h4>
                                                @endforelse
                                            </ul>
                                            <div class="allnews"><a href="{{url('/archive')}}" rel="nofollow">All Ads</a></div>
                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="tab22">
                                            <ul class="media-list">
                                                @forelse($mostReadNews as $key=>$data)
                                                    <?php
                                                    if (isset($data->newsSubCategory))
                                                    {
                                                        $url=$data->newsCategory->link.'/'.$data->newsSubCategory->link.'/'.$data->id.'/'.$data->title;
                                                    }else{
                                                        $url=$data->newsCategory->link.'/'.'news'.'/'.$data->id.'/'.$data->title;
                                                    }
                                                    ?>
                                                    <li class="media">
                                                        <div class="media-left">
                                                    <span>
                                                        {{$key+1}}
                                                    </span>
                                                            <a href="{{url($url)}}">
                                                                <img class="lazyload media-object" src="{{asset('/client')}}/media/common/placeholder-xs.png" data-src="{{asset($data->feature_small)}}" alt="{{$data->title}}">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <h4 class="media-heading"><a href="{{url($url)}}">{{$data->title}}</a></h4>
                                                        </div>
                                                    </li>
                                                @empty
                                                    <h4 class="text-danger text-center">No Record Found !</h4>
                                                @endforelse

                                            </ul>
                                            <div class="allnews"><a href="{{url('/archive')}}" rel="nofollow"> All Ads</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center row">
                        @forelse($sideA->where('place',\App\Models\Biggapon::SIDE)->skip(1)->take(2) as $key=>$side)
                        <div class="col-sm-12 paddingBottom20">
                            <div id="s{{$key}}">
                                <a id="{{$key}}" target="_blank" href="{{$side->target_url}}">
                                    <img src="{{asset($side->image)}}" alt="" class="img_ad img-responsive"/>
                                </a>
                            </div>
                        </div>
                    @empty

                        @endforelse
                    </div>

                </aside>
            </div>
        </div>
    </section>

    @if(count($educations)>0)
    <section class="Sports paddingTop20">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 main-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <h2 class="catTitleBlock">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <span class="left">
                                            <span class="catName">
                                                <?php $education=$educations[0];
                                                ?>
                                                <a href="{{url($education->newsCategory->link)}}">{{$education->newsCategory->category_name}} </a>
                                            </span>
                                            <span class="catSubName">
                                                {{--<a href="education.htm">ক্রিকেট</a>--}}
                                                {{--<a href="education.htm">ফুটবল</a>--}}
                                            </span>
                                        </span>
                                    </div>
                                    <div class="col-sm-4">
                                        <a href="{{url($education->newsCategory->link)}}" class="right">All Ads <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </h2>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($educations as $education)

                            <?php
                            if (isset($education->newsSubCategory))
                            {
                                $url=$education->newsCategory->link.'/'.$education->newsSubCategory->link.'/'.$education->id.'/'.$education->title;
                            }else{
                                $url=$education->newsCategory->link.'/'.'news'.'/'.$education->id.'/'.$education->title;
                            }
                            ?>
                        <div class="col-xs-12 col-sm-6 col-md-3 col-md-3">
                            <div class="single-block">
                                <div class="img-mobile-left">
                                    <div class="img-box"><a href="{{url($url)}}">
                                            <img src="{{asset('/client')}}/media/common/placeholder-sm.png" data-src="{{asset($education->feature_medium)}}" alt="" class="lazyload img-responsive"></a>
                                    </div>
                                </div>

                                <div class="content-mobile-right">
                                    <div class="details">
                                        <h3><a href="education.htm">{{$education->title}}</a></h3>
                                    </div>
                                    <div class="meta"><span class="pull-left tags"><i class="fa fa-tags"></i>
                                        <a href="{{url('/topic/'.explode(',', $education->topic)[0])}}">{{explode(',', $education->topic)[0]}}</a></span>
                                    </div>

                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>

                </div>
            </div>
        </div>
    </section>
    @endif
    <section>
        <div class="container text-center paddingTopBottom20">
            <div class="row">
                @forelse($sideA->where('place',\App\Models\Biggapon::MIDDLE)->take(1) as $i=>$sideData)
                <div class="col-sm-12">

                    <div id='s{{$i}}'>
                        <a id="{{$i}}" target="_blank" href="{{$sideData->target_url}}">
                            <img src="{{asset($sideData->image)}}" alt="" class="img_ad img-responsive"/>
                        </a>
                    </div>
                </div>
                @empty

                @endforelse
            </div>
        </div>
    </section>

@if(count($technologies)>0)
    <section class="deshjure">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 main-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <?php
                            $technology=$technologies[0];
                            ?>
                            <h2 class="catTitle"><a href="{{url($technology->newsCategory->link)}}">{{$technology->newsCategory->category_name}}</a><span class="liner"></span></h2>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-sm-5">
                            <?php
                            if (isset($technology->newsSubCategory))
                            {
                                $url=$technology->newsCategory->link.'/'.$technology->newsSubCategory->link.'/'.$technology->id.'/'.$technology->title;
                            }else{
                                $url=$technology->newsCategory->link.'/'.'news'.'/'.$technology->id.'/'.$technology->title;
                            }
                            ?>
                            <div class="single-block">
                                <div class="img-box">
                                    <a href="{{url($url)}}">
                                        <img src="{{asset('/client')}}/media/common/placeholder-sm.png" data-src="{{asset($technology->feature_medium)}}" alt="{{$technology->title}}" class="lazyload img-responsive">
                                    </a>
                                </div>
                                <div class="details">
                                    <h4><a href="{{url($url)}}">{{$technology->title}}</a></h4>
                                </div>
                                <div class="meta">

                                    <span class="pull-left tags"><i class="fa fa-tags"></i>
                                        <a href="{{url('/topic/'.explode(',', $technology->topic)[0])}}">{{explode(',', $technology->topic)[0]}}</a></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-7">
                            @forelse($technologies->skip(1)->take(4) as $technology)
                                <?php
                                if (isset($technology->newsSubCategory))
                                {
                                    $url=$technology->newsCategory->link.'/'.$technology->newsSubCategory->link.'/'.$technology->id.'/'.$technology->title;
                                }else{
                                    $url=$technology->newsCategory->link.'/'.'news'.'/'.$technology->id.'/'.$technology->title;
                                }?>

                            <div class="media">
                                <div class="media-left media-top"><a href="{{url($url)}}">
                                        <img src="{{asset('/client')}}/media/common/placeholder-xs.png" data-src="{{asset($technology->feature_small)}}" alt="{{$technology->title}}" class="lazyload"></a>
                                </div>

                                <div class="media-body">
                                    <h4 class="media-heading">
                                        <a href="{{url($technology->newsCategory->link)}}">{{$technology->title}}</a>
                                    </h4>
                                    <div class="meta"><i class="fa fa-tags"></i>
                                        <a href="{{url('/topic/'.explode(',', $technology->topic)[0])}}">{{explode(',', $technology->topic)[0]}}</a>
                                    </div>
                                </div>
                            </div>
                                @empty

                            @endforelse
                        </div>
                    </div>

                    <div class="row">
                        @forelse($technologies->skip(5)->take(4) as $technology)

                            <?php
                            if (isset($technology->newsSubCategory))
                            {
                                $url=$technology->newsCategory->link.'/'.$technology->newsSubCategory->link.'/'.$technology->id.'/'.$technology->title;
                            }else{
                                $url=$technology->newsCategory->link.'/'.'news'.'/'.$technology->id.'/'.$technology->title;
                            }?>

                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                            <div class="single-block">
                                <div class="img-mobile-left">
                                    <div class="img-box"><a href="{{url($url)}}">
                                            <img src="{{asset('/client')}}/media/common/placeholder-xs.png" data-src="{{asset($technology->feature_medium)}}" alt="{{$technology->title}}" class="lazyload"></a>
                                    </div>
                                </div>

                                <div class="content-mobile-right">
                                    <div class="details">
                                        <h4><a href="{{url($url)}}">{{$technology->title}}</a></h4>
                                    </div>
                                    <div class="meta"><span class="pull-left tags"><i class="fa fa-tags"></i>
                                            <a href="{{url('/topic/'.explode(',', $technology->topic)[0])}}">{{explode(',', $technology->topic)[0]}}</a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                            @empty

                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </section>
@endif

    {{--<section>--}}
        {{--<div class="container">--}}
            {{--<div class="row text-center marginTopBottom20">--}}
                {{--<div class="col-sm-12">--}}

                    {{--<div id='012'></div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</section>--}}


    <section style="display:none;">
        <div class="container">
            <div class="row text-center marginTopBottom20">
                <div class="col-sm-12">

                    <div id='014'></div>
                </div>
            </div>
        </div>
    </section>

    @if(count($entertainments)>0)
        <section class="Sports paddingTop20">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 main-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <h2 class="catTitleBlock">
                                    <div class="row">
                                        <div class="col-sm-8">
                                        <span class="left">
                                            <span class="catName">
                                                <?php $entertainment=$entertainments[0];
                                                ?>
                                                <a href="{{url($entertainment->newsCategory->link)}}">{{$entertainment->newsCategory->category_name}} </a>
                                            </span>
                                            <span class="catSubName">
                                                {{--<a href="education.htm">ক্রিকেট</a>--}}
                                                {{--<a href="education.htm">ফুটবল</a>--}}
                                            </span>
                                        </span>
                                        </div>
                                        <div class="col-sm-4">
                                            <a href="{{url($entertainment->newsCategory->link)}}" class="right">All Ads <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </h2>
                            </div>
                        </div>
                        <div class="row">
                            @foreach($entertainments as $entertainment)

                                <?php
                                if (isset($entertainment->newsSubCategory))
                                {
                                    $url=$entertainment->newsCategory->link.'/'.$entertainment->newsSubCategory->link.'/'.$entertainment->id.'/'.$entertainment->title;
                                }else{
                                    $url=$entertainment->newsCategory->link.'/'.'news'.'/'.$entertainment->id.'/'.$entertainment->title;
                                }
                                ?>
                                <div class="col-xs-12 col-sm-6 col-md-3 col-md-3">
                                    <div class="single-block">
                                        <div class="img-mobile-left">
                                            <div class="img-box"><a href="{{url($url)}}">
                                                    <img src="{{asset('/client')}}/media/common/placeholder-sm.png" data-src="{{asset($entertainment->feature_medium)}}" alt="" class="lazyload img-responsive"></a>
                                            </div>
                                        </div>

                                        <div class="content-mobile-right">
                                            <div class="details">
                                                <h3><a href="education.htm">{{$entertainment->title}}</a></h3>
                                            </div>
                                            <div class="meta"><span class="pull-left tags"><i class="fa fa-tags"></i>
                                        <a href="{{url('/topic/'.explode(',', $entertainment->topic)[0])}}">{{explode(',', $entertainment->topic)[0]}}</a></span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                    </div>
                </div>
            </div>
        </section>
    @endif


    <section class="paddingTopBottom20">
        <div class="container">
            <div class="main-content category">
                <div class="row">

                    @if(count($healths)>0)
                    <div class="col-sm-3">
                        <div class="single-cat-height">

                            <?php $healthData=$healths[0];?>
                            <?php
                            if (isset($healthData->newsSubCategory))
                            {
                                $url=$healthData->newsCategory->link.'/'.$healthData->newsSubCategory->link.'/'.$healthData->id.'/'.$healthData->title;
                            }else{
                                $url=$healthData->newsCategory->link.'/'.'news'.'/'.$healthData->id.'/'.$healthData->title;
                            }
                            ?>

                            <h2 class="catTitle"><a href="{{url($healthData->newsCategory->link)}}">{{$healthData->newsCategory->category_name}}</a><span class="liner"></span></h2>
                            <div class="single-block">

                                <div class="img-box"><a href="{{url($url)}}">
                                        <img src="{{asset('/client')}}/media/common/placeholder-sm.png" data-src="{{asset($healthData->feature_medium)}}" alt="{{$healthData->title}}" class="lazyload img-responsive"></a>
                                </div>
                                <h4><a href="{{url($url)}}">{{$healthData->title}}</a></h4>


                                <div class="details">
                                    @forelse($healths->skip(1)->take(5) as $health)
                                        <?php
                                        if (isset($health->newsSubCategory))
                                        {
                                            $url=$health->newsCategory->link.'/'.$health->newsSubCategory->link.'/'.$health->id.'/'.$health->title;
                                        }else{
                                            $url=$health->newsCategory->link.'/'.'news'.'/'.$health->id.'/'.$health->title;
                                        }
                                        ?>
                                    <div class="media">
                                        <div class="media-body">
                                            <h4 class="media-heading"><a href="{{url($url)}}">{{$health->title}}</a></h4>
                                        </div>
                                    </div>
                                        @empty

                                    @endforelse
                                </div>
                            </div>
                        </div>
                        <div class="allnews"><a href="{{url($healthData->newsCategory->link)}}"> All Ads </a></div>
                    </div><!-- end col-sm-3 -->

                    @endif

                    @if(count($probashs)>0)
                    <div class="col-sm-3">
                        <div class="single-cat-height">

                            <?php $probashData=$probashs[0];?>
                            <?php
                            if (isset($probashData->newsSubCategory))
                            {
                                $url=$probashData->newsCategory->link.'/'.$probashData->newsSubCategory->link.'/'.$probashData->id.'/'.$probashData->title;
                            }else{
                                $url=$probashData->newsCategory->link.'/'.'news'.'/'.$probashData->id.'/'.$probashData->title;
                            }
                            ?>

                            <h2 class="catTitle"><a href="{{url($probashData->newsCategory->link)}}">{{$probashData->newsCategory->category_name}}</a><span class="liner"></span></h2>
                            <div class="single-block">

                                <div class="img-box"><a href="{{url($url)}}">
                                        <img src="{{asset('/client')}}/media/common/placeholder-sm.png" data-src="{{asset($probashData->feature_medium)}}" alt="{{$probashData->title}}" class="lazyload img-responsive"></a>
                                </div>
                                <h4><a href="{{url($url)}}">{{$probashData->title}}</a></h4>


                                <div class="details">
                                    @forelse($probashs->skip(1)->take(5) as $probash)
                                        <?php
                                        if (isset($probash->newsSubCategory))
                                        {
                                            $url=$probash->newsCategory->link.'/'.$probash->newsSubCategory->link.'/'.$probash->id.'/'.$probash->title;
                                        }else{
                                            $url=$probash->newsCategory->link.'/'.'news'.'/'.$probash->id.'/'.$probash->title;
                                        }
                                        ?>
                                    <div class="media">
                                        <div class="media-body">
                                            <h4 class="media-heading"><a href="{{url($url)}}">{{$probash->title}}</a></h4>
                                        </div>
                                    </div>
                                        @empty

                                    @endforelse
                                </div>
                            </div>
                        </div>
                        <div class="allnews"><a href="{{url($probashData->newsCategory->link)}}"> All Ads </a></div>
                    </div><!-- end col-sm-3 -->

                    @endif

                    @if(count($literatures)>0)
                    <div class="col-sm-3">
                        <div class="single-cat-height">

                            <?php $literatureData=$literatures[0];?>
                            <?php
                            if (isset($literatureData->newsSubCategory))
                            {
                                $url=$literatureData->newsCategory->link.'/'.$literatureData->newsSubCategory->link.'/'.$literatureData->id.'/'.$literatureData->title;
                            }else{
                                $url=$literatureData->newsCategory->link.'/'.'news'.'/'.$literatureData->id.'/'.$literatureData->title;
                            }
                            ?>

                            <h2 class="catTitle"><a href="{{url($literatureData->newsCategory->link)}}">{{$literatureData->newsCategory->category_name}}</a><span class="liner"></span></h2>
                            <div class="single-block">

                                <div class="img-box"><a href="{{url($url)}}">
                                        <img src="{{asset('/client')}}/media/common/placeholder-sm.png" data-src="{{asset($literatureData->feature_medium)}}" alt="{{$literatureData->title}}" class="lazyload img-responsive"></a>
                                </div>
                                <h4><a href="{{url($url)}}">{{$literatureData->title}}</a></h4>


                                <div class="details">
                                    @forelse($literatures->skip(1)->take(5) as $literature)
                                        <?php
                                        if (isset($literature->newsSubCategory))
                                        {
                                            $url=$literature->newsCategory->link.'/'.$literature->newsSubCategory->link.'/'.$literature->id.'/'.$literature->title;
                                        }else{
                                            $url=$literature->newsCategory->link.'/'.'news'.'/'.$literature->id.'/'.$literature->title;
                                        }
                                        ?>
                                    <div class="media">
                                        <div class="media-body">
                                            <h4 class="media-heading"><a href="{{url($url)}}">{{$literature->title}}</a></h4>
                                        </div>
                                    </div>
                                        @empty

                                    @endforelse
                                </div>
                            </div>
                        </div>
                        <div class="allnews"><a href="{{url($literatureData->newsCategory->link)}}"> All Ads </a></div>
                    </div><!-- end col-sm-3 -->

                    @endif

                    @if(count($interviews)>0)
                    <div class="col-sm-3">
                        <div class="single-cat-height">

                            <?php $interviewData=$interviews[0];?>
                            <?php
                            if (isset($interviewData->newsSubCategory))
                            {
                                $url=$interviewData->newsCategory->link.'/'.$interviewData->newsSubCategory->link.'/'.$interviewData->id.'/'.$interviewData->title;
                            }else{
                                $url=$interviewData->newsCategory->link.'/'.'news'.'/'.$interviewData->id.'/'.$interviewData->title;
                            }
                            ?>

                            <h2 class="catTitle"><a href="{{url($interviewData->newsCategory->link)}}">{{$interviewData->newsCategory->category_name}}</a><span class="liner"></span></h2>
                            <div class="single-block">

                                <div class="img-box"><a href="{{url($url)}}">
                                        <img src="{{asset('/client')}}/media/common/placeholder-sm.png" data-src="{{asset($interviewData->feature_medium)}}" alt="{{$interviewData->title}}" class="lazyload img-responsive"></a>
                                </div>
                                <h4><a href="{{url($url)}}">{{$interviewData->title}}</a></h4>


                                <div class="details">
                                    @forelse($interviews->skip(1)->take(5) as $interview)
                                        <?php
                                        if (isset($interview->newsSubCategory))
                                        {
                                            $url=$interview->newsCategory->link.'/'.$interview->newsSubCategory->link.'/'.$interview->id.'/'.$interview->title;
                                        }else{
                                            $url=$interview->newsCategory->link.'/'.'news'.'/'.$interview->id.'/'.$interview->title;
                                        }
                                        ?>
                                    <div class="media">
                                        <div class="media-body">
                                            <h4 class="media-heading"><a href="{{url($url)}}">{{$interview->title}}</a></h4>
                                        </div>
                                    </div>
                                        @empty

                                    @endforelse
                                </div>
                            </div>
                        </div>
                        <div class="allnews"><a href="{{url($interviewData->newsCategory->link)}}"> All Ads </a></div>
                    </div><!-- end col-sm-3 -->

                    @endif

                </div><!--end row-->
            </div>
        </div>
    </section>


@endsection


@section('script')

    @endsection