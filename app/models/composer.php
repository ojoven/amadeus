<?php
// COMPOSER MODEL
// NOT OO, at this moment
include "../lib/MysqliDb.php";
include "../../env.php";

function loadComposers() {

    $db = new MysqliDb(HOST, USER, PASSWORD, DBNAME);
    $query = "SELECT * FROM composers";
    $composers = $db->query($query);

    if (!empty($composers)) {
        $data['success'] = true;
        $data['composers'] = $composers;
    } else {
        $data['success'] = false;
    }

    return $data;

}