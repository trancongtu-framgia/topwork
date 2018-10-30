@foreach ($jobArr as $job)
    @foreach ($job->applications as $application)
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="jp_recent_resume_box_wrapper @if ($application->status == config('app.candidate_apply_checked'))  candidate_checked @endif">
                <div class="jp_recent_resume_img_wrapper">
                    <img src="{{ asset(config('app.candidate_media_url') . $application->user->candidate->avatar_url) }}" width="80" height="100" alt="resume_img"></div>
                <div class="jp_recent_resume_cont_wrapper"><h3>{{ $application->user->name }}</h3>
                    <p><a href="#">{{ __('Name Job:') . $application->job->title }}</a></p>
                    <p><a href="#"><i class="fa fa-info-circle"></i>{{ __('Apply Date:') . $application->created_at }}</a></p>
                    <p><a href="#"><i class="fa fa-map-marker"></i>{{ __('Location:') . $application->job->locationJobs->name }}</a></p>
                    @if ($application->note)
                        <p><a href="#"><i class="fa fa-map-marker"></i>{{ __('Note:') . $application->note }}</a></p>
                    @endif
                </div>
                <div class="jp_recent_resume_btn_wrapper">
                    <ul>
                        <li>
                            <a href="{{ route('application.getDetailCandidate', $application->user->token) . '?job=' . $application->job->id }}">{{ __('View Profile') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    @endforeach
@endforeach

