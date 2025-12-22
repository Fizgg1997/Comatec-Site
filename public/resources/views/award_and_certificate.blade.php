@extends('layouts.app')

@section('content')
@php
    // Locale & direction
    $loc  = request()->route('locale') ?? app()->getLocale() ?? 'en';
    $isAr = $loc === 'ar';
    $dir  = $isAr ? 'rtl' : 'ltr';

    // Safe file URL helper (handles absolute URLs and storage paths)
    $furl = function ($p) {
        if (!$p) return null;
        $p = str_replace('\\','/',$p);
        if (preg_match('~^https?://~i', $p)) return $p;          // already absolute
        if (stripos($p, 'storage/') === 0) return asset($p);     // "storage/..."
        return \Storage::disk('public')->url($p);                // storage path
    };

    // Robust link builder for this page (avoids "Missing parameter: locale")
    $awardUrl = function ($id) use ($loc) {
        try {
            return route('show.award_and_certificate', ['locale' => $loc, 'id' => $id]);
        } catch (\Throwable $e) {
            // Fallback to a direct URL if route() still complains
            return url($loc . '/awards-certificates/' . $id);
        }
    };
@endphp

<div dir="{{ $dir }}">

    {{-- ===== Banner ===== --}}
    <div class="position-relative">
        <img
            src="{{ $furl($data->image) ?? asset('assets/hero-fallback.jpg') }}"
            width="100%" height="560" class="banner-img" alt="banner"
        />
        <div class="b-banner">
            <div class="position-relative">
                <h1 class="text-light b-boldItalic header-font-size m-0 text-bounce">
                    {{ $data->title }}
                </h1>
            </div>
        </div>
    </div>

    {{-- ===== Main content ===== --}}
    <div class="dark-bckground flex-wrap d-flex align-items-start justify-content-between position-relative">
        <div class="col-12 col-sm-12 col-md-5 col-lg-5 col-xxl-5 h-100" style="min-height: 450px">
            <div class="img-background">
                @if(!empty($data->image))
                    <img src="{{ $furl($data->image) }}" width="100%" height="100%" alt="image">
                @endif
            </div>
        </div>

        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xxl-6 pt-10p">
            <div class="d-flex align-items-center">
                @if(!empty($data->icon))
                    <img src="{{ $furl($data->icon) }}" width="100" height="100" alt="icon">
                @endif
                <h1 class="b-semiBold text-light mx-4">{{ $data->title }}</h1>
            </div>

            <div>
                <p class="text-light-inner font-size-20 mt-4">{!! $data->body !!}</p>
            </div>
        </div>
    </div>

    {{-- ===== Related items slider ===== --}}
    <div class="my-10p">

        @if($data->type === 'award')
            {{-- AWARDS slider --}}
            <div class="swiper-container-2 layout-padding mb-5">
                <div class="swiper-wrapper align-items-center justify-content-center" style="height:auto">
                    @foreach ($awards_and_certificates as $award)
                        <div class="swiper-slide" id="awards_slide">
                            <a href="{{ $awardUrl($award['id']) }}">
                                <img
                                    src="{{ $furl($award['image']) }}"
                                    width="90" height="90"
                                    class="w-100 certificate-img" alt="award"
                                />
                            </a>
                            <p class="b-extraBold date_awards text-center">{{ $award['title'] }}</p>
                        </div>
                    @endforeach
                </div>

                <div class="position-relative">
                    <div class="swiper-button-next" id="swiper-button-next"></div>
                    <div class="swiper-button-prev" id="swiper-button-prev"></div>
                </div>
            </div>
        @else
            {{-- CERTIFICATES slider --}}
            <div class="swiper-certificate layout-padding mb-5" id="certificate">
                <div class="swiper-wrapper align-items-center justify-content-center" id="swiper" style="height: auto">
                    @foreach ($awards_and_certificates as $item)
                        <div class="swiper-slide" id="certificate_slide">
                            <a href="{{ $awardUrl($item['id']) }}">
                                <img
                                    src="{{ $furl($item['image']) }}"
                                    width="140" height="140"
                                    class="h-100 certificate-img" alt="certificate"
                                />
                            </a>
                        </div>
                    @endforeach
                </div>

                <div class="position-relative">
                    <div class="swiper-button-next" id="swiper-button-next"></div>
                    <div class="swiper-button-prev" id="swiper-button-prev"></div>
                </div>
            </div>
        @endif

    </div>
</div>
@endsection
