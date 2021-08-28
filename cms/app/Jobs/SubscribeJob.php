<?php

namespace App\Jobs;

use App\Mail\EMail;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;
use App\Repositories\GuidesRepository;

class SubscribeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $guides;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($guides)
    {
        $this->guides = $guides;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $guides_info = $this->guides;
        
        $subject = 'Subscribe Guides: '.$guides_info->title;
        $input['title'] = $guides_info->title;
        $input['description'] = $guides_info->description;
        $input['slug'] = $guides_info->slug;
        $subscribes = \DB::table('subscribe')->where('status', 1)->get();
        if($subscribes != null && count($subscribes) > 0){
            foreach($subscribes as $subcribe){
                $email = $subcribe->email;
                Mail::send('emails.subscribe-news', ['info' => $input],function($message) use ($email, $subject) {
                    $message->to($email)->subject($subject);
                });
            }
        } 
    }
}
