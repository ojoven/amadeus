<?php
// LESSON COMPOSER MODEL
include "../lib/MysqliDb.php";
include "../../env.php";

class LessonComposer {

    protected $db;

    public function __construct() {
        $this->db = new MysqliDb(HOST, USER, PASSWORD, DBNAME);
    }

    public function getLessonsComposer($composerId) {

        $query = "SELECT * FROM lessons_composers WHERE composer_id = " . $composerId;
        $lessons = $this->db->query($query);
        return $lessons;

    }

}