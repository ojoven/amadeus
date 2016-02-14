<?php
// VIDEO MODEL
include "../lib/MysqliDb.php";
include "../../env.php";

class Video {

    protected $db;

    public function __construct() {
        $this->db = new MysqliDb(HOST, USER, PASSWORD, DBNAME);
    }

    public function getVideosComposition($compositionId) {

        $query = "SELECT * FROM videos WHERE composition_id = " . $compositionId;
        $videos = $this->db->query($query);
        return $videos;

    }

}