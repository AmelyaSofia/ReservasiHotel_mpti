<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Log;

class MidtransController extends Controller
{
    public function callback(Request $request)
    {
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        
        try {
            $notification = new \Midtrans\Notification();
            
            $transaction = $notification->transaction_status;
            $type = $notification->payment_type;
            $orderId = $notification->order_id;
            $fraud = $notification->fraud_status;

            // orderId format: RES-{id}-{time}
            $orderParts = explode('-', $orderId);
            $reservationId = $orderParts[1] ?? null;

            if (!$reservationId) {
                return response()->json(['message' => 'Invalid order ID'], 400);
            }

            $reservation = Reservation::find($reservationId);
            
            if (!$reservation) {
                return response()->json(['message' => 'Reservation not found'], 404);
            }

            if ($transaction == 'capture') {
                if ($type == 'credit_card') {
                    if ($fraud == 'challenge') {
                        $reservation->update(['payment_status' => 'challenge']);
                    } else {
                        $reservation->update(['payment_status' => 'paid', 'status' => 'confirmed']);
                    }
                }
            } else if ($transaction == 'settlement') {
                $reservation->update(['payment_status' => 'paid', 'status' => 'confirmed']);
            } else if ($transaction == 'pending') {
                $reservation->update(['payment_status' => 'pending']);
            } else if ($transaction == 'deny') {
                $reservation->update(['payment_status' => 'failed']);
            } else if ($transaction == 'expire') {
                $reservation->update(['payment_status' => 'expired']);
            } else if ($transaction == 'cancel') {
                $reservation->update(['payment_status' => 'failed']);
            }

            return response()->json(['message' => 'Callback handled successfully']);

        } catch (\Exception $e) {
            Log::error('Midtrans Callback Error: ' . $e->getMessage());
            return response()->json(['message' => 'Error handling callback', 'error' => $e->getMessage()], 500);
        }
    }
}
