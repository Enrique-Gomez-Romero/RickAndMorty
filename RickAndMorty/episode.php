<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="recursos/css/style.css">
    <link rel="stylesheet" href="recursos/css/bootstrap.min.css">
    <script src="recursos/js/bootstrap.bundle.js"></script>
    <link rel="shortcut icon" href="recursos/img/Rick_and_Mortysaaa.png" />
    <title>Capitulos</title>
</head>
<body style="background-image: url(recursos/img/fondito.jpg); background-size: cover;">
<header class="text-center sticky-top">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">
                    <img src="recursos/img/Among-Us.png" alt="Logo Rick_and_Morty" class="img-fluid rick" width="50">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link fs-5" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-5" href="episode.php?page=1">Capítulos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-5" href="personajes.php?page=1">Personajes</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="container">
        <div class="row">
                <?php
                $page = 1;
                if (isset($_GET['page'])) {
                    $page = $_GET['page']; 
                    //curl
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, "https://rickandmortyapi.com/api/episode?page=" . $page);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                    $response = curl_exec($ch);
                    curl_close($ch);

                    $data = json_decode($response, true);
                    $episodios = $data['results'];

                    foreach ($episodios as $episodios) {
                        echo "<div class='col-12 col-md-6 col-lg-4 col-xl-3 mt-5'>
                        <div class='card mb-3 border border-success border-5'>
                            <img src='recursos/img/portal.png' alt='Cargando imagen...'>
                                <div class='card-body text-break'>
                                    <h5 class='card-title'>'" . $episodios['name'] . "'</h5>
                                    <p class='card-text'>Episode:'" . $episodios['episode'] . "'</p>
                                    <p class='card-text'>Air date:'" . $episodios['air_date'] . "'</p>
                                    <p class='card-text'>Created: '" . $episodios['created'] . "'</p>
                                    <p class='card-text'>ID: '" . $episodios['id'] . "'</p>
                                </div>
                                <a href='episodioEspecifico.php?id=" . $episodios['id'] . "' class='rounded rounded-0 btn btn-success'>Ver Personajes Del Capitulo:'" . $episodios['name'] . "'</a>
                            </div>
                        </div>"; 
                    }
                }
                $pages = $data['info']['pages'];
                ?>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-center flex-wrap justify-content-around mt-2">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <?php
                        for ($i = 1; $i <= $pages; $i++) {
                            echo "<li class='page-item'><a class='page-link' href='episode.php?page=$i'>$i</a></li>";
                        }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <footer class="text-center">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p class="text-white">© 2021 Rick and Morty</p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>