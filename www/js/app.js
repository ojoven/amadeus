// DOM VARS
var $lessonsDropdown = $("#lessons"),
    $toPlayComposition = $("#to-play-composition"),
    $compositionLoader = $("#composition-loader");

// LOGIC
$(function() {

    loadComposersOnLessonsDropdownOnPageLoad();
    toPlayCompositionManagement();

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

function toPlayCompositionManagement() {

    $toPlayComposition.off().on('click', function() {
        playNextComposition();
        return false;
    });

}

function playNextComposition() {

    showLoaderComposition();
    loadComposition();

}

function showLoaderComposition() {

    $toPlayComposition.hide();
    $compositionLoader.show();

}

function loadComposition() {

    $.ajax({
        type: "GET",
        dataType: "JSON",
        url: "/api.php?action=getnextcomposition",
        statusCode: {
            500: function() {
                alertError('Ooops! Problems!');
            }
        }
    }).done(function (data) {

        if (!data.success) {
            alertError('Ooops! Problems!');
        }

        // We hide the loader
        $compositionLoader.hide();

        console.log(data.composition);

    });

}

// AUXILIARS
function alertError(message) {
    alert(message); // no special error handling, just a friendly alert ;)
}