$(function() {
    $('body').on('click', '.checkbox label,input:checkbox', function(e) {
        playClickSound();
        $('.nextBtn').attr('disabled', false);
        hideDialog();
    });

    $('body').on('click', '.click_enlarge', function(e) {
        e.preventDefault();
        $('.popup-overlay .content img').attr('src', $(this).data('src'));
        $('.popup-overlay').addClass('show-popup');
    });

    $('.popup-overlay .close').click(function(e) {
        e.preventDefault();
        $('.popup-overlay').removeClass('show-popup');
    });

});

let data = {
    generic: null,
    module: null,
    questions: null,
    totalAttempts: 0,
}

let html = {};
let answerFeedbackBtn = null;

function goTo(moduleID, sectionID) {
    stop();
    moduleID = moduleID || 1;
    sectionID = sectionID || 1;
    data.totalAttempts = 1;
    answerFeedbackBtn = $('<button class="feedback-btn bounce-in animation delay-05s" index="0">NEXT</button>');

    hideDialog();
    updateModuleSection(moduleID, sectionID);

    let section = data.module.sections[sectionID];
    let question = data.questions[section.question];

    $(".intro-box").text(data.module.title);

    setTimeout(() => {

        $('#screen-frame').removeClass().addClass((section.type == 'exercise' ? 'exercise ' : 'screen-frame ') + section.className);
        $("#content").html(section.content);
        typer(100, 1000);
        if (section.buttons != undefined) {
            if (section.buttons.backBtn) {
                $('.previousBtn').text(section.buttons.backBtn);
            }
            $('.nextBtn').text(section.buttons.nextBtn);
        }

        if (section.type == 'narrative') {
            showButton('#content', (section.buttons != undefined && section.buttons.backBtn ? false : true), 'afterend', 'bounce-in animation');
            $('.previousBtn').click(function() {
                currentSection = sectionID;
                goTo(moduleID, sectionID - 1)
            });
            $('.nextBtn').click(function() {
                currentSection = sectionID;
                goTo(moduleID, sectionID + 1)
            });
        } else if (section.type == 'interactive') {
            showButton('#content', (section.buttons != undefined && section.buttons.backBtn ? false : true), 'afterend', 'bounce-in animation');
            $('.nextBtn').text('SUBMIT');
            $('.nextBtn').click(function() {
                stop();
                evaluateQuestion(question, moduleID, sectionID + 1);
            });
            if (data.questions != null && question) {
                setTimeout(() => {
                    $('.text-box').height($('#content').height() + 100);
                }, 100);
                populateQuestion(question, section.question, moduleID, sectionID);
            }
        } else if (section.type == 'exercise') {
            if (data.module.sections[section.previous].type != 'exercise') {
                setTimeout(() => {
                    showButton('.text-box', (section.buttons != undefined && section.buttons.backBtn ? false : true), 'afterend', '');
                    $('.nextBtn').removeClass().addClass('nextBtn circal-next-btn bounce-in animation');
                    $('.nextBtn').click(function() {
                        goTo(moduleID, sectionID + 1);
                    });
                }, 5000);
            } else {
                populateQuestion(question, section.question, moduleID, sectionID);
            }
        }

    }, 1000);

    if (moduleID == 1) {
        module1_UI(section, sectionID);
    }
    toggleStudent(section);
}

