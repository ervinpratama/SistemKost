<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function index($id) 
    {
        $districts = District::where('regency_id', $id)->pluck('name', 'id');
        return json_encode($districts);
    }
}
