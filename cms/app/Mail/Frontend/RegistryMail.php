<?php

namespace App\Mail\Frontend;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Customer;

class RegistryMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $customer;

    public $password;

    public function __construct(Customer $customer, $password)
    {
        $this->customer = $customer;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $customer = $this->customer;
        $password = $this->password;

        return $this->view('emails.create_customer')
                    ->with('password', $password)
                    ->with('customer', $customer);
    }
}
