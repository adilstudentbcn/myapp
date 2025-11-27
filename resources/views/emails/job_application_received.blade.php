@php
  /** @var \App\Models\JobApplication $application */
  /** @var \App\Models\Job|null $job */
  /** @var \App\Models\User|null $candidate */
@endphp

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>New application</title>
</head>

<body style="font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;">

  <h2>New application received</h2>

  <p>
    You have a new application for
    <strong>{{ $job->title ?? 'your job' }}</strong>
    @if($job && $job->employer)
      at <strong>{{ $job->employer->name }}</strong>
    @endif
    .
  </p>

  @if ($candidate)
    <p>
      <strong>Candidate:</strong> {{ $candidate->name }}<br>
      <strong>Email:</strong> {{ $candidate->email }}
    </p>
  @endif

  @if ($application->cv_url)
    <p>
      <strong>CV / portfolio:</strong>
      <a href="{{ $application->cv_url }}">{{ $application->cv_url }}</a>
    </p>
  @endif

  <p><strong>Message:</strong></p>
  <p style="white-space: pre-line;">
    {{ $application->message }}
  </p>

  <hr>

  <p style="font-size: 12px; color: #666;">
    Sent automatically by Rocket when a candidate applies to your job.
  </p>
</body>

</html>