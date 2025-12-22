@extends('layouts.app')

@section('content')
@php
  $isAr = app()->getLocale()==='ar';
  $dir  = $isAr ? 'rtl' : 'ltr';
  \Carbon\Carbon::setLocale(app()->getLocale());

  // Robust file-url helper (handles full URLs, storage paths, and backslashes)
  $furl = function ($p) {
      if (!$p) return null;
      $p = str_replace('\\','/',$p);
      if (preg_match('~^https?://~i', $p)) return $p;        // already a full URL
      if (stripos($p, 'storage/') === 0) return asset($p);   // starts with "storage/..."
      return \Storage::disk('public')->url($p);              // normal storage path
  };
@endphp

<div dir="{{ $dir }}">
  {{-- HERO --}}
  <div class="position-relative">
    <img src="{{ $header['bg_url'] ?? asset('assets/hero-fallback.jpg') }}"
         alt="" width="100%" height="640" class="banner-img" />
    <div class="b-banner">
      <div class="position-relative">
        <h1 class="text-light b-boldItalic header-font-size m-0 text-bounce">
          {{ $header['title'] ?? '' }}
        </h1>
        <div id="banner_name">
          <h1 class="text-light b-boldItalic header-font-size-2 text-bounce">
            {{ $header['description'] ?? '' }}
          </h1>
        </div>
      </div>
    </div>
  </div>

  {{-- INDUSTRIES (cards) --}}
  <div class="mt-5" id="industry">
    <div class="row d-flex align-items-stretch flex-wrap layout-padding-sm">
      @foreach ($industries as $industry)
        <div class="col-12 col-sm-6 col-md-3 position-relative p-0 m-0 d-flex align-items-stretch">
          <a href="{{ route('show.industry', ['locale' => app()->getLocale(), 'id' => $industry['id']]) }}" class="text-decoration-none">
            <div class="col position-relative m-0 d-flex align-items-stretch h-100 img__wrap">
              <div class="image-fade">
                <img src="{{ $furl($industry['image']) }}" width="100%" height="100%" class="project-img fade-in-visible" alt="">
              </div>
              <div class="position-abs-bottom-down d-flex align-items-stretch w-100 px-5">
                <div style="background-color: {{ $industry['color'] }}">
                  <div class="d-flex align-items-center justify-content-center h-100 px-3">
                    @php $iicon = $furl($industry['icon'] ?? null); @endphp
                    @if($iicon)
                      <img src="{{ $iicon }}" width="24" height="24" alt="">
                    @endif
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

  {{-- INDUSTRY STRIPS --}}
  <div class="mt-5 layout-padding mx-4" id="our_industries">
    @foreach ($our_industry as $key => $industry)
      @php $title = strip_tags($industry['title']); @endphp

      @if ($key % 2 === 0)
        <a class="text-decoration-none">
          <div class="d-flex flex-row justify-content-between align-items-center">
            <div class="col pl-2 industry_text">
              <p class="blue-color b-bold font-size-2rem">
                @if($isAr)
                  {{ $title }}
                @else
                  @php
                    $parts = preg_split('/\s+/u', trim($title));
                    $last  = array_pop($parts);
                    $first = implode(' ', $parts);
                  @endphp
                  {{ $first }} <span class="b-light">{{ $last }}</span>
                @endif
              </p>
              <p class="font-size-20 description">{{ $industry['summary'] }}</p>
            </div>
            <div class="col">
              <img src="{{ $furl($industry['image']) }}" width="100%" height="auto" class="project-img" alt="">
            </div>
          </div>
        </a>
      @else
        <a class="text-decoration-none">
          <div class="d-flex flex-row justify-content-between align-items-center">
            <div class="col">
              <img src="{{ $furl($industry['image']) }}" width="100%" height="auto" class="project-img" alt="">
            </div>
            <div class="col pr-2 industry_text">
              <p class="blue-color b-bold font-size-2rem">
                @if($isAr)
                  {{ $title }}
                @else
                  @php
                    $parts = preg_split('/\s+/u', trim($title));
                    $last  = array_pop($parts);
                    $first = implode(' ', $parts);
                  @endphp
                  {{ $first }} <span class="b-light">{{ $last }}</span>
                @endif
              </p>
              <p class="font-size-20 description">{{ $industry['summary'] }}</p>
            </div>
          </div>
        </a>
      @endif
    @endforeach
  </div>

  {{-- PAGES --}}
  <div class="mt-5 mb-0 pb-0 d-flex layout-padding justify-content-center padding-zero" id="about">
    <div class="col sm-display-none"></div>

    @foreach ($pages as $page)
      <div class="d-flex flex-column col-sm col-md col-lg">
        <a href="{{ route('show.page', ['locale' => app()->getLocale(), 'slug' => $page['slug']]) }}" class="text-decoration-none">
          <div class="border-right px-2 px-sm-5 px-md-5 px-lg-5 d-flex justify-content-center align-items-center @if($loop->last) border-0 @endif">
            @php $iconUrl = $furl($page['icon'] ?? null); @endphp
            @if($iconUrl)
              <img src="{{ $iconUrl }}" width="115" height="115" class="icon-img" alt="{{ $page['title'] }}">
            @endif
          </div>
          <div class="px-2 px-sm-5 px-md-5 px-lg-5 text-center mt-3">
            <p class="mb-1 b-light font-size-25">{{ $page['title'] }}</p>
          </div>
        </a>
      </div>
    @endforeach

    <div class="col sm-display-none"></div>
  </div>

  {{-- STATISTICS --}}
  <div class="mt-5 position-relative" id="statistic">
    <img src="{{ asset('assets/background2.png') }}" width="100%" height="500" class="h-200-sm" alt="">
    <div class="d-flex align-items-center justify-content-center position-abs-center w-100" id="statistics">
      @foreach ($statistics as $key => $statistic)
        <div class="mx-lg-5 mx-xl-5 px-2">
          <div class="d-flex justify-content-center">
            <img src="{{ $furl($statistic['icon']) }}" width="70" height="70" class="svg-icons" alt="">
          </div>
          <div class="text-center">
            <p class="mb-1 mt-2 b-extraBold font-size-30 counter"
               style="--target-count: {{ $statistic['achievement_number'] }};">
              {{ $statistic['achievement_number'] }}
            </p>
            <p class="b-semibold font-size-22">{!! $statistic['title'] !!}</p>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  {{-- TEAM --}}
  <div class="mt-4">
    <div class="d-flex justify-content-center align-items-center my-5" id="our_team">
      <p class="b-semibold title-b">{{ __('app.home.sections.our_team') }}</p>
    </div>

    <div class="d-flex justify-content-center align-items-start flex-md-wrap flex-wrap flex-lg-nowrap layout-padding">
      @foreach ($our_team as $team)
        @php $isCeo = str_ireplace(['.', ' '], '', $team['job_title']) === 'ceo'; @endphp
        <div class="scale col {{ $isCeo ? 'ceo-margin' : 'my-sm-2' }}" style="padding: 0rem .60rem">
          <a href="{{ $team['linkedIn_account'] }}" target="_blank" rel="noopener">
            <div class="d-flex align-items-center justify-content-center">
              <img src="{{ $furl($team['image']) }}" class="redius-100"
                   width="{{ $isCeo ? 127 : 90 }}" height="{{ $isCeo ? 127 : 90 }}" alt="">
            </div>
            <div class="text-center">
              <p class="b-medium font-size-21 blue-color mb-1 mt-2 padding-zero-sm">{{ $team['name'] }}</p>
              <p class="color-grey font-size-15">{{ $team['job_title'] }}</p>
            </div>
          </a>
        </div>
      @endforeach
    </div>
  </div>

  {{-- PROJECTS --}}
  <div class="my-5" id="our_projects">
    <div class="d-flex justify-content-center align-items-center mt-5 mb-4">
      <p class="b-semibold title-b">{{ __('app.home.sections.projects') }}</p>
    </div>

    <div class="d-flex align-items-center justify-content-center layout-padding flex-wrap">
      @foreach ($projects as $project)
        <div class="col-12 col-lg-3 col-xl-3 col-xxl-3 col-md-6 col-sm-6 px-3">
          <a href="{{ route('show.project', ['locale' => app()->getLocale(), 'id' => $project['id']]) }}">
            <div>
              <img src="{{ $furl($project['image']) }}" class="project_im" width="100%" height="auto" alt="">
            </div>
            <div class="project-title">
              <p class="b-bold text-center blue-color b-bold wrap-17">{{ $project['title'] }}</p>
            </div>
          </a>
        </div>
      @endforeach
    </div>
  </div>

  {{-- CERTIFICATES (Swiper 1) --}}
  <div class="my-5" id="certificate">
    <div class="d-flex justify-content-center align-items-center my-4">
      <p class="b-semibold title-b">{{ __('app.home.sections.certificates') }}</p>
    </div>

    <div class="swiper-container swiper-certs layout-padding mb-5">
      <div class="swiper-wrapper align-items-center justify-content-lg-center justify-content-md-center justify-content-start">
        @foreach ($certificates as $data)
          <div class="swiper-slide" id="certificate_slide">
            <a href="{{ route('show.award_and_certificate', ['locale' => app()->getLocale(), 'id' => $data['id']]) }}">
              <img src="{{ $furl($data['image']) }}" width="160" height="160" class="h-100 certificate-img" alt="">
            </a>
          </div>
        @endforeach
      </div>

      <div class="position-relative">
        <div class="swiper-button-next swiper-button-next-certs"></div>
        <div class="swiper-button-prev swiper-button-prev-certs"></div>
      </div>
    </div>
  </div>

  {{-- AWARDS (Swiper 2) + CLIENTS/PARTNERS + NEWS --}}
  <div class="my-5">
    <div class="d-flex justify-content-center align-items-center mt-5">
      <p class="b-semibold title-b" style="font-size: 32px; margin: 6rem 0 2rem; color:#115F7F">
        {{ __('app.home.sections.awards') }}
      </p>
    </div>

    <div class="swiper-container swiper-awards layout-padding mb-5" id="awards">
      <div class="swiper-wrapper align-items-center justify-content-lg-center justify-content-md-center justify-content-start">
        @foreach ($awards as $data)
          <div class="swiper-slide" id="awards_slide">
            <a href="{{ route('show.award_and_certificate', ['locale' => app()->getLocale(), 'id' => $data['id']]) }}">
              <img src="{{ $furl($data['image']) }}" width="70" height="100" class="w-100 certificate-img" alt="">
            </a>
            <p class="b-extraBold date_awards text-center">{{ $data['title'] }}</p>
          </div>
        @endforeach
      </div>

      <div class="position-relative">
        <div class="swiper-button-next swiper-button-next-awards"></div>
        <div class="swiper-button-prev swiper-button-prev-awards"></div>
      </div>
    </div>

    {{-- CLIENTS & PARTNERS --}}
    <div class="mt-4">
      <div class="d-flex justify-content-center align-items-center py-4">
        <p class="b-semibold title-b">{{ __('app.home.sections.clients') }}</p>
      </div>

      <div class="d-flex align-items-center justify-content-between flex-column flex-md-row layout-padding">
        <div class="col-12 col-md-6 d-flex flex-wrap align-items-center justify-content-center" style="padding: 1rem 2rem" id="partners-section">
          @foreach ($our_partners as $partner)
            <div class="d-flex justify-content-center align-items-center">
              <img src="{{ $furl($partner['logo']) }}" width="120" height="auto" class="mx-3 my-2" alt="">
            </div>
          @endforeach
        </div>

        <div class="col-12 col-md-6 flex-wrap d-flex align-items-center justify-content-center ms-0 ms-md-0 ms-lg-5" style="padding: 1rem 2rem" id="clients-section">
          @foreach ($our_clients as $client)
            <div class="d-flex justify-content-center align-items-center">
              <img src="{{ $furl($client['logo']) }}" style="max-height: 80px; max-width: 100px;" class="mx-3 my-2" alt="">
            </div>
          @endforeach
        </div>
      </div>
    </div>

    {{-- NEWS (Swiper 3) --}}
    @isset($news_and_articles)
      <div class="mt-5" id="news">
        <div class="d-flex justify-content-center align-items-center my-4">
          <p class="b-semibold title-b" style="font-size: 32px; color:#115F7F">
            {{ __('app.home.sections.news') }}
          </p>
        </div>

        <div class="d-flex justify-content-center mb-4 flex-wrap layout-padding" id="news_and_articles">
          <div class="swiper-container swiper-news w-100">
            <div class="{{ count($news_and_articles) <= 5 ? 'swiper-wrapper align-items-center news-wrap w-100 ps-lg-5 ps-md-5 ps-0 ps-sm-0' : 'swiper-wrapper align-items-center w-100 ps-lg-5 ps-md-5 ps-0 ps-sm-0' }}">
              @foreach ($news_and_articles as $item)
                <div class="swiper-slide swiper-slide_news" id="news_slide">
                  <div class="card m-2 h-100 scale" style="overflow-wrap:anywhere">
                    <a href="{{ route('show.news', ['locale' => app()->getLocale()]) }}" class="h-100">
                      <div class="position-relative">
                        <img class="card-img-top" src="{{ $furl($item['image']) }}" alt="" height="170" width="100%" />
                        <div class="raduis-tr-10px position-abs-bottom-0 bck-white p-2 text-center">
                          <p class="mb-0 b-extraBold font-size-12 px-2">
                            {{ \Carbon\Carbon::parse($item['date'])->translatedFormat('M') }}
                          </p>
                          <p class="mb-0 b-extraBold font-size-12 px-2">
                            {{ \Carbon\Carbon::parse($item['date'])->format('y') }}
                          </p>
                        </div>
                      </div>

                      <div class="card-body px-4 py-3 flex-grow-1 d-flex" style="height: calc(100% - 170px);">
                        <div class="mt-4">
                          <h5 class="b-extraBold font-size-20">{{ $item['title'] }}</h5>
                          <p class="font-size-14">{{ $item['summary'] }}</p>
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
              @endforeach
            </div>

            <div class="position-relative">
              <div class="swiper-button-next swiper-button-next-news"></div>
              <div class="swiper-button-prev swiper-button-prev-news"></div>
            </div>
          </div>
        </div>
      </div>
    @endisset
  </div>
