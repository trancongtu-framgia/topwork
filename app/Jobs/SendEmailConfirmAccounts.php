<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;

class SendEmailConfirmAccounts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $userInfo;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->userInfo = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::send('emails.send_email_confirm_accounts', [
            'name' => $this->userInfo['name'],
            'link' => route('user.confirmAccount', $this->userInfo['user_id']),
        ], function ($msg) {
            $msg->to($this->userInfo['email'], $this->userInfo['name'])->subject(__('Inform From Topwork'));
        });
    }
}
