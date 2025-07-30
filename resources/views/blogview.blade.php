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
      @if($post->cover)
        <div class="text-center mb-4">
          @php
            $imagePath = '';
            if (str_starts_with($post->cover, 'http')) {
              $imagePath = $post->cover;
            } elseif (str_starts_with($post->cover, 'uploads/')) {
              $imagePath = asset('storage/' . $post->cover);
            } elseif (str_starts_with($post->cover, 'public/')) {
              $imagePath = asset(str_replace('public/', '', $post->cover));
            } else {
              $imagePath = asset('storage/' . $post->cover);
            }
          @endphp
          <!-- Debug: {{ $post->cover }} -> {{ $imagePath }} -->
          <img src="{{ $imagePath }}" 
               class="img-fluid rounded shadow" 
               alt="Cover Artikel" 
               style="max-height: 400px; object-fit: cover;"
               onerror="this.style.display='none'; this.nextElementSibling.style.display='block'; console.log('Image failed to load:', '{{ $imagePath }}');">
          <div style="display: none; padding: 2rem; background: #f8f9fa; border-radius: 8px; color: #666;">
            <i class="bi bi-image"></i> Cover artikel tidak tersedia
          </div>
        </div>
      @endif
      <div class="row">
        <div class="col-12">
          <div class="article-content" data-aos="fade-up">
            {!! $post->content !!}
          </div>
          <div class="mt-4 text-muted" data-aos="fade-up" data-aos-delay="100">
            <small>Dipublikasikan pada: {{ $post->created_at->format('d F Y H:i') }}</small>
          </div>
        </div>
      </div>
    </div>
  </section>

</main>

<style>
  .article-content {
    line-height: 1.8;
    font-size: 16px;
    color: #333;
  }
  
  .article-content h1, 
  .article-content h2, 
  .article-content h3, 
  .article-content h4, 
  .article-content h5, 
  .article-content h6 {
    margin-top: 2rem;
    margin-bottom: 1rem;
    color: #2c3e50;
    font-weight: 600;
  }
  
  .article-content p {
    margin-bottom: 1.5rem;
  }
  
  .article-content img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    margin: 1rem 0;
  }
  
  .article-content ul, 
  .article-content ol {
    margin-bottom: 1.5rem;
    padding-left: 2rem;
  }
  
  .article-content li {
    margin-bottom: 0.5rem;
  }
  
  .article-content blockquote {
    border-left: 4px solid #3498db;
    padding-left: 1rem;
    margin: 1.5rem 0;
    font-style: italic;
    color: #666;
  }
  
  .article-content a {
    color: #3498db;
    text-decoration: none;
  }
  
  .article-content a:hover {
    text-decoration: underline;
  }
</style>
@endsection