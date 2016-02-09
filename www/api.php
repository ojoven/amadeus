<?php
// OK, this is a really poor MVC, but come on, it's a front end super simple toy project!

// lib
include "../app/lib/MysqliDb.php";

// env
include "../env.php";

// models
include "../app/models/composer.php";
include "../app/models/composition.php";

// NO ACTION PROVIDED
if (!isset($_GET['action'])) {
    send_error();
}

// ACTIONS, OUR CONTROLLER
switch ($_GET['action']) {

    case 'loadcomposers':
        $data = loadComposers();
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