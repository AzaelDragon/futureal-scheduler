<?php

namespace App\Http\Controllers;

use App\Block;
use App\Building;
use App\Room;
use App\Schedule;
use App\Subject;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class ScheduleController extends Controller {

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
        $schedules = Schedule::where('user', Auth::user() -> id) -> orderBy('date', 'asc') -> get();
        $subjects = Subject::where('user', Auth::user() -> id) -> orderBy('name', 'asc') -> get();
        $rooms = Room::where('user', Auth::user() -> id) -> orderBy('name', 'asc') -> get();
        $blocks = Block::all();
        return response(view('schedules') -> with(['schedules' => $schedules, 'buildings' => $buildings, 'subjects' => $subjects, 'rooms' => $rooms, 'blocks' => $blocks]), 200);

    }

    /**
     * Get a data JSON for fullCalendar.
     *
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function calendar(Request $request) {

        $rawData = Schedule::where('user', Auth::user() -> id) -> get();
        $data = array();

        foreach ($rawData as $entry) {

            $dates = $this -> parse_dates($entry -> date, $entry -> block);

            $obj = [
                'id' => $entry -> id,
                'title' => Subject::find($entry -> subject) -> name,
                'start' => $dates[0],
                'end' => $dates[1],
                'block' => $entry -> block,
                'subject' => $entry -> subject,
                'room' => $entry -> room,
                'className' => 'event-rose'
            ];

            array_push($data, $obj);

        }

        return Response::json($data);
    }

    private function parse_block_time($id) {
        switch ($id) {
            case 1:
                return ['07:00:00', '09:00:00'];
            break;
            case 2:
                return ['9:00:00', '11:00:00'];
            break;
            case 3:
                return ['11:00:00', '13:00:00'];
            break;
            case 4:
                return ['14:00:00', '16:00:00'];
            break;
            case 5:
                return ['16:00:00', '18:00:00'];
            break;
            default:
                return ['00:00:00', '02:00:00'];
            break;
        }
    }

    private function parse_dates ($date, $id) {

        $duration = $this -> parse_block_time($id);

        return [
             str_replace('+00:00', 'Z', Carbon::parse($date . ' ' . $duration[0]) -> toIso8601String()),
             str_replace('+00:00', 'Z', Carbon::parse($date . ' ' . $duration[0]) -> toIso8601String())
        ];

    }

    private function americanize_date($date) {

        return str_replace('/', '-', $date);

    }

    /**
     * Find the amount of registries associated to the authenticated user.
     *
     * @return int
     */
    public static function find_amount() {

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
            'date' => 'required',
            'block' => 'required',
            'subject' => 'required',
            'room' => 'required'
        );

        $validator = Validator::make($request -> all(), $rules);

        if ($validator -> fails()) {
            return response('ERROR', 400);
        }

        $inputDate = $this -> americanize_date($request -> input('date'));
        $inputBlock = $request -> input('block');

        $queriedData = Schedule::where('date', $inputDate) -> get();
        $overschedulingFlag = false;

        foreach ($queriedData as $testEntry) {
            if ($testEntry -> block == $inputBlock) {
                $overschedulingFlag = true;
            }
        }

        if ($overschedulingFlag) {
            return response('OVERSCHEDULED', 400);
        }

        $schedule = new Schedule();
        $schedule -> date = $this -> americanize_date($request -> input('date'));
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

        $inputDate = $this -> americanize_date($request -> input('date'));
        $inputBlock = $request -> input('block');

        $queriedData = Schedule::where('date', $inputDate) -> get();
        $overschedulingFlag = false;

        foreach ($queriedData as $testEntry) {
            if ($testEntry -> block == $inputBlock) {
                $overschedulingFlag = true;
            }
        }

        if ($overschedulingFlag) {
            return response('OVERSCHEDULED', 400);
        }

        $schedule = Schedule::find($id);
        $schedule -> date = $this -> americanize_date($request -> input('date'));
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
