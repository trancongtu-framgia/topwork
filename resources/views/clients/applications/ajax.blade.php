@foreach ($jobArr as $job)
    @foreach ($job->applications as $application)
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="jp_recent_resume_box_wrapper">
                <div class="jp_recent_resume_img_wrapper">
                    <img src="{{ asset(config('app.candidate_media_url') . $application->user->candidate->avatar_url) }}" width="80" height="100" alt="resume_img"></div>
                <div class="jp_recent_resume_cont_wrapper"><h3>{{ $application->user->name }}</h3>
                    <p><a href="#">{{ __('Name Job:') . $application->job->title }}</a></p>
                    <p><a href="#">{{ __('Apply Date:') . $application->created_at }}</a></p></div>
                <div class="jp_recent_resume_btn_wrapper">
                    <ul>
                        <li>
                            <a href="{{ route('candidate.getInfo', $application->user->token) }}">{{ __('View Profile') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    @endforeach
@endforeach

