@extends('layouts.website')

@section('content')
<section class="container mt-5">
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="mb-4 w-25">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('bookingPage') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Form Pemesanan Kamar</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<section class="py-lg-7">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card overflow-hidden mb-5">
                    <form class="p-3" id="form" action="{{ route('bookings.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="card-header px-4 py-sm-5 py-3">
                                    <h2>Hai Bougenvillian!</h2>
                                    <p class="lead">Isi form berikut untuk menyelesaikan proses pemesanan.</p>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 pe-2 mb-3">
                                            <label for="id_number">No. KTP</label>
                                            <input class="form-control" placeholder="ID Card Number" type="text"
                                                name="id_number">
                                        </div>
                                        <div class="col-md-12 pe-2 mb-3">
                                            <label>Nama Lengkap</label>
                                            <input class="form-control" placeholder="Full Name" type="text" name="name">
                                        </div>
                                        <div class="col-md-12 pe-2 mb-3">
                                            <label>No. WhatsApp</label>
                                            <input class="form-control" placeholder="WhatsApp Number" type="text"
                                                name="whatsapp_number">
                                        </div>
                                        <div class="col-md-12 pe-2 mb-3">
                                            <label>Tanggal Check In</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                                <input class="form-control datepicker" placeholder="Please select date" type="text" name="check_in_date">
                                            </div>
                                        </div>
                                        <div class="col-md-12 pe-2 mb-3">
                                            <div class="form-group mb-0">
                                                <label>Alamat</label>
                                                <textarea name="address" class="form-control" id="message" rows="6"
                                                    placeholder="Address"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12 pe-2 mb-3">
                                            <div class="form-group mb-0">
                                                <label for="images" class="form-label">File KTP</label>
                                                <input type="file" class="form-control" name="id_card_file">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 text-end ms-auto">
                                            <button type="submit"
                                                class="btn btn-round bg-gradient-warning mb-0">Booking</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-5 position-relative bg-cover px-0 mt-4"
                                style="background-image: url('{{ asset('design-system/img/curved-images/curved5.jpg') }}')">
                                <div class="position-absolute z-index-2 w-100 h-100 top-0 start-0 d-lg-block d-none">
                                    <img src="{{ asset('design-system/img/wave-1.svg') }}"
                                        class="h-100 ms-n2" alt="vertical-wave">
                                </div>
                                <div
                                    class="z-index-2 text-center d-flex h-100 w-100 d-flex m-auto justify-content-center">
                                    @csrf
                                    <div class="mask bg-gradient-warning opacity-9"></div>
                                    <div class="p-5 ps-sm-8 position-relative text-start my-auto z-index-2">
                                        <input type="hidden" name="room_id" value="{{ $room->id }}">
                                        <h3 class="text-white">{{ $room->name }}</h3>
                                        <p class="text-white opacity-8 mb-4">{{ $room->roomType->name }} •
                                            {{ '(' . $room->roomType->currency . ') ' . number_format($room->roomType->price,0,',','.') }}
                                        </p>
                                        <div class="d-flex p-2 text-white">
                                            <div>
                                                <i class="fas fa-phone text-sm" aria-hidden="true"></i>
                                            </div>
                                            <div class="ps-3">
                                                <span class="text-sm opacity-8">{{ $boardingHouse->phone_number }}</span>
                                            </div>
                                        </div>
                                        <div class="d-flex p-2 text-white">
                                            <div>
                                                <i class="fas fa-envelope text-sm" aria-hidden="true"></i>
                                            </div>
                                            <div class="ps-3">
                                                <span class="text-sm opacity-8">hello@creative-tim.com</span>
                                            </div>
                                        </div>
                                        <div class="d-flex p-2 text-white">
                                            <div>
                                                <i class="fas fa-map-marker-alt text-sm" aria-hidden="true"></i>
                                            </div>
                                            <div class="ps-3">
                                                <span class="text-sm opacity-8">{{ $boardingHouse->address }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
