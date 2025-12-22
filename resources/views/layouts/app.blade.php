<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale()==='ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>COMATEC</title>
    <link rel="icon" type="image/x-icon" href="https://comatec.com.sa/storage/settings/February2024/sZF1HtFbyxEVuFhh82Wk.png">
    <link rel="stylesheet" type="text/css" href="{{ asset('custom/styles/styles.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('custom/styles/fonts.css')}}" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
</head>

<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

@php
  // Build /en <-> /ar switch while keeping the rest of the path the same
  $currentLocale = app()->getLocale();
  $otherLocale   = $currentLocale === 'ar' ? 'en' : 'ar';
  $segments      = request()->segments();
  if (!empty($segments) && in_array($segments[0], ['en','ar'])) {
      $segments[0] = $otherLocale;
  } else {
      array_unshift($segments, $otherLocale);
  }
  $switchUrlAll = url(implode('/', $segments));
  $isHome = request()->routeIs('home');
@endphp

<div>
    {{-- ========================= HEADER ========================= --}}
    <header class="py-4 layout-padding {{ $isHome ? 'unscrolled' : 'scrolled' }}" id="header">
        <div>
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid d-flex justify-content-between px-0">
                    {{-- Brand --}}
                    <a class="navbar-brand" href="{{ route('home', ['locale'=>app()->getLocale()]) }}">
                        <div class="logo">
                            <img src="{{ asset('assets/logo.png') }}" width="260" />
                        </div>
                    </a>

                    {{-- Toggler --}}
                    <button class="navbar-toggler list-btn" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                            aria-label="Toggle navigation">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                             class="bi bi-list" viewBox="0 0 16 16">
                            <path style="fill:#6c757d" fill-rule="evenodd"
                                  d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                        </svg>
                    </button>

                    {{-- Menu --}}
                    <div class="collapse navbar-collapse" style="flex-grow: initial" id="navbarNavDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                                   href="{{ route('home', ['locale'=>app()->getLocale()]) }}">
                                    <p class="b-regular m-3 header-item">{{ __('app.header.home') }}</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('show.page', ['locale'=>app()->getLocale(), 'slug'=>'about-us']) }}">
                                    <p class="b-regular m-3 header-item">{{ __('app.header.about') }}</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home', ['locale'=>app()->getLocale()]) }}#industry">
                                    <p class="b-regular m-3 header-item">{{ __('app.header.services') }}</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home', ['locale'=>app()->getLocale()]) }}#our_projects">
                                    <p class="b-regular m-3 header-item">{{ __('app.header.projects') }}</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home', ['locale'=>app()->getLocale()]) }}#news">
                                    <p class="b-regular m-3 header-item">{{ __('app.header.news') }}</p>
                                </a>
                            </li>

                            {{-- Get in touch (MOBILE ONLY) --}}
                            <li class="nav-item d-lg-none">
                                <a class="nav-link" href="{{ route('show.contact_us', ['locale'=>app()->getLocale()]) }}">
                                    <p class="b-regular m-3 header-item">{{ __('app.header.get_in_touch') }}</p>
                                </a>
                            </li>

                            {{-- Language toggle (MOBILE ONLY) --}}
                            <li class="nav-item d-lg-none">
                                <a class="nav-link" href="{{ $switchUrlAll }}">
                                    <p class="b-regular m-3 header-item">
                                        {{ app()->getLocale() === 'ar' ? __('app.header.english') : __('app.header.arabic') }}
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </div>

                    {{-- Right side (DESKTOP ONLY): Get in touch + language toggle --}}
                    <div class="d-lg-flex align-items-center d-none">
                        <a href="{{ route('show.contact_us', ['locale'=>app()->getLocale()]) }}" style="text-decoration:none" class="sm-display-none">
                            <div class="d-lg-flex align-items-center">
                                <div class="mview">
                                    <svg id="Layer_1" style="width:20px;height:20px" data-name="Layer 1"
                                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14.77 25.82">
                                        <defs><style>.cls{fill:#433e3f!important;}</style></defs>
                                        <path class="cls"
                                              d="M1691,109.24a2,2,0,0,1,1.82-2.12h5.85a1.69,1.69,0,0,1,1.29.61,2.38,2.38,0,0,1,0,3,1.66,1.66,0,0,1-1.29.61h-5.85a2,2,0,0,1-1.82-2.12Z"
                                              transform="translate(-1688.4 -96.33)"/>
                                        <path class="cls"
                                              d="M1690.23,100.59h0a1.58,1.58,0,0,1-1.27-.63,2.17,2.17,0,0,1-.54-1.49,2.27,2.27,0,0,1,.52-1.51,1.65,1.65,0,0,1,1.29-.63h11.14a1.65,1.65,0,0,1,1.29.63,2.28,2.28,0,0,1,.53,1.51,2.17,2.17,0,0,1-.54,1.49,1.61,1.61,0,0,1-1.28.63h-11.12Z"
                                              transform="translate(-1688.4 -96.33)"/>
                                        <path class="cls"
                                              d="M1690.23,122.15h0a1.58,1.58,0,0,1-1.27-.63,2.19,2.19,0,0,1-.54-1.49,2.27,2.27,0,0,1,.52-1.51,1.65,1.65,0,0,1,1.29-.63h11.14a1.65,1.65,0,0,1,1.29.63,2.28,2.28,0,0,1,.53,1.51,2.19,2.19,0,0,1-.54,1.49,1.61,1.61,0,0,1-1.28.63h-11.12Z"
                                              transform="translate(-1688.4 -96.33)"/>
                                    </svg>
                                </div>
                                <p class="b-regular m-3 pointer header-item" style="text-decoration:none">
                                    {{ __('app.header.get_in_touch') }}
                                </p>
                            </div>
                        </a>

                        <a class="nav-link d-none d-lg-block" href="{{ $switchUrlAll }}">
                            <p class="b-regular m-3 header-item mb-0">
                                {{ app()->getLocale() === 'ar' ? __('app.header.english') : __('app.header.arabic') }}
                            </p>
                        </a>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    {{-- PAGE CONTENT --}}
    @yield('content')

    {{-- ========================= FOOTER ========================= --}}
  <footer>
    <div class="footer d-flex flex-column">
      <div class="d-flex justify-content-sm-start justify-content-md-around justify-content-lg-around align-items-start flex-wrap">

        <div class="mx-4 my-2">
          <p class="footer-head mb-3">{{ __('app.footer.about_us') }}</p>
          <a href="{{ route('show.page', ['locale'=>app()->getLocale(),'slug'=>'about-us']) }}"><p class="mb-1">{{ __('app.footer.who_we_are') }}</p></a>
          <a href="{{ route('home', ['locale'=>app()->getLocale()]) }}#our_team"><p class="mb-1">{{ __('app.footer.our_team') }}</p></a>
          <a href="{{ route('home', ['locale'=>app()->getLocale()]) }}#certificate"><p class="mb-1">{{ __('app.footer.iso_certificates') }}</p></a>
        </div>

        <div class="mx-4 my-2">
          <p class="footer-head mb-3">{{ __('app.footer.our_services') }}</p>
          @isset($industries)
            @foreach($industries as $industry)
              <a href="{{ route('show.industry', ['locale'=>app()->getLocale(),'id'=>$industry['id']]) }}">
                <p class="mb-1">{{ $industry['title'] }}</p>
              </a>
            @endforeach
          @endisset
        </div>

        <div class="mx-4 my-2">
          <p class="footer-head mb-3">{{ __('app.footer.quick_links') }}</p>
          <p class="mb-1">{{ __('app.footer.ecommerce') }}</p>
          <a href="{{ route('show.career', ['locale'=>app()->getLocale()]) }}" style="color:#999!important;">
            <p class="mb-1">{{ __('app.footer.careers') }}</p>
          </a>
        </div>

        <div class="mx-4 my-2">
          <p class="footer-head mb-3">{{ __('app.footer.address') }}</p>
          <p class="mb-1">{{ __('app.footer.addr_line1') }}</p>
          <p class="mb-1">{{ __('app.footer.addr_line2') }}</p>
          <p class="mb-1">{{ __('app.footer.addr_city') }}</p>
        </div>

        <div class="mx-4 my-2">
          <p class="footer-head mb-3">{{ __('app.footer.contact_us') }}</p>
          <p class="mb-1">{{ __('app.footer.tel') }}: <span class="mx-1" dir="ltr">+966 11 416 1901</span></p>
          <p class="mb-1">{{ __('app.footer.tel') }}: <span class="mx-1" dir="ltr">+966 11 416 1908</span></p>
          <p class="mb-1">{{ __('app.footer.email') }}:
            <a href="mailto:info@comatec.com.sa" style="color:#999">info@comatec.com.sa</a>
          </p>

          <div class="d-flex">
            <div class="mx-1">
              <a target="_blank" href="https://www.facebook.com/AlRashedCOMATEC/?_rdc=1&_rdr">
                <svg id="Capa_1" height="15" viewBox="0 0 512 512" width="15" xmlns="http://www.w3.org/2000/svg">
                  <path style="fill:#fff"
                        d="m512 256c0-141.4-114.6-256-256-256s-256 114.6-256 256 114.6 256 256 256c1.5 0 3 0 4.5-.1v-199.2h-55v-64.1h55v-47.2c0-54.7 33.4-84.5 82.2-84.5 23.4 0 43.5 1.7 49.3 2.5v57.2h-33.6c-26.5 0-31.7 12.6-31.7 31.1v40.8h63.5l-8.3 64.1h-55.2v189.5c107-30.7 185.3-129.2 185.3-246.1z"/>
                </svg>
              </a>
            </div>
            <div class="mx-1">
              <a target="_blank" href="https://www.youtube.com/channel/UC6JRuRhnYIFLn7BqP136Gbw">
                <svg width="18" height="18" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <circle cx="24" cy="24" r="20" fill="#fff"/>
                  <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M35.3 16.38c.4.4.69.9.83 1.44.85 3.42.66 8.82.02 12.36a3 3 0 0 1-.83 1.44 3 3 0 0 1-1.44.83C31.88 33 23.85 33 23.85 33s-8.02 0-10.02-.54a3 3 0 0 1-1.44-.83 3 3 0 0 1-.83-1.44c-.85-3.4-.62-8.81 0-12.34.15-.55.45-1.05.84-1.45.39-.4.88-.68 1.43-.83C15.81 15.02 23.84 15 23.84 15s8.03.02 10.02.54c.55.15 1.04.43 1.44.84ZM27.94 24l-6.66 3.86V20.14L27.94 24Z"
                        fill="black"/>
                </svg>
              </a>
            </div>
            <div class="mx-1">
              <a target="_blank" href="https://www.linkedin.com/company/comatecsa/">
                <svg height="15" viewBox="0 0 512 512" width="15" xmlns="http://www.w3.org/2000/svg">
                  <path style="fill:#fff"
                        d="m256 0c-141.36 0-256 114.64-256 256s114.64 256 256 256 256-114.64 256-256S397.36 0 256 0zm-74.39 387h-62.35V199.43h62.35zM150.43 173.81h-.41c-20.92 0-34.45-14.4-34.45-32.4 0-18.41 13.95-32.41 35.27-32.41 21.33 0 34.45 14 34.86 32.41 0 18-13.53 32.4-35.27 32.4zM406.41 387h-62.34V286.65c0-25.22-9.03-42.42-31.59-42.42-17.22 0-27.48 11.6-31.99 22.8-1.65 4.01-2.05 9.61-2.05 15.21V387h-62.34s.82-169.98 0-187.57h62.34v26.56c8.29-12.78 23.11-30.96 56.19-30.96 41.02 0 71.78 26.81 71.78 84.42V387z"/>
                </svg>
              </a>
            </div>
          </div>
        </div>

      </div>

      <div class="my-5 d-flex align-items-center w-100 justify-content-center">
        {{-- keep your SVG logo here (unchanged) --}}
        @include('partials.footer-logo')
      </div>
    </div>

    <div class="d-flex justify-content-center footer-rights">
      <p class="m-3 my-italic">COMATEC. {{ __('app.footer.rights_reserved') }}</p>
    </div>
  </footer>
</div>

{{-- Scripts (unchanged) --}}
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>

<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
function timeout(ms){return new Promise(r=>setTimeout(r,ms));}
function animateCounter(el,start,end,duration){let range=end-start,current=start,inc=range/duration*10;let t=setInterval(function(){current+=inc;el.innerHTML=(end%1===0)?Math.round(current):current.toFixed(2);if(current>=end){clearInterval(t);el.innerHTML=(end%1===0)?Math.round(end):end.toFixed(2)}},10)}
function handleIntersection(entries,observer){entries.forEach(entry=>{if(entry.target.id==='statistic'){if(entry.isIntersecting){entry.target.querySelectorAll('.counter').forEach(c=>animateCounter(c,0,parseFloat(c.innerHTML),2000));observer.unobserve(entry.target)}}else if(entry.target.id==='our_industries'){if(entry.isIntersecting){processDescriptionElements();observer.unobserve(entry.target)}}})}
const observeFadeIn=(id)=>{const s=document.querySelector(`#${id}`);const io=new IntersectionObserver((es,o)=>{es.forEach(e=>{if(e.isIntersecting){e.target.style.opacity=1;e.target.style.transform='translateY(0)';o.unobserve(e.target)}})},{threshold:.5});s.querySelectorAll('img').forEach((img,i)=>{const row=Math.floor(i/4);img.style.transition=`opacity 1s ease-out ${row*0.2}s, transform 1s ease-out ${row*0.2}s`;io.observe(img)})}
function checkScroll(){const industrySection=document.getElementById('industry');var windowHeight=window.innerHeight;const images=document.querySelectorAll('.fade-in-visible');const iconImage=document.querySelectorAll('.position-abs-bottom-down');var r=industrySection.getBoundingClientRect();if(r.top<windowHeight/1.3){images.forEach((img,i)=>{img.style.animation=`slideFromTop 1s ease ${i}s forwards`});iconImage.forEach((img,i)=>{img.style.animation=`appear 1s ease ${i}s forwards`})}}
function checkPartners(){const partners=document.getElementById('partners-section');const rect=partners.getBoundingClientRect();if(rect.top<window.innerHeight/2){observeFadeIn('partners-section');setTimeout(()=>observeFadeIn('clients-section'),1500)}}
async function typeWriterAsync(node){return new Promise(res=>{var i=0,text=node.innerHTML;node.innerHTML="";(function tw(){if(i<text.length){node.innerHTML+=text.charAt(i++);setTimeout(tw,2)}else{res()}})()})}
async function processDescriptionElements(){var items=document.getElementById('our_industries').children;for(const el of items){var ps=el.querySelectorAll('p');ps[0].classList.add('title-fade-in');const d=ps[1];d.style.display='block';await typeWriterAsync(d)}}
document.addEventListener("DOMContentLoaded",async function(){
    new Swiper('.swiper-container',{slidesPerView:1,spaceBetween:0,navigation:{nextEl:".swiper-button-next",prevEl:".swiper-button-prev"},breakpoints:{576:{slidesPerView:2},768:{slidesPerView:3},992:{slidesPerView:4},1200:{slidesPerView:6}}});
    new Swiper('.swiper-container3',{slidesPerView:1,navigation:{nextEl:".swiper-button-next",prevEl:".swiper-button-prev"},breakpoints:{576:{slidesPerView:1},768:{slidesPerView:2},992:{slidesPerView:4},1200:{slidesPerView:5}}});
    new Swiper('.swiper-container-2',{slidesPerView:1,spaceBetween:0,navigation:{nextEl:".swiper-button-next",prevEl:".swiper-button-prev"},breakpoints:{576:{slidesPerView:2},768:{slidesPerView:3},992:{slidesPerView:4},1200:{slidesPerView:7}}});

    var header=document.getElementById("header");
    window.addEventListener('scroll',()=>{checkScroll();checkPartners();if(window.scrollY>100){header.classList.remove("unscrolled");header.classList.add("scrolled")}else{header.classList.remove("scrolled");header.classList.add("unscrolled")}});
    checkScroll();checkPartners();

    var obs=new IntersectionObserver(handleIntersection,{threshold:.1});
    var ind=document.getElementById('our_industries'); if(ind) obs.observe(ind);
    const stat=document.getElementById('statistic'); obs=new IntersectionObserver(handleIntersection,{threshold:.5}); if(stat) obs.observe(stat);
});
</script>
</body>
</html>