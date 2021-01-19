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
                            <h2 class="no-margin"> আমাদের কথা </h2>
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
                    <img alt="Demoonews.com" src="{{asset('/client')}}/media/common/placeholder-xs.png" data-src="{{asset($setting->logo)}}" class="lazyload" style="width:100%;">
                </div>
                <div class="col-sm-8">
                    <?php
                    echo $setting->short_description;
                    ?>
                    <br>

                        <?php
                        echo $setting->description;
                        ?>
                </div>
            </div>
        </div>
    </section>

    @endsection


@section('script')

    @endsection