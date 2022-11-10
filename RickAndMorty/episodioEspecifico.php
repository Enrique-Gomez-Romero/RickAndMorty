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
    <title>Document</title>
</head>

<body>
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
            <div class="col-12 d-flex justify-content-center flex-wrap justify-content-around mt-2">
                <?php
                $capitulo = 42;
                //curl 
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "https://rickandmortyapi.com/api/episode/" . $capitulo);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                $response = curl_exec($ch);
                curl_close($ch);

                //json
                $data = json_decode($response, true);

                //mostrar un solo episodio seleccionado
                echo "<center>";
                echo $data['name'];
                echo "<br>";
                echo $data['episode'];
                echo "<br>";
                echo $data['air_date'];
                echo "<br>";
                echo $data['created'];
                echo "</center>"; 
                
                //traer los personajes del episodio
                $results = $data['characters'];
                //mostrar todos los episodios
                foreach ($results as $result) {
                    //echo "<center>";
                    // echo $result;
                    //traer los personajes del episodio
                    $chPersonaje = curl_init();
                    curl_setopt($chPersonaje, CURLOPT_URL, $result);
                    curl_setopt($chPersonaje, CURLOPT_RETURNTRANSFER, TRUE);
                    $responsePersonaje = curl_exec($chPersonaje);
                    curl_close($chPersonaje);
                    //Json del personaje
                    $dataPersonaje = json_decode($responsePersonaje, true);
                    //Imprimir el personaje
                    echo "<div class='col-12 col-md-6 col-lg-3 col-xl-4 d-flex justify-content-center flex-wrap justify-content-around'>
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
                //mostrarme todos los episodios
                //mostrar todos los episodios
/*                 foreach($results as $result){
                    echo "<center>";
                    echo $result['name'];
                    echo "<br>";
                    echo $result['id'];
                    echo "<br>";
                    echo $result['air_date'];
                    echo "<br>";
                    echo $result['episode'];
                    echo "</center>";
                } */
                ?>
            </div>
        </div>
    </div>
</body>

</html>