@extends('layouts.app-inner')

@section('content')

<!-- <div class="lazyload" id="pageContent"> -->
<!-- <div class="position-relative" style="margin-top: 80px;">
        <img
            src="{{asset('storage').'/'.  $data->header_image}}"
            width="100%"
            height="580px"
            class="banner-img"
        />
        <div class="b-banner b-right">
            <h1 class="text-light b-extraBold font-size-5rem m-0">
                
            </h1>
        </div>
        <div class="position-abs-bottom-down-s d-flex align-items-stretch w-100 px-5 px-sm-3 px-md-4 px-lg-5">
            <div style="background-color: #57802E">
                <div class="d-flex align-items-center justify-content-center h-100 px-3">
                    <svg id="Layer_1" width="35" height="35" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 39.72 39.74">
                        <defs>
                            <style>
                            .cls-1 {
                                fill: #fff !important;
                            }
                            </style>
                        </defs>
                        <path
                            class="cls-1"
                            d="M119,1957.22c0-.12,0-.23,0-.34a5.9,5.9,0,0,1,1.72-4.29c.55-.54,1.09-1.08,1.63-1.64a5.07,5.07,0,0,1,4.12-1.51l.26,0a2.28,2.28,0,0,0,2.5-2.65c-.35-1.54-.81-3.31-3.45-3.26a1.84,1.84,0,0,1-.25,0,7.37,7.37,0,0,1-4.26-2.2c-.58-.61-1.15-1.22-1.72-1.84a9,9,0,0,1-2.16-4.26l-.06-.29a5.05,5.05,0,0,0-1.34-2.15,4.44,4.44,0,0,0-2-1.24c-1.57-.34-2.58,1.07-2.53,2.49a3.89,3.89,0,0,0,3.4,3.54h.07a6.36,6.36,0,0,1,3.87,2.09c.8.87,1.58,1.76,2.41,2.62a7,7,0,0,1,2.06,3.89v0a4.62,4.62,0,0,1-1.25,3.73c-.74.79-1.47,1.59-2.25,2.35a6.28,6.28,0,0,1-4.13,1.7h-.07a3.87,3.87,0,0,0-3.74,3.64,3.23,3.23,0,0,0,3.47,3.25A4.2,4.2,0,0,0,119,1957.22Z"
                            transform="translate(-89.6 -1931.47)"
                        />
                        <path
                            class="cls-1"
                            d="M103.58,1960.86l.35,0a6.31,6.31,0,0,1,4.56,1.77l1.62,1.69a5,5,0,0,1,1.36,4.1l0,.25a2.37,2.37,0,0,0,1.47,2.41,4.16,4.16,0,0,0,3.57-1,3.32,3.32,0,0,0,.87-1.68c.16-.58.06-1.13.24-1.72a9.11,9.11,0,0,1,2-3.42c.57-.62,1.14-1.23,1.73-1.84a7.69,7.69,0,0,1,4.21-2.22c.09,0,.19,0,.29-.06a4,4,0,0,0,3.44-3.35,1.89,1.89,0,0,0-.46-1.79,2.63,2.63,0,0,0-2-.67,3.94,3.94,0,0,0-3.54,3.31v.06a7,7,0,0,1-2.07,3.84c-.83.84-1.62,1.73-2.42,2.6a6.44,6.44,0,0,1-3.84,2.07h0a4.49,4.49,0,0,1-3.72-1.3c-.77-.78-1.52-1.57-2.29-2.34a5.92,5.92,0,0,1-1.74-4v-.07a3.86,3.86,0,0,0-3.83-3.56,3.13,3.13,0,0,0-3.38,3.22A4.17,4.17,0,0,0,103.58,1960.86Z"
                            transform="translate(-89.6 -1931.47)"
                        />
                        <pat
                            class="cls-1"
                            d="M98.11,1936.23a6.94,6.94,0,0,1-3.76,3.75c-.31.12-1.1.44-1.4.1s.24-.91.41-1.14a21.53,21.53,0,0,1,1.77-1.93,20.14,20.14,0,0,1,1.93-1.77c.24-.18.82-.68,1.14-.4S98.23,1935.91,98.11,1936.23Z"
                            transform="translate(-89.6 -1931.47)"
                        />
                        <path
                            class="cls-1"
                            d="M125.55,1938.94c.17.23.68.82.41,1.14s-1.08,0-1.4-.11a7,7,0,0,1-3.75-3.77c-.13-.31-.45-1.08-.1-1.37s.91.24,1.14.41a20.14,20.14,0,0,1,1.93,1.77A21.53,21.53,0,0,1,125.55,1938.94Z"
                            transform="translate(-89.6 -1931.47)"
                        />
                        <path
                            class="cls-1"
                            d="M98.11,1966.47c.12.31.44,1.07.1,1.36s-.91-.23-1.15-.41a17.82,17.82,0,0,1-1.92-1.77,20.14,20.14,0,0,1-1.78-1.92c-.17-.23-.68-.83-.4-1.13s1.1,0,1.41.13A7,7,0,0,1,98.11,1966.47Z"
                            transform="translate(-89.6 -1931.47)"
                        />
                        <path
                            class="cls-1"
                            d="M125.55,1963.73a21.41,21.41,0,0,1-1.77,1.92,18.91,18.91,0,0,1-1.93,1.77c-.23.18-.82.69-1.14.42s0-1,.09-1.34a7.09,7.09,0,0,1,3.74-3.76c.32-.13,1.1-.47,1.41-.14S125.72,1963.5,125.55,1963.73Z"
                            transform="translate(-89.6 -1931.47)"
                        />
                        <path
                            class="cls-1"
                            d="M104.09,1965.25H104a6.87,6.87,0,0,1-4.14-2.24c-.65-.69-1.28-1.4-1.95-2.08a7.38,7.38,0,0,1-2.24-4.13v-.08a4.52,4.52,0,0,1,1.37-4c.54-.51,1.09-1,1.61-1.55a6.2,6.2,0,0,1,4.54-1.86h.09a3.86,3.86,0,0,0,3.82-3.72,3.39,3.39,0,0,0-3.5-3.56,4.27,4.27,0,0,0-3.76,3.84v.08a6.91,6.91,0,0,1-1.86,4.49c-.54.55-1.09,1.08-1.65,1.6a5.31,5.31,0,0,1-4.12,1.33h-.06a2.58,2.58,0,0,0-2,.65,2,2,0,0,0-.48,1.8,3.61,3.61,0,0,0,3.48,3.35l.12,0a8.7,8.7,0,0,1,4.37,2.41c.54.56,1.08,1.12,1.61,1.69a9.49,9.49,0,0,1,2.31,4.28,1,1,0,0,0,0,.17,5,5,0,0,0,3.37,3.36,2.17,2.17,0,0,0,2.53-2.42A3.89,3.89,0,0,0,104.09,1965.25Z"
                            transform="translate(-89.6 -1931.47)"
                        />
                        <path
                            class="cls-1"
                            d="M115.37,1942.13H115a6,6,0,0,1-4.59-1.87c-.54-.58-1.06-1.16-1.6-1.75a5.24,5.24,0,0,1-1.37-4.2l0-.26c.06-1.44-1-2.87-2.54-2.51a5.07,5.07,0,0,0-2.4,1,5.2,5.2,0,0,0-1,2.4l-.06.24a8.81,8.81,0,0,1-2.19,4.29c-.56.62-1.13,1.22-1.71,1.82a7.31,7.31,0,0,1-4.23,2.17,1.36,1.36,0,0,1-.29.06c-2,0-3.09,1.72-3.42,3.26a2.27,2.27,0,0,0,2.47,2.64,3.71,3.71,0,0,0,3.54-3.22v-.06a7.07,7.07,0,0,1,2.08-3.92c.82-.85,1.61-1.74,2.4-2.62a6.37,6.37,0,0,1,3.86-2.1h0a4.5,4.5,0,0,1,3.76,1.35c.77.81,1.51,1.65,2.27,2.48a6.7,6.7,0,0,1,1.74,4.31v.07a3.86,3.86,0,0,0,3.85,3.66,3.3,3.3,0,0,0,3.4-3.46A4.21,4.21,0,0,0,115.37,1942.13Z"
                            transform="translate(-89.6 -1931.47)"
                        />
                    </svg>
                </div>
            </div>
            <div style="background-color: #115f7f">
                <div class="d-flex align-items-center justify-content-center h-100 py-3" >
                    <p class="mb-0 text-light mx-4 b-semibold" style="font-size: 27px; padding: 0rem 1rem"> 
                        {{ $data->title }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div style="margin-top: 80px;" class="layout-padding mx-5">
        <p class="b-light font-size-20 text-dark">
            {!!  $data->description !!}
        </p>
    </div> -->


<!-- <div style="background-color:#2D292A;height:300px;width:100%"></div>
</div> -->


<div>
    <div class="dark-bckground flex-wrap d-flex align-items-start justify-content-between position-relative ">
        <div class="col-12 col-sm-12 col-md-5 col-lg-5 col-xxl-5 h-100" style="min-height: 450px">
            @if ($data->type === 'award')
            <div class="img-background">
                <div class="awards_swiper" >

                <div id="splide" class="splide">
                        <div class="splide__track">
                            <div class="splide__list">

                            @if ($data->slider_images)
                            @foreach (json_decode($data->slider_images) as $img)
                                <div class="splide__slide  w-100">
                                    <img src="{{ asset('storage').'/'.$img }}" width="100%" height="100%" />
                                </div>
                                @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            @else
            <div class="img-background">
                <img src="{{asset('storage').'/'.  $data->header_image}}" width="100%" height="100%" />

            </div>
            @endif
        </div>

        <div class="col col-sm col-md col-lg col-xxl pt-10p pr-5">
            <div class="d-flex align-items-center">
                <img src="{{ asset('storage') . '/' . $data->image }}" width="{{ $data->type === 'award' ? 90 : 140 }}"
                    height="{{ $data->type === 'award' ? 90 : 140 }}"
                    class="{{ $data->type === 'award' ? '' : 'border-raduis' }}" />
                <h1 class="b-semiBold text-light mx-4">{{ $data->title }}</h1>
            </div>
            <p class="text-light-inner mt-4">
                {!! $data->description !!}
            </p>
        </div>



    </div>

    <div class="my-10p">


        @if($data->type === 'award')
        <div class="swiper-container-2 layout-padding mb-5">
            <div class="swiper-wrapper align-items-center justify-content-center" style="height:auto">
                @foreach ($awards_and_certificates as $key => $award)
                <div class="swiper-slide" id="awards_slide">
                    <a href="{{ route('show.award_and_certificate', ['id' => $award['id']]) }}">
                        <img src="{{ asset('storage').'/'.$award['image'] }}" width="90" height="90"
                            class="w-100 certificate-img" />
                    </a>

                    <p class="b-extraBold date_awards text-center">{{$award['title']}}</p>
                </div>
                @endforeach
            </div>

            <div class="position-relative">
                <div class="swiper-button-next" id="swiper-button-next"></div>
                <div class="swiper-button-prev" id="swiper-button-prev"></div>
            </div>
        </div>
        @else

        <div class="swiper-certificate layout-padding mb-5" id="certificate">
            <div class="swiper-wrapper align-items-center justify-content-center" id="swiper" style="height: auto">
                @foreach ($awards_and_certificates as $item)
                <div class="swiper-slide" id="certificate_slide">
                    <a href="{{ route('show.award_and_certificate', ['id' => $item['id']]) }}">
                        <img src="{{ asset('storage').'/'.$item['image'] }}" width="140" height="140"
                            class="h-100 certificate-img" />
                    </a>
                </div>
                @endforeach
            </div>
            <!-- Add Pagination -->
            <div class="position-relative">
                <div class="swiper-button-next" id="swiper-button-next"></div>
                <div class="swiper-button-prev" id="swiper-button-prev"></div>
            </div>
        </div>

        @endif


    </div>
</div>