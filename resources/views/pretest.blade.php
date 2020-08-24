@extends('layouts.courses')

@section('content')
<section class="screen-frame">
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
    {{-- <span class="lamp-imag"><img src="{{ asset('assets/images/pretest/lamp.svg') }}" alt="lamp"></span> --}}
    <span class="wall-frames"><img src="{{ asset('assets/images/pretest/wall-frames.svg') }}" alt="wall-frames"></span>

    <div id="text-box-main">

        <div class="text-box zoomOut">
            {{-- <span class="mape"><img src="{{ asset('assets/images/pretest/mape.svg') }}" alt="mape"></span> --}}

            <div id="content"></div>

            {{-- <div class="pervious" id="navBtn">
                    <button class="btn nextBtn">NEXT</button>
                    <button class="btn previousBtn">Previous</button>
                </div> --}}
            <div class='loader' style="display: none"><img src='{{ asset('assets/images/pretest/loader.svg') }}'></div>
        </div>

        <span class="man-doctor">
            <object data="{{ asset('assets/images/pretest/man-doctor.svg') }}" type="image/svg+xml"></object>
        </span>
        <span class="doctor_sitting" style="display: none">
            <img src="{{ asset('assets/images/pretest/doctor_sitting.svg') }}" alt="doctor_sitting">
        </span>
        <span class="nursery">
            <img src="{{ asset('assets/images/pretest/nursery.svg') }}" alt="nursery">
        </span>
        <span class="door ">
            <img src="{{ asset('assets/images/pretest/door.svg') }}" alt="door">
        </span>
        <span class="lady-doctor">
            <object data="{{ asset('assets/images/pretest/lady-doctor.svg') }}" type="image/svg+xml"></object>
        </span>
        <span class="logo">
            <img src="{{ asset('assets/images/pretest/logo.png') }}" alt="logo">
        </span>
        <span class="table-chair">
            <img src="{{ asset('assets/images/pretest/table-chair.svg') }}" alt="table-chair">
        </span>
    </div>
</section>

<script>
    var pretestCompleted = {{ $pretestCompleted }};
</script>
<script type="text/javascript" src="{{ asset('courses/pretest.js') }}"></script>

@endsection