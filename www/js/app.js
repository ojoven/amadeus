// DOM VARS
var $lessonsDropdown = $("#lessons"),
    $toPlayLesson = $("#to-play-lesson"),
    $lessonLoader = $("#lesson-loader");

// LOGIC
$(function() {

    loadComposersOnLessonsDropdownOnPageLoad();
    toPlayLessonManagement();

});

// FUNCTIONS
function loadComposersOnLessonsDropdownOnPageLoad() {

    $.ajax({
        type: "GET",
        dataType: "JSON",
        url: "/api.php?action=loadcomposers",
        statusCode: {
            500: function() {
                alertError('Ooops! Problems!');
            }
        }
    }).done(function (data) {

        if (!data.success) {
            alertError('Ooops! Problems!');
        }

        // We remove the loading option from the select
        $lessonsDropdown.find('.loading').remove();

        var composers = data.composers;
        composers.forEach(function(composer) {
            var composerOption = '<option value="' + composer.slug +  '">' + composer.name + '</option>';
            $lessonsDropdown.append(composerOption);
        });

    });

}

function toPlayLessonManagement() {

    $toPlayLesson.off().on('click', function() {
        playNextLesson();
    });

}

function playNextLesson() {

    showLoaderLesson();
    loadLesson();

}

function showLoaderLesson() {

    $toPlayLesson.hide();
    $lessonLoader.show();


}

// AUXILIARS
function alertError(message) {
    alert(message); // no special error handling, just a friendly alert ;)
}