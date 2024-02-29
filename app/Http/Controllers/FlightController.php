<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FlightController extends Controller
{
    public function search(Request $request) {
        $query = [
            'from' => $request->query('from'),
            'to' => $request->query('to'),
            'date1' => $request->query('date1'),
            'date2' => $request->query('date2'),
            'passengers' => $request->query('passengers'),
        ];

        $validator = Validator::make($query, [
            'from' => ['required'],
            'to' => ['required'],
            'date1' => ['required'],
            'date2' => [],
            'passengers' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => [
                    'code' => 422,
                    'message' => 'Vadation error',
                    'errors' => $validator->errors()
                ]
            ]);
        }

        $to_id = DB::table('airports')->where('iata', 'LIKE', '%' . $request->query('from') . '%')->get('id')[0]->id;
        $from_id = DB::table('airports')->where('iata', 'LIKE', '%' . $request->query('to') . '%')->get('id')[0]->id;

        $flights_to = DB::table('flights')
            ->where('from_id', 'LIKE', $from_id)
            ->where('to_id', 'LIKE',  $to_id)
            ->get()
        ;

        $flights_back = DB::table("flights")
            ->where('from_id', 'LIKE', $to_id)
            ->where('to_id', 'LIKE', $from_id)
            ->get()
        ;

        return response()->json([
            'data' => [
                'flights_to' => $flights_to,
                'flights_back' => $flights_back
            ]
        ]);
        
    }
}
