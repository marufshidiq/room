<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Room;

class APIController extends Controller
{
    public function IPUpdate(Request $request)
    {
        if (!$request->has(['key', 'ip'])) {
            return response()->json([
                'error' => true,
                'message' => 'Parameter incomplete'
            ]);
        }

        $room = Room::where('key', $request->key);
        if($room->count() != 1){
            return response()->json([
                'error' => true,
                'message' => 'Key not found'
            ]);
        }

        $ip = $request->ip;
        $is_valid_ip = filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);

        if(!$is_valid_ip){
            return response()->json([
                'error' => true,
                'message' => 'IP incorrect'
            ]);
        }

        $room = $room->first();
        $room->update([
            'ip_address' => $ip,
            'last_update' => date('Y-m-d H:i:s')
        ]);

        return response()->json([
            'error' => false,
            'message' => 'Success'
        ]);
    }

    public function usage(Request $request)
    {
        if (!$request->has(['key', 'token'])) {
            return response()->json([
                'error' => true,
                'message' => 'Parameter incomplete'
            ]);
        }

        $room = Room::where('key', $request->key);
        if($room->count() != 1){
            return response()->json([
                'error' => true,
                'message' => 'Key not found'
            ]);
        }
        
        $room = $room->first();
        $agenda = $room->agenda->where('token', $request->token);
        if($agenda->count()!=1){
            return response()->json([
                'error' => true,
                'message' => 'Agenda not found'
            ]);
        }
        $agenda = $agenda->first();

        $start = Carbon::parse($agenda->datetime_start);
        $end = Carbon::parse($agenda->datetime_end);
        $now = Carbon::now();

        
        $s = $now->greaterThanOrEqualTo($start);
        $e = $now->lessThan($end);

        $access = array();
        
        if($e && !$s){
            $status = "Belum memasuki waktu agenda yang telah ditentukan";
            $is_valid = false;
        }
        elseif ($e && $s){
            $is_valid = true;
            $status = "Sesuai jadwal";
            $access = array(
                "listrik" => $agenda->listrik,
                "ac" => $agenda->ac,
                "proyektor" => $agenda->proyektor,
                "finish" => $agenda->datetime_end
            );
            // array_push($access, array("listrik" => $agenda->listrik));
            // array_push($access, array("ac" => $agenda->ac));
            // array_push($access, array("proyektor" => $agenda->proyektor));

            // array_push($access, array("finish" => $agenda->datetime_end));
        }
        elseif (!$e && $s){
            $status = "Jadwal agenda sudah terlewat";
            $is_valid = false;
        }        

        return response()->json([
            'error' => false,
            'valid' => $is_valid,
            'access' => $access,
            'status' => $status
        ]);        
    }
}
