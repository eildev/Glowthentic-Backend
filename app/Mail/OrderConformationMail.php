<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderConformationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    protected $newOrders;
    public function __construct($newOrders)
    {
        $this->newOrders = $newOrders;
    }

    public function build(){
        return  $this->subject('Order Conformation Mail')->view('backend.order.orderConformMail')->with('order',$this->newOrders);
    }
}
