@extends('layouts.user')

@section('main')
<main class="main">
  <section id="hero" class="hero section">
    <div class="hero-bg">
      <img src="assets/img/hero-bg-light.webp" alt="">
    </div>
    <div class="container text-center">
      <div class="d-flex flex-column justify-content-center align-items-center">
        <h1 data-aos="fade-up">FAQ <span>Bunda Bening</span></h1>
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
      <h2>FAQ</h2>
    </div>

    <div class="container">
      <div class="row g-5 mt-2">
       <div class="accordion" id="accordionExample">
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              Bagaimana membuat Siswa Baru?
            </button>
          </h2>
          <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <div class="accordion-body text-black-50">
              Login sebagai Guru > Buka Menu Siswa > Create New Siswa > Isi Formulir > Submit
            </div>
          </div>
        </div>

        <div class="accordion-item">
          <h2 class="accordion-header" id="headingTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              Bagaimana membuat Laporan Siswa?
            </button>
          </h2>
          <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
            <div class="accordion-body text-black-50">
              Login sebagai Guru > Buka Menu Laporan > Create New Laporan > Isi Formulir > Submit
            </div>
          </div>
        </div>

        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePrintReport" aria-expanded="false" aria-controls="collapseTwo">
              Bagaimana mencetak Laporan Siswa?
            </button>
          </h2>
          <div id="collapsePrintReport" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body text-black-50">
              Login sebagai Guru > Buka Menu Laporan > Klik tombol Laporan > Pilih Tanggal & Nama Siswa > Print PDF
            </div>
          </div>
        </div>

        <div class="accordion-item">
          <h2 class="accordion-header" id="headingThree">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
              Bagaimana membuat Absensi Siswa?
            </button>
          </h2>
          <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
            <div class="accordion-body text-black-50">
              Login sebagai Guru > Buka Menu Absensi > Create New Absensi > Isi Formulir > Submit
            </div>
          </div>
        </div>

        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDownloadAttendance" aria-expanded="false" aria-controls="collapseTwo">
              Bagaimana mengunduh Absensi Siswa?
            </button>
          </h2>
          <div id="collapseDownloadAttendance" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body text-black-50">
              Login sebagai Guru > Buka Menu Kehadiran Siswa > Klik tombol Laporan Kehadiran > Pilih Tanggal & Nama Siswa > Download PDF
            </div>
          </div>
        </div>

        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNewTeacher" aria-expanded="false" aria-controls="collapseTwo">
              Bagaimana membuat Guru Baru?
            </button>
          </h2>
          <div id="collapseNewTeacher" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body text-black-50">
              Login sebagai Staff > Buka Menu Guru > Create New Anggota > Isi Formulir > Submit
            </div>
          </div>
        </div>

        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNewBook" aria-expanded="false" aria-controls="collapseTwo">
              Bagaimana menambahkan Buku Baru?
            </button>
          </h2>
          <div id="collapseNewBook" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body text-black-50">
              Login sebagai Staff > Buka Menu Buku > Create New Buku > Isi Formulir > Submit
            </div>
          </div>
        </div>

        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNewBorrowingBook" aria-expanded="false" aria-controls="collapseTwo">
              Bagaimana mencatat peminjaman Buku?
            </button>
          </h2>
          <div id="collapseNewBorrowingBook" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body text-black-50">
              Login sebagai Staff > Buka Menu Peminjaman > Create New Peminjaman > Isi Formulir > Submit
            </div>
          </div>
        </div>

        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNewReturningBook" aria-expanded="false" aria-controls="collapseTwo">
              Bagaimana mencatat pengembalian Buku?
            </button>
          </h2>
          <div id="collapseNewReturningBook" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body text-black-50">
              Login sebagai Staff > Buka Menu Peminjaman > Cari Data Peminjam Buku > Klik Edit > Ubah data Status Pengembalian > Submit
            </div>
          </div>
        </div>

        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNewArticle" aria-expanded="false" aria-controls="collapseTwo">
              Bagaimana menambahkan Artikel?
            </button>
          </h2>
          <div id="collapseNewArticle" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body text-black-50">
              Login sebagai Staff > Buka Menu Artikel > Create New Artikel > Isi Formulir > Submit
            </div>
          </div>
        </div>

      </div>
      </div>
    </div>
  </section>

</main>
@endsection