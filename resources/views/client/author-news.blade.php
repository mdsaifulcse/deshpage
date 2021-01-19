@extends('client.layouts.master')

@section('title')
    {{\App\Models\Setting::first()->value('company_slogan')}}
@endsection

@section('style')

    @endsection

@section('content')
    <section class="padding20">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="media paddingTopBottom20">
                        <div class="media-left author-img">

                            @if(file_exists($author->profile->avatar))

                                <img src="{{asset('/client')}}/media/common/placeholder-xs.png" data-src="{{asset($author->profile->avatar)}}" alt="{{$author->title}}" class="media-object" style="margin-top:5px;width:40px;height:40px;border-radius:100%;display:inline-block;">

                            @else
                                <img src="{{asset('/client')}}/media/common/placeholder-xs.png" data-src="{{asset(\App\Models\Setting::first()->value('favicon'))}}" alt="{{$author->profile->designation}}" class="media-object" style="margin-top:5px;width:40px;height:40px;border-radius:100%;display:inline-block;">
                            @endif

                        </div>
                        <div class="media-body">
                            <div class="paddingLeft10">
                                <h3 class="no-margin author-name"><strong>{{$author->profile->designation}}</strong></h3>
                                <h5 class="author-occupation"><em></em></h5>
                                <div id="bio">
                                    <p>{{$author->profile->bio}}</p>
                                </div>
                                <ul class="social-media no-margin list-inline list-unstyled paddingTopBottom20">
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="author-page">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="loadMoreContent">

                        @forelse($authorNews as $news)
                            <?php
                            if (isset($news->newsSubCategory))
                            {
                                $url=$news->newsCategory->link.'/'.$news->newsSubCategory->link.'/'.$news->id.'/'.$news->title;
                            }else{
                                $url=$news->newsCategory->link.'/'.'news'.'/'.$news->id.'/'.$news->title;
                            }
                            ?>

                        <div class="single-block auto">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="single-block auto no-margin">
                                        <a href="{{url($url)}}">
                                            <img alt="{{$news->title}}" src="{{asset('/client')}}/media/common/placeholder-sm.png" data-src="{{asset($news->feature_medium)}}" class="lazyload img-responsive">
                                        </a>
                                        <div class="overlay-category">
                                            <a href="{{url($news->newsCategory->link)}}" rel="nofollow">{{$news->newsCategory->category_name}}</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-9 paddingTop15">
                                    <h3 class="no-margin"><a href="{{url($url)}}">{{$news->title}}</a></h3>

                                    <small class="text-muted"><i class="fa fa fa-clock-o"></i>
                                        <?php $bongabda = new EasyBanglaDate\Types\BnDateTime($news->published_date);

                                        echo  $bongabda->getDateTime()->enFormat('h:i a, l jS F Y ');
                                        ?>
                                    </small>

                                    <p>
                                        <?php
                                        if (strlen($news->meta_description) != strlen(utf8_decode($news->meta_description)))
                                        {
                                            echo substr($news->meta_description,0,300);
                                        }else{
                                            echo substr($news->meta_description,0,19);
                                        }
                                        ?>...
                                    </p>

                                </div>
                            </div>
                        </div>

                        @empty
                            <h3 class="alert alert-danger text-center">No Record Found !</h3>
                        @endforelse


                    <div class="text-center paddingBottom20" style="display:none;">
                        <button id="load_more_button"><img alt="Loader" src="https://cdn.jagonews24.com/media/common/ajax-loader.gif" class="animation_image" style="width: 30px; display: none;"> Read More</button>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>


    @endsection


@section('script')

    @endsection