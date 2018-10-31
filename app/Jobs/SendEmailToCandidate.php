<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;

class SendEmailToCandidate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $candidate;
    protected $company;
    protected $job;
    protected $jobId;
    Protected $jobName;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($candidate, $company)
    {
        $this->candidate = $candidate;
        $this->company = $company['company'];
        $this->job = $company['job'];
        $this->jobId = $this->job->id;
        $this->jobName = $this->job->title;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::send('emails.send_mail_candidates', [
            'companyName' => $this->company->name,
            'candidateName' => $this->candidate->name,
            'nameJob' => $this->jobName,
            'link' => route('jobs.detail', $this->jobId),
        ], function ($msg) {
            $msg->to($this->candidate->email, $this->candidate->name)->subject(__('THÔNG BÁO TỪ TOPWORK'));
        });
    }
}
