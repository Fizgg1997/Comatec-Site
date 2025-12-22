@extends('layouts.app')

@section('content')
@php($loc = app()->getLocale())
<div class="position-relative">
   <img src="https://comatec.com.sa/storage/header/November2023/vOAxrNHUy9BuXe7qn0Lz.jpg" width="100%" height="640px" class="banner-img" id="header_bacground" />
    <div class="b-banner">
        <div class="position-relative">
            <h1 class="text-light b-boldItalic header-font-size m-0 text-bounce">Innovative</h1>
            <div id="banner_name">
                <h1 class="text-light b-boldItalic header-font-size-2  text-bounce">Communication and Technology
                </h1>
                <p class="text-light b-regular font-size-3rem " id="header_desc"> </p>
            </div>
        </div>
    </div>
</div>

<div class="mt-5" id="industry">
    <div class="d-flex justify-content-center align-items-center my-4">
        <!-- <p style="font-size: 32px;color:#115F7F" class="b-semibold">BUSINESS LINES</p> -->
    </div>

    <div class="row d-flex align-items-stretch flex-wrap layout-padding-sm">
        @foreach ($industries as $key => $industry)
        <div class="col-12 col-sm-6 col-md-3 position-relative p-0 m-0 d-flex align-items-stretch">
            <a href="{{ route('show.industry', ['locale' => $loc, 'id' => $industry['id']]) }}" class="text-decoration-none">
                <div class="col position-relative m-0 d-flex align-items-stretch h-100 img__wrap">
                    <div class="image-fade">
                        <img src="{{ asset('storage').'/'.$industry['image'] }}" width="100%" height="100%" class="project-img fade-in-visible" />
                    </div>
                    <div class="position-abs-bottom-down d-flex align-items-stretch w-100 px-5">
                        <div style="background-color: {{ $industry['color'] }}">
                            <div class="d-flex align-items-center justify-content-center h-100 px-3">
                                <img src="{{ asset('storage').'/'.$industry['icon'] }}" width="24" height="24" />
                            </div>
                        </div>
                        <div style="background-color: #115f7f; width: 100%">
                            <div class="d-flex align-items-center justify-content-center h-100 py-3">
                                <p class="mb-0 text-light mx-1 b-semibold text-truncate wrap-17">
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

<div class="mt-5 layout-padding mx-4" id="our_industries">
    @foreach ($our_industry as $key => $industry)
    @if ($key % 2 == 0)
    <a class="text-decoration-none">
        <div class="d-flex flex-row justify-content-between align-items-center">
            <div class="col pl-2 industry_text">
                <p class="blue-color b-bold font-size-2rem">
                    @php
                        $industryTitleWords = explode(' ', $industry['title']);
                        $lastWord = array_pop($industryTitleWords);
                        $industryTitleWithoutLast = implode(' ', $industryTitleWords);
                    @endphp
                    {{ $industryTitleWithoutLast }} <span class="b-light">{{ $lastWord }}</span>
                </p>
                <p class="font-size-20 description" id="description">
                    {{ $industry['summary'] }}
                </p>
            </div>
            <div class="col">
                <img src="{{ asset('storage').'/'.$industry['image'] }}" width="100%" height="auto" class="project-img" />
            </div>
        </div>
    </a>
    @else
    <a class="text-decoration-none">
        <div class="d-flex flex-row justify-content-between align-items-center">
            <div class="col">
                <img src="{{ asset('storage').'/'.$industry['image'] }}" width="100%" height="auto" class="project-img" />
            </div>
            <div class="col pr-2 industry_text">
                <p class="blue-color b-bold font-size-2rem">
                    @php
                        $industryTitleWords = explode(' ', $industry['title']);
                        $lastWord = array_pop($industryTitleWords);
                        $industryTitleWithoutLast = implode(' ', $industryTitleWords);
                    @endphp
                    {{ $industryTitleWithoutLast }} <span class="b-light">{{ $lastWord }}</span>
                </p>
                <p class="font-size-20 description">
                    {{ $industry['summary'] }}
                </p>
            </div>
        </div>
    </a>
    @endif
    @endforeach
</div>

