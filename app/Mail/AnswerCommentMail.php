<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AnswerCommentMail extends Mailable
{
    use Queueable, SerializesModels;


    protected $detail;

    
    public function __construct($detail)
    {
        $this->detail = $detail;
    }

    
    public function build()
    {

            
        $details = $this->detail;

        return $this->markdown('mail.answer-comment-mail' , compact('details'));
    }
}
