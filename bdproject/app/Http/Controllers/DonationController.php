<?php

namespace App\Http\Controllers;

use App\Mail\DonationReceived;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Donation;
use Stripe\Subscription;

class DonationController extends Controller
{
    public function createCheckoutSession(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $amount = $request->input('amount');

        if (!$amount) {
            return back()->with('error', 'Te rugăm să alegi o sumă!');
        }

        if ($amount == 'other') {
            $amount = $request->input('custom_amount');
        }

        $amountInCents = (int) ($amount * 100);

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'ron',
                    'product_data' => ['name' => 'Donație pentru pisici'],
                    'unit_amount' => $amountInCents,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => url('/donate/verify/{CHECKOUT_SESSION_ID}'),
            'cancel_url' => route('donation.cancel'),
        ]);


        Donation::create([
            'user_id' => auth()->id(),
            'amount' => $amount,
            'stripe_session_id' => $session->id,
            'status' => 'pending',
        ]);


        return redirect($session->url);
    }




    public function verifyPayment($sessionId)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $session = Session::retrieve($sessionId);

        if ($session->payment_status === 'paid') {
            $donation = Donation::where('stripe_session_id', $sessionId)->first();

            if ($donation && $donation->status !== 'succeeded') {
                $donation->status = 'succeeded';
                $donation->save();

                Mail::to($donation->user->email)->send(new DonationReceived($donation));

            }

            return view('donations.donation_success');
        } else {
            return view('donations.donation_cancel');
        }
    }

    public function showDonationForm()
    {
        $targetAmount = 10000;

        $totalDonations = Donation::where('status', 'succeeded')->sum('amount');

        $progress = ($totalDonations / $targetAmount) * 100;

        return view('donations.help', compact('totalDonations', 'targetAmount', 'progress'));
    }




}
