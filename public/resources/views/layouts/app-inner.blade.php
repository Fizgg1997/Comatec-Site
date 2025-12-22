<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale()==='ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>COMATEC</title>
    <link rel="icon" type="image/x-icon" href="https://comatec.com.sa/storage/settings/February2024/sZF1HtFbyxEVuFhh82Wk.png">

    <link rel="stylesheet" type="text/css" href="{{ asset('custom/styles/styles.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('custom/styles/fonts.css') }}" />

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet">
</head>
<body dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

<div>
    <header class="py-3 layout-padding fixed-header">
        <nav class="navbar navbar-expand-lg p-0">
            <div class="container-fluid d-flex justify-content-between px-0">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <div class="logo">
                        <img src="{{ asset('assets/logo.png') }}" width="260" alt="COMATEC" />
                    </div>
                </a>

                <button class="navbar-toggler list-btn" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                        aria-label="Toggle navigation">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                         class="bi bi-list" viewBox="0 0 16 16">
                        <path style="fill:#6c757d" fill-rule="evenodd"
                              d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                    </svg>
                </button>

                <div class="collapse navbar-collapse" style="flex-grow:initial" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ url('/') }}">
                                <p class="b-regular m-3 header-item">Home</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('show.page', ['slug' => 'about-us']) }}">
                                <p class="b-regular m-3 header-item">About us</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/#industry') }}">
                                <p class="b-regular m-3 header-item">Our Services</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/#our_projects') }}">
                                <p class="b-regular m-3 header-item">Projects</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/#news') }}">
                                <p class="b-regular m-3 header-item">News</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('contact-us') }}">
                                <p class="b-regular text-light m-3 header-item">Get in touch</p>
                            </a>
                        </li>
                    </ul>
                </div>

                <a href="{{ url('/contact-us') }}" class="sm-display-none" style="text-decoration:none">
                    <div class="d-lg-flex align-items-center d-none">
                        <div>
                            <svg id="Layer_1" style="width:20px;height:20px" data-name="Layer 1"
                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14.77 25.82">
                                <defs><style>.cls-1{fill:#6c757d!important;}</style></defs>
                                <path class="cls-1"
                                      d="M1691,109.24a2,2,0,0,1,1.82-2.12h5.85a1.69,1.69,0,0,1,1.29.61,2.38,2.38,0,0,1,0,3,1.66,1.66,0,0,1-1.29.61h-5.85a2,2,0,0,1-1.82-2.12Z"
                                      transform="translate(-1688.4 -96.33)"/>
                                <path class="cls-1"
                                      d="M1690.23,100.59h0a1.58,1.58,0,0,1-1.27-.63,2.17,2.17,0,0,1-.54-1.49,2.27,2.27,0,0,1,.52-1.51,1.65,1.65,0,0,1,1.29-.63h11.14a1.65,1.65,0,0,1,1.29.63,2.28,2.28,0,0,1,.53,1.51,2.17,2.17,0,0,1-.54,1.49,1.61,1.61,0,0,1-1.28.63h-11.12Z"
                                      transform="translate(-1688.4 -96.33)"/>
                                <path class="cls-1"
                                      d="M1690.23,122.15h0a1.58,1.58,0,0,1-1.27-.63,2.19,2.19,0,0,1-.54-1.49,2.27,2.27,0,0,1,.52-1.51,1.65,1.65,0,0,1,1.29-.63h11.14a1.65,1.65,0,0,1,1.29.63,2.28,2.28,0,0,1,.53,1.51,2.19,2.19,0,0,1-.54,1.49,1.61,1.61,0,0,1-1.28.63h-11.12Z"
                                      transform="translate(-1688.4 -96.33)"/>
                            </svg>
                        </div>
                        <p class="b-regular m-3 pointer header-item" style="text-decoration:none">Get in touch</p>
                    </div>
                </a>
            </div>
        </nav>
    </header>

    @yield('content')

    <footer>
        <div class="footer d-flex flex-column">
            <div class="d-flex justify-content-sm-start justify-content-md-around justify-content-lg-around align-items-start flex-wrap">
                <div class="mx-4 my-2">
                    <p class="footer-head mb-3">About us</p>
                    <a href="{{ route('show.page', ['slug' => 'about-us']) }}"><p class="mb-1">Who we are</p></a>
                    <a href="{{ route('home') }}#our_team"><p class="mb-1">Our Team</p></a>
                    <a href="{{ route('home') }}#certificate "><p class="mb-1">ISO Certificates</p></a>
                </div>

                <div class="mx-4 my-2">
                    <p class="footer-head mb-3">Our Services</p>
                    @foreach ($industries as $industry)
                        <a href="{{ route('show.industry', ['id' => $industry['id']]) }}"><p class="mb-1">{{ $industry['title'] }}</p></a>
                    @endforeach
                </div>

                <div class="mx-4 my-2">
                    <p class="footer-head mb-3">Quick Links</p>
                    <p class="mb-1">E-commerce</p>
                    <a href="{{ url('/career') }}" style="color:#999999!important;"><p class="mb-1">Careers</p></a>
                </div>

                <div class="mx-4 my-2">
                    <p class="footer-head mb-3">Address</p>
                    <p class="mb-1">7973 prince Mohammed Ibn Abdulaziz St.</p>
                    <p class="mb-1">Al Olaya</p>
                    <p class="mb-1">Riyadh 12222</p>
                </div>

                <div class="mx-4 my-2">
                    <p class="footer-head mb-3">Contact Us</p>
                    <p class="mb-1">Tel: <span class="mx-1">+966 11 416 1901</span></p>
                    <p class="mb-1">Tel: <span class="mx-1">+966 11 416 1908</span></p>
                    <p class="mb-1">Email:
                        <span class="mx-1">
                            <a href="mailto:info@comatec.com.sa" style="color:#999999!important;">info@comatec.com.sa</a>
                        </span>
                    </p>
                    <div class="d-flex">
                        <div class="mx-1">
                            <a target="_blank" href="https://www.facebook.com/AlRashedCOMATEC/?_rdc=1&_rdr">
                                <!-- facebook svg -->
                                <svg id="Capa_1" enable-background="new 0 0 512 512" height="15" viewBox="0 0 512 512" width="15" xmlns="http://www.w3.org/2000/svg"><path style="fill:#fff" d="m512 256c0-141.4-114.6-256-256-256s-256 114.6-256 256 114.6 256 256 256c1.5 0 3 0 4.5-.1v-199.2h-55v-64.1h55v-47.2c0-54.7 33.4-84.5 82.2-84.5 23.4 0 43.5 1.7 49.3 2.5v57.2h-33.6c-26.5 0-31.7 12.6-31.7 31.1v40.8h63.5l-8.3 64.1h-55.2v189.5c107-30.7 185.3-129.2 185.3-246.1z"/></svg>
                            </a>
                        </div>
                        <div class="mx-1">
                            <a target="_blank" href="https://www.youtube.com/channel/UC6JRuRhnYIFLn7BqP136Gbw">
                                <!-- youtube svg -->
                                <svg width="18" height="18" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="24" cy="24" r="20" fill="#fff"/><path fill-rule="evenodd" clip-rule="evenodd" d="M35.3005 16.3781C35.6996 16.7772 35.9872 17.2739 36.1346 17.8187C36.9835 21.2357 36.7873 26.6324 36.1511 30.1813C36.0037 30.7261 35.7161 31.2228 35.317 31.6219C34.9179 32.021 34.4212 32.3086 33.8764 32.456C31.8819 33 23.8544 33 23.8544 33C23.8544 33 15.8269 33 13.8324 32.456C13.2876 32.3086 12.7909 32.021 12.3918 31.6219C11.9927 31.2228 11.7051 30.7261 11.5577 30.1813C10.7038 26.7791 10.9379 21.3791 11.5412 17.8352C11.6886 17.2903 11.9762 16.7936 12.3753 16.3945C12.7744 15.9954 13.2711 15.7079 13.8159 15.5604C15.8104 15.0165 23.8379 15 23.8379 15C23.8379 15 31.8654 15 33.8599 15.544C34.4047 15.6914 34.9014 15.979 35.3005 16.3781ZM27.9423 24L21.283 27.8571V20.1428L27.9423 24Z" fill="black"/></svg>
                            </a>
                        </div>
                        <div class="mx-1">
                            <a target="_blank" href="https://www.linkedin.com/company/comatecsa/">
                                <!-- linkedin svg -->
                                <svg height="15" viewBox="0 0 512 512" width="15" xmlns="http://www.w3.org/2000/svg"><path style="fill:#fff" d="m256 0c-141.363281 0-256 114.636719-256 256s114.636719 256 256 256 256-114.636719 256-256-114.636719-256-256-256zm-74.390625 387h-62.347656v-187.574219h62.347656zm-31.171875-213.1875h-.40625c-20.921875 0-34.453125-14.402344-34.453125-32.402344 0-18.40625 13.945313-32.410156 35.273437-32.410156 21.328126 0 34.453126 14.003906 34.859376 32.410156 0 18-13.53125 32.402344-35.273438 32.402344zm255.984375 213.1875h-62.339844v-100.347656c0-25.21875-9.027343-42.417969-31.585937-42.417969-17.222656 0-27.480469 11.601563-31.988282 22.800781-1.648437 4.007813-2.050781 9.609375-2.050781 15.214844v104.75h-62.34375s.816407-169.976562 0-187.574219h62.34375v26.558594c8.285157-12.78125 23.109375-30.960937 56.1875-30.960937 41.019531 0 71.777344 26.808593 71.777344 84.421874z"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="my-5 d-flex align-items-center w-100 justify-content-center">
                {{-- COMATEC mark (as in your original) --}}
                @includeIf('partials.comatec-mark')
            </div>
        </div>

        <div class="d-flex justify-content-center footer-rights">
            <p class="m-3 my-italic">COMATEC. All Rights Reserved</p>
        </div>
    </footer>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    var splide = new Splide('.splide', { type: 'fade', rewind: true });
    try { splide.mount(); } catch (e) {}

    new Swiper('.swiper-container-2', {
        slidesPerView: 1, spaceBetween: 0,
        navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
        breakpoints: { 576:{slidesPerView:2}, 768:{slidesPerView:3}, 992:{slidesPerView:4}, 1200:{slidesPerView:6} }
    });

    new Swiper('.swiper-certificate', {
        slidesPerView: 1, spaceBetween: 0,
        navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
        breakpoints: { 576:{slidesPerView:2}, 768:{slidesPerView:3}, 992:{slidesPerView:4}, 1200:{slidesPerView:5} }
    });
});
</script>

</body>
</html>
