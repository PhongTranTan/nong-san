<?php

namespace App\Mail\Frontend;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Customer;

class ForgotPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $customer;

    public $token;
    
    public function __construct(Customer $customer, $token)
    {
        $this->customer = $customer;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $customer = $this->customer;
        $token = $this->token;

        return $this->view('emails.forgot_password')
                    ->with('customer', $customer)
                    ->with('token', $token);
    }
}
