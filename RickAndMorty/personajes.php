<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="recursos/css/style.css">
    <link rel="stylesheet" href="recursos/css/bootstrap.min.css">
    <script src="recursos/js/bootstrap.bundle.js"></script>
    <link rel="shortcut icon" href="recursos/img/Rick_and_Mortysaaa.png"/>
    <title>Document</title>
</head>

<body style="background-image: url(recursos/img/fondito.jpg);">
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
                            <a class="nav-link fs-5" href="episodios.php">Capítulos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-5" href="personajes.php?page=1">Personajes</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="text-center text-white">
        <p class="fs-2">Todos Los Personajes</p>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-center flex-wrap justify-content-around mt-2">
                <?php
                $page = 1;
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, "https://rickandmortyapi.com/api/character/?page=".$page);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                    $response = curl_exec($ch);
                    curl_close($ch);

                    //traer a todos los personajes de la pagina 1
                    $data = json_decode($response, true);
                    $results = $data['results'];
                    foreach ($results as $result) {
                        echo "<div class='col-3 d-flex justify-content-center flex-wrap justify-content-around'>
                            <div class='card mb-3 text-break'>
                                <img src=" . $result['image'] . " class='card-img-top'>
                                <div class='card-body text-break'>
                                    <h5 class='card-title text-break'>'" . $result['name'] . "'</h5>
                                    <p class='card-text'>Estatus: '" . $result['status'] . "'</p>
                                    <p class='card-text'>Especie: '" . $result['species'] . "'</p>
                                    <p class='card-text'>Genero: '" . $result['gender'] . "'</p>
                                </div>
                            </div>   
                        </div>";
                    }
                }

                $pages = $data['info']['pages'];
                ?>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-center flex-wrap justify-content-around mt-2">
                <nav aria-label="Page navigation example">
                    <ul class="pagination d-flex justify-content-center flex-wrap">
                        <?php
                        for ($i = 1; $i <= $pages; $i++) {
                            echo "<li class='page-item'><a class='page-link' href='personajes.php?page=" . $i . "'>" . $i . "</a></li>";
                        }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</body>
</html>