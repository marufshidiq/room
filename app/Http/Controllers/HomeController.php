<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use App\Agenda;
use Carbon\Carbon;

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
        $now = Carbon::now();
        $agendaOfTheWeek = array();
        $agendaOfTheYear = array();
        $maxAgendaWeek = 0;
        $maxAgendaYear = 0;
        $todayAgendaCount = $this->countAgenda(date('Y-m-d'));
        for($i = 0; $i<7; $i++){
            $diff = $i - $now->dayOfWeek;
            if($diff == 0){
                $n = $this->countAgenda($now->format('Y-m-d')); 
            }
            elseif($diff<0){
                $n = $this->countAgenda($now->subDays(abs($diff))->format('Y-m-d')); 
            }
            elseif($diff>0){
                $n = $this->countAgenda($now->addDays(abs($diff))->format('Y-m-d')); 
            }
            if($n>$maxAgendaWeek){
                $maxAgendaWeek = $n;
            }
            array_push($agendaOfTheWeek, $n);
        }        
        $maxAgendaWeek += 3;

        for($i = 1; $i<=12;$i++){
            $year = date('Y');
            $n = $this->countAgenda($year.'-'.$i.'-1', $year.'-'.$i.'-31');
            array_push($agendaOfTheYear, $n);
            if($n>$maxAgendaYear){
                $maxAgendaYear = $n;
            }
        }
        $maxAgendaYear += 3;

        $allAgenda = Agenda::all();
        $allRoom = Room::all();
        return view('home', compact('allAgenda', 'allRoom', 'agendaOfTheWeek', 'maxAgendaWeek', 'agendaOfTheYear', 'maxAgendaYear', 'todayAgendaCount'));
    }

    public function countAgenda($start, $end="")
    {
        if($end == ""){
            $end = $start;
        }
        $count = Agenda::whereBetween('datetime_start', [$start.' 00:00:00', $end.' 23:59:59'])->count();
        return $count;
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
