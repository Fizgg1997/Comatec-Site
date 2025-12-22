@extends('layouts.app-inner')
@section('content')
<div class="dark-bckground flex-wrap d-flex align-items-start justify-content-between position-relative">
    <div class="col-12 col-sm-12 col-md-5 col-lg-5 col-xxl-5  h-100" style="min-height: 450px">
        <div class="img-background">
            <img src="{{asset('storage').'/'.  $data->inner_image}}" width="100%" height="100%" />
        </div>
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xxl-6 pt-10p">
        <div class="d-flex align-items-center">
            <img src="{{asset('storage').'/'.  $data->icon}}" width="100" height="100" class="border-raduis" />
            <h1 class="b-semiBold text-light mx-4">{{ $data->title}}</h1>
        </div>
        <div>
            <p class="text-light-inner font-size-20 mt-4">
                {!! $data->description !!} </p>
        </div>
    </div>
</div>
<div class="mt-5 layout-padding mx-4" id="our_industries">
    @foreach ($project_details as $key => $industry)
    @if ($key % 2 == 0)
    <a class="text-decoration-none">
        <div class="d-flex flex-row justify-content-between align-items-center">
            <div class="col pe-2">
                <img src="{{asset('storage').'/'.  $industry['image']}}" width="100%" height="200"
                    class="project-img" />
            </div>
            <div class="col ps-3 ">
                <p class="blue-color b-semibold font-size-2rem mb-0">
                    {{ $industry['title'] }}
                </p>
                <p class="blue-color b-semibold my-4 font-size-25">
                    <i>
                        {{ $industry['subtitles'] }}
                    </i>
                </p>
                <p class=" font-size-20 me-3 b-light">
                    {!! $industry['description'] !!}
                </p>
            </div>
        </div>
    </a>
    @else
    <a class="text-decoration-none ">
        <div class="d-flex flex-row justify-content-between align-items-center">
            <div class="col pe-3">
                <p class="blue-color b-semibold font-size-2rem">
                    {{ $industry['title'] }}
                </p>
                <p class="blue-color b-semibold my-4 font-size-25">
                    <i>
                        {{ $industry['subtitles'] }}
                    </i>
                </p>
                <p class=" font-size-20  b-light me-3" id="description">
                    {!! $industry['description'] !!}

                </p>
            </div>
            <div class="col ps-2">
                <img src="{{asset('storage').'/'.  $industry['image']}}" width="100%" height="200"
                    class="project-img" />
            </div>
        </div>
    </a>
    @endif
    @endforeach
</div>
<div class="mt-5 pb-7p">
    <div class="row d-flex align-items-stretch flex-wrap">
        @foreach ($industries as $key => $industry)
        <div class="col-12 col-sm-6 col-md-3 position-relative p-0 m-0 d-flex align-items-stretch">
            <a href="{{ route('show.industry', ['id' => $industry['id']]) }}" class="text-decoration-none">
                <div class="col position-relative m-0 d-flex align-items-stretch h-100 img__wrap">
                    <div class="image-fade">
                        <img src="{{asset('storage').'/'.  $industry['image']}}" width="100%" height="100%"
                            class="project-img " />
                    </div>
                    <div class="position-abs-bottom-down-page d-flex align-items-stretch w-100 px-5">
                        <div style="background-color: {{ $industry['color'] }}">
                            <div class="d-flex align-items-center justify-content-center h-100 px-3">
                                <img src="{{asset('storage').'/'.  $industry['icon']}}" width="24" height="24" />
                            </div>
                        </div>
                        <div style="background-color: #115f7f; width: 100%">
                            <div class="d-flex align-items-center justify-content-center h-100 py-3">
                                <p class="mb-0 text-light mx-1 b-semibold text-truncate"
                                    style="font-size: 17px; text-wrap:initial">
                                    {{ $industry['title'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
<div class="mt-5">

    @if ($promote_images && $data['id'] == 3)
        @foreach ($promote_images as $key => $img)
            <img src="{{asset('storage').'/'.  $img['images']}}" width="100%" height="100%" />
        @endforeach

    @endif
</div>
@endsection