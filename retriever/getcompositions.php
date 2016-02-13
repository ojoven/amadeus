<?php
include 'lib/simple_html_dom.php';
include 'lib/MysqliDb.php';
include 'lib/functions.php';

getCompositions();

function getCompositions() {

    $composers = getListComposers();
    $composers = array_slice($composers, 0, 2);

    foreach ($composers as $composer) {

        // We first save the HTMLs of the search "[composer] + compositions"
        saveHtmlSearchComposerCompositions($composer);

        // Once saved, we extract the compositions
        $compositions = extractCompositionsFromSearchHtmls($composer);
        $compositions = array_slice($compositions, 0, 1);

        // For each composition, let's try to retrieve the info from Wikipedia
        foreach ($compositions as $composition) {
            // TODO: THIS IS NOT DONE!
            getWikipediaPageForComposition($composition);
        }

    }

}