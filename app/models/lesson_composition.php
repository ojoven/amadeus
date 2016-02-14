<?php
// LESSON COMPOSITION MODEL
include "../lib/MysqliDb.php";
include "../../env.php";

class LessonComposition {

    protected $db;

    public function __construct() {
        $this->db = new MysqliDb(HOST, USER, PASSWORD, DBNAME);
    }

    public function getLessonsComposition($compositionId) {

        $query = "SELECT * FROM lessons_compositions WHERE composition_id = " . $compositionId;
        $lessons = $this->db->query($query);
        return $lessons;

    }

}