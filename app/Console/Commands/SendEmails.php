<?php

namespace App\Console\Commands;

use App\Mail\MedicalAppointment;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';


    public function sendEmail()
    {
        Mail::to('walinparedes3010@gmail.com')->send(new MedicalAppointment('Wallace Paredes'));
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->sendEmail();
    }
}
