<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RideDetailsRequest;
use App\Models\Ride;
use Illuminate\Http\Request;

class RideController extends Controller
{
    public function rideDetails(RideDetailsRequest $request)
    {
        try {
            $transportOptions = ['car_id', 'bike_id', 'cycle_id', 'taxi_id'];
            $selectedTransport = array_filter(
                $request->only($transportOptions),
                fn($value) => !is_null($value)
            );
            $transporField = key($selectedTransport);
            $transportValue = $selectedTransport[$transporField];
            $ride = Ride::create([
                "user_id" => auth()->id(),
                "from" => $request->from,
                "to" => $request->to,
                "transport_id" => $request->transport_id,
                "when" => $request->when,
                $transporField => $transportValue,
                "date" => $request->date,
                "time" => $request->time,
                "value" => $request->value,
                "payment_way" => $request->payment_way,
                "status" => "active",
            ]);

            return response()->json([
                "status" => true,
                "message" => "Ride Created Successfully",
                "ride" => $ride,
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "Failed to create ride. Please try again later.",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
}
