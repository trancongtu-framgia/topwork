@foreach ($jobArr as $job)
    @foreach ($job->applications as $application)
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="jp_recent_resume_box_wrapper @if ($application->status == config('app.candidate_apply_checked'))  candidate_checked @endif">
                <div class="jp_recent_resume_img_wrapper">
                    @if ($application->user->candidate->avatar_url)
                        <img src="{{ asset(config('app.candidate_media_url') . $application->user->candidate->avatar_url) }}" class="candidate_list_img" alt="resume_img">
                    @else
                        <img src="{{ asset(config('app.candidate_media_url') . 'user.png') }}" class="candidate_list_img" alt="resume_img">
                    @endif
                </div>
                <div class="jp_recent_resume_cont_wrapper">
                    <h3>{{ $application->user->name }}</h3>
                    <p><a href="#" class="set_padding">{{ __('Name Job:') }}</a>{{ $application->job->title }}</p>
                    <p><a href="#"><i class="fa fa-info-circle"></i><span class="set_padding">{{ __('Apply Date:') }}</span>{{ $application->created_at }}</a></p>
                    <p><a href="#"><i class="fa fa-map-marker"></i><span class="set_padding">{{ __('Location:') }}</span>{{ $application->job->locationJobs->name }}</a></p>
                    @if ($application->note)
                        <p><a href="#"><i class="fa fa-th-large"></i><span class="set_padding">{{ __('Note:') }}</span>{{ $application->note }}</a></p>
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

