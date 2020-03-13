<?php

namespace App\Http\Controllers;

use App\Building;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BuildingController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {

        $this -> middleware('auth');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $buildings = Building::where('user', Auth::user() -> id) -> orderBy('name', 'asc') -> get();
        return response(view('buildings') -> with('buildings', $buildings), 200);

    }

    /**
     * Find the amount of registries associated to the authenticated user.
     *
     * @return int
     */
    public static function findAmount() {

        $buildings = Building::where('user', Auth::user() -> id) -> orderBy('name', 'asc') -> get();
        return count($buildings);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $rules = array(
            'name' => 'required'
        );

        $validator = Validator::make($request -> all(), $rules);

        if ($validator -> fails()) {
            return response('Error on resource creation', 400);
        }

        $building = new Building();
        $building -> name = $request -> input('name');
        $building -> user = Auth::user() -> id;
        $building -> save();

        return response('Resource created', 200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        $rules = array(
            'name' => 'required|unique:buildings',
        );

        $validator = Validator::make($request -> all(), $rules);

        if ($validator -> fails()) {
            return response('ERROR', 400);
        }

        $room = Building::find($id);
        $room -> name = $request -> input('name');
        $room -> save();

        return response('Resource updated', 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        Building::destroy($id);
        return response('Resource destroyed', 200);

    }

}
