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
                <div class="article-preview">
                  @php 
                    // Strip HTML tags and get clean text
                    $cleanContent = strip_tags($post->content);
                    // Get first 300 characters
                    $preview = substr($cleanContent, 0, 300);
                    // Add ellipsis if content is longer
                    if (strlen($cleanContent) > 300) {
                      $preview .= '...';
                    }
                  @endphp
                  <p>{{ $preview }}</p>
                </div>
                <a href="{{ route('blog.view', $post->slug) }}" class="read-more stretched-link">Baca Selengkapnya <i class="bi bi-arrow-right"></i></a>
              </div>
            </div>
          </div><!-- End Service Item -->
        @endforeach

      </div>
    </div>
  </section>

</main>

<style>
  .article-preview {
    margin-bottom: 1rem;
  }
  
  .article-preview p {
    color: #666;
    line-height: 1.6;
    margin-bottom: 0;
  }
  
  .service-item .read-more {
    color: #3498db;
    font-weight: 500;
    text-decoration: none;
    transition: color 0.3s ease;
  }
  
  .service-item .read-more:hover {
    color: #2980b9;
  }
  
  .service-item .read-more i {
    margin-left: 0.5rem;
    transition: transform 0.3s ease;
  }
  
  .service-item .read-more:hover i {
    transform: translateX(3px);
  }
</style>
@endsection