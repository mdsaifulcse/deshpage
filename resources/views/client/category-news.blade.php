@extends('client.layouts.master')

@section('title')
   {{$categoryData->category_name}} | {{\App\Models\Setting::first()->value('company_slogan')}}
@endsection

@section('style')

    @endsection

@section('content')


    <section class="paddingTop65">
        <div class="container">
            <div class="row paddingTopBottom20">
                <div class="col-sm-12">
                    <ol class="breadcrumb  no-margin">
                        <li><a href="{{url('/')}}"><i class="fa fa-home text-danger"></i></a></li>
                        <li><a class="active" href="{{url('/')}}"> {{$categoryData->category_name}} </a></li>
                        @if(!empty($subCatData))
                        <li >{{$subCatData->sub_category_name}}</li>
                            @endif

                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 main-content">
                    <div class="row">
                        <div class="col-sm-12">
                            @forelse($categoryNews->take(1) as $catNews)
                                <?php
                                if (isset($catNews->newsSubCategory))
                                {
                                    $url=$catNews->newsCategory->link.'/'.$catNews->newsSubCategory->link.'/'.$catNews->id.'/'.$catNews->title;
                                }else{
                                    $url=$catNews->newsCategory->link.'/'.'news'.'/'.$catNews->id.'/'.$catNews->title;
                                }
                                ?>
                            <div class="single-block">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                        <div class="img-box">
                                            <a href="{{URL::to($url)}}" title="{{$catNews->title}}">
                                                <img alt="{{$catNews->title}}" src="{{asset('/client')}}/media/common/placeholder-bg.png" data-src="{{asset($catNews->feature_photo)}}" class="lazyload img-responsive">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                        <div class="paddingRight10 paddingTop20">
                                            <h3 style="font-size:1.5em;line-height:34px;margin-bottom:10px;">
                                                <a href="{{URL::to($url)}}" title="{{$catNews->title}}">{{$catNews->title}}</a></h3>
                                            <?php
                                            if (strlen($catNews->meta_description) != strlen(utf8_decode($catNews->meta_description)))
                                            {
                                                echo substr($catNews->meta_description,0,300);
                                            }else{
                                                echo substr($catNews->meta_description,0,19);
                                            }
                                            ?>...
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty


                            @endforelse
                        </div>
                    </div>

                    <div class="row text-center">
                        <div class="col-sm-12">
                        </div>
                    </div>
                    @if(count($categoryNews)>0)
                    <div class="row" id="loadMoreContent">

                        @foreach($categoryNews->skip(1) as $news)

                            <?php
                            if (isset($news->newsSubCategory))
                            {
                                $url=$news->newsCategory->link.'/'.$news->newsSubCategory->link.'/'.$news->id.'/'.$news->title;
                            }else{
                                $url=$news->newsCategory->link.'/'.'news'.'/'.$news->id.'/'.$news->title;
                            }

                            ?>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="single-block cat-block">
                                <div class="row">
                                    <div class="col-xs-5 col-sm-5">
                                        <div class="img-box">
                                            <a href="{{url($url)}}" title="{{$news->title}}">
                                                <img alt="{{$news->title}}" src="{{asset('/client')}}/media/common/placeholder-xs.png" data-src="{{asset($news->feature_medium)}}" class="lazyload img-responsive">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-xs-7 col-sm-7">
                                        <div class="paddingTop10 paddingRight10">
                                            <h3 style="font-size:1.1em;"><a href="{{url($url)}}" title="{{$news->title}}"> {{$news->title}}</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        @endforeach


                    </div><!-- end loadMoreContent -->
                    @if($categoryNews->nextPageUrl()!='')
                            <div class="text-center paddingBottom20" >
                                <button id="load_more_button" data-page="1" data-link="{{$categoryNews->nextPageUrl()}}">
                                    আরও পড়ুন </button>
                            </div>
                        @endif

                    @else
                        <h4 class="text-danger text-center">কোন ফলাফল পাওয়া যায়নি</h4>
                    @endif


                </div>
                <aside class="col-xs-12 col-sm-12 col-md-4 col-lg-4 aside">
                    @forelse($sideA->take(1) as $first)
                        <div class="text-center advertisement">
                            <div class="row">
                                <div class="col-sm-12 paddingBottom20">

                                    <a target="_blank" href="{{$first->target_url}}">
                                        <img src="{{asset($first->image)}}" alt="" class="img_ad img-responsive" style="margin:0 auto;">
                                    </a>

                                </div>
                            </div>
                        </div>
                @empty

                @endforelse

                    <!-- latest -->
                    <div class="row">
                        <div class="col-xs-12 col-sm-12">
                            <div>
                                <h2 class="McatTitle"><span class="eee"> সর্বোচ্চ পঠিত - {{$categoryData->category_name}} </span></h2>

                                <div class="details-thumb">
                                    @forelse($categoryMostReadNews->take(1) as $readNews)

                                        <?php
                                        if (isset($readNews->newsSubCategory))
                                        {
                                            $url=$readNews->newsCategory->link.'/'.$readNews->newsSubCategory->link.'/'.$readNews->id.'/'.$readNews->title;
                                        }else{
                                            $url=$readNews->newsCategory->link.'/'.'news'.'/'.$readNews->id.'/'.$readNews->title;
                                        }
                                        ?>
                                        <div class="thumb-first">
                                            <a href="{{url($url)}}">
                                                <img src="{{asset($readNews->feature_medium)}}" alt="{{$readNews->title}}!" style="width:100%;">
                                            </a>
                                            <h4>
                                                <a href="{{url($url)}}">{{$readNews->title}}!</a>
                                            </h4>
                                        </div>
                                    @empty
                                        <h4 class="text-danger text-center">কোন ফলাফল পাওয়া যায়নি</h4>
                                    @endforelse

                                    <div class="sub-thumb">
                                        <div class="row FlexRow">
                                            @forelse($categoryMostReadNews->skip(1)->take(4) as $readNewsData)
                                                <?php
                                                if (isset($readNewsData->newsSubCategory))
                                                {
                                                    $url=$readNewsData->newsCategory->link.'/'.$readNewsData->newsSubCategory->link.'/'.$readNewsData->id.'/'.$readNewsData->title;
                                                }else{
                                                    $url=$readNewsData->newsCategory->link.'/'.'news'.'/'.$readNewsData->id.'/'.$readNewsData->title;
                                                }
                                                ?>
                                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 FlexRow">
                                                    <div class="small-thumb thumb-border-bottom">
                                                        <a href="{{url($url)}}">
                                                            <img src="{{asset($readNewsData->feature_medium)}}" alt="{{$readNewsData->title}}" style="width:100%;">
                                                        </a>
                                                        <h4>
                                                            <a href="{{url($url)}}">{{$readNewsData->title}}</a>
                                                        </h4>
                                                    </div>
                                                </div>

                                            @empty
                                                <h4 class="text-danger text-center">কোন ফলাফল পাওয়া যায়নি</h4>
                                            @endforelse

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                    <!-- popular -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="jagoTab2 TwoTab">

                                <ul class="nav nav-tabs nav-justified" role="tablist">
                                    <li role="presentation" class="active">
                                        <a href="education.htm#tab21" aria-controls="tab21" role="tab" data-toggle="tab">সর্বশেষ</a></li>
                                    <li role="presentation"><a href="education.htm#tab22" aria-controls="tab22" role="tab" data-toggle="tab">জনপ্রিয়</a></li>
                                </ul>

                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade in active" id="tab21">
                                        <ul class="media-list">
                                            @forelse($allLatestNews->skip(1)->take(4) as $key=>$latestNews)
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
                                                        {{MyHelper::bn_number($key)}}
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
                                                <h4 class="text-danger text-center">কোন ফলাফল পাওয়া যায়নি</h4>
                                            @endforelse
                                        </ul>
                                        <div class="allnews"><a href="{{url('/archive')}}" rel="nofollow">আজকের সর্বশেষ সবখবর</a></div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="tab22">
                                        <ul class="media-list">
                                            @forelse($mostReadNews->skip(1)->take(4) as $key=>$data)
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
                                                        {{MyHelper::bn_number($key)}}
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
                                                <h4 class="text-danger text-center">কোন ফলাফল পাওয়া যায়নি</h4>
                                            @endforelse

                                        </ul>
                                        <div class="allnews"><a href="{{url('/archive')}}" rel="nofollow"> আজকের সর্বশেষ সবখবর</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>

    @endsection


@section('script')

    {{Request::path()}}

    <script>
        $('#load_more_button').on('click',function () {

            //$('#load_more_button').css({'display':'none'})
            var targetPage=$(this).data('page');

            targetPage++
            $(this).data('page',targetPage);


                $.ajax({
                url:"{{url(Request::path())}}"+'?page='+targetPage,
                method:"GET",

                success:function(data){
                    $('#loadMoreContent').append(data);
                }
                })

        //$('#loadMoreContent').append().load('{{Request::path()}}'+'?page='+targetPage);


        })

        </script>

@endsection