</div>

{{-- Swiper init --}}
<script>
  // Certificates
  new Swiper('.swiper-certs', {
    slidesPerView: 5,
    spaceBetween: 16,
    navigation: {
      nextEl: '.swiper-button-next-certs',
      prevEl: '.swiper-button-prev-certs',
    },
    breakpoints: { 0:{slidesPerView:2}, 576:{slidesPerView:3}, 992:{slidesPerView:4}, 1200:{slidesPerView:5} }
  });

  // Awards
  new Swiper('.swiper-awards', {
    slidesPerView: 5,
    spaceBetween: 16,
    navigation: {
      nextEl: '.swiper-button-next-awards',
      prevEl: '.swiper-button-prev-awards',
    },
    breakpoints: { 0:{slidesPerView:2}, 576:{slidesPerView:3}, 992:{slidesPerView:4}, 1200:{slidesPerView:5} }
  });

  // News
  new Swiper('.swiper-news', {
    slidesPerView: 3,
    spaceBetween: 16,
    navigation: {
      nextEl: '.swiper-button-next-news',
      prevEl: '.swiper-button-prev-news',
    },
    breakpoints: { 0:{slidesPerView:1}, 768:{slidesPerView:2}, 1200:{slidesPerView:3} }
  });
</script>
@endsection
