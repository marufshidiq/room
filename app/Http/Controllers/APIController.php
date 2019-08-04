<?php

namespace App\Http\Controllers;

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
}
