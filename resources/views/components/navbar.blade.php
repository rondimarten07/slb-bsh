<nav id="navmenu" class="navmenu">
  <ul>
    <li><a href="{{ route('home') . '#hero' }}" class="active">Home</a></li>
    <li><a href="{{ route('home') . '#vision' }}">Visi Misi</a></li>
    <li><a href="{{ route('home') . '#features' }}">Keunggulan</a></li>
    <li><a href="{{ route('home') . '#services' }}">Layanan</a></li>
    <li><a href="{{ route('blog') }}">Artikel</a></li>
    <li><a href="{{ route('faq') }}">FAQ</a></li>
    {{-- <li><a href="{{ route('blog') }}">Artikel</a></li> --}}
    {{-- <li class="dropdown"><a href="#"><span>Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
      <ul>
        <li><a href="#">Dropdown 1</a></li>
        <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
          <ul>
            <li><a href="#">Deep Dropdown 1</a></li>
            <li><a href="#">Deep Dropdown 2</a></li>
            <li><a href="#">Deep Dropdown 3</a></li>
            <li><a href="#">Deep Dropdown 4</a></li>
            <li><a href="#">Deep Dropdown 5</a></li>
          </ul>
        </li>
        <li><a href="#">Dropdown 2</a></li>
        <li><a href="#">Dropdown 3</a></li>
        <li><a href="#">Dropdown 4</a></li>
      </ul>
    </li>
    <li><a href="#contact">Contact</a></li> --}}
  </ul>
  <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
</nav>