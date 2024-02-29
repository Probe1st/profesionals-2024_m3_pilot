<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ValidateBookingData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // $validator = Validator::make($request->all(), [
        //         'flight_from' => ['required', 'array',
        //         'id' => ['required', 'string'],
        //     ],
            
        //     // 'flight_from[date]' => ['required','string'],
        //     'flight_back' => ['array', 'max:2', 'min:2'],
        //     // 'flight_back[id]' => ['required','string'],
        //     // 'flight_back[date]' => ['required','string'],
        //     'passengers' => ['required','array'],
        //     // 'passengers[*][first_name]' => ['required','string'],
        //     // 'passengers[*][last_name]' => ['required','string'],
        //     // 'passengers[*][birth_date]' => ['required','string'],
        //     // 'passengers[*][document_number]' => ['required','string', 'max:10', 'min:10'],
        // ]);

        // if( $validator->fails() ) {
        //     return response()->json([
        //         'error' => [
        //             'code' => 422,
        //             'error' => 'Validation error',
        //             'errors' => $validator->errors()
        //         ]
        //     ]);
        // }

        return $next($request);
    }
}
