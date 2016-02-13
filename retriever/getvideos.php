<?php
include '../env.php';
include '../vendor/autoload.php';
include 'lib/functions.php';

$db = new MysqliDb(HOST, USER, PASSWORD, DBNAME);

$client = new Google_Client();
$client->setApplicationName("Amadeus");
$client->setDeveloperKey(YOUTUBE_API_KEY);

$compositions = getListCompositionsDb();
$compositions = array_slice($compositions, 0, 10);

foreach ($compositions as $composition) {

    $maxResults = 25;
    $youtube = new Google_Service_YouTube($client);
    $searchResponse = $youtube->search->listSearch('id,snippet', array(
        'q' => $composition['composition'] . " " . $composition['composer'],
        'maxResults' => $maxResults,
        'type' => 'video',
        'order' => 'relevance',
        'videoEmbeddable' => 'true'
    ));

    foreach ($searchResponse as $index=>$result) {

        $relevance = $index + 1;

        $videoId = $result->getId()->getVideoId();
        $videoTitle = $result->getSnippet()->getTitle();
        $videoDescription = $result->getSnippet()->getDescription();

        $query = "INSERT INTO `videos`(`composition_id`,`youtube_id`,`title`,`description`,`relevance` )";
        $query .= " VALUES ('" . $composition['id'] . "','" . $videoId . "','" . escapeSingleQuote($videoTitle)
            . "','" . escapeSingleQuote($videoDescription) . "','" . $relevance . "');";

        $db->rawQuery($query);

    }

    echo "Inserting videos for " . $composition['composition'] . PHP_EOL;
    sleep(1); // To avoid having problems with YouTube API quota limit

}
