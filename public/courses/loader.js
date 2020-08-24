$(function() {
    $('body').on('click', 'span.user-arrow', function(e) {
        $('ul.profile').toggleClass('active-profile');
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

});





// global audio controls
var wants_to_listen = false;
var audio = null;
var clickSound = null;
var load_mp3 = true;
var mp3 = null;

// global buttons
var previousNextBtn = "<div class='pervious' id='navBtn'><button class='btn nextBtn'>NEXT</button><button class='btn previousBtn'>Previous</button></div>";
var nextBtn = "<button class='btn nextBtn'>NEXT</button>";

// global svg
var manDoctorSvg = 'assets/images/pretest/man-doctor.svg';
var ladyDoctorSvg = 'assets/images/pretest/lady-doctor.svg';

function loadJson(dir, file) {
    dir = dir || null;
    file = file || null;
    let response = null;
    let url = "/courses/" + dir + (file != null ? "/" + file + ".json" : ".json");

    if (dir != null) {
        $.ajax({
            async: false,
            url: url,
            success: function(result) {
                response = result;
            }
        });
    }

    return response;
}

function loadHtml(type) {
    type = type || null;
    let response = null;

    if (type != null) {
        $.ajax({
            async: false,
            url: "/courses/html/" + type + ".html",
            success: function(result) {
                response = result;
            }
        });
    }

    return response;
}

function typer(speed, delay) {
    $("[data-typer]").attr("data-typer", function(i, txt) {

        var $typer = $(this),
            tot = txt.length,
            pauseMax = speed,
            pauseMin = 60,
            ch = 0;

        setTimeout(() => {
            (function typeIt() {
                if (ch > tot) return;
                $typer.text(txt.substring(0, ch++));
                setTimeout(typeIt, ~~(Math.random() * (pauseMax - pauseMin + 1) + pauseMin));
            }());
        }, delay || 1000);

    });
}

function updateModuleSection(moduleID, sectionID) {
    $.ajax({
        type: "POST",
        url: "/modules/section/update",
        headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content') },
        data: { "module_id": moduleID, "section_id": sectionID },
        dataType: "json",
        success: function(response) {
            console.log(response);
        }
    });
}

function updateTimespentLogs(moduleID, type, startOREnd) {
    $.ajax({
        type: "POST",
        url: "/modules/timespent/update",
        headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content') },
        data: { "module_id": moduleID, "type": type, "start_or_end": startOREnd },
        dataType: "json",
        success: function(response) {
            console.log(response);
        }
    });
}

function toggleBox(section) {
    $('.text-box').removeClass('zoomIn');

    setTimeout(() => {
        $('.text-box').addClass('zoomIn');

        if (section % 2 == 0) {
            $('.text-box').addClass('arrow-right');
        } else {
            $('.text-box').removeClass('arrow-right');
        }
    }, 1050);
}

function toggleModuleContent(appendTo, isNext) {
    // $('.text-box').removeClass('zoomOut');
    let slideIn = '';
    let slideOut = '';
    if (isNext) {
        slideIn = 'slide-in-left';
        slideOut = 'slide-out-left';
    } else {
        slideIn = 'slide-in-right';
        slideOut = 'slide-out-right';
    }

    $(appendTo).removeClass().addClass(slideOut);
    setTimeout(() => {
        $(appendTo).removeClass().addClass(slideIn);
    }, 1000);
}

function toggleDoctor(section, callback) {
    if (section.doctor) {
        if (section.doctor === "lady") {
            // $('.lady-doctor object').attr('data', ladyDoctorSvg);
            $('.lady-doctor').animate({ 'right': '3%' }, 1000);
            $('.man-doctor').animate({ 'left': '-35vw' }, 1000);
        }

        if (section.doctor === "man") {
            // $('.man-doctor object').attr('data', manDoctorSvg);
            $('.man-doctor').animate({ 'left': '5vw' }, 1000);
            $('.lady-doctor').animate({ 'right': '-40%' }, 1000);
        }
    } else {
        $('.lady-doctor').animate({ 'right': '-40%' }, 1000);
        $('.man-doctor').animate({ 'left': '-35vw' }, 1000);
    }

    if (callback !== undefined) {
        callback(section);
    }
}

function doctorLipsing(start) {
    let doctor = parseInt($('.man-doctor').css('left')) > 1 ? 'man' : 'lady';
    let mouthUp = document.getElementsByClassName(doctor + '-doctor')[0].children[0].getSVGDocument().getElementById(doctor + '-mouth-up');
    let mouthDown = document.getElementsByClassName(doctor + '-doctor')[0].children[0].getSVGDocument().getElementById(doctor + '-mouth-down');
    let upClass = mouthUp.classList[0];
    let downClass = mouthDown.classList[0];
    start = start || true;
    mouthUp.setAttribute("class", upClass + (start ? " up" : ""));
    mouthDown.setAttribute("class", downClass + (start ? " down" : ""));
}

function showDialog(feedback) {
    $('.doctor-feedback').removeClass("show-feedback");
    $('.doctor-face').addClass("show-d-face");

    setTimeout(function() {
        $('.doctor-feedback').html('<p>' + feedback + '</p>');
        $('.doctor-feedback').addClass("show-feedback");
    }, 500);
}

function hideDialog() {
    $('.doctor-feedback').removeClass("show-feedback");
    $('.doctor-face').removeClass("show-d-face");
}

function showFeedback(nodeList, resetIndex, callback) {
    resetIndex = resetIndex || false;

    if (resetIndex) {
        answerFeedbackBtn.attr("index", 0);
        $('.qustions-feedback').remove();
    }

    $('.nextBtn').attr('disabled', true);

    let index = parseInt(answerFeedbackBtn.attr("index"));
    let node = nodeList[index];
    let feedback = $(node).data('feedback');
    let alert = $('<span class="qustions-feedback show-qustionsfeedback"><p>' + feedback + '</p></span>');
    if (feedback != undefined && feedback.length > 0) {


        alert.insertBefore(node);
        answerFeedbackBtn.appendTo(alert);
        answerFeedbackBtn.attr("index", ++index);

        if (nodeList.length > index) {
            answerFeedbackBtn.one('click', function(e) {
                // node.checked = false;
                showFeedback(nodeList, false, callback);
                $(alert).remove('.qustions-feedback');
            });
        } else {
            answerFeedbackBtn.one('click', function(e) {
                if (callback !== undefined) {
                    callback(nodeList);
                }
                hideDialog();
                // node.checked = false;
                $('.nextBtn').attr('disabled', false);
                $(alert).remove('.qustions-feedback');
            });
        }
        $('.qustions-feedback').height($('.qustions-feedback p').height() + 10);
    }
}

function showButton(appendTo, onlyNext, position, animateClass) {
    let btn = '';
    animateClass = animateClass || null;
    if ($('#navBtn').length > 0) {
        $('#navBtn').remove();
    } else {
        $('.nextBtn').remove();
    }
    if (appendTo !== null) {
        if (!onlyNext) {
            btn = previousNextBtn;
        } else {
            btn = nextBtn;
        }
        document.querySelector(appendTo).insertAdjacentHTML(position, btn);
        if (animateClass) {
            $('.btn').addClass(animateClass);
        }
    }
}

function muteUnmute(appendTo) {
    $('.speaker').remove();

    // in case for any screen we dont want the mp3, we will pass appendTo as null
    // this will remove the speaker icon and not append on that screen
    if (appendTo !== null) {
        if (wants_to_listen) {
            $('<span>')
                .attr('class', 'speaker unmute')
                .html('<img src="/assets/images/unmute.svg" alt="speaker" />')
                .appendTo(appendTo)
        } else {
            $('<span>')
                .attr('class', 'speaker mute')
                .html('<img src="/assets/images/mute.svg" alt="speaker" />')
                .appendTo(appendTo)
        }

        $('.speaker').click(function() {
            playClickSound();
            speak();
        });
    }
}

function isAudioPlaying() {
    if (audio !== null) {
        return (audio.duration > 0 && !audio.paused);
    }

    return false;
}

function speak() {
    if (isAudioPlaying()) {
        audio.pause();
        wants_to_listen = false;
        $('.speaker img').attr('src', '/assets/images/mute.svg');
    } else {
        if (load_mp3) {
            var request = new XMLHttpRequest();
            request.open("GET", mp3, true);
            request.responseType = "blob";
            request.onload = function() {
                if (this.status == 200) {
                    wants_to_listen = true;
                    load_mp3 = false;

                    $('.speaker img').attr('src', '/assets/images/unmute.svg');

                    audio = new Audio(URL.createObjectURL(this.response));
                    audio.load();
                    audio.play();
                }
            }

            request.send();
        } else {
            wants_to_listen = true;
            $('.speaker img').attr('src', '/assets/images/unmute.svg');
            audio.play();
        }
    }
}

function stop() {
    if (audio !== null) {
        audio.pause();
        audio.currentTime = 0;
    }

    load_mp3 = true;
}

function loadClickSound() {
    var mp3 = '/sound/click.mp3';
    var request = new XMLHttpRequest();
    request.open("GET", mp3, true);
    request.responseType = "blob";

    request.onload = function() {
        if (this.status == 200) {
            clickSound = new Audio(URL.createObjectURL(this.response));
            clickSound.load();
        }
    }

    request.send();
}

function playClickSound() {
    if (clickSound !== null) {
        clickSound.play();
    } else {
        loadClickSound();
    }
}

loadClickSound();