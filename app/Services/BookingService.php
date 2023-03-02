<?php

namespace App\Services;

use Aloha\Twilio\Twilio;
use App\Models\Package;
use App\Models\User;
use Laravel\Cashier\Cashier;
use Stripe\StripeClient;

class BookingService
{

    public StripeClient|null $stripe = null;

    public function __construct()
    {
        $stripeId = config('stripe.stripe_id');
        $this->stripe = new StripeClient($stripeId);
    }

    public function create($packageId)
    {
        $package = Package::findOrFail($packageId);

        /** @var User $user */
        $user = auth()->user();
        return $user->bookings()->firstOrCreate([
            'package_id' => $packageId,
            'package_data' => $package->toArray(),
            'user_data' => $user->toArray(),
            'price' => $package->price,
        ]);
    }

    public function getGoods()
    {
        return $this->stripe->products->all();
    }

    public function buyProduct($productId)
    {
        $user = auth()->user();

        $priceId = $this->stripe->products->retrieve($productId)->default_price;
        $price = $this->stripe->prices->retrieve($priceId, [])->unit_amount;

        return $user->charge($price, $user->defaultPaymentMethod()?->id);
    }
}
