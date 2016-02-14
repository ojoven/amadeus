<?php
// COMPOSITION MODEL
include "../lib/MysqliDb.php";
include "../../env.php";

class Composition {

    protected $db;

    public function __construct() {
        $this->db = new MysqliDb(HOST, USER, PASSWORD, DBNAME);
    }

    public function getNextComposition() {

        $composition = $this->getRandomCompositionConsideringRelevance();

    }

    public function getRandomCompositionConsideringRelevance() {

        $composition = $this->getJustRandomComposition();

    }

    public function getJustRandomComposition() {

        $numCompositions = $this->getTotalNumberCompositions();
        $randCompositionIndex = rand(0, $numCompositions - 1);

        // At first, we'll get just random composition
        $query = "SELECT * FROM compositions LIMIT " . $randCompositionIndex . ", 1";
        $compositions = $this->db->query($query);
        $randomComposition = $compositions[0];
        return $randomComposition;

    }

    public function getTotalNumberCompositions() {

        $query = "SELECT count(*) as numComposers FROM compositions";
        $numComposersRow = $this->db->query($query);
        $numComposers = $numComposersRow[0]['numComposers'];
        return $numComposers;

    }


}