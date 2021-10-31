<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;

class SendRafmReportCsSelfcare extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var $fileName
     */
    public $fileName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($fileName)
    {
        $this->fileName = $fileName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $filePath = public_path('storage/cs/'. $this->fileName .'.csv.gz');

        return $this->view('welcome')->subject('CS Selfcare RAFM Report')->attach($filePath, [
            'as' =>'RAFM REPORT',
            'mime' => 'application/gzip'
        ]);
    }
}
