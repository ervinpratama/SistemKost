@extends('layouts.website')

@section('content')
<section class="container mt-5">
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="mb-4 w-25">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('bookingPage') }}">Daftar Kamar</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Kamar</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<section class="py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-6 ms-auto me-auto text-center">
                <h2 class="text-gradient text-warning">{{ $room->name }}</h2>
                <p>
                    Pilihan Kos Terbaik Untuk Anda
                </p>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-6 position-relative">
                <div class="position-relative ms-md-5 me-md-n5">
                    <div class="blur-shadow-image">
                        <img class="image-left rounded-3 img-fluid position-relative top-0 end-0 bg-cover"
                            src="https://asset-a.grid.id/crop/0x0:0x0/360x240/photo/2020/12/07/3742949463.jpg"
                            alt="image">
                    </div>
                    <div class="colored-shadow"
                        style="background-image: url(&quot;https://asset-a.grid.id/crop/0x0:0x0/360x240/photo/2020/12/07/3742949463.jpg&quot;);">
                    </div>
                </div>
                <p
                    class="blockquote border border-warning rounded w-50 p-3 display-1 float-md-end mt-4 me-md-n2 mx-auto">
                    HARGA PER BULAN:
                    <br>
                    <br>
                    <span class="h3 text-warning">Rp {{ number_format($room->roomType->price,0,',','.') }}/bulan</span>
                </p>
                <!-- Second image on the left side of the article -->
                <div class="position-absolute bottom-0 mb-5 ms-n2 me-3 start-0 end-2 d-md-block d-none">
                    <div class="blur-shadow-image">
                        <img class="image-container rounded-3 img-fluid position-relative bg-cover"
                            src="https://djuragan.sgp1.digitaloceanspaces.com/djurkam/local/images/lodgings/5ec4bb37c2f69.jpg"
                            alt="image">
                    </div>
                    <div class="colored-shadow"
                        style="background-image: url(&quot;https://djuragan.sgp1.digitaloceanspaces.com/djurkam/local/images/lodgings/5ec4bb37c2f69.jpg&quot;);">
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <!-- First image on the right side, above the article -->
                <div class="position-relative ms-n4 mb-5 mt-8 d-md-block d-none">
                    <div class="blur-shadow-image">
                        <img class="image-right rounded-3 img-fluid position-relative bg-cover"
                            src="https://www.kostjakarta.net/uploads/2021/09/789928-380x260.jpeg"
                            alt="image">
                    </div>
                    <div class="colored-shadow"
                        style="background-image: url(&quot;https://www.kostjakarta.net/uploads/2021/09/789928-380x260.jpeg&quot;);">
                    </div>
                </div>
                <div style="min-height: 500px;">
                <p>Detail Kos {!! $room->description !!}
                </p>
                <a href={{ route('bookingForm', $room->id) }} class="btn btn-outline-warning">Pesan Kamar Ini</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
