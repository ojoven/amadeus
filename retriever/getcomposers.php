<?php
include '../env.php';
include 'lib/simple_html_dom.php';
include 'lib/MysqliDb.php';

insertComposersOnDB();

function insertComposersOnDB() {

    $composers = getListComposers();

    foreach ($composers as $index=>$composer) {

        $slug = getSlugComposer($composer);
        $relevance = $index + 1;

        $db = new MysqliDb(HOST, USER, PASSWORD, DBNAME);

        $query = "INSERT INTO `composers`(`slug`,`name`,`relevance`)";
        $query .= " VALUES ('" . $slug . "','" . $composer . "','" . $relevance . "');";

        echo $query . PHP_EOL;
        $db->rawQuery($query);

    }

}

function getSlugComposer($composer) {
    $composer = trim($composer);
    $composer = strtolower($composer);
    $composer = str_replace(' ', '_',$composer);
    $composer = str_replace('-', '_',$composer);
    return $composer;
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