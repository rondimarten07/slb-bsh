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
        {{-- <p data-aos="fade-up" data-aos-delay="100">Berbagai berita dan informasi terbaru seputar Bunda Bening<br></p> --}}
        {{-- <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
          <a href="#about" class="btn-get-started">Get Started</a>
          <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
        </div> --}}
        {{-- <img src="{{ Storage::url($post->cover) }}" class="img-fluid hero-img" alt="" data-aos="zoom-out" data-aos-delay="300"> --}}
      </div>
    </div>

  </section>


  <section id="" class="services section mt-2">
    <div class="container section-title" data-aos="fade-up">
      <h2>{{ $post->title }}</h2>
    </div>

    <div class="container">
      <img src="{{ Storage::url($post->cover) }}" class="img-fluid hero-img" alt="" data-aos="zoom-out" data-aos-delay="300">
      <div class="row g-5 mt-2">
        @php echo $post->content; @endphp
      </div>
    </div>
  </section>

</main>
@endsection