<?php

namespace App\Listeners;

use App\Events\OrderProduct;
use App\Mail\OrderMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendOrderMail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrderProduct  $event
     * @return void
     */
    public function handle(OrderProduct $event)
    {
        Mail::to($event->order->user->email)->send(new OrderMail($event->order, $event->detail));
    }
}
