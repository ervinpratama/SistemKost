@extends('layouts.master')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm text-dark"><a class="opacity-5 text-dark" href="javascript:;">Dashboard</a>
        </li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Pemesanan Kamar</li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Pemesanan Kamar</h6>
</nav>
@endsection

@section('content')
@if (session()->has('url'))
<script>
    window.open('{{ session()->get('url') }}', "_blank");
</script>
@endif
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table table-flush" id="datatable-search">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Nama</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Kamar</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Tanggal Pesan</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center"
                                    style="width: 220px">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $booking)
                                <tr>
                                    <td class="text-sm font-weight-normal">{{ $booking->customer->user->name }}</td>
                                    <td class="text-sm font-weight-normal">{{ $booking->customer->room->name }}</td>
                                    <td class="text-sm font-weight-normal">{{ $booking->created_at->format('d M Y') }}</td>
                                    <td class="text-sm font-weight-normal">
                                        @if ($booking->status == 'pending')
                                            <span class="badge badge-warning text-dark">Pending</span>
                                        @elseif ($booking->status == 'accept')
                                            <span class="badge badge-success text-dark">Accept</span>
                                        @else
                                            <span class="badge badge-danger text-dark">Reject</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="#" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Detail booking" data-bs-toggle="modal" data-bs-target="#detail{{ $booking->id }}">
                                            <i class="fa fa-clipboard"></i>&nbsp; Detail &nbsp;
                                        </a>
                                        @if ($booking->status == 'pending')
                                            <a href="{{ route('bookings.updateStatus', [$booking->id, 'accept']) }}" 
                                                class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" 
                                                data-original-title="Accept booking">
                                                <i class="fa fa-check"></i>&nbsp; Accept &nbsp;
                                            </a>
                                            <a href="{{ route('bookings.updateStatus', [$booking->id, 'reject']) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Reject booking"> 
                                                <i class="fa fa-close"></i> Reject &nbsp;
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <div class="modal fade" id="detail{{ $booking->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                                    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title" id="modal-title-default">Detail Booking</h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <dl class="row">
                                                    <dt class="col-sm-4">Nama Lengkap</dt>
                                                    <dd class="col-sm-8">{{ $booking->customer->user->name }}</dd>
                                                  
                                                    <dt class="col-sm-4">No. KTP</dt>
                                                    <dd class="col-sm-8">{{ $booking->customer->id_number }}</dd>
                                                  
                                                    <dt class="col-sm-4">Jenis Kelamin</dt>
                                                    <dd class="col-sm-8">{{ $booking->customer->gender == 'L' ? 'Laki-Laki' : 'Perempuan' }}</dd>
                                                  
                                                    <dt class="col-sm-4">Kamar</dt>
                                                    <dd class="col-sm-8">{{ $booking->customer->room->name }}</dd>
                                                  
                                                    <dt class="col-sm-4">Kontak</dt>
                                                    <dd class="col-sm-8">
                                                        @if ($booking->customer->phone_number == $booking->customer->whatsapp_number || $booking->customer->phone_number == null)
                                                            <a href="https://wa.me/62{{ ltrim($booking->customer->whatsapp_number, '0') }}" target="_blank">{{ $booking->customer->whatsapp_number . ' (WhatsApp)' }}</a>
                                                        @else
                                                            {{ $booking->customer->phone_number }} / <br> <a href="https://wa.me/62{{ ltrim($booking->customer->whatsapp_number, '0') }}" target="_blank">{{ $booking->customer->whatsapp_number  . ' (WhatsApp)' }}</a>
                                                        @endif
                                                    </dd>

                                                    <dt class="col-sm-4">Alamat</dt>
                                                    <dd class="col-sm-8">{{ $booking->customer->address }}</dd>

                                                    <dt class="col-sm-4">Email Kamar</dt>
                                                    <dd class="col-sm-8">{{ $booking->customer->user->email }}</dd>
                                                </dl>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-link  ml-auto" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
    <script src="{{ asset('assets/js/plugins/datatables.js') }}"></script>
    <script>
        const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
            searchable: true,
            fixedHeight: true
        });
    </script>
@endpush
