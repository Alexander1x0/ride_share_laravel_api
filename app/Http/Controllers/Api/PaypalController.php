<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaypalRequest;
use Illuminate\Http\Request;
use App\Models\PaypalTransaction;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalController extends Controller
{
    public function paypal(PaypalRequest $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        // Create PayPal Order
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('success'),
                "cancel_url" => route('cancel'),
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $request->value,
                    ],
                ],
            ],
        ]);

        if (isset($response['id']) && $response['id'] != null) {
            // Save transaction in the database
            PaypalTransaction::create([
                'ride_id' => $request->ride_id,
                'user_id' => auth()->id(),
                'paypal_order_id' => $response['id'],
                'status' => 'PENDING',
                'amount' => $request->value,
                'currency' => 'USD',
                'response' => json_encode($response),
            ]);

            // Return approval URL
            foreach ($response['links'] as $link) {
                if ($link['rel'] == 'approve') {
                    return response()->json(["status" => true, 'approval_url' => $link['href']], 200);
                }
            }
        }

        return response()->json(["status" => false, 'message' => 'Unable to create PayPal order.'], 400);
    }

    public function success(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        // Capture payment
        $response = $provider->capturePaymentOrder($request->token);

        if (isset($response['status']) && $response['status'] === 'COMPLETED') {
            // Update transaction status
            $transaction = PaypalTransaction::where('paypal_order_id', $response['id'])->first();
            if ($transaction) {
                $transaction->status = 'COMPLETED';
                $transaction->response = json_encode($response);
                $transaction->save();
            }

            return response()->json(["status" => true, 'message' => 'Payment successful!', 'data' => $response], 200);
        }

        return response()->json(["status" => false, 'message' => 'Payment not completed.'], 422);
    }

    public function cancel(Request $request)
    {
        // Update transaction status
        $transaction = PaypalTransaction::where('paypal_order_id', $request->token)->first();
        if ($transaction) {
            $transaction->status = 'CANCELED';
            $transaction->save();
        }

        return response()->json(["status" => true, 'message' => 'Payment was canceled.'], 200);
    }
}
