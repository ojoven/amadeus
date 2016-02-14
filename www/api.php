<?php
// OK, this is a really poor MVC, but come on, it's a front end super simple toy project!

// lib
include "../app/lib/MysqliDb.php";

// env
include "../env.php";

// models
include "../app/models/composer.php";
include "../app/models/composition.php";
include "../app/models/lesson_composer.php";
include "../app/models/lesson_composition.php";
include "../app/models/video.php";

// NO ACTION PROVIDED
if (!isset($_GET['action'])) {
    send_error();
}

// ACTIONS, OUR CONTROLLER
switch ($_GET['action']) {

    case 'loadcomposers':
        $composer = new Composer();
        $data = $composer->loadComposers();
        send_json($data);
        break;

    case 'getnextcomposition':
        $composition = new Composition();
        $data = $composition->getNextComposition();
        send_json($data);
        break;

    default:
        send_error();
}

// AUXILIAR
function send_error() {
    send_json(array('success' => false));
}

function send_json($data) {
    header('Content-Type: application/json');
    echo json_encode($data);
}