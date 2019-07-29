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

    public function addAgenda(Request $request)
    {
        $agenda = new Agenda;
        $agenda->name = $request->agendaname;
        $agenda->pic = $request->pic;
        $agenda->contact = $request->contact;
        $agenda->room_id = $request->selroom;
        $agenda->datetime_start = $request->datetime_start;
        $agenda->datetime_end = $request->datetime_end;
        if($request->has('listrik')){
            if($request->listrik == "on"){
                $agenda->listrik = "1";
            }
        }

        if($request->has('ac')){
            if($request->ac == "on"){
                $agenda->ac = "1";
            }
        }

        if($request->has('proyektor')){
            if($request->proyektor == "on"){
                $agenda->proyektor = "1";
            }
        }
        $agenda->token = rand(100000, 999999);
        $agenda->save();
        return redirect()->route('get.agenda');
    }

    public function deleteRoom(Request $request)
    {
        $room = Room::where('id', $request->id)->delete();
        return "Oke";
    }

    public function deleteAgenda(Request $request)
    {
        $agenda = Agenda::where('id', $request->id)->delete();
        return "Oke";
    }
}
