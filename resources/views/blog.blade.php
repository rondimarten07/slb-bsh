@extends('layouts.user')

@section('main')
<main class="main">
  <section id="hero" class="hero section">
    <div class="hero-bg">
      <img src="assets/img/hero-bg-light.webp" alt="">
    </div>
    <div class="container text-center">
      <div class="d-flex flex-column justify-content-center align-items-center">
        <h1 data-aos="fade-up">Artikel <span>Bunda Bening</span></h1>
        <p data-aos="fade-up" data-aos-delay="100">Berbagai berita dan informasi terbaru seputar Bunda Bening<br></p>
        {{-- <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
          <a href="#about" class="btn-get-started">Get Started</a>
          <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
        </div> --}}
        <img src="assets/img/hero-services-img.webp" class="img-fluid hero-img" alt="" data-aos="zoom-out" data-aos-delay="300">
      </div>
    </div>

  </section>


  <section id="" class="services section">
    <div class="container section-title" data-aos="fade-up">
      <h2>Artikel</h2>
    </div>

    <div class="container">

      <div class="row g-5">

        @foreach ($posts as $post)
          <div class="col-lg-12" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item item-cyan position-relative">
              <i class="bi bi-file-earmark-text-fill icon"></i>
              <div>
                <h3>{{ $post->title }}</h3>
                <p>@php 
                  $firstParagraph = preg_match('/<p>(.*?)<\/p>/', $post->content, $matches) ? $matches[1] : '';
                  echo substr(strip_tags($firstParagraph), 0, 500); 
                @endphp</p>
                {{-- <a href="{{ route('blog') . '/' . $post->slug }}" class="read-more stretched-link">Learn More <i class="bi bi-arrow-right"></i></a> --}}
              </div>
            </div>
          </div><!-- End Service Item -->
        @endforeach

      </div>
    </div>
  </section>

</main>
@endsection