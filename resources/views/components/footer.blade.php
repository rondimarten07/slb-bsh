<footer id="footer" class="footer position-relative light-background">

  <div class="container footer-top">
    <div class="row gy-4">
      <div class="col-lg-4 col-md-6 footer-about">
        <a href="index.html" class="logo d-flex align-items-center">
          <span class="sitename">SLB Bunda Bening</span>
        </a>
        <div class="footer-contact pt-3">
          <p>Jl. Cibiru Beet Hilir, Cileunyi Wetan</p>
          <p>Kabupaten Bandung, Jawa Barat 40622</p>
          <p class="mt-3"><strong>Telepon:</strong> <span>+62813-2092-1473</span></p>
          <p><strong>Email:</strong> <span>slbautismabsh@gmail.com</span></p>
        </div>
        <div class="social-links d-flex mt-4">
          <a href="{{ env('APP_URL') }}"><i class="bi bi-house"></i></a>
          <a href="https://www.facebook.com/people/SLB-Autisma-Bunda-Bening-Selakshahati/61567140183563/" target="_blank"><i class="bi bi-facebook"></i></a>
          <a href="https://www.instagram.com/slbbundabeningselakshahati" target="_blank"><i class="bi bi-instagram"></i></a>
          <a href="https://youtube.com/@mediabsh" target="_blank"><i class="bi bi-youtube"></i></a>
        </div>
      </div>

      <div class="col-lg-2 col-md-3 footer-links">
        <h4>Tautan</h4>
        <ul>
          <li><a href="/">Home</a></li>
          <li><a href="#vision">Visi Misi</a></li>
          <li><a href="#features">Keunggulan</a></li>
          <li><a href="#services">Layanan</a></li>
          {{-- <li><a href="#">Artikel</a></li> --}}
        </ul>
      </div>

      <div class="col-lg-2 col-md-3 footer-links">
        <h4>Layanan Kami</h4>
        <ul>
          <li><a href="#">Pendidikan Inklusif</a></li>
          <li><a href="#">Kelas Terapi</a></li>
          <li><a href="#">Dukungan Individu & Emosional</a></li>
          <li><a href="#">Pelatihan & Edukasi Orang Tua</a></li>
          <li><a href="#">Advokasi Pendidikan</a></li>
        </ul>
      </div>

      <div class="col-lg-4 col-md-12 footer-newsletter">
        <h4>Donasi</h4>
        <p>Scan QR Code berikut untuk memberikan donasi dan membuat Bunda Bening menjadi lebih baik</p>
        <img src="{{ asset('assets/img/Generate QR code Form Donasi SLB BSH.png') }}" alt="QR Code Donasi" width="200px"/>
        {{-- <form action="forms/newsletter.php" method="post" class="php-email-form">
          <div class="newsletter-form"><input type="email" name="email"><input type="submit" value="Subscribe"></div>
          <div class="loading">Loading</div>
          <div class="error-message"></div>
          <div class="sent-message">Your subscription request has been sent. Thank you!</div>
        </form> --}}
      </div>

    </div>
  </div>

  <div class="container copyright text-center mt-4">

    <p>© <span>Copyright</span><strong class="px-1 sitename">SLB Bunda Bening Selakshahati</strong><span>2025</span></p>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you've purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
      {{-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> --}}
    </div>
  </div>

</footer>