<?php
include 'simple_html_dom.php';

getCompositions();

function getCompositions() {

    $composers = getListComposers();

    foreach ($composers as $composer) {

        // We first save the HTMLs of the search "[composer] + compositions"
        saveHtmlSearchComposerCompositions($composer);

        // Once saved, we extract the compositions
        extractCompositionsFromSearchHtmls($composer);

    }

}

function extractCompositionsFromSearchHtmls($composer) {

    $saveHtmlFilePath = getHtmlFilePathSearchCompositions($composer);
    $html = str_get_html(file_get_contents($saveHtmlFilePath));

    foreach ($html->find('._G0d') as $span) {

            echo trim(ltrim($span->plaintext, ',')) . PHP_EOL;

    }

}

function saveHtmlSearchComposerCompositions($composer) {

    echo PHP_EOL . "Retrieving HTML search for '" . $composer . "'" . PHP_EOL . "-------------" . PHP_EOL;
    $composerSearch = getSlugComposerEncoded($composer);
    $saveHtmlFilePath = getHtmlFilePathSearchCompositions($composer);
    if (file_exists($saveHtmlFilePath)) {
        return;
    }

    $urlSearch = "https://www.google.es/search?q=" . $composerSearch . "+compositions";
    $htmlSearch = file_get_contents($urlSearch);
    $htmlSearch = utf8_encode($htmlSearch);

    file_put_contents($saveHtmlFilePath, $htmlSearch);

    sleep(5); // To avoid being banished, just prevention

}

function getHtmlFilePathSearchCompositions($composer) {

    $composerSearch = getSlugComposerEncoded($composer);
    $saveHtmlFile = "../data/searchHtmls/" . $composerSearch . ".html";
    return $saveHtmlFile;
}

function getSlugComposerEncoded($composer) {
    return urlencode(strtolower(trim($composer)));
}

function getListComposers() {

    $composers = array();
    $filePath = "../data/composers";
    $handle = fopen($filePath, "r");
    if ($handle) {
        while (($line = fgets($handle)) !== false) {
            array_push($composers, trim($line));
        }

        fclose($handle);
    }

    return $composers;

}