<?php

namespace App\Http\Controllers;

use App\Models\BoardingHouse;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Alert;

class BoardingHouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (BoardingHouse::countData() == 0) {
            $provinces = Province::all();
            return view('boarding_houses.index', compact('provinces'));
        } else {
            $boardingHouse = BoardingHouse::getData();
            // Get data location
            $village = Village::where('id', $boardingHouse->village_id)->first();
            $district = District::where('id', $village->district_id)->first();
            $regency = Regency::where('id', $district->regency_id)->first();
            $province = Province::where('id', $regency->province_id)->first();
            // Get data for option
            $villages = Village::where('district_id', $district->id)->get();
            $districts = District::where('regency_id', $regency->id)->get();
            $regencies = Regency::where('province_id', $province->id)->get();
            $provinces = Province::all();
            return view('boarding_houses.edit', compact('boardingHouse', 'villages', 'districts', 'regencies', 'provinces'));
        }
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
            'name' => 'required|max:255',
            'owner' => 'required|max:255',
            'village_id' => 'required|max:10',
            'postal_code' => 'required|regex:/^[0-9]+$/',
            'address' => 'required',
            'phone_number' => 'max:15|regex:/^[0-9]+$/',
            'whatsapp_number' => 'max:15|regex:/^[0-9]+$/',
        ]);

        if ($validator->fails()) {
            Alert::toast($validator->messages()->all()[0], 'error');
            return redirect()->back()->withInput();
        }

        BoardingHouse::store($request);
        Alert::toast('Informasi rumah kos berhasil disimpan.', 'success');
        return redirect()->route('boardingHouses.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BoardingHouse  $boardingHouse
     * @return \Illuminate\Http\Response
     */
    public function show(BoardingHouse $boardingHouse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BoardingHouse  $boardingHouse
     * @return \Illuminate\Http\Response
     */
    public function edit(BoardingHouse $boardingHouse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BoardingHouse  $boardingHouse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BoardingHouse $boardingHouse)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'owner' => 'required|max:255',
            'village_id' => 'required|max:10',
            'postal_code' => 'required|regex:/^[0-9]+$/',
            'address' => 'required',
            'phone_number' => 'max:15|regex:/^[0-9]+$/',
            'whatsapp_number' => 'max:15|regex:/^[0-9]+$/',
        ]);

        if ($validator->fails()) {
            Alert::toast($validator->messages()->all()[0], 'error');
            return redirect()->back()->withInput();
        }

        BoardingHouse::edit($request, $boardingHouse);
        Alert::toast('Informasi rumah kos berhasil disimpan.', 'success');
        return redirect()->route('boardingHouses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BoardingHouse  $boardingHouse
     * @return \Illuminate\Http\Response
     */
    public function destroy(BoardingHouse $boardingHouse)
    {
        //
    }
}
