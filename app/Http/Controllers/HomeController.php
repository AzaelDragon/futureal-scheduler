<?php

namespace App\Http\Controllers;

use App\Block;
use App\Building;
use App\Room;
use App\Schedule;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {

        $this -> middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {

        $buildings = Building::where('user', Auth::user() -> id) -> orderBy('name', 'asc') -> get();
        $schedules = Schedule::where('user', Auth::user() -> id) -> orderBy('date', 'asc') -> get();
        $subjects = Subject::where('user', Auth::user() -> id) -> orderBy('name', 'asc') -> get();
        $rooms = Room::where('user', Auth::user() -> id) -> orderBy('name', 'asc') -> get();
        $blocks = Block::all();
        return response(view('home') -> with(['schedules' => $schedules, 'buildings' => $buildings, 'subjects' => $subjects, 'rooms' => $rooms, 'blocks' => $blocks]), 200);


    }

}