<div class="mt-5 mb-0 pb-0 d-flex layout-padding justify-content-center padding-zero" id="about">
    <div class="col sm-display-none"></div>

    @foreach ($pages as $key => $page)
    <div class="d-flex flex-column col-sm col-md col-lg">
        <a href="{{ route('show.page', ['locale' => $loc, 'slug' => $page['slug']]) }}" class="text-decoration-none">
            <div class="border-right px-2 px-sm-5 px-md-5 px-lg-5 d-flex justify-content-center align-items-center @if($loop->last) border-0 @endif">
                <img src="{{ asset('storage').'/'.$page['icon'] }}" width="115" height="115" class="icon-img" />
            </div>
            <div class="px-2 px-sm-5 px-md-5 px-lg-5 text-center mt-3">
                <p class="mb-1 b-light font-size-25">
                    {!! implode(' ', array_map(function($word, $index) {
                        return $index !== 0 ? "<span class='color-green b-semibold'>$word</span>" : $word;
                    }, explode(' ', $page['title']), array_keys(explode(' ', $page['title'])))) !!}
                </p>
            </div>
        </a>
    </div>
    @endforeach

    <div class="col sm-display-none"></div>
</div>

<div class="mt-5 position-relative" id="statistic">
    <img src="{{ asset('assets/background2.png') }}" width="100%" height="500" class="h-200-sm" />
    <div class="d-flex align-items-center justify-content-center position-abs-center w-100" id="statistics">
        @foreach ($statistics as $key => $statistic)
        <div class="mx-lg-5 mx-xl-5 px-2">
            <div class="d-flex justify-content-center">
                <img src="{{ asset('storage').'/'.$statistic['icon'] }}" width="70" height="70" class="svg-icons" />
            </div>
            <div class="text-center">
                <p class="mb-1 mt-2 b-extraBold font-size-30 counter" style="--target-count: {{ $statistic['achievement_number'] }};">
                    {{ $statistic['achievement_number'] }}
                </p>
                <p class="b-semibold font-size-22">
                    {!! $statistic['title'] !!}
                </p>
            </div>
        </div>
        @endforeach
    </div>
</div>

<div class="mt-4">
    <div class="d-flex justify-content-center align-items-center my-5" id="our_team">
        <p class="b-semibold title-b">OUR TEAM</p>
    </div>

    <div class="d-flex justify-content-center align-items-start flex-md-wrap flex-wrap flex-lg-nowrap layout-padding">
        @foreach ($our_team as $key => $team)
        <div class="scale col @if($team['job_title'] === 'CEO') ceo-margin @else my-sm-2 @endif" style="padding: 0rem .60rem">
            <a href="{{ $team['linkedIn_account'] }}" target="_blank" rel="noopener">
                <div class="d-flex align-items-center justify-content-center">
                    <img src="{{ asset('storage').'/'.$team['image'] }}" class="redius-100"
                        width="{{ $team['job_title'] === 'CEO' ? 127 : 90 }}"
                        height="{{ $team['job_title'] === 'CEO' ? 127 : 90 }}" />
                </div>
                <div class="text-center">
                    <p class="b-medium font-size-21 blue-color mb-1 mt-2 padding-zero-sm">
                        {{ $team['name'] }}
                    </p>
                    <p class="color-grey font-size-15">{{ $team['job_title'] }}</p>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>

<div class="my-5" id="our_projects">
    <div class="d-flex justify-content-center align-items-center mt-5 mb-4">
        <p class="b-semibold title-b">PROJECTS</p>
    </div>

    <div class="d-flex align-items-center justify-content-center layout-padding flex-wrap">
        @foreach ($projects as $key => $project)
        <div class="col-12 col-lg-3 col-xl-3 col-xxl-3 col-md-6 col-sm-6 px-3">
            <a href="{{ route('show.project', ['locale' => $loc, 'id' => $project['id']]) }}">
                <div>
                    <img src="{{ asset('storage').'/'.$project['image'] }}" class="project_im" width="100%" height="600" />
                </div>
                <div class="project-title">
                    <p class="b-bold text-center blue-color b-bold wrap-17">{{ $project['title'] }}</p>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>

<div class="my-5" id="certificate">
    <div class="d-flex justify-content-center align-items-center my-4">
        <p class="b-semibold title-b">CERTIFICATES</p>
    </div>
    <div class="swiper-container layout-padding mb-5">
        <div class="swiper-wrapper align-items-center justify-content-lg-center justify-content-md-center justify-content-start" id="swiper">
            @foreach ($certificates as $key => $data)
            <div class="swiper-slide" id="certificate_slide">
                <a href="{{ route('show.award_and_certificate', ['locale' => $loc, 'id' => $data['id']]) }}">
                    <img src="{{ asset('storage').'/'.$data['image'] }}" width="160" height="160" class="h-100 certificate-img" />
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
</div>

