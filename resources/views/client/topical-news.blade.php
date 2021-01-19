@extends('client.layouts.master')

@section('title')
   {{$topic}}
@endsection

@section('style')

    @endsection

@section('content')

    <section>
        <div class="container">
            <div class="marginBottom20">
                <h1> <i class="fa fa-tag" style="color:#9a1515;"></i> {{$topic}} খবর</h1>
                <div class="row">
                    <div class="padding15">
                        <div class="custom-social-share">
                            <div class="custom_share_count pull-left"></div>
                            <ul class="social-media custom-social-share">
                                <li>
                                    <button type="button" onclick='window.open ("https://www.facebook.com/sharer.php?u={{Request::url()}}","mywindow","menubar=1,resizable=1,width=350,height=250");'>
                                        <i class="fa fa-facebook"></i></button>
                                </li>
                                <li>
                                    <button type="button" onclick='window.open ("https://twitter.com/intent/tweet?text={{$topic}}&url={{Request::url()}}","mywindow","menubar=1,resizable=1,width=360,height=250");'>
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
            <div class="row">
                <div class="col-sm-12">
                    <div id="ad">

                    </div>
                    <div class="row">
                        <div class="col-sm-8 main-content">
                            <div class="white-box">
                                <div class="jagoTab2 TagTab">

                                    <ul class="nav nav-tabs nav-justified" role="tablist">
                                        <li role="presentation" class="active">
                                            <a href="#topicalNews" aria-controls="topicalNews" role="tab" data-toggle="tab">খবর </a>
                                        </li>
                                        {{--<li role="presentation"><a href="#photo" aria-controls="photo" role="tab" data-toggle="tab">ফটো গ্যালারি </a></li>--}}
                                    </ul>

                                    <div class="tab-content">
                                        @if(count($topicalNews)>0)
                                        <div role="tabpanel" class="tab-pane fade in active" id="topicalNews">
                                            @foreach($topicalNews as $topic)
                                                <?php
                                                if (isset($topic->newsSubCategory))
                                                {
                                                    $url=$topic->newsCategory->link.'/'.$topic->newsSubCategory->link.'/'.$topic->id.'/'.$topic->title;
                                                }else{
                                                    $url=$topic->newsCategory->link.'/'.'news'.'/'.$topic->id.'/'.$topic->title;
                                                }
                                                ?>
                                            <div class="tag-block">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="tag-img">
                                                            <a href="{{url($url)}}">
                                                                <img alt="{{$topic->title}}" src="{{asset('/client')}}/media/common/placeholder-sm.png" data-src="{{asset($topic->feature_medium)}}" class="lazyload img-responsive">
                                                            </a>
                                                            <div class="overlay-category">
                                                                <a href="{{url($topic->newsCategory->link)}}" rel="nofollow">{{$topic->newsCategory->category_name}}</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <h3>
                                                            <a href="{{url($url)}}">{{$topic->title}}</a>
                                                        </h3>
                                                        <small>{{MyHelper::bn_date_time(date('h:i A, d M Y l'),strtotime($topic->published_date))}}</small>
                                                        <p>
                                                            <?php
                                                            if (strlen($topic->meta_description) != strlen(utf8_decode($topic->meta_description)))
                                                            {
                                                                echo substr($topic->meta_description,0,300);
                                                            }else{
                                                                echo substr($topic->meta_description,0,19);
                                                            }
                                                            ?>...
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            @endforeach

                                        </div>

                                            @else
                                            <h3 class="alert alert-danger text-center">কোন তথ্য পাওয়া যায়নি!</h3>
                                        @endif

                                    </div>
                                </div>
                            </div>
                            @if($topicalNews->nextPageUrl()!='')
                                <div class="text-center paddingBottom20" >
                                    <button id="load_more_button" data-page="1" data-link="{{$topicalNews->nextPageUrl()}}">
                                        আরও পড়ুন </button>
                                </div>
                            @endif
                        </div>

                        <aside class="aside col-sm-4" style="height: auto !important; min-height: 0px !important;">
                            <div class="row paddingBottom20" style="height: auto !important;">
                                <div class="col-sm-12 text-center">
                                    <script async="" type="text/javascript"></script>
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @endsection


@section('script')

    <script>
        $('#load_more_button').on('click',function () {

            //$('#load_more_button').css({'display':'none'})
            var targetPage=$(this).data('page');

            targetPage++
            $(this).data('page',targetPage);
            $.ajax({
                url:'{{url(Request::path())}}'+'?page='+targetPage,
                method:"GET",

                success:function(data){

                    $('#topicalNews').append(data);
                }
            })
        })

    </script>

    @endsection