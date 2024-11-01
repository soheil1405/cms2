<?php

namespace App\Jobs;

use App\Mail\AnswerCommentMail;
use App\Mail\TicketAnswerEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;



    protected $detail;



    public function __construct($detail)
    {
        $this->detail = $detail;

        
    
        if (isset($detail['link'])) {

            $email = new AnswerCommentMail($detail);
        
        } else {
            
            $email = new TicketAnswerEmail($this->detail);
            
        }

        // Mail::to($this->detail['email'])->send($email);


    
    
    }


    public function handle()
    {


        $data = $this->detail;

        
        // dd('job');

        if (isset($data['link'])) {

            $email = new AnswerCommentMail($data);
        
        } else {
            $email = new TicketAnswerEmail($this->detail);
            
        }

        Mail::to($this->detail['email'])->send($email);


    }
}