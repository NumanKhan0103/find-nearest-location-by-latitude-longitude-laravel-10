<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LocationController extends Controller
{

    public function index(Request $request)
    {
        // 33.664391, 73.073083

        $user = new User();
        $user->name = 'John Doe';
        $user->email = 'john@example.com';
        $user->password = bcrypt('password');
        $user->lat = '40.7128';
        $user->lon = '74.0060';
        $user->save();



        // 33.664391, 73.073083
        $lat = "33.664391";
        $lon = "73.073083";

        $users = User::select("users.id"
                        ,DB::raw("6371 * acos(cos(radians(" . $lat . "))
                        * cos(radians(users.lat))
                        * cos(radians(users.lon) - radians(" . $lon . "))
                        + sin(radians(" .$lat. "))
                        * sin(radians(users.lat))) AS distance"))
                        // ->groupBy("users.id")
                        ->get();



    // $users = User::select("users.id",
    // DB::raw("6371 * ACOS(COS(RADIANS($lat))
    //     * COS(RADIANS(users.lat))
    //     * COS(RADIANS(users.lon) - RADIANS($lon))
    //     + SIN(RADIANS($lat))
    //     * SIN(RADIANS(users.lat))) AS distance"))
    // ->get();

        dd($users);
    }
}
