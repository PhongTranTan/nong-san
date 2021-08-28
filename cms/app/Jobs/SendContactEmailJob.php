<?php

namespace App\Jobs;

use App\Mail\EMail;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendContactEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $input;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($input)
    {
        $this->input = $input;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //Send to visitor
        $email = new EMail();
        $email->subject = 'Empirecity Contact';
        $email->receiver_address = $this->input['email'];;
        $email->receiver_name = $this->input['name'];
        $email->body = [
            'view'=>'emails.contact2visitor',
            'content'=>[
                'input'=>$this->input
            ]
        ];
        sendMail($email);


        // Send to admin
        $system_email = \System::content('contact_email', env('CONTACT_EMAIL'));
        if ($system_email) {
            $email = new EMail();
            $email->subject = 'Empirecity Contact';
            $email->receiver_address = env('CONTACT_EMAIL');
            $email->receiver_name = 'Admin';
            $email->body = [
                'view'=>'emails.contact2admin',
                'content'=>[
                    'input'=>$this->input
                ]
            ];
            sendMail($email);
        }
    }
}
