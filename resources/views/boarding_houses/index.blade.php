@extends('layouts.master')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm text-dark"><a class="opacity-5 text-dark" href="javascript:;">Dashboard</a>
        </li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Informasi Rumah Kos</li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Informasi Rumah Kos</h6>
</nav>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 mt-lg-0 mt-4">
        <!-- Card Profile -->
        <div class="card card-body" id="profile">
            <div class="row justify-content-left align-items-center">
                <div class="col-sm-auto col-4">
                    <div class="avatar avatar-xl position-relative">
                        <img src="{{ asset('assets/img/logo-ct.png') }}" alt="main_logo"
                            class="w-100 border-radius-lg shadow-sm">
                    </div>
                </div>
                <div class="col-sm-auto col-8 my-auto">
                    <div class="h-100">
                        <h5 class="mb-1 font-weight-bolder">
                            Bougenville Kost
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            Jl. Simpang Remujung No. 5
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <form action="{{ route('boardingHouses.store') }}" method="POST" id="form">
            @csrf
            <!-- Card Informasi Rumah Kos -->
            <div class="card mt-4" id="basic-info">
                <div class="card-header">
                    <h5>Informasi Rumah Kos</h5>
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-6">
                            <label class="form-label">Nama Rumah Kos <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input id="name" name="name" class="form-control" type="text" placeholder="Boarding house name"
                                    required="required" value="{{ old('name') }}">
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Pemilik Rumah Kos <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input id="owner" name="owner" class="form-control" type="text"
                                    placeholder="Owner" required="required" value="{{ old('owner') }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label mt-4">Deskripsi</label>
                            <div class="input-group">
                                <textarea id="description" name="description" class="form-control" cols="30" rows="5">{{ old('description') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label class="form-label mt-4">Provinsi <span class="text-danger">*</span></label>
                            <select id="province" name="province_id" class="form-control" required>
                                <option hidden selected disabled>Select province...</option>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label mt-4">Kota/Kabupaten <span class="text-danger">*</span></label>
                            <select id="regency" name="regency_id" class="form-control" required>
                                <option hidden selected disabled>Select regency...</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <label class="form-label mt-4">Kecamatan <span class="text-danger">*</span></label>
                            <select id="district" name="district_id" class="form-control" required>
                                <option hidden selected disabled>Select district...</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <label class="form-label mt-4">Kelurahan/Desa <span class="text-danger">*</span></label>
                            <select id="village" name="village_id" class="form-control" required>
                                <option hidden selected disabled>Select village...</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <label class="form-label mt-4">Kode Pos</label>
                            <div class="input-group">
                                <input id="postal_code" name="postal_code" class="form-control" type="text"
                                    placeholder="Postal code" value="{{ old('postal_code') }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label mt-4">Alamat <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <textarea id="address" name="address" class="form-control" cols="30" rows="5" required>{{ old('address') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label class="form-label mt-4">Nomor Telepon</label>
                            <div class="input-group">
                                <input id="phone_number" name="phone_number" class="form-control" type="text"
                                    placeholder="0341 7356 314" value="{{ old('phone_number') }}">
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="form-label mt-4">Nomor WhatsApp</label>
                            <div class="input-group">
                                <input id="whatsapp_number" name="whatsapp_number" class="form-control" type="text"
                                    placeholder="085 735 631 620" value="{{ old('whatsapp_number') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Card Aturan Rumah Kos -->
            <div class="card mt-4">
                <div class="card-header">
                    <h5>Aturan Rumah Kos</h5>
                </div>
                <div class="card-body pt-0">
                    <div id="editor">
                        <p>Tambahkan aturan rumah kos di bagian sini.</p>
                        <p>Anda dapat menggunakan fitur-fitur yang terdapat di bagian toolbar atas, seperti</p>
                        <ul>
                            <li>List</li>
                            <li><b>Bold</b></li>
                            <li><i>Italic</i></li>
                            <li><u>Underline</u></li>
                        </ul>
                    </div>
                    <textarea name="rule" style="display:none" id="rule"></textarea>
                </div>
            </div>
            <!-- Card Update Informasi Rumah Kos -->
            <div class="card mt-4">
                <div class="card-body">
                    <button type="submit" class="btn bg-gradient-primary m-0 ms-2">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('style')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endpush

@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script src="{{ asset('assets/js/plugins/choices.min.js') }}"></script>
    <script>
        var quill = new Quill('#editor', {
            theme: 'snow',
        });

        var province = document.getElementById('province');
        var regency = document.getElementById('regency');
        var district = document.getElementById('district');
        var village = document.getElementById('village');
        const provinces = new Choices(province, {
            searchEnabled: true,
            searchPlaceholderValue: "Cari provinsi...",
            shouldSort: false,
        });
        const regencies = new Choices(regency, {
            searchEnabled: true,
            searchPlaceholderValue: "Cari kota/kabupaten...",
            shouldSort: false,
        });
        const districts = new Choices(district, {
            searchEnabled: true,
            searchPlaceholderValue: "Cari kecamatan...",
            shouldSort: false,
        });
        const villages = new Choices(village, {
            searchEnabled: true,
            searchPlaceholderValue: "Cari kelurahan/desa...",
            shouldSort: false,
        });

        $('#province').on('change', function() {
            var provinceID = $(this).val();
            if (provinceID) {
                $.ajax({
                    type:'GET',
                    url:'regencies/' + provinceID,
                    dataType : "json",
                    success:function(data) {
                        // Remove Selected Items
                        regencies.removeActiveItems();
                        districts.removeActiveItems();
                        villages.removeActiveItems();
                        // Change Selected Items
                        regencies.setChoices([{value: "", label: "Select regency...", selected: true}], 'value', 'label', false);
                        districts.setChoices([{value: "", label: "Select district...", selected: true}], 'value', 'label', false);
                        villages.setChoices([{value: "", label: "Select village...", selected: true}], 'value', 'label', false);
                        // Remove All Option
                        regencies.clearChoices();
                        districts.clearChoices();
                        villages.clearChoices();
                        jQuery.each(data, function(key,value) {
                            regencies.setChoices(
                                [
                                    { value: key, label: value},
                                ],
                                'value',
                                'label',
                                false,
                            );
                        });
                    }
                }); 
            }
        });

        $('#regency').on('change', function() {
            var regencyID = $(this).val();
            if (regencyID) {
                $.ajax({
                    type:'GET',
                    url:'districts/' + regencyID,
                    dataType : "json",
                    success:function(data) {
                        // Remove Selected Item
                        districts.removeActiveItems();
                        villages.removeActiveItems();
                        // Change Selected Items
                        districts.setChoices([{value: "", label: "Select district...", selected: true}], 'value', 'label', false);
                        villages.setChoices([{value: "", label: "Select village...", selected: true}], 'value', 'label', false);
                        // Remove All Option
                        districts.clearChoices();
                        villages.clearChoices();
                        jQuery.each(data, function(key,value) {
                            districts.setChoices(
                                [
                                    { value: key, label: value},
                                ],
                                'value',
                                'label',
                                false,
                            );
                        });
                    }
                }); 
            }
        });

        $('#district').on('change', function() {
            var districtID = $(this).val();
            if (districtID) {
                $.ajax({
                    type:'GET',
                    url:'villages/' + districtID,
                    dataType : "json",
                    success:function(data) {
                        // Remove Selected Item
                        villages.removeActiveItems();
                        // Change Selected Items
                        villages.setChoices([{value: "", label: "Select village...", selected: true}], 'value', 'label', false);
                        // Remove All Option
                        villages.clearChoices();
                        jQuery.each(data, function(key,value) {
                            villages.setChoices(
                                [
                                    { value: key, label: value},
                                ],
                                'value',
                                'label',
                                false,
                            );
                        });
                    }
                }); 
            }
        });

        $("#form").on("submit",function(){
            $("#rule").val(quill.container.firstChild.innerHTML);
        })

    </script>
@endpush
