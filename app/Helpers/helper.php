<?php

use App\Mail\OrderEmail;
use App\Models\OrderItem;

use Illuminate\Support\Facades\Mail;

function orderEmail($id)
{
  $order = OrderItem::where('id', $id)->with('items')->first();

  $mailData = [
    'subject' => 'Thank You For Purchasing Product',
    'order' => $order
  ];

  Mail::to($order->email)->send(new OrderEmail($mailData));
}

?>  