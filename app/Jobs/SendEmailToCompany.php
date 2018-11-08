<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;

class SendEmailToCompany implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $company;
    protected $candidate;
    protected $job;
    protected $jobName;
    protected $jobId;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data, $candidate)
    {
        $this->company = $data['company'];
        $this->job = $data['job'];
        $this->candidate = $candidate;
        $this->jobName = $this->job->title;
        $this->jobId = $this->job->id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::send('emails.send_email_company', [
            'companyName' => $this->company->name,
            'candidateName' => $this->candidate->name,
            'jobName' => $this->jobName,
            'link' => route('application.getDetailCandidate', ['token' => $this->candidate->token, 'jobId' => $this->jobId]),
        ], function ($msg) {
            $msg->to($this->company->email, $this->company->name)->subject(__('THÔNG BÁO TỪ TOPWORK'));
        });
    }
}
