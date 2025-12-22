@extends('layouts.app-inner')

@section('content')



<div>
    <div class="dark-bckground flex-wrap d-flex align-items-start justify-content-between position-relative ">
        <div class="col-12 col-sm-12 col-md-5 col-lg-5 col-xxl-5 h-100" style="min-height: 450px">
            <div class="img-background">
                <div class="awards_swiper">

                    <div id="splide" class="splide">
                        <div class="splide__track">
                            <div class="splide__list">


                                @if ($data->images)

                                @foreach (json_decode($data->images) as $img)
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

        </div>

        <div class="col col-sm col-md col-lg col-xxl pt-10p pr-5">
            <div class="d-flex align-items-center">
                <img src="{{ asset('storage') . '/' . $data->image }}" width="90" height="90" />
                <h1 class="b-semiBold text-light mx-4">{{ $data->title }}</h1>
            </div>
            <p class="text-light-inner mt-4">
                {!! $data->description !!}
            </p>
        </div>



    </div>

    <div class="my-10p">



    </div>
</div>