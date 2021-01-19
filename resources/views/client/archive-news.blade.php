@extends('client.layouts.master')

@section('title')
    আজকের খবর- সর্বশেষ আপডেট | {{\App\Models\Setting::first()->value('company_slogan')}}
@endsection

@section('style')

    @endsection

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="text-center padding20 no-margin">
                                <h2 class="no-margin"> All Ads</h2>
                            </div>
                        </div>
                    </div>
                    <form action="{{url('/archive')}}" method="get" class="form-horizontal">
                        <div class="box-white padding15">
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="input-group">

                                        <div class="input-group-addon">Date <i class="fa fa-calendar"></i></div>
                                        <input type="text" name="dateFrom" class="form-control" id="dateFrom"
                                               value="@if(isset($request->dateFrom)) {{$request->dateFrom}} @endif">

                                        <div class="input-group-addon">To <i class="fa fa-calendar"></i></div>
                                        <input type="text" name="dateTo" class="form-control" id="dateTo"
                                        value="@if(isset($request->dateTo)) {{$request->dateTo}} @endif">
                                    </div>
                                </div>
                                <div class="col-sm-3">

                                    {!! Form::select('category_id',$categories,isset($request->category_id)?$request->category_id:[], ['id'=>'loadSubCategory','placeholder' => '-- Category --','class' => 'form-control','required'=>false]) !!}

                                    @if ($errors->has('category_id'))
                                        <span class="help-block">
                                            <strong class="text-danger">{{ $errors->first('category_id') }}</strong>
                                        </span>
                                    @endif

                                </div>
                                <div class="col-sm-4">
                                    <input type="text" name="keyword" value="{{isset($request->keyword)?$request->keyword:''}}" class="form-control" id="text_search" placeholder="What are you looking for?">
                                </div>
                            </div>
                        </div>
                        <div class="box-ashes padding15 marginBottom20">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label for="division" class="sr-only">বিভাগ</label>

                                    {!! Form::select('division_id',$states,isset($request->division_id)?$request->division_id:[], ['placeholder' => 'States','class' => 'form-control','required'=>false]) !!}

                                    @if ($errors->has('division_id'))
                                        <span class="help-block">
                                            <strong class="text-danger">{{ $errors->first('division_id') }}</strong>
                                         </span>
                                    @endif
                                </div>
                                <div class="col-sm-2"><button type="submit" class="btn btn-primary btn-block">Search </button></div>

                                <div class="col-sm-2">
                                    <a href="{{url('/archive')}}" class="btn btn-danger btn-block">All Ads Search</a>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="row">
                        @forelse($newses as $key=>$news)
                            <?php
                            if (isset($news->newsSubCategory))
                            {
                                $url=$news->newsCategory->link.'/'.$news->newsSubCategory->link.'/'.$news->id.'/'.$news->title;
                            }else{
                                $url=$news->newsCategory->link.'/'.'news'.'/'.$news->id.'/'.$news->title;
                            }
                            ?>
                        <div class="col-xs-12 col-sm-6">
                            <div class="single-block auto">
                                <div class="row">
                                    <div class="col-xs-4 col-sm-4">
                                        <div class="single-block auto no-margin archive-box">
                                            <a href="{{url($url)}}">
                                                <img alt="{{$news->title}}" src="media/common/placeholder-xs.png" data-src="{{asset($news->feature_medium)}}" class="lazyload img-responsive">
                                            </a>
                                            <div class="overlay-category">
                                                <a href="{{url($news->newsCategory->link)}}">{{$news->newsCategory->category_name}}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-8 col-sm-8 paddingTop10">
                                        <h3 class="no-margin"><a href="{{url($url)}}">{{$news->title}}</a></h3>
                                        <small class="text-muted">
                                            <?php $bongabda = new EasyBanglaDate\Types\BnDateTime($news->published_date);

                                            echo  $bongabda->getDateTime()->enFormat('h:i a, l jS F Y ');
                                            ?>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                            <h4 class="text-danger text-center">কোন ফলাফল পাওয়া যায়নি</h4>
                        @endforelse

                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box-white paddingTop15 paddingBottom10 marginBottom20">
                                <ul class="pagination">
                                    {{$newses->links()}}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
    </section>


    @endsection


@section('script')

    <link rel="stylesheet" href="{{asset('/client/assets')}}/common/plugins/daterangepicker/css/daterangepicker.css">
    <script src="{{asset('/client/assets')}}/common/plugins/daterangepicker/js/moment.min.js"></script>
    <script src="{{asset('/client/assets')}}/common/plugins/daterangepicker/js/daterangepicker.js"></script>


    <script>
        $(function() {
            $('#dateFrom').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                maxDate: new Date(),
                locale: {
                    format: 'MM/DD/YYYY'
                }
            });
            @if($request->has('dateFrom'))
            $('#dateFrom').val("{{$request->dateFrom}}");
            @else
            $('#dateFrom').val('');
            @endif
        });
        $(function() {
            $('#dateTo').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                maxDate: new Date(),
                locale: {
                    format: 'MM/DD/YYYY'
                }
            });
            @if($request->has('dateTo'))
            $('#dateTo').val("{{$request->dateTo}}");
            @else
            $('#dateTo').val('');
            @endif
        });
    </script>

    @endsection