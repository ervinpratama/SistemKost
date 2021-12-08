<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = Booking::orderByDesc('created_at')->get();
        $message = "Proses booking kamar Anda sudah di acc, berikut email dan password Anda agar bisa login ke dalam sistem kami, %0a";
        return view('bookings.index', compact('bookings', 'message'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_number' => 'required|max:20',
            'name' => 'required|max:255',
            'whatsapp_number' => 'max:15',
            'address' => 'required',
            'id_card_file' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::toast($validator->messages()->all()[0], 'error');
            return redirect()->back()->withInput();
        }

        Room::updateStatusBooked($request->room_id);
        $room_name = Room::getName($request->room_id);
        $email = User::createEmail($room_name);
        $password = User::createPassword();
        $user_id = User::storeCustomer($request, $email, $password);
        $customer_id = Customer::store($request, $user_id);
        Booking::store($request, $customer_id, $password);
        Alert::success(
            'Anda berhasil memesan kamar.', 
            'Silahkan menunggu konfirmasi dari Admin yang akan dikirimkan melalui WhatsApp.')
            ->toHtml()->persistent('Dismiss');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    public function updateStatus(Booking $booking, $status)
    {
        Booking::updateStatus($booking, $status);

        if ($status == 'accept'){
            $phone_number = ltrim($booking->customer->whatsapp_number, '0');
            $url = "https://wa.me/62". $phone_number ."?text=Proses booking kamar Anda sudah di acc, berikut email dan password Anda agar bisa login ke dalam sistem kami, %0a%0aEmail: " . $booking->customer->user->email . "%0aPassword: " . $booking->temporary_password . "%0a%0aTerima kasih sudah menggunakan layanan kami, dan ditunggu kedatangan Anda di kos.";
            session()->flash('url', $url);
        }
        
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
