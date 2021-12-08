<div class=" position-sticky z-index-sticky top-0">
    <div class="row">
        <nav class="navbar navbar-expand-lg navbar-light bg-white py-3">
            <div class="container">
                <a class="navbar-brand font-weight-bold"
                    href="{{ route('landingPage') }}" rel="tooltip"
                    title="Designed and Coded by Creative Tim" data-placement="bottom" target="_blank">
                    Rumah Kos Bougenville
                </a>
                <a href="{{ route('login') }}"
                    class="btn btn-sm  bg-gradient-warning  btn-round mb-0 ms-auto d-lg-none d-block">Login</a>
                <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon mt-2">
                        <span class="navbar-toggler-bar bar1"></span>
                        <span class="navbar-toggler-bar bar2"></span>
                        <span class="navbar-toggler-bar bar3"></span>
                    </span>
                </button>
                <div class="collapse navbar-collapse w-100 pt-3 pb-2 py-lg-0" id="navigation">
                    <ul class="navbar-nav navbar-nav-hover mx-auto">
                        <li class="nav-item mx-2">
                            <a href="{{ route('landingPage') }}" class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center" aria-expanded="false" role="button">
                                Home
                            </a>
                        </li>
                        <li class="nav-item mx-2">
                            <a href="{{ route('bookingPage') }}" class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center" aria-expanded="false" role="button">
                                Daftar Kamar
                            </a>
                        </li>
                        <li class="nav-item mx-2">
                            <a href="{{ route('contactUs') }}" class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center" aria-expanded="false" role="button">
                                Hubungi Kami
                            </a>
                        </li>
                    </ul>
                    <ul class="navbar-nav d-lg-block d-none">
                        <li class="nav-item">
                            <a href="{{ route('login') }}"
                                class="btn btn-sm  bg-gradient-warning  btn-round mb-0 me-1">Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>
