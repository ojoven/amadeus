// DOM VARS
var $lessonsDropdown = $("#lessons")

// LOGIC
$(function() {

    loadComposersOnLessonsDropdownOnPageLoad();


});

// FUNCTIONS
function loadComposersOnLessonsDropdownOnPageLoad() {


    $.ajax({
        type: "GET",
        dataType: "JSON",
        url: "/api.php?action=loadcomposers"
    }).done(function (data) {

        if (!data.success) {
            alert('WTF!'); // no special error handling, just a friendly alert ;)
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
