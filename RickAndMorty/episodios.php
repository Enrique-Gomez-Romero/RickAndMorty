<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $capitulo = 10;
    //curl 
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://rickandmortyapi.com/api/episode/".$capitulo);
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
    foreach($results as $result){
        echo "<center>";
        // echo $result;
        //traer los personajes del episodio
        $chPersonaje = curl_init();
        curl_setopt($chPersonaje, CURLOPT_URL, $result);
        curl_setopt($chPersonaje, CURLOPT_RETURNTRANSFER, TRUE);
        $responsePersonaje = curl_exec($chPersonaje);
        curl_close($chPersonaje);
        //Json del personaje
        $dataPersonaje = json_decode($responsePersonaje , true);
        //Imprimir el personaje
        echo "<br>";
        echo $dataPersonaje['name'];
        echo "<br>";
        echo $dataPersonaje['id'];
        echo "<br>";
        echo $dataPersonaje['status'];
        echo "<br>";
        echo "<img src='".$dataPersonaje['image']."'>";
        echo "</center>";
    }

    // mostrar todos los episodios
    // foreach($results as $result){
    //     echo "<center>";
    //     echo $result['name'];
    //     echo "<br>";
    //     echo $result['id'];
    //     echo "<br>";
    //     echo $result['air_date'];
    //     echo "<br>";
    //     echo $result['episode'];
    //     echo "</center>";
    // }




    ?>
</body>
</html>