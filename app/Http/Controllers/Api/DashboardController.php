<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dashboard;
use App\Models\Customer;
use App\Models\BoardingHouse;
use Illuminate\Http\Request;
use Auth;


class DashboardController extends Controller
{
    public function indexBoardingHouse() 
    {
        return BoardingHouse::all();
    }

    public function indexDataCustomer() 
    {
        //return Customer::where('user_id', Auth::id())->get();
        return Customer::where('user_id','=',Auth::id())->get();
        //return Customer::where('user_id', 8)->get();
    }


}
