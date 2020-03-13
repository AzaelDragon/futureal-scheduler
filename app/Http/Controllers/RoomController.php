<?php

namespace App\Http\Controllers;

use App\Building;
use App\Room;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Integer;

class RoomController extends Controller {

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

        $rooms = Room::where('user', Auth::user() -> id) -> orderBy('name', 'asc') -> get();
        $buildings = Building::where('user', Auth::user() -> id) -> orderBy('id', 'asc') -> get();
        return response(view('rooms') -> with(['rooms' => $rooms, 'buildings' => $buildings]), 200);

    }

    /**
     * Find the amount of registries associated to the authenticated user.
     *
     * @return int
     */
    public static function findAmount() {

        $rooms = Room::where('user', Auth::user() -> id) -> orderBy('name', 'desc') -> get();
        return count($rooms);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $rules = array(
            'name' => 'required',
            'building' => 'required'
        );

        $validator = Validator::make($request -> all(), $rules);

        if ($validator -> fails()) {
            return response('ERROR', 400);
        }

        $room = new Room();
        $room -> name = $request -> input('name');
        $room -> building = $request -> input('building');
        $room -> user = Auth::user() -> id;
        $room -> save();

        return response('OK', 200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        $rules = array(
            'name' => 'required',
            'building' => 'required'
        );

        $validator = Validator::make($request -> all(), $rules);

        if ($validator -> fails()) {
            return response('ERROR', 400);
        }

        $room = Room::find($id);
        $room -> name = $request -> input('name');
        $room -> building = $request -> input('building');
        $room -> save();

        return response('OK', 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Integer $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) {

        Room::destroy($id);
        return response('OK', 200);

    }

}
