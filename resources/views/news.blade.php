@extends('layouts.app-inner')

@section('content')


<div class="position-relative" style="margin-top: 80px;">

    <img src="{{ asset('assets/news-bck.png') }}" width="100%" height="550px" class="banner-img" />
    <div class="b-banner">
        <h1 class="text-light b-semibold font-size-4rem m-0" id="title">News And Articles</h1>
    </div>
</div>

<div class="row align-items-stretch justify-content-center layout-padding mt-5">
    @foreach ($data as $key => $item)
    <div class="card p-0 col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 m-2">
        <a href="{{ route('show.news_and_articles', ['id' => $item['id']]) }}" class="h-100">
            <div class="position-relative">
                <img class="card-img-top" src="{{asset('storage').'/'.  $item['image']}}" alt="Card image cap" />
                <div class="raduis-tr-10px position-abs-bottom-0 bck-white p-2 text-center">
                    <p class="mb-0 b-extraBold font-size-12 px-2">
                        {{ \Carbon\Carbon::parse($item['date'])->format('m') }}</p>
                    <p class="mb-0 b-extraBold font-size-12 px-2">
                        {{ \Carbon\Carbon::parse($item['date'])->format('y') }}</p>
                </div>
            </div>
            <div class="card-body px-4 py-3">
                <div class="mt-4">
                    <h5 class="b-extraBold font-size-20">
                        {{ $item['title'] }}
                    </h5>
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div>

@endsection