<div class="my-5">
    <div class="d-flex justify-content-center align-items-center mt-5">
        <p style="font-size: 32px; margin: 6rem 0rem 2rem 0rem;color:#115F7F" class="b-semibold">AWARDS</p>
    </div>

    <div class="swiper-container-2 layout-padding mb-5" id="awards">
        <div class="swiper-wrapper align-items-center justify-content-lg-center justify-content-md-center justify-content-start">
            @foreach ($awards as $key => $data)
            <div class="swiper-slide" id="awards_slide">
                <a href="{{ route('show.award_and_certificate', ['locale' => $loc, 'id' => $data['id']]) }}">
                    <img src="{{ asset('storage').'/'.$data['image'] }}" width="70" height="100" class="w-100 certificate-img" />
                </a>
                <p class="b-extraBold date_awards text-center">{{ $data['title'] }}</p>
            </div>
            @endforeach
        </div>
        <div class="position-relative">
            <div class="swiper-button-next" id="swiper-button-next"></div>
            <div class="swiper-button-prev" id="swiper-button-prev"></div>
        </div>
    </div>

    <div class="mt-4">
        <div class="d-flex justify-content-center align-items-center py-4">
            <p class="b-semibold title-b">OUR CLIENTS & PARTNERS</p>
        </div>

        <div class="d-flex align-items-center justify-content-between flex-column flex-md-row flex-sm-column flex-lg-row flex-xl-row flex-xxl-row layout-padding">
            <div class="col-12 col-md-6 col-sm-12 col-lg-6 col-xl-6 d-flex flex-wrap align-items-center justify-content-center" style="padding: 1rem 2rem" id="partners-section">
                @foreach ($our_partners as $key => $partner)
                <div class="d-flex justify-content-center align-items-center">
                    <img src="{{ asset('storage').'/'.$partner['logo'] }}" width="120" height="auto" class="mx-3 my-2" />
                </div>
                @endforeach
            </div>

            <div class="col-12 col-md-6 col-sm-12 col-lg-6 col-xl-6 flex-wrap d-flex align-items-center justify-content-center ms-0 ms-md-0 ms-lg-5 ms-xl-5 ms-xxl-5" style="padding: 1rem 2rem" id="clients-section">
                @foreach ($our_clients as $key => $client)
                <div class="d-flex justify-content-center align-items-center">
                    <img src="{{ asset('storage').'/'.$client['logo'] }}" width="auto" height="auto" style="max-height: 80px;max-width: 100px;" class="mx-3 my-2" />
                </div>
                @endforeach
            </div>
        </div>
    </div>

    @isset($news_and_articles)
    <div class="mt-5" id="news">
        <div class="d-flex justify-content-center align-items-center my-4">
            <p style="font-size: 32px;color:#115F7F" class="b-semibold mt-2">NEWS & ARTICLES</p>
        </div>

        <div class="d-flex justify-content-center mb-4 flex-wrap layout-padding" id="news_and_articles">
            <div class="swiper-container3 w-100">
                <div class="{{ count($news_and_articles) <= 5 ? 'swiper-wrapper align-items-center news-wrap w-100 ps-lg-5 ps-md-5 ps-0 ps-sm-0' : 'swiper-wrapper align-items-center w-100 ps-lg-5 ps-md-5 ps-0 ps-sm-0' }}">
                    @foreach ($news_and_articles as $key => $item)
                    <div class="swiper-slide swiper-slide_news" id="news_slide">
                        <div class="card m-2 h-100 scale" style="overflow-wrap: anywhere">
                            <a href="{{ route('show.news', ['locale' => $loc]) }}" class="h-100">
                                <div class="position-relative">
                                    <img class="card-img-top" src="{{ asset('storage').'/'.$item['image'] }}" alt="Card image cap" height="170" width="100%" />
                                    <div class="raduis-tr-10px position-abs-bottom-0 bck-white p-2 text-center">
                                        <p class="mb-0 b-extraBold font-size-12 px-2">{{ \Carbon\Carbon::parse($item['date'])->format('m') }}</p>
                                        <p class="mb-0 b-extraBold font-size-12 px-2">{{ \Carbon\Carbon::parse($item['date'])->format('y') }}</p>
                                    </div>
                                </div>
                                <div class="card-body px-4 py-3 flex-grow-1 d-flex" style="height: calc(100% - 170px);">
                                    <div class="mt-4">
                                        <h5 class="b-extraBold font-size-20">{{ $item['title'] }}</h5>
                                        <p class="font-size-14">{!! $item['summary'] !!}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="position-relative">
                    <div class="swiper-button-next" id="swiper-button-next"></div>
                    <div class="swiper-button-prev" id="swiper-button-prev"></div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</div>
@endsection
