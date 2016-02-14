// DOM VARS
var $lessonsDropdown = $("#lessons"),
    $toPlayComposition = $("#to-play-composition"),
    $compositionLoader = $("#composition-loader"),
    $compositionContent = $("#composition-content"),
    $compositionTitle = $("#composition-title"),
    $composerName = $("#composer-name"),
    $videoProgress = $("#video-progress"),
    $toPauseVideo = $("#to-pause-video"),
    $toPlayVideo = $("#to-play-video"),
    $toNextVideo = $("#to-next-video"),
    $toReloadVideo = $("#to-reload-video");

// Other VARS
var player,
    playerLoaded = false,
    videoDuration;

// LOGIC
$(function() {

    // Composers
    loadComposersOnLessonsDropdownOnPageLoad();

    // Main Play Composition
    toPlayCompositionManagement();

    // Auxiliars
    loadYouTubeIframeAPI();

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

        var composition = data.composition;

        // We hide the loader
        $compositionLoader.hide();

        // Show the content
        $compositionContent.show();

        $compositionTitle.html(composition.composition.name);
        $composerName.html(composition.composer.name);

        loadVideoComposition(composition);

    });

}

function loadVideoComposition(composition) {

    if (playerLoaded) player.destroy(); // We destroy previous player

    player = new YT.Player('player', {
        height: '390',
        width: '640',
        videoId: composition.videos[0].youtube_id,
        events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
        }
    });

}

function progressBar() {

    interval = window.setInterval(function(){
        $videoProgress.css('left',
            ((player.getCurrentTime()/videoDuration)*100)+'%'
        );

    },1000);

}

function onPlayerReady(event) {

    // We've loaded a player
    playerLoaded = true;

    // Automatically play video
    event.target.playVideo();

    // Get Video Duration
    videoDuration = player.getDuration();

    // Progress Bar
    progressBar();

    // Video Controls
    videoControlsManagement();
}

// YOUTUBE
function loadYouTubeIframeAPI() {

    var tag = document.createElement('script');
    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

}


var done = false;
function onPlayerStateChange(event) {
    if (event.data == YT.PlayerState.PLAYING && !done) {
        //setTimeout(stopVideo, 6000);
        done = true;
    }
}

function stopVideo() {
    player.stopVideo();
}

function pauseVideo() {
    player.pauseVideo();
}

function playVideo() {
    player.playVideo();
}

function reloadVideo() {
    player.seekTo(0);
}

function videoControlsManagement() {

    $toPauseVideo.off().on('click', function() {
        pauseVideo();
        $toPlayVideo.show();
        $toPauseVideo.hide();
        return false;
    });

    $toPlayVideo.off().on('click', function() {
        playVideo();
        $toPlayVideo.hide();
        $toPauseVideo.show();
        return false;
    });

    $toReloadVideo.off().on('click', function() {
        reloadVideo();
        return false;
    });

    $toNextVideo.off().on('click', function() {
        playNextComposition();
        return false;
    });

}

// AUXILIARS
function alertError(message) {
    alert(message); // no special error handling, just a friendly alert ;)
}