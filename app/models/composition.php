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
        $data['composition'] = $composition;
        $data['success'] = true;
        return $data;

    }

    public function getRandomCompositionConsideringRelevance() {

        $composerModel = new Composer();
        $videoModel = new Video();
        $lessonCompositionModel = new LessonComposition();
        $lessonComposerModel = new LessonComposer();

        $composition['composition'] = $this->getRandomComposition();
        $composerId = $composition['composition']['composer_id'];
        $compositionId = $composition['composition']['id'];

        $composition['videos'] = $videoModel->getVideosComposition($compositionId);
        $composition['composer'] = $composerModel->getComposer($composerId);
        $composition['lessons']['composer'] = $lessonComposerModel->getLessonsComposer($composerId);
        $composition['lessons']['composition'] = $lessonCompositionModel->getLessonsComposition($compositionId);

        return $composition;

    }

    public function getRandomComposition() {

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