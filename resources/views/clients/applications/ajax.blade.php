@foreach ($applications as $application)
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="jp_recent_resume_box_wrapper @if ($application->status == config('app.candidate_apply_checked'))  candidate_checked @endif">
            <div class="jp_recent_resume_img_wrapper">
                @if (file_exists(config('app.candidate_media_url') . $application->user->candidate->avatar_url))
                    <img src="{{ asset(config('app.candidate_media_url') . $application->user->candidate->avatar_url) }}" class="candidate_list_img" alt="resume_img">
                @else
                    <img src="{{ asset(config('app.candidate_media_url') . 'user.png') }}" class="candidate_list_img" alt="resume_img">
                @endif
            </div>
            <div class="jp_recent_resume_cont_wrapper">
                <h3>{{ $application->user->name }}</h3>
                <p><i class="fa fa-user set_padding"></i>{{ __('Job Name') }} : <span class="candidate_application">{{ $application->job->title }}</span></p>
                <p><i class="fa fa-calendar set_padding"></i>{{ __('Apply Date') }} : <span class="candidate_application">{{ date('d - m - Y', strtotime($application->created_at)) }}</span></p>
                <p><i class="fa fa-map-marker set_padding"></i>{{ __('Location') }} : <span class="candidate_application">{{ $application->job->locationJobs->name }}</span></p>
                @if ($application->note)
                    <p><i class="fa fa-th-large set_padding"></i>{{ __('Note') }} : <span class="candidate_application">{{ $application->note }}</span></p>
                @endif
            </div>
            <div class="jp_recent_resume_btn_wrapper">
                <ul>
                    <li>
                        <a href="{{ route('application.getDetailCandidate', ['token' => $application->user->token, 'jobId' => $application->job->id]) }}">{{ __('View Profile') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endforeach
