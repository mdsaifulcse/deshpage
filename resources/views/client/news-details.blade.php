@extends('client.layouts.master')

@section('title')
   {{$news->title}}
@endsection

@section('style')

    @endsection

@section('content')



    <section >

        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-8 main-content marginBottom20">
                    <div class="row marginBottom20">
                        <div class="col-sm-12">
                            <article class="box-white">
                                <div class="padding15 box-white">
                                    <ol class="breadcrumb hidden-print">
                                        <li><a href="{{URL::to('/')}}"><i class="fa fa-home text-danger"></i></a></li>
                                        <li>
                                            <a href="{{url($news->newsCategory->link)}}">{{$news->newsCategory->category_name}}</a>
                                        </li>
                                    </ol>
                                    <h1 class="no-margin">
                                        {{$news->title}}
                                    </h1>
                                    <div class="dividerDetails"></div>
                                    <blockquote class="no-margin no-padding">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="media">

                                                    <div class="media-left hidden-print">
                                                        @if(isset($news->newsAuthor) && file_exists($news->newsAuthor->avatar))

                                                        <img src="{{asset('/client')}}/media/common/placeholder-xs.png" data-src="{{asset($news->newsAuthor->avatar)}}" alt="{{$news->title}}" class="media-object" style="margin-top:5px;width:30px;height:30px;border-radius:100%;display:inline-block;">

                                                            @else
                                                            <img src="{{asset('/client')}}/media/common/placeholder-xs.png" data-src="{{asset(\App\Models\Setting::first()->value('favicon'))}}" alt="{{$news->title}}" class="media-object" style="margin-top:5px;width:40px;height:40px;border-radius:100%;display:inline-block;">
                                                        @endif
                                                    </div>

                                                    <div class="media-body">
                                                <span class="small text-muted time-with-author">
                                                <i class="fa fa-pencil"></i>
                                                @if(isset($news->newsAuthor))
                                                <a class="hidden-print" href="{{url('/author/'.$news->newsAuthor->id)}}" style="display:inline-block;" rel="nofollow">{{$news->newsAuthor->profile->designation}} </a>

                                                @endif
                                                <br>
                                                <i class="fa fa fa-clock-o text-danger"></i>
                                                প্রকাশিত:
                                                    <?php $bongabda = new EasyBanglaDate\Types\BnDateTime($news->published_date);

                                                    echo  $bongabda->getDateTime()->format('h:i a, l jS F Y ');
                                                    ?>

                                                </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-4 text-right">
                                                <div class="hidden-print">
                                                    <div class="custom-social-share">
                                                        <div class="custom_share_count pull-left"></div>
                                                        <ul class="social-media custom-social-share">
                                                            <li>
                                                                <button type="button" onclick='window.open ("https://www.facebook.com/sharer.php?u={{Request::url()}}","mywindow","menubar=1,resizable=1,width=350,height=250");'>
                                                                    <i class="fa fa-facebook"></i></button>
                                                            </li>
                                                            <li>
                                                                <button type="button" onclick='window.open ("https://twitter.com/intent/tweet?text={{$news->title}}&url={{Request::url()}}","mywindow","menubar=1,resizable=1,width=360,height=250");'>
                                                                    <i class="fa fa-twitter"></i></button>
                                                            </li>
                                                            <li>
                                                                <button type="button" data-action="share/whatsapp/share" onclick='window.open ("https://web.whatsapp.com/send?text={{Request::url()}}", "mywindow","menubar=1,resizable=1,width=360,height=450");'>
                                                                    <i class="fa fa-whatsapp" style="background: #25D366;"></i></button>
                                                            </li>
                                                            <li>
                                                                <button type="button" onclick="window.print();"><i class="fa fa-print"></i></button>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </blockquote>
                                </div>

                            @if(!empty($news->video_url))

                                <div class="paddingTop10 hidden-print">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe width="560" height="315" src="https://www.youtube.com/embed/oyujSic_FOU" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div>
                                </div>

                                @else

                                <div class="paddingTop10">
                                    <div class="featured-image">

                                        <img src="{{asset('/client')}}/media/common/placeholder-bg.png" data-src="{{asset($news->feature_photo)}}"  class="lazyload" alt="{{$news->title}}">

                                    </div>
                                </div>
                                @endif


                                <div class="content-details">

                                  <p><?php
                                      echo $news->meta_description;
                                      ?></p>

                                  <?php
                                    echo $news->description;
                                    ?>

                                    @forelse($news->moreNewsPhotos as $moreNewsPhoto)
                                        <div class="paddingTop10">
                                            <div class="featured-image">
                                                <img src="{{asset('/client')}}/media/common/placeholder-bg.png" data-src="{{asset($moreNewsPhoto->photo)}}" class="lazyload" alt="{{$news->title}}">
                                            </div>
                                        </div>

                                        <?php
                                        echo $moreNewsPhoto->description;
                                        ?>
                                        @empty

                                        @endforelse


                                    <p><span style="color: #999999;"><em></em></span></p>
                                </div>

                                <div class="paddingLeft10 paddingRight10 hidden-print photo-title">
                                    <ul class="photo-tags">
                                        <li><i class="fa fa-tags"></i></li>
                                        <?php $topics=explode(',', $news->topic)?>
                                        @forelse($topics as $topic)
                                        <li><a href="{{URL::to('/topic/'.$topic)}}">{{$topic}}</a></li>
                                            @empty

                                        @endforelse
                                    </ul>
                                </div>


                                <div class="row text-center advertisement hidden-print">
                                </div>

                                <hr>
                            </article>
                        </div>
                    </div>

                    <div class="marginBottom20 hidden-print">
                        <div id='vdo_ai_div'></div>

                    </div>

                    <div class="marginBottom20 hidden-print">
                        <h2 class="McatTitle"><span class="eee"> {{\App\Models\Setting::first()->value('company_name')}} সর্বশেষ </span></h2>
                        <div class="row">
                            @forelse($latestNews as $latest)
                                <?php
                                if (isset($latest->newsSubCategory))
                                {
                                    $url=$latest->newsCategory->link.'/'.$latest->newsSubCategory->link.'/'.$latest->id.'/'.$news->title;
                                }else{
                                    $url=$latest->newsCategory->link.'/'.'news'.'/'.$latest->id.'/'.$latest->title;
                                }

                                ?>
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                                <div class="single-block">
                                    <div class="img-mobile-left">
                                        <div class="img-box">
                                            <a href="{{url($url)}}">
                                                <img src="{{asset($latest->feature_medium)}}" alt="{{$latest->title}}" class="lazyload img-responsive">
                                            </a>
                                        </div>
                                    </div>

                                    <div class="content-mobile-right">
                                        <div class="details">
                                            <h3><a href="{{url($url)}}">{{$latest->title}}</a></h3>
                                        </div>
                                        <div class="meta">
                                            <span class="tags"><a href="{{url($latest->newsCategory->link)}}">{{$latest->newsCategory->category_name}}</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                @empty
                                <h4 class="text-danger text-center">কোন ফলাফল পাওয়া যায়নি</h4>
                            @endforelse
                        </div>
                    </div>

                    <div class="marginBottom20 text-center hidden-print">

                        <div></div>
                    </div>

                    <div class="marginBottom20 hidden-print">
                        <h2 class="McatTitle"><span class="eee"> {{\App\Models\Setting::first()->value('company_name')}} জনপ্রিয় </span></h2>
                        <div class="row">
                            @forelse($mostReadNews as $mostRead)
                                <?php
                                if (isset($mostRead->newsSubCategory))
                                {
                                    $url=$mostRead->newsCategory->link.'/'.$mostRead->newsSubCategory->link.'/'.$mostRead->id.'/'.$news->title;
                                }else{
                                    $url=$mostRead->newsCategory->link.'/'.'news'.'/'.$mostRead->id.'/'.$mostRead->title;
                                }

                                ?>
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                                    <div class="single-block">
                                        <div class="img-mobile-left">
                                            <div class="img-box">
                                                <a href="{{url($url)}}">
                                                    <img src="{{asset($mostRead->feature_medium)}}" alt="{{$mostRead->title}}" class="lazyload img-responsive">
                                                </a>
                                            </div>
                                        </div>

                                        <div class="content-mobile-right">
                                            <div class="details">
                                                <h3><a href="{{url($url)}}">{{$mostRead->title}}</a></h3>
                                            </div>
                                            <div class="meta">
                                                <span class="tags"><a href="{{url($mostRead->newsCategory->link)}}">{{$mostRead->newsCategory->category_name}}</a></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <h4 class="text-danger text-center">কোন ফলাফল পাওয়া যায়নি</h4>
                            @endforelse

                        </div>
                    </div>
                </div>
                <aside class="col-xs-12 col-sm-12 col-md-4 aside hidden-print">
                    <div>
                        <h2 class="McatTitle"><span class="eee"> সর্বশেষ - {{$news->newsCategory->category_name}}</span></h2>
                        <div class="single-block">
                            <div class="details with-icon">

                                @forelse($latestCatNews as $latestNews)


                                    <?php
                                    if (isset($latestNews->newsSubCategory))
                                    {
                                        $url=$latestNews->newsCategory->link.'/'.$latestNews->newsSubCategory->link.'/'.$latestNews->id.'/'.$news->title;
                                    }else{
                                        $url=$latestNews->newsCategory->link.'/'.'news'.'/'.$latestNews->id.'/'.$latestNews->title;
                                    }

                                    ?>


                                <div class="media">
                                    <div class="media-body">
                                        <h4 class="media-heading">
                                            <a href="{{url($url)}}">
                                                <i class="fa fa-angle-double-right"></i>
                                                {{$latestNews->title}}
                                            </a>
                                        </h4>
                                    </div>
                                </div>

                                    @empty
                                    <h4 class="text-danger text-center">কোন ফলাফল পাওয়া যায়নি</h4>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    @forelse($sideA->take(1) as $firstOne)
                    <div class="text-center advertisement">
                        <div class="row">
                            <div class="col-sm-12 paddingBottom20">

                                <a target="_blank" href="{{$firstOne->target_url}}">
                                    <img src="{{asset($firstOne->image)}}" alt="" class="img_ad img-responsive" style="margin:0 auto;">
                                </a>

                            </div>
                        </div>
                    </div>
                    @empty

                    @endforelse

                    <div>
                        <h2 class="McatTitle"><span class="eee"> সর্বোচ্চ পঠিত - {{$news->newsCategory->category_name}} </span>
                        </h2>
                        <div class="details-thumb">
                            @forelse($categoryMostReadNews->take(1) as $readNews)

                                <?php
                                if (isset($readNews->newsSubCategory))
                                {
                                    $url=$readNews->newsCategory->link.'/'.$readNews->newsSubCategory->link.'/'.$readNews->id.'/'.$news->title;
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

                            @endforelse

                            <div class="sub-thumb">
                                <div class="row FlexRow">
                                    @forelse($categoryMostReadNews->skip(1)->take(4) as $readNewsData)
                                        <?php
                                        if (isset($readNewsData->newsSubCategory))
                                        {
                                            $url=$readNewsData->newsCategory->link.'/'.$readNewsData->newsSubCategory->link.'/'.$readNewsData->id.'/'.$news->title;
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

                                    @endforelse

                                </div>
                            </div>
                        </div>
                    </div>
                    @forelse($sideA->skip(1)->take(1) as $second)
                        <div class="text-center advertisement">
                            <div class="row">
                                <div class="col-sm-12 paddingBottom20">

                                    <a target="_blank" href="{{$second->target_url}}">
                                        <img src="{{asset($second->image)}}" alt="" class="img_ad img-responsive" style="margin:0 auto;">
                                    </a>

                                </div>
                            </div>
                        </div>
                    @empty

                    @endforelse


                    <div class="text-center advertisement hidden-print">

                        <div class="row">
                            <div class="col-sm-12 paddingBottom20">

                                <div id='div' style='margin:auto;'></div>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>

    </section>



    @endsection


@section('script')

    @endsection