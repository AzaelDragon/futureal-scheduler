<?php

namespace App\Http\Controllers;

use App\Block;
use App\Building;
use App\Room;
use App\Schedule;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ScheduleController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $buildings = Building::where('user', Auth::user() -> id) -> orderBy('name', 'asc') -> get();
        $schedules = Schedule::where('user', Auth::user() -> id) -> orderBy('date', 'asc') -> get();
        $subjects = Subject::where('user', Auth::user() -> id) -> orderBy('name', 'asc') -> get();
        $rooms = Room::where('user', Auth::user() -> id) -> orderBy('name', 'asc') -> get();
        $blocks = Block::all();
        return response(view('schedules') -> with(['schedules' => $schedules, 'buildings' => $buildings, 'subjects' => $subjects, 'rooms' => $rooms, 'blocks' => $blocks]), 200);

    }

    /**
     * Find the amount of registries associated to the authenticated user.
     *
     * @return int
     */
    public static function findAmount() {

        $schedules = Schedule::where('user', Auth::user() -> id) -> orderBy('name', 'desc') -> get();
        return count($schedules);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $rules = array(
            'date' => 'required|date',
            'block' => 'required',
            'subject' => 'required',
            'room' => 'required'
        );

        $validator = Validator::make($request -> all(), $rules);

        if ($validator -> fails()) {
            return response('ERROR', 400);
        }

        $schedule = new Schedule();
        $schedule -> date = $request -> input('date');
        $schedule -> block = $request -> input('block');
        $schedule -> subject = $request -> input('subject');
        $schedule -> room = $request -> input('room');
        $schedule -> user = Auth::user() -> id;
        $schedule -> save();

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
            'date' => 'required|date',
            'block' => 'required',
            'subject' => 'required',
            'room' => 'required',
        );

        $validator = Validator::make($request -> all(), $rules);

        if ($validator -> fails()) {
            return response('ERROR', 400);
        }

        $schedule = Schedule::find($id);
        $schedule -> date = $request -> input('date');
        $schedule -> block = $request -> input('block');
        $schedule -> subject = $request -> input('subject');
        $schedule -> room = $request -> input('room');
        $schedule -> user = Auth::user() -> id;
        $schedule -> save();

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

        Schedule::destroy($id);
        return response('OK', 200);

    }

}
