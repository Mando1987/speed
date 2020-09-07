@extends('layouts.front')
@section('content')
    @include('front.includes.slider')
    <div class="tab-home">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <ul class="nav nav-tabs text-center" role="tablist">
                        <li role="presentation" class="active"><a href="#about" aria-controls="about" role="tab"
                                data-toggle="tab">من نحن</a></li>
                        <li role="presentation"><a href="#services" aria-controls="about" role="tab"
                                data-toggle="tab">خدماتنا</a></li>
                        <li role="presentation"><a href="#other" aria-controls="other" role="tab" data-toggle="tab">طلب
                                شحن</a></li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="tab-content">
                        @include('front.includes.about-tab')
                        @include('front.includes.services-tab')
                        @include('front.includes.addOrder-tab')
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('front.includes.services')
    @include('front.includes.whyChargeForWe')

    @include('front.includes.historyOfOrders')
@endsection
