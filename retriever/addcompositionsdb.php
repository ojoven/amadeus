<?php
include '../env.php';
include 'lib/simple_html_dom.php';
include 'lib/MysqliDb.php';
include 'lib/functions.php';

insertComposersOnDB();

function insertComposersOnDB() {

    $db = new MysqliDb(HOST, USER, PASSWORD, DBNAME);
    $composers = getListComposersDb();

    foreach ($composers as $index=>$composer) {

        $compositions = extractCompositionsFromSearchHtmls($composer['name']);

        foreach ($compositions as $composition) {

            echo "Inserting " . $composition . "..." . PHP_EOL;
            $relevance = $index + 1;

            $query = "INSERT INTO `compositions`(`composer_id`,`name`,`relevance`)";
            $query .= " VALUES ('" . $composer['id'] . "','" . escapeSingleQuote($composition) . "','" . $relevance . "');";

            $db->rawQuery($query);

        }

    }

}