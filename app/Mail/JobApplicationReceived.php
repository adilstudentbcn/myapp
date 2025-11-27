<?php

namespace App\Mail;

use App\Models\JobApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class JobApplicationReceived extends Mailable
{
  use Queueable, SerializesModels;

  public JobApplication $application;

  /**
   * Create a new message instance.
   */
  public function __construct(JobApplication $application)
  {
    $this->application = $application->load(['user', 'job.employer']);
  }

  /**
   * Build the message.
   */
  public function build()
  {
    $job = $this->application->job;
    $user = $this->application->user;

    return $this->subject('New application for: ' . ($job->title ?? 'your job'))
      ->view('emails.job_application_received', [
        'application' => $this->application,
        'job' => $job,
        'candidate' => $user,
      ]);
  }
}
