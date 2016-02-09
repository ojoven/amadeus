<?php
include 'lib/simple_html_dom.php';
include 'lib/MysqliDb.php';

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
            getWikipediaPageForComposition($composition);
        }

    }

}

function getWikipediaPageForComposition($composition) {

    $languages = array('es', 'en');
    foreach ($languages as $language) {

        // First we have to retrieve
        $urlSearchEn = "https://" . $language . ".wikipedia.org/w/api.php?action=query&list=search&srsearch=" . $composition . "&utf8=&format=json";
        $data = getContentFromUrlJson($urlSearchEn);

        //$urlSearch = "https://" . $language . ".wikipedia.org/w/api.php?action=opensearch&search=" . $composition . "&limit=1&namespace=0&format=json";
        print_r($data);
    }


}

function getContentFromUrlJson($url) {

    $json = file_get_contents($url);
    $result = json_decode($json, true);
    return $result;

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

function extractCompositionsFromSearchHtmls($composer) {

    $compositions = array();
    $saveHtmlFilePath = getHtmlFilePathSearchCompositions($composer);
    $html = str_get_html(file_get_contents($saveHtmlFilePath));

    foreach ($html->find('._G0d') as $span) {

        $composition = trim(ltrim($span->plaintext, ','));
        echo $composition . PHP_EOL;
        array_push($compositions, $composition);

    }

    return $compositions;

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