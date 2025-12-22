@extends('layouts.app-inner')

@section('content')

{{-- ===================== HERO (image + text) ===================== --}}
<div class="dark-bckground flex-wrap d-flex align-items-start justify-content-between position-relative">

    {{-- Image column (goes RIGHT in Arabic via order classes) --}}
    <div
        class="col-12 col-sm-12 col-md-5 col-lg-5 col-xxl-5 {{ app()->getLocale()==='ar' ? 'order-md-2 order-lg-2' : 'order-md-1 order-lg-1' }}"
        style="min-height: 450px"
    >
        <div class="img-background" style="height:100%;">
            <img src="{{ asset('storage').'/'.ltrim($data->image,'/\\') }}"
                 width="100%" height="100%"
                 style="object-fit:cover;"
                 alt="">
        </div>
    </div>

    {{-- Content column (goes LEFT in Arabic via order classes) --}}
    <div
        class="col-12 col-sm-12 col-md-6 col-lg-6 col-xxl-6 {{ app()->getLocale()==='ar' ? 'order-md-1 order-lg-1' : 'order-md-2 order-lg-2' }} pt-10p"
        @if(app()->getLocale()==='ar') style="text-align:right;padding-right:90px;padding-left:0;" @endif
    >
        {{-- Title + icon (reverse row in Arabic) --}}
        <div class="d-flex align-items-center {{ app()->getLocale()==='ar' ? 'flex-row-reverse' : '' }}">
            <img src="{{ asset('storage').'/'.ltrim($data->icon,'/\\') }}" width="100" height="100" alt="">

            @if(app()->getLocale()==='ar')
                <h1 class="b-semiBold text-light" style="margin-right:1rem;margin-left:0;">{{ $data->title }}</h1>
            @else
                <h1 class="b-semiBold text-light mx-4">{{ $data->title }}</h1>
            @endif
        </div>

        <div>
            <p class="text-light-inner font-size-20 mt-4">{!! $data->body !!}</p>
        </div>
    </div>
</div>
{{-- =================== /HERO =================== --}}

{{-- ===================== THREE CARDS ===================== --}}
<div class="px-10-0 d-flex layout-padding justify-content-center padding-zero" id="about">
    <div class="col sm-display-none"></div>

    @foreach ($pages as $key => $page)
        <div class="d-flex flex-column col-sm col-md col-lg">
            <a href="{{ route('show.page', ['locale'=>app()->getLocale(), 'slug'=>$page['slug']]) }}" class="text-decoration-none">
                <div class="border-right px-2 px-sm-5 px-md-5 px-lg-5 d-flex justify-content-center align-items-center @if($loop->last) border-0 @endif"
                     @if(app()->getLocale()==='ar') style="border-right:none;border-left:1px solid #808080;" @endif>
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
</div>
{{-- =================== /THREE CARDS =================== --}}

@endsection

@push('styles')
<style>
/* RTL-only polish (does NOT affect English) */
html[dir="rtl"] .dark-bckground .pt-10p{ text-align:right; padding-right:90px; padding-left:0; }
@media (max-width:1200px){ html[dir="rtl"] .dark-bckground .pt-10p{ padding-right:40px; } }
@media (max-width:992px){ html[dir="rtl"] .dark-bckground .pt-10p{ padding-right:20px; } }
/* put the thin divider on the left in RTL for the cards row */
html[dir="rtl"] #about .border-right{ border-right:none; border-left:1px solid #808080; }
</style>
@endpush
