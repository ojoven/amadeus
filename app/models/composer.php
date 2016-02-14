<?php
// COMPOSER MODEL
include "../lib/MysqliDb.php";
include "../../env.php";

class Composer {

    protected $db;

    public function __construct() {
        $this->db = new MysqliDb(HOST, USER, PASSWORD, DBNAME);
    }

    // Single
    public function getComposer($composerId) {

        $query = "SELECT * FROM composers WHERE id = " . $composerId;
        $composers = $this->db->query($query);
        return (isset($composers[0])) ? $composers[0] : false;

    }

    // List
    public function loadComposers() {

        $query = "SELECT * FROM composers";
        $composers = $this->db->query($query);

        if (!empty($composers)) {
            $data['success'] = true;
            $data['composers'] = $composers;
        } else {
            $data['success'] = false;
        }

        return $data;

    }

}

