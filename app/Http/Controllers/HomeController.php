<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use App\Agenda;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allAgenda = Agenda::all();
        $allRoom = Room::all();
        return view('home', compact('allAgenda', 'allRoom'));
    }

    public function getRoom()
    {
        $allRoom = Room::all();
        return view('room', compact('allRoom'));
    }

    public function getAgenda()
    {
        $allRoom = Room::all();
        $allAgenda = Agenda::all();
        return view('agenda', compact('allRoom', 'allAgenda'));
    }

    public function addRoom(Request $request)
    {
        $room = new Room;
        $room->name = $request->roomname;
        if($request->has('listrik')){
            $room->listrik = '1';
        }
        if($request->has('ac')){
            $room->ac = '1';
        }
        if($request->has('proyektor')){
            $room->proyektor = '1';
        }
        $room->key = str_random(10);
        $room->save();
        return redirect()->back();

    }
}
