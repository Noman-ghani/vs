
var introductory = null;

function goToScreen(sectionNo, score) {
    stop();
    sectionNo = sectionNo || null;
    score = score || null;

    if (sectionNo != null) {
        $('.intro-box').text(introductory.title);

        setTimeout(() => {
            $('#content').html(introductory.sections[sectionNo].title);
            $('#content').append(introductory.sections[sectionNo].content);
            $('#text-box-main').removeClass().addClass(introductory.sections[sectionNo].className);

            $('.text-box .mape').remove();
            $('.text-box .q-number').remove();
            $('.text-box .up-logo').remove();

            $('.text-box').prepend(introductory.sections[sectionNo].iconTop);
            $('.previousBtn').hide();
            $('#navBtn').remove();

            if (sectionNo < 2) {
                showButton('.text-box', true, 'beforeend');
            } else {
                showButton('.text-box', false, 'beforeend');
            }

            if (sectionNo > 1) {
                $('.previousBtn').show();
            }

            $('.previousBtn').click(function(e) {
                playClickSound();
                goToScreen(sectionNo - 1);
            });

            $('.nextBtn').click(function(e) {
                playClickSound();
                goToScreen(sectionNo + 1);
            });

            // SCORE SCREEN
            if (score !== null) {
                score = JSON.parse(score);
                $('.previousBtn').hide();

                muteUnmute('.text-box');
                mp3 = '/sound/scores/' + score.correct_answers + '.mp3'

                if (wants_to_listen) {
                    speak();
                }

                $('.score-number').text(score.correct_answers + '/' + score.questions_attempted);
                $('.nextBtn').text('SEE CORRECT ANSWERS');
                $('.nextBtn').click(function(e) {
                    correctAnswers();
                });
            }

            // QUESTION SCREEN
            if (introductory.sections[sectionNo + 1] != undefined && introductory.sections[sectionNo + 1].pretest) {
                $('.previousBtn').hide();
                $('.nextBtn').text('START TEST');
                $('.nextBtn').click(function(e) { nextQuestion(sectionNo + 1); });
            }

            // MOVING TO MODULE
            if (Object.keys(introductory.sections).length == sectionNo) {
                $('.previousBtn').hide();
                $('.nextBtn').text('SELECT MODULE');
                $('.nextBtn').unbind();
                $('.nextBtn').click(function(e) {
                    $.get("lms?", function(data, textStatus, jqXHR) {
                            $('body').html(data);
                        },
                        "html"
                    );
                });
            }

            if ((sectionNo >= 1 && sectionNo <= 12)) {
                muteUnmute('.text-box');

                if (sectionNo <= 10) {
                    mp3 = '/sound/introductory/' + sectionNo + '.mp3'

                    if (wants_to_listen) {
                        speak();
                    }
                }
            } else {
                muteUnmute(null);
            }
        }, 1000);

        toggleBox(sectionNo);

        toggleStudent(introductory.sections[sectionNo], function(section) {
            // SWITCHING BACKGROUND IF QUESTION SCREEN
            if (section.pretest) {
                setTimeout(() => {
                    $('#navBtn').hide();
                }, 1000);
                $('.student_sitting').show().animate({ 'right': '2vw' }, 1000);
                $('.table-chair').animate({ 'left': '-200vw' }, 1000);
                $('.door').animate({ 'bottom': '-50vw' }, 1000);
            } else {
                setTimeout(() => {
                    $('#navBtn').show();
                }, 1000);

                $('.student_sitting').animate({ 'right': '-35vw' }, 1000);
                $('.table-chair').animate({ 'left': '0' }, 1000);
                $('.door').animate({ 'bottom': '0' }, 1000);
                if (section.student === "lady") {
                    $('.logo').animate({ 'opacity': '0' }, 1000);
                } else {
                    $('.logo').animate({ 'opacity': '1' }, 1000);
                }
            }
        });
    }
}

function nextQuestion(section) {
    setTimeout(() => {
        $.get("pretest/question", function(data, status) {
            if (status == 'success' && data.next) {
                $('.q-number').attr('id', data.question.id);
                $('.q-number .q-count').text(data.count);
                let html = '<p>' + data.question.question + '</p>';
                html += '<ul class="qustions-wrp">';

                $.each(data.question.mcq_answers, function(index, value) {
                    html += '<li class="clickable" id="' + value.id + '"><span class="option" >' + value.option + '</span><span class="qustions" >' + value.answer + '</span></li>';
                });

                html += '</ul>';

                $("#content").fadeOut(0).html(html).fadeIn(1000);
                $('#content').removeClass('blurred');

                muteUnmute('.text-box');
                load_mp3 = true;
                mp3 = '/sound/mcqs/' + data.question.id + '.mp3';

                if (wants_to_listen) {
                    speak();
                }
            } else {
                $('#content').removeClass('blurred');
                goToScreen(section + 1, data.score || null);
            }

            $('.loader').hide();
        }).then(function(x) {
            $('.clickable').on('click', function(e) {
                stop();
                playClickSound();

                let mcq_answer_id = $(this).attr('id');
                $(this).addClass('active-qustions');

                saveAttempt($('.q-number').attr('id'), mcq_answer_id, section);
            });

            singleColumnByCha(28);
        });
    }, 1000);
}

function saveAttempt(mcq_id, mcq_answer_id, section) {
    $('.loader').show();
    $('#content').addClass('blurred');

    $.ajax({
        type: "POST",
        url: "pretest/attempt",
        data: { 'mcq_id': mcq_id, 'mcq_answer_id': mcq_answer_id },
        dataType: "json",
        success: function(response) {
            if (response.success) {
                nextQuestion(section);
            }
        }
    });
}

function correctAnswers(url) {
    url = url || "pretest/answersheet?page=1&count=9";
    $('.loader').show();
    $('#content').addClass('blurred');

    $.get(url, function(data, textStatus, jqXHR) {
        if (textStatus == "success") {
            let html = '';

            $.each(data.data, function(index, value) {
                html += '<li><span class="qustion"><span class="order-number">' + value.id + '</span> <p>' + value.question + '</p></span><span class="answer green-blue"><p>' + value.mcq_answers[0].option + ': ' + value.mcq_answers[0].answer + '</p></span></li>';
            });

            setTimeout(() => {
                $('.previousBtn').unbind();
                $('.nextBtn').unbind();
                if (data.current_page == data.last_page) {
                    $('.nextBtn').click(function() { goToScreen(14) });
                    $('.previousBtn').click(function(e) { correctAnswers(data.prev_page_url + "&count=9"); });
                } else {
                    if (data.prev_page_url) {
                        $('.previousBtn').show();
                        $('.previousBtn').click(function(e) { correctAnswers(data.prev_page_url + "&count=9"); });
                    } else {
                        $('.previousBtn').hide();
                    }

                    $('.nextBtn').click(function(e) { correctAnswers(data.next_page_url + "&count=9"); });
                }
                $('#content .answer-sheet').fadeOut(0).html(html).fadeIn(1000);
                $('.loader').hide();
                $('#content').removeClass('blurred');
            }, 1000);
        }
    }, "json");
}

function singleColumnByCha(charecters) {
    $('body').find('.screen-frame').removeClass('single-column');

    $(".qustions").each(function() {
        var myStr = $(this).text();

        if ($.trim(myStr).length > charecters) {
            $('body').find('.screen-frame').addClass('single-column')
        }
    });
}

introductory = loadJson('introductory');

if (pretestCompleted) {
    goToScreen(10);
} else {
    goToScreen(1);
}