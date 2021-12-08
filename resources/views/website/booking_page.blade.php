@extends('layouts.website')

@section('content')
<!-- -------- START HEADER 4 w/ search book a ticket form ------- -->
<header>
    <div class="page-header min-vh-50"
        style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-design-system/assets/img/airport.jpg')">
        <span class="mask bg-gradient-warning"></span>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-white text-center">
                    <h2 class="text-white">Pilih Kamar Sesuai Kebutuhanmu</h2>
                    <p class="lead">An arrangement you make to have a hotel room, tickets, etc. at a particular time
                        in the future</p>
                </div>
            </div>
        </div>
    </div>
    <div class="position-relative overflow-hidden" style="height:36px;margin-top:-33px;">
        <div class="w-full absolute bottom-0 start-0 end-0"
            style="transform: scale(2);transform-origin: top center;color: #fff;">
            <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="currentColor"></path>
            </svg>
        </div>
    </div>
    {{-- <div class="container">
        <div class="row bg-white shadow-lg mt-n6 border-radius-md pb-4 p-3 mx-sm-0 mx-1 position-relative">
            <div class="col-lg-3 mt-lg-n2 mt-2">
                <label class="">Leave From</label>
                <select class="form-control" name="choices-button" id="choices-button">
                    <option value="Choice 1" selected="">Brazil</option>
                    <option value="Choice 2">Bucharest</option>
                    <option value="Choice 3">London</option>
                    <option value="Choice 4">USA</option>
                </select>
            </div>
            <div class="col-lg-3 mt-lg-n2 mt-2">
                <label class="">To</label>
                <select class="form-control" name="choices-remove-button" id="choices-remove-button">
                    <option value="Choice 1" selected="">Italy</option>
                    <option value="Choice 2">Spain</option>
                    <option value="Choice 3">Denmark</option>
                    <option value="Choice 4">Poland</option>
                </select>
            </div>
            <div class="col-lg-3 mt-lg-n2 mt-2">
                <label class="">Depart</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                    <input class="form-control datepicker" placeholder="Please select date" type="text">
                </div>
            </div>
            <div class="col-lg-3 mt-lg-n2 mt-2">
                <label class="">&nbsp;</label>
                <button type="button" class="btn bg-gradient-dark w-100 mb-0">Search</button>
            </div>
        </div>
    </div> --}}
</header>
<!-- -------- END HEADER 4 w/ search book a ticket form ------- -->
<section class="pt-7 pb-0">
    <div class="container">
        <div class="row">
        @foreach ($rooms as $room)
            <div class="col-lg-4 col-md-6" >
                <div class="card card-blog card-plain" >
                    <div class="position-relative">
                        <a href="{{ route('detailPage', $room->id) }}" class="d-block blur-shadow-image">
                            <img src="{{ url('storage/uploads/'.$room->files->name) }}"
                                alt="img-blur-shadow" class="img-fluid shadow border-radius-lg" style="height: 250px !important; width: 100% !important">
                        </a>
                    </div>
                    <div class="card-body px-1 pt-3">
                        <p class="text-gradient text-dark mb-2 text-sm">{{ $room->roomType->name }}</p>
                        <a href="{{ route('detailPage', $room->id) }}">
                            <h5>
                            {{ $room->name }}
                            </h5>
                        </a>
                            {!! $room->description !!}
                        <a href="{{ route('bookingForm', $room->id) }}" class="btn btn-outline-warning btn-sm">Booking</a>
                    </div>
                </div>
            </div>
            @endforeach
            </div>
            <div class="col-sm-7 ms-auto text-end">
                <ul class="pagination pagination-warning mt-4">
                    <li class="page-item ms-auto">
                        <a class="page-link" href="javascript:;" aria-label="Previous">
                            <span aria-hidden="true"><i class="fa fa-angle-double-left" aria-hidden="true"></i></span>
                        </a>
                    </li>
                    <li class="page-item active">
                        <a class="page-link" href="javascript:;">1</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="javascript:;">2</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="javascript:;">3</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="javascript:;">4</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="javascript:;">5</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="javascript:;" aria-label="Next">
                            <span aria-hidden="true"><i class="fa fa-angle-double-right" aria-hidden="true"></i></span>
                        </a>
                    </li>
                </ul>
            </div>
        
    </div>
</section>
@endsection
