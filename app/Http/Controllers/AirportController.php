<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AirportController extends Controller
{
    public function search(Request $request) {
        $query = $request->query('query');

        $airports = DB::table('airports')
            ->where('city', 'LIKE', '%'. $query .'%')
            ->orWhere('name', 'LIKE', '%' . $query . '%')
            ->orWhere('iata', 'LIKE', '%' . $query . '%')
            ->get();

        return response()->json([
            'data' => [
                'items' => $airports,
            ]
        ]);
    
    }
}
