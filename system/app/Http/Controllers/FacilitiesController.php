<?php

namespace App\Http\Controllers;

use App\Models\Facilities;
use Illuminate\Http\Request;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;

class FacilitiesController extends Controller
{
    public function insertfacilities(Request $request)
    {

        $facilities = new Facilities();
        $facilities->name = $request->name;
        $facilities->abbreviation = $request->abbreviation;
        $facilities->description = $request->description;
        $facilities->location_desc = $request->location_desc;
        $facilities->number_of_beds = $request->number_of_beds;
        $facilities->number_of_cots = $request->number_of_cots;
        $facilities->open_whole_day = $request->open_whole_day;
        $facilities->open_whole_week = $request->open_whole_week;
        $facilities->facility_type = $request->facility_type;
        $facilities->operation_status = $request->operation_status;
        $facilities->ward = $request->ward;
        $facilities->owner = $request->owner;
        $facilities->officer_in_charge = $request->officer_in_charge;
        $facilities->physical_address = $request->physical_address;
        $facilities->parent = $request->parent;
        $facilities->save();
        // return response()->json($facilities);

        return redirect()->back()->with('success', 'saved succesfully');
    }

    public function getfacilities()
    {
        return Facilities::all();
    }

    public function facilitiestable(){
        $data = Facilities::all();
        return view('facilitieslist',['facilities'=>$data]);
    }
}
