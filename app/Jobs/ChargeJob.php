<?php

namespace App\Jobs\ChargeJob;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Spatie\WebhookClient\Models\WebhookCall;
use App\Notifications\sendOrderNotification;
use App\Models\User;
use App\Models\Order;

class ChargeJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /** @var \Spatie\WebhookClient\Models\WebhookCall */
    public $webhookCall;

    public function __construct(WebhookCall $webhookCall)
    {
        $this->webhookCall = $webhookCall;
    }

    public function handle()
    {
        // do your work here
        $charge = $this->webhookCall->payload['data']['object'];
        $user = User::where('stripe_id',$charge['customer'])->first();

        if($user){
            $order = Order::where('user_id',$user->id)
                ->whereNull('paid_at')
                ->latest()
                ->get();

                    $order->update(['paid_at' => now()]);

            $user->notify(new sendOrderNotification());
            $order->update(['delivered_at' => now()]);        
        }

    }
}