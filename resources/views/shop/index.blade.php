@extends('layouts.shop')
@section('head')
    <link href="{{ asset('css/swiper-bundle.min.css') }}" rel="stylesheet">
@endsection

@section('content')

    {{--    slider--}}
    <div class="row slider_div">
        <div class="col-12">
            @if(sizeof($sliders)>0)
                <div class="slider_box">
                    <div>


                        <!-- Swiper -->
                        <div class="swiper-container s1">
                            <div class="swiper-wrapper">
                                @foreach($sliders as $key=>$value)
                                    <div class="swiper-slide">
                                        <a href=""><img style="height: 500px; width: 100%" src="{{$value->url}}" alt=""></a>
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

    <div class="specialOffer ">
        <div class="col-3">
            <a class="banner" href=""></a>
            <a class="showAll" href="">مشاهده همه</a>
        </div>
        <div class="col-9">
            <div class="swiper-container s2 ">
                <div class="swiper-wrapper">
                    @foreach($amazingOffers as $amazingOffer)
                    <div class="swiper-slide">
                        <a class="card" href="">
                            <div class="image">
                                <img src="{{$amazingOffer->product->image->url}}" >
                            </div>
                            <div class="title">
                                {{$amazingOffer->product->title}}
                            </div>
                            <div class="price">
                                <div class="oldPrice">
                                    <del>{{$amazingOffer->oldPrice->price}}</del>
                                    <span class="percent">
                                        {{ '٪'.percent($amazingOffer->price,$amazingOffer->oldPrice->price) }}
                                    </span>
                                </div>

                                <div class="newPrice">
                                    <span>{{$amazingOffer->price}}</span>
                                    <span>تومان</span>
                                </div>
                            </div>
                            <div class="timer" data-countdown="2021/06/01 08:47"></div>
                        </a>
                    </div>
                    @endforeach


                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>

        </div>

    </div>


@endsection

@section('script')

    <script src="{{ asset('js/swiper-bundle.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/jquery.countdown.min.js') }}" type="text/javascript"></script>

    <!-- Initialize Swiper -->
    <script>
        var swiper1 = new Swiper('.s1', {
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

    <script>
        var swiper2 = new Swiper('.s2', {
            slidesPerView: 4,
            spaceBetween: 15,
            direction: getDirection(),
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            on: {
                resize: function () {
                    swiper.changeDirection(getDirection());
                }
            }
        });

        function getDirection() {
            var windowWidth = window.innerWidth;
            var direction = window.innerWidth <= 760 ? 'vertical' : 'horizontal';

            return direction;
        }
    </script>

    <script>
        $('[data-countdown]').each(function() {
            var $this = $(this), finalDate = $(this).data('countdown');
            $this.countdown(finalDate, function(event) {
                $this.html(event.strftime('%H:%M:%S'));
            });
        });
    </script>
@endsection
