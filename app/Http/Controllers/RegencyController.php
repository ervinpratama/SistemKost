<?php

namespace App\Http\Controllers;

use App\Models\Regency;
use Illuminate\Http\Request;

class RegencyController extends Controller
{
    public function index($id) 
    {
        $regencies = Regency::where('province_id', $id)->pluck('name', 'id');
        return json_encode($regencies);
    }
}
