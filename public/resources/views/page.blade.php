@extends('layouts.app-inner')

@section('content')

@php
    $isAr = app()->getLocale() === 'ar';
@endphp

{{-- Main section (image left, content right). Uses your existing classes; no CSS file changes needed. --}}
<section class="dark-bckground d-flex flex-wrap align-items-start justify-content-between position-relative">
    {{-- LEFT: image (always left) --}}
    <div class="col-12 col-sm-12 col-md-5 col-lg-5 col-xxl-5 h-100" style="min-height:450px">
        <div class="img-background">
            @if(!empty($data->image))
                <img src="{{ asset('storage').'/'.ltrim($data->image,'/\\') }}" width="100%" height="100%" alt="{{ $data->title }}">
            @endif
        </div>
    </div>

    {{-- RIGHT: text (RTL only for Arabic) --}}
    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xxl-6 pt-10p"
         dir="{{ $isAr ? 'rtl' : 'ltr' }}"
         style="{{ $isAr ? 'text-align:right;' : '' }}">
        <div class="d-flex align-items-center {{ $isAr ? 'flex-row-reverse' : '' }}">
            @if(!empty($data->icon))
                <img src="{{ asset('storage').'/'.ltrim($data->icon,'/\\') }}" width="100" height="100" alt="">
            @endif
            <h1 class="b-semiBold text-light mx-4 m-0">{{ $data->title }}</h1>
        </div>

        {{-- use div, not <p>, to safely render rich HTML from $data->body --}}
        <div class="font-size-20 mt-4 text-light-inner">
            {!! $data->body !!}
        </div>
    </div>
</section>

{{-- Bottom tiles --}}
<section class="px-10-0 d-flex layout-padding justify-content-center padding-zero" id="about">
    <div class="col sm-display-none"></div>

    @foreach ($pages as $page)
        <div class="d-flex flex-column col-sm col-md col-lg">
            <a href="{{ route('show.page', ['slug' => $page['slug']]) }}" class="text-decoration-none">
                <div class="border-right px-2 px-sm-5 px-md-5 px-lg-5 d-flex justify-content-center align-items-center @if($loop->last) border-0 @endif">
                    @if(!empty($page['icon']))
                        <img src="{{ asset('storage').'/'.ltrim($page['icon'],'/\\') }}" width="115" height="115" class="icon-img" alt="">
                    @endif
                </div>
                <div class="px-2 px-sm-5 px-md-5 px-lg-5 text-center mt-3" dir="auto">
                    <p class="mb-1 b-light font-size-25">
                        {!! implode(' ', collect(explode(' ', trim($page['title'] ?? '')))->map(function($w,$i){
                            return $i === 0 ? e($w) : "<span class='color-green b-semibold'>".e($w)."</span>";
                        })->toArray()) !!}
                    </p>
                </div>
            </a>
        </div>
    @endforeach

    <div class="col sm-display-none"></div>
</section>

@endsection
