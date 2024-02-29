<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function booking(Request $request) {
        $data = $request->all();
        $data['code'] = $this->generateCode();

        $book = Booking::create($data);

        return response()->json([
            'data' => [
                'code' => $book->code,
            ]
        ]);
    }

    public function generateCode() {
        $code = '';
        $chars = 'QWERTYUIOPASDFGHJKLZXCVBNM';

        for( $i = 0; $i < 5; $i++ ) {
            $code .= $chars[ rand(0, strlen($chars) ) ];
        }

        return $code;
    }
}
