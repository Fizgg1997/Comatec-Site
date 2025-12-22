<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>COMATEC</title>
  <link rel="icon" type="image/x-icon" href="https://comatec.com.sa/storage/settings/February2024/sZF1HtFbyxEVuFhh82Wk.png">

  <!-- Your CSS -->
  <link rel="stylesheet" href="{{ asset('custom/styles/styles.css') }}" />
  <link rel="stylesheet" href="{{ asset('custom/styles/fonts.css') }}" />

  <!-- Swiper + Bootstrap CSS -->
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

  <style>
    /* we keep your existing keyframes, but ensure content is visible by default */
    .fade-in-visible { opacity: 1; }
    .position-abs-bottom-down { opacity: 1; }

    /* header scroll styles */
    header.scrolled { background:#fff; box-shadow:0 2px 12px rgba(0,0,0,.06); }
    header.unscrolled { background:transparent; }
  </style>
</head>
<body>
  <!-- Bootstrap bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
          crossorigin="anonymous"></script>

  <div>
    <header class="py-4 layout-padding unscrolled" id="header">
      <div>
        <nav class="navbar navbar-expand-lg">
          <div class="container-fluid d-flex justify-content-between px-0">
            <a class="navbar-brand" href="{{ url('/'.app()->getLocale()) }}">
              <div class="logo">
                <img src="{{ asset('assets/logo.png') }}" width="260" alt="COMATEC" />
              </div>
            </a>

            <button class="navbar-toggler list-btn" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
                    aria-expanded="false" aria-label="Toggle navigation">
              <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                   class="bi bi-list" viewBox="0 0 16 16">
                <path style="fill:#6c757d" fill-rule="evenodd"
                      d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
              </svg>
            </button>

            <div class="collapse navbar-collapse" style="flex-grow: initial" id="navbarNavDropdown">
              <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link active" href="{{ url('/'.app()->getLocale()) }}"><p class="b-regular m-3 header-item">Home</p></a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('show.page', ['locale'=>app()->getLocale(),'slug'=>'about-us']) }}"><p class="b-regular m-3 header-item">About us</p></a></li>
                <li class="nav-item"><a class="nav-link" href="#industry"><p class="b-regular m-3 header-item">Our Services</p></a></li>
                <li class="nav-item"><a class="nav-link" href="#our_projects"><p class="b-regular m-3 header-item">Projects</p></a></li>
                <li class="nav-item"><a class="nav-link" href="#news"><p class="b-regular m-3 header-item">News</p></a></li>
               
              </ul>
            </div>

            <a href="{{ url('/'.app()->getLocale().'/contact-us') }}" class="sm-display-none text-decoration-none">
              <div class="d-lg-flex align-items-center d-none">
                <p class="b-regular m-3 pointer header-item">Get in touch</p>
              </div>
            </a>
          </div>
        </nav>
      </div>
    </header>

    @yield('content')

    <footer>
      <div class="footer d-flex flex-column">
        <div class="d-flex justify-content-md-around align-items-start flex-wrap">
          <div class="mx-4 my-2">
            <p class="footer-head mb-3">About us</p>
            <a href="{{ route('show.page', ['locale'=>app()->getLocale(),'slug'=>'about-us']) }}"><p class="mb-1">Who we are</p></a>
            <a href="#our_team"><p class="mb-1">Our Team</p></a>
            <a href="#certificate"><p class="mb-1">ISO Certificates</p></a>
          </div>

          <div class="mx-4 my-2">
            <p class="footer-head mb-3">Our Services</p>
            @isset($industries)
              @foreach ($industries as $industry)
                <a href="{{ route('show.industry', ['locale'=>app()->getLocale(),'id'=>$industry['id']]) }}"><p class="mb-1">{{ $industry['title'] }}</p></a>
              @endforeach
            @endisset
          </div>

          <div class="mx-4 my-2">
            <p class="footer-head mb-3">Quick Links</p>
            <p class="mb-1">E-commerce</p>
            <a href="{{ url('/'.app()->getLocale().'/career') }}" style="color:#999!important;"><p class="mb-1">Careers</p></a>
          </div>

          <div class="mx-4 my-2">
            <p class="footer-head mb-3">Address</p>
            <p class="mb-1">7973 Prince Mohammed Ibn Abdulaziz St.</p>
            <p class="mb-1">Al Olaya</p>
            <p class="mb-1">Riyadh 12222</p>
          </div>

          <div class="mx-4 my-2">
            <p class="footer-head mb-3">Contact Us</p>
            <p class="mb-1">Tel: <span class="mx-1">+966 11 416 1901</span></p>
            <p class="mb-1">Tel: <span class="mx-1">+966 11 416 1908</span></p>
            <p class="mb-1">Email: <a href="mailto:info@comatec.com.sa" style="color:#999;">info@comatec.com.sa</a></p>
          </div>
        </div>

        <div class="d-flex justify-content-center footer-rights">
          <p class="m-3 my-italic">COMATEC. All Rights Reserved</p>
        </div>
      </div>
    </footer>
  </div>

  <!-- Swiper -->
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

  <script>
    /* ---------- Header scroll state ---------- */
    document.addEventListener('scroll', () => {
      const header = document.getElementById('header');
      if (!header) return;
      (window.scrollY > 100) ? header.classList.add('scrolled')
                             : header.classList.remove('scrolled');
    }, { passive: true });

    /* ---------- Safe Swiper init (only if present) ---------- */
    document.addEventListener('DOMContentLoaded', () => {
      try {
        new Swiper('.swiper-container', {
          slidesPerView: 1, spaceBetween: 0,
          navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
          breakpoints: { 576:{slidesPerView:2}, 768:{slidesPerView:3}, 992:{slidesPerView:4}, 1200:{slidesPerView:6} }
        });
      } catch(_) {}
      try {
        new Swiper('.swiper-container3', {
          slidesPerView: 1,
          navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
          breakpoints: { 576:{slidesPerView:1}, 768:{slidesPerView:2}, 992:{slidesPerView:4}, 1200:{slidesPerView:5} }
        });
      } catch(_) {}
      try {
        new Swiper('.swiper-container-2', {
          slidesPerView: 1, spaceBetween: 0,
          navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
          breakpoints: { 576:{slidesPerView:2}, 768:{slidesPerView:3}, 992:{slidesPerView:4}, 1200:{slidesPerView:7} }
        });
      } catch(_) {}
    });

    /* ---------- Inline animation injector (no WOW.js) ---------- */
    (function inlineReveals(){
      const industry = document.getElementById('industry');
      if (!industry) return;

      const imgs  = industry.querySelectorAll('.fade-in-visible');
      const bars  = industry.querySelectorAll('.position-abs-bottom-down');

      const io = new IntersectionObserver((entries) => {
        entries.forEach((e) => {
          if (!e.isIntersecting) return;

          // apply inline animation styles to match prod’s “element.style”
          if (e.target.classList.contains('fade-in-visible')) {
            e.target.style.animation = 'slideFromTop 1s ease 0s 1 normal forwards running';
            e.target.style.opacity   = '1';
            e.target.style.transform = 'translateY(0)';
          }
          if (e.target.classList.contains('position-abs-bottom-down')) {
            e.target.style.animation = 'appear 1s ease 0s 1 normal forwards running';
            e.target.style.opacity   = '1';
          }
          io.unobserve(e.target);
        });
      }, { threshold: 0.25 });

      imgs.forEach((el, i) => {
        // optional stagger per row
        el.style.animationDelay = `${(i%4)*0.15}s`;
        io.observe(el);
      });
      bars.forEach((el, i) => {
        el.style.animationDelay = `${(i%4)*0.15}s`;
        io.observe(el);
      });
    })();

    /* ---------- Counters + descriptions (your original logic) ---------- */
    function timeout(ms){ return new Promise(r => setTimeout(r, ms)); }
    function animateCounter(el, start, end, duration){
      let range = end - start, current = start, increment = range / duration * 10;
      const t = setInterval(() => {
        current += increment;
        if ((end % 1) === 0) { el.innerHTML = Math.round(current); }
        else { el.innerHTML = current.toFixed(2); }
        if (current >= end) {
          clearInterval(t);
          el.innerHTML = (end % 1) === 0 ? Math.round(end) : end.toFixed(2);
        }
      }, 10);
    }
    function handleIntersection(entries, observer){
      entries.forEach(entry => {
        if (!entry.isIntersecting) return;

        if (entry.target.id === 'statistic') {
          entry.target.querySelectorAll('.counter').forEach(c => {
            animateCounter(c, 0, parseFloat(c.innerHTML), 2000);
          });
          observer.unobserve(entry.target);
        } else if (entry.target.id === 'our_industries') {
          processDescriptionElements().then(() => observer.unobserve(entry.target));
        }
      });
    }
    async function typeWriterAsync(node){
      return new Promise(resolve => {
        let i = 0, text = node.innerHTML;
        node.innerHTML = '';
        (function tw(){
          if (i < text.length){ node.innerHTML += text.charAt(i++); setTimeout(tw, 2); }
          else resolve();
        })();
      });
    }
    async function processDescriptionElements(){
      const wrap = document.getElementById('our_industries');
      if (!wrap) return;
      for (const block of wrap.children){
        const ps = block.querySelectorAll('p');
        if (!ps.length) continue;
        ps[0].classList.add('title-fade-in');
        const desc = ps[1];
        if (desc){ desc.style.display = 'block'; await typeWriterAsync(desc); }
      }
    }
    document.addEventListener('DOMContentLoaded', () => {
      const obs1 = new IntersectionObserver(handleIntersection, { threshold: .1 });
      const obs2 = new IntersectionObserver(handleIntersection, { threshold: .5 });
      const ind  = document.getElementById('our_industries');
      const stat = document.getElementById('statistic');
      if (ind)  obs1.observe(ind);
      if (stat) obs2.observe(stat);
    });
  </script>
</body>
</html>
