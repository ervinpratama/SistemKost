<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Booking;
use App\Models\File;
use App\Models\BoardingHouse;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Alert;

class WebsiteController extends Controller
{
    public function landingPage()
    {
        $boardinghouses = BoardingHouse::all();
        return view('website.landing_page', compact('boardinghouses'));
    }

    public function bookingPage()
    {
        $rooms = Room::with('files')->where('status', 'available')->get();
        return view('website.booking_page', compact('rooms'));
    }

    public function detailPage($id)
    {
        $room = Room::findOrFail($id);
        $images = File::getImageByRoom($room->id);
        return view('website.room_detail', compact('room', 'images'));
    }

    public function bookingForm($id)
    {
        $room = Room::findOrFail($id);
        $boardingHouse = BoardingHouse::first();
        return view('website.booking_form', compact('room', 'boardingHouse'));
    }

    public function contactUs()
    {

    }
}
