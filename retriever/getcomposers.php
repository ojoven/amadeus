<?php
include '../env.php';
include 'lib/simple_html_dom.php';
include 'lib/MysqliDb.php';
include 'lib/functions.php';

insertCompositionsOnDB();

function insertCompositionsOnDB() {

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