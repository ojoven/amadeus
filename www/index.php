<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Amadeus - Aprende Música Clásica</title>
    <meta name="description" content="Aprende música clásica mientras escuchas las grandes obras de los grandes compositores.">
    <meta name="author" content="SitePoint">
    <link href='https://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/css/style.css?v=1.0">

    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>

<body>

    <header id="main-header">
        <h1>Amadeus</h1>
        <span class="subtitle">Aprende Música Clásica</span>
    </header>
    <main id="main">

        <section id="lecture">
            <span class="title">Lección</span>
            <select id="lessons">
                <option value="all" selected>Todos los Compositores (Top 50)</option>
                <option disabled role=separator>O elige un compositor...</option>
                <option disabled class="loading">Cargando compositores...</option>
            </select>
        </section>

        <section id="play">

            <a href="#" id="to-play-composition">
                <img class="play-icon" src="/img/icon_play.svg" alt="Play icon">
            </a>

            <img id="composition-loader" src="/img/loading.svg" alt="Loader">


            <section id="composition-content">

                <div id="intro-card" class="card">
                    <div class="title">Ahora está sonando...</div>
                    <div class="body">
                        <a href="#" id="composition-title" class="learn-option"></a>
                        <a href="#" id="composer-name" class="learn-option"></a>
                    </div>
                </div>

                <div id="video-container">
                    <div id="player"></div>

                    <div id="video-controls">

                        <div id="options">

                            <a class="option" id="to-play-video" href="#"><i></i></a>
                            <a class="option" id="to-pause-video" href="#"><i></i></a>
                            <a class="option" id="to-reload-video" href="#"><i></i></a>
                            <a class="option" id="to-next-video" href="#"><i></i></a>

                        </div>

                        <div class="progress-wrap progress">
                            <div id="video-progress" class="progress-bar progress"></div>
                        </div>
                    </div>
                </div>


            </section>

            <!--
            <section id="composition-content" hidden>

                <ul class="tabs">

                    <li>Video</li>
                    <li>Composer</li>
                    <li>Composition</li>

                </ul>

                <div class="main-content">

                    <div id="video"></div>

                    <div id="composer"></div>

                    <div id="composition"></div>

                </div>
                <div id="player"></div>

            </section>
            -->

        </section>

    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="js/app.js"></script>
</body>
</html>