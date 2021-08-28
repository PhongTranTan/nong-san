<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendContactEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $input;

    protected $locale;

    public function __construct(array $input, $locale)
    {
        $this->input = $input;
        $this->locale = $locale;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = trans('emails.new_contact_email', [], $this->locale);

        return $this->subject($subject)
            ->view('emails.contact2admin')
            ->with('input', $this->input)
            ->with('locale', $this->locale);
    }
}
