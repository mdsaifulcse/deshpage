@extends('client.layouts.master')

@section('title')
   {{$userPlay}}
@endsection

@section('style')

    @endsection

@section('content')

    <section>
        <div class="container">
            <div class="marginBottom20">
                <h1> <i class="fa fa-tag" style="color:#9a1515;"></i> {{$userPlay}} অনুসন্ধানের ফলাফল</h1>

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
                                        @if(count($results)>0)
                                        <div role="tabpanel" class="tab-pane fade in active" id="topicalNews">
                                            @foreach($results as $result)
                                                <?php
                                                if (isset($result->newsSubCategory))
                                                {
                                                    $url=$result->newsCategory->link.'/'.$result->newsSubCategory->link.'/'.$result->id.'/'.$result->title;
                                                }else{
                                                    $url=$result->newsCategory->link.'/'.'news'.'/'.$result->id.'/'.$result->title;
                                                }
                                                ?>
                                            <div class="tag-block">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="tag-img">
                                                            <a href="{{url($url)}}">
                                                                <img alt="{{$result->title}}" src="{{asset('/client')}}/media/common/placeholder-sm.png" data-src="{{asset($result->feature_medium)}}" class="lazyload img-responsive">
                                                            </a>
                                                            <div class="overlay-category">
                                                                <a href="{{url($result->newsCategory->link)}}" rel="nofollow">{{$result->newsCategory->category_name}}</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <h3>
                                                            <a href="{{url($url)}}">{{$result->title}}</a>
                                                        </h3>
                                                        <small>
                                                            <?php $bongabda = new EasyBanglaDate\Types\BnDateTime($result->published_date);

                                                            echo  $bongabda->getDateTime()->format('h:i a, l jS F Y ');
                                                            ?>
                                                        </small>
                                                        <p>
                                                            <?php
                                                            if (strlen($result->meta_description) != strlen(utf8_decode($result->meta_description)))
                                                            {
                                                                echo substr($result->meta_description,0,300);
                                                            }else{
                                                                echo substr($result->meta_description,0,19);
                                                            }
                                                            ?>...
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            @endforeach


                                                <div class="text-center paddingBottom20" >
                                                        {{$results->appends(['user_play' => $userPlay])->links()}}
                                                </div>

                                        </div>

                                            @else
                                            <h3 class="alert alert-danger text-center">কোন তথ্য পাওয়া যায়নি!</h3>
                                        @endif

                                    </div>
                                </div>
                            </div>


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