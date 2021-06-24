<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clock;
use Carbon\Carbon;
use Auth;

class UserController extends Controller
{
    public function clockin()
    {
        $found = 0;
        $user = Auth::user();
        $today_date = Carbon::now()->format('Y-m-d');
        $clocks = Clock::where('user_id', $user->id)->get();
        foreach ($clocks as $clock) {
            if ($today_date == $clock->created_at->format('Y-m-d')) {
                $found = 1;
                $current_time = $clock->clock_in;
            }
        }

        if ($found) {
            return response()->json(array(['already' => '*Note: Time is already started at ' . $current_time]) , 200);
        } else {
            $current = Carbon::now()->format('Y-m-d H:i:s');
            $current_time = Carbon::parse($current)->addHour('5')->format('g:i a');

            $clockin = new Clock;
            $clockin->clock_in = $current_time;
            $clockin->user_id = $user->id;
            $clockin->save();
            return response()->json(array(['start_res' => $current_time]) , 200);
        }
    }

    public function clockout()
    {
        $found = 0;
        $current = Carbon::now()->format('Y-m-d H:i:s');
        $current_date = Carbon::now()->format('d-M-Y');
        $current_time = Carbon::parse($current)->addHour('5')->format('g:i a');
        $user = Auth::user();
        $clocks = Clock::where('user_id', $user->id)->get();

        if ($found) {
            return response()->json(array(['already' => '*Note: Time is already started at ' . $current_time]) , 200);
        } else {
            $clockout = new Clock;
            $clockout->clock_out = $current_time;
            $clockout->user_id = $user->id;
            $clockout->save();
            return response()->json(array([ 'end_msg' => '*Note: Time ends at '.$current_time, 'end_res' => $current_time]), 200);
        }


    }
}
