<?php
include "../../env.php";

function query_select() {

    $db = new MysqliDb(HOST, USER, PASSWORD, DBNAME);
    $query = "INSERT INTO `composers`(`slug`,`name`,`relevance`)";

}