function module1_UI(section, sectionID) {
    if (section.type == 'narrative') {
        if (sectionID != 1 || currentSection == 2) {
            if (!$('.text-box').hasClass('zoomIn')) {
                toggleBox(sectionID);
            }
            if (sectionID < 39) {
                if (currentSection < sectionID) {
                    toggleModuleContent('#content', true);
                } else {
                    toggleModuleContent('#content', false);
                }
            }
            if (sectionID <= 2) {
                $('.nextBtn').animate({ 'opacity': '0' }, 500);
                if (sectionID > 1 && sectionID < 39) {
                    setTimeout(() => {
                        $('.logo').animate({ 'opacity': '1' }, 1000);
                    }, 1000);
                } else {
                    $('.logo').animate({ 'opacity': '0' }, 1000);
                }
            }
            if (sectionID == 39) {
                $('.logo').animate({ 'opacity': '0' }, 500);
                $('.user-box').animate({ 'opacity': '0' }, 500);
                setTimeout(() => {
                    $('.user-box').animate({ 'opacity': '1' }, 1000);
                    $('.logo').animate({ 'opacity': '1' }, 1000);
                }, 2000);
                updateTimespentLogs(currentModule, section.type, 'end');
                toggleBox(sectionID);
            }
        } else {
            toggleBox(sectionID);
        }
    } else if (section.type == 'interactive') {
        if (sectionID < 39) {
            $('.user-box').animate({ 'opacity': '0' }, 1000);
            setTimeout(() => {
                $('.user-box').animate({ 'opacity': '1' }, 1000);
            }, 2000);
            $('.logo').animate({ 'opacity': '0' }, 1000);
        }
        if (sectionID > 39) {
            updateTimespentLogs(currentModule, section.type, 'start');
        } else if (sectionID >= Object.keys(data.module.sections).length) {
            updateTimespentLogs(currentModule, section.type, 'end');
        }
        toggleBox(sectionID);
    } else if (section.type == 'exercise') {
        if (data.module.sections[section.previous].type != 'exercise') {
            $('.logo').animate({ 'opacity': '0' }, 1000);
            $('.wall-frames').animate({ 'left': '-35vw' }, 1000);
            $('.table-chair').animate({ 'left': '-200vw' }, 1000);
            $('.door').animate({ 'right': '-5vw', 'bottom': '7vw', 'width': '17vw' }, 1000);
            $('.nursery').fadeOut().delay(2000).fadeIn();

            $('.window').animate({ 'left': '-4.7vw' }, 1000);
            $('.set-lady-student').delay(1000).animate({ 'left': '-7vw' }, 1000);
            $('.lady-patient').animate({ 'right': '40%' }, 1000);
            $('.earth').animate({ 'height': '8vw' }, 1000);

        } else {
            $('.logo').animate({ 'opacity': '0' }, 1000);
            $('.wall-frames').animate({ 'left': '-35vw' }, 1000);
            $('.table-chair').animate({ 'left': '-200vw' }, 1000);
            $('.door').animate({ 'bottom': '-50vw' }, 1000);

            $('.window').animate({ 'left': '-20vw' }, 1000);
            $('.set-lady-student').animate({ 'left': '-45vw' }, 1000);
            $('.lady-patient').animate({ 'right': '-15%' }, 1000);
            $('.earth').animate({ 'height': '0vw' });
            $('.nursery').fadeOut();
            $('.nextBtn').fadeOut();
        }
        $('.text-box .border-bottom:first').hide();
        toggleBox(sectionID);
    }
}

function populateQuestion(question, qNo, moduleID, sectionID) {
    muteUnmute('.text-box')
    mp3 = '/sound/modules/1/questions/m1q' + qNo + '.mp3'

    if (wants_to_listen) {
        setTimeout(function() {
            speak();
        }, 1000);
    }

    if (question.type == 'checkbox') {
        $('#content #question-title p').text(question.text);
        let optionList = '';
        $.each(question.options, function(index, value) {
            optionList += '<li class="checkbox">';
            optionList += '<input type="checkbox" id="option-' + value.id + '" data-index="' + value.id + '" data-correct="' + value.correct + '" data-feedback="' + value.feedback + '" name="option_' + value.id + '">';
            optionList += '<label for="option-' + value.id + '">' + value.text + '</label>';
            optionList += '<div class="check"></div>';
            optionList += '</li>';
        });
        $('#content #options-list').html(optionList);
    }
    if (question.type == 'button') {
        $('#content .qustion-area p').text(question.text);
        let optionList = generateButtons(question);
        $('#content .qustion-area p').after(optionList);
    }
}

function evaluateQuestion(question, moduleID, sectionID) {
    if (question.type == 'checkbox') {
        evaluateCheckbox(question.maxTries, { correctFeedback: question.correctFeedback, incorrectFeedback: question.incorrectFeedback },
            function(inCorrectOptions) {
                inCorrectOptions.forEach(element => {
                    element.disabled = true;
                });
                $('.nextBtn').unbind();
                $('.nextBtn').click(function() { goTo(moduleID, sectionID) });
                setTimeout(() => {
                    $('.nextBtn').text("NEXT");
                    $('.nextBtn').attr('disabled', false);
                }, 1000);
            })
    }
}

