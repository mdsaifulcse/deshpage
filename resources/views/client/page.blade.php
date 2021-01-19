@extends('client.layouts.master')

@section('title')
    {{\App\Models\Setting::first()->value('company_slogan')}}
@endsection

@section('style')

    @endsection

@section('content')

    <section class="box-white" style="margin-top: 0px;">
        <div class="container">
            <div class="box-white padding15 marginTopBottom20">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-center">
                            <h2 class="no-margin"> {{$page->title}}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="box-white paddingBottom20">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 text-center">

                    @if(isset($page->pagePhoto) && file_exists($page->pagePhoto->photo))

                    <img alt="" src="{{asset('/client')}}/media/common/placeholder-xs.png" data-src="{{asset($page->pagePhoto->photo)}}" class="lazyload" style="width:100%;">

                        @else
                        <img alt="" src="{{asset('/client')}}/media/common/placeholder-xs.png" data-src="{{asset(\App\Models\Setting::first()->value('logo'))}}" class="lazyload" style="width:100%;">
                    @endif
                </div>
                <div class="col-sm-8">
                    <?php
                    echo $page->description;
                    ?>
                </div>
            </div>
        </div>
    </section>

    @endsection


@section('script')

    @endsection