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
  <title>Home</title>
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
  <div class="container">
    <div class="row d-flex justify-content-center flex-wrap justify-content-around">
      <div class="col-9 d-flex justify-content-center flex-wrap justify-content-around mt-2">
        <?php
        $capitulo = 1;
        //curl 
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://rickandmortyapi.com/api/episode/" . $capitulo);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($ch);
        curl_close($ch);

        //json
        $data = json_decode($response, true);

        //traer los personajes del episodio
        $results = $data['characters'];
        foreach ($results as $result) {
          //traer los personajes del episodio
          $chPersonaje = curl_init();
          curl_setopt($chPersonaje, CURLOPT_URL, $result);
          curl_setopt($chPersonaje, CURLOPT_RETURNTRANSFER, TRUE);
          $responsePersonaje = curl_exec($chPersonaje);
          curl_close($chPersonaje);
          //Json del personaje
          $dataPersonaje = json_decode($responsePersonaje, true);
          echo "<div class='col-12 col-md-6 col-lg-4 col-xl-4 d-flex justify-content-center flex-wrap justify-content-around'>
            <div class='card mb-3'>
              <img src=" . $dataPersonaje['image'] . " class='card-img-top'>
                <div class='card-body'>
                  <h5 class='card-title'>'" . $dataPersonaje['name'] . "'</h5>
                  <p class='card-text'>Estatus: '" . $dataPersonaje['status'] . "'</p>
                  <p class='card-text'>Especie: '" . $dataPersonaje['species'] . "'</p>
                  <p class='card-text'>Genero: '" . $dataPersonaje['gender'] . "'</p>
                </div>
              </div>   
            </div>";
        }
        ?>
      </div>
      <div class="col-12 col-md-6 col-lg-4 col-xl-3 mt-2">
        <div class="text-center border border-dark border-5 ">
          <p class="fs-2">Personajes Aleatorios</p>
        </div>
        <?php
        //3 personajes aleatorios en tarjetas 
        $url = "https://rickandmortyapi.com/api/character";
        $json = file_get_contents($url);
        $data = json_decode($json, true);
        $results = $data['results'];
        $characters = array_rand($results, 3);

        foreach ($characters as $character) {

          echo "<div class='border border-dark border-5'>
                        <div class='card mb-3'>
                            <img src=" . $results[$character]['image'] . " class='card-img-top'>
                            <div class='card-body'>
                                <h5 class='card-title'>'" . $results[$character]['name'] . "'</h5>
                                <p class='card-text'>Estatus: '" . $results[$character]['status'] . "'</p>
                                <p class='card-text'>Especie: '" . $results[$character]['species'] . "'</p>
                                <p class='card-text'>Genero: '" . $results[$character]['gender'] . "'</p>
                            </div>
                        </div>
                    </div>";
        }
        ?>
      </div>
    </div>
  </div>
</body>

</html>