function generateButtons(question) {
    let buttons = [];
    $.each(question.options, function(index, value) {
        let button = $('<button id="option-' + value.id + '" data-index="' + value.id + '" data-correct="' + value.correct + '" data-feedback="' + value.feedback + '" name="option_' + value.id + '">' + value.text + '</button>');
        button.click(function(e) {
            evaluateButtons(question, this);
        });
        buttons.push(button);
    });
    $('.buttons').remove();
    return $('<div class="buttons"></div>').append(buttons);
}

function evaluateButtons(question, element) {
    if ($(element).data('correct')) {
        if (question.subQuestion !== undefined) {
            $('#content .qustion-area p').text(question.subQuestion.text);
            let optionList = generateButtons(question.subQuestion);
            $('#content .qustion-area p').after(optionList);
        }
    } else {
        showDialog(question.incorrectFeedback);
    }
}

function evaluateCheckbox(maxTries, feedback, callback) {
    let checkedOptions = [],
        correctChecked = [],
        inCorrectChecked = [],
        missingChecked = [],
        correctOptions = [],
        inCorrectOptions = [];

    $.each($('#options-list .checkbox input:checkbox'), function(index, option) {
        if ($(option).is(':checked')) {
            checkedOptions.push(option);

            if ($(option).data('correct')) {
                correctChecked.push(option);
            } else {
                inCorrectChecked.push(option);
            }
        } else {
            if ($(option).data('correct')) {
                missingChecked.push(option);
            }
        }

        if ($(option).data('correct')) {
            correctOptions.push(option);
        } else {
            inCorrectOptions.push(option);
        }
    });

    if (checkedOptions.length == 0) {
        showDialog(data.generic.noSelectionFeedbackText);
        $('.nextBtn').attr('disabled', true);
        data.totalAttempts -= 1;
    }

    if (maxTries > data.totalAttempts) {
        if (checkedOptions.length != 0) {
            showFeedback(inCorrectChecked, true, function(nodes) {
                nodes.forEach(node => {
                    node.checked = false;
                    $(node).closest('li').removeClass('border-red');
                });
                correctChecked.forEach(node => {
                    node.checked = false;
                    $(node).closest('li').removeClass('border-green');
                });
            });

            if (correctOptions.length > checkedOptions.length) {
                showDialog(data.generic.missingFeedbackText);
            }

            if (correctOptions.length < checkedOptions.length) {
                showDialog(data.generic.extraFeedbackText);
            }

            if (correctOptions.length == checkedOptions.length) {
                showDialog(feedback.incorrectFeedback);
            }
            if (correctOptions.length > checkedOptions.length || correctOptions.length < checkedOptions.length || correctOptions.length == checkedOptions.length) {
                $.each(checkedOptions, function(index, option) {
                    $(option).parent('li').addClass($(option).data('correct') ? 'border-green' : 'border-red');
                });
            }
        }
    } else {
        if (inCorrectChecked.length > 0 || correctChecked.length != correctOptions.length) {
            showFeedback(correctOptions, true);
            showDialog(data.generic.maxAttemptsExceedText);

            $.each(correctOptions, function(index, option) {
                $(option).parent('li').addClass('border-green');
            });
            // $.each(inCorrectOptions, function (index, option) {
            //   $(option).parent('li').addClass('border-red');
            // });
        }
    }

    if (correctOptions.length == correctChecked.length && inCorrectChecked.length == 0) {
        setTimeout(function() {
            mp3 = '/sound/modules/good_work.mp3'

            if (wants_to_listen) {
                speak();
            }
        }, 1000);
        showFeedback([], true);
        showDialog(feedback.correctFeedback);
        callback(inCorrectOptions);
    }

    data.totalAttempts += 1;
}

data.generic = loadJson('generic');
data.module = loadJson('modules', 1);
data.questions = loadJson('questions', 1);
html['narrative'] = loadHtml('narrative');
html['interactive'] = loadHtml('interactive');

goTo(currentModule, currentSection);