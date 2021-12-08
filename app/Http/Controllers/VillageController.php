<?php

namespace App\Http\Controllers;

use App\Models\Village;
use Illuminate\Http\Request;

class VillageController extends Controller
{
    public function index($id) 
    {
        $villages = Village::where('district_id', $id)->pluck('name', 'id');
        return json_encode($villages);
    }
}
