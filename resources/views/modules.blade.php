@if (!$isAjax)
@extends('layouts.courses')
@endif

@section('content')

<div class="popup-overlay">
    <div class="popup">
        <a class="close" href="#">&times;</a>
        <div class="content">
            <img src="" alt="">
        </div>
    </div>
</div>

<section class="screen-frame" id="screen-frame">
    <span class="intro-box">PAGE TITLE</span>
    <span class="user-box">
        <span class="user-wpr">
            <span class="user-icon">
                <img src="{{ asset('assets/images/pretest/user-icon.svg') }}" alt="user-icon">
            </span>
            <span class="user-name">{{ $user }}</span>
            <span class="user-arrow">
                <img src="{{ asset('assets/images/pretest/user-arrow.svg') }}" alt="user-arrow">
            </span>
        </span>
        <ul class="profile">
            <li><a href="/logout">Logout</a>
        </ul>
    </span>
    <span class="wall-frames"><img src="{{ asset('assets/images/pretest/wall-frames.svg') }}" alt="wall-frames"></span>

    <div id="text-box-main">

        <div class="text-box zoomOut">
            <div id="animator">
                <div id="content"></div>
            </div>
            <div class='border-bottom'></div>
            <div class='loader' style="display: none"><img src='{{ asset('assets/images/pretest/loader.svg') }}'></div>
        </div>
        <span class="student-face"><img src="/assets/images/pretest/student-face.svg" alt="student-face">
            <span class="student-feedback"></span>
        </span>
        <span class="man-student">
            <object data="{{ asset('assets/images/pretest/man-student.svg') }}" type="image/svg+xml"></object>
        </span>
        <span class="student_sitting" style="display: none">
            <img src="{{ asset('assets/images/pretest/student_sitting.svg') }}" alt="student_sitting">
        </span>
        <span class="nursery">
            <img src="{{ asset('assets/images/pretest/nursery.svg') }}" alt="nursery">
        </span>
        <span class="door ">
            <img src="{{ asset('assets/images/pretest/door.svg') }}" alt="door">
        </span>
        <span class="lady-student">
            <object data="{{ asset('assets/images/pretest/lady-student.svg') }}" type="image/svg+xml"></object>
        </span>
        <span class="logo">
            <img src="{{ asset('assets/images/pretest/logo.png') }}" alt="logo">
        </span>
        <span class="table-chair">
            <img src="{{ asset('assets/images/pretest/table-chair.svg') }}" alt="table-chair">
        </span>

        <span class="window"><img src="{{ asset('assets/images/pretest/window.svg') }}" alt="window"></span>
        <span class="set-lady-student"><img src="{{ asset('assets/images/pretest/set-lady-student.svg') }}" alt="set-lady-student"></span>
        <span class="lady-patient"><img src="{{ asset('assets/images/pretest/lady-patient.svg') }}" alt="lady-patient"></span>
        <span class="earth"></span>
    </div>
</section>

<script>
    var currentModule = {{ $module }};
    var currentSection = {{ $section }}; 
    var timespent_log = JSON.parse('{{ $timespent }}'); 

    if(!timespent_log.started_at){
        updateTimespentLogs(currentModule, 'narrative', 'start');
    }
</script>
<script type="text/javascript" src="{{ asset('courses/functions.js') }}"></script>
@endsection