<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $orderDetails;
    public $totalAmount;
    public $bankName;
    public $bankCode;
    public $branchCode;
    public $accountNumber;
    public $accountHolder;
    public $name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($orderDetails, $totalAmount, $accountHolder, $name)
    {
        $this->orderDetails = $orderDetails;
        $this->totalAmount = $totalAmount;
        $this->accountHolder = $accountHolder;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.order_confirmation');
    }
}
