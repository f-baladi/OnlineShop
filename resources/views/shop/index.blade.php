@extends('layouts.shop')
@section('head')
    <link href="{{ asset('css/swiper-bundle.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="row slider_div">
        <div class="col-12">
            @if(sizeof($sliders)>0)
                <div class="slider_box">
                    <div  >


                                <!-- Swiper -->
                                <div class="swiper-container">
                                    <div class="swiper-wrapper">
                                        @foreach($sliders as $key=>$value)
                                        <div class="swiper-slide">
                                            <a href="" ><img style="height: 500px; width: 100%" src="{{$value->url}}" alt=""></a>
                                        </div>
                                        @endforeach
                                    </div>
                                    <!-- Add Pagination -->
                                    <div class="swiper-pagination"></div>
                                    <!-- Add Arrows -->
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                </div>


                    </div>
                </div>

            @endif
        </div>

    </div>


@endsection

@section('script')

    <script src="{{ asset('js/swiper-bundle.min.js') }}" type="text/javascript"></script>

    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            autoplay: {
                delay: 2500,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    </script>
@endsection
