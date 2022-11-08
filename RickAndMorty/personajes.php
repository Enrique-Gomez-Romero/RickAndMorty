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
        $numero = 1;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://rickandmortyapi.com/api/character/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);
        $results = $data['results'];

        foreach($results as $result){
            echo "<center>";
            echo $result['name'];
            echo "<br>";
            echo $result['id'];
            echo "<br>";
            echo $result['status'];
            echo "<br>";
            echo "<img src='".$result['image']."'>";
            echo "</center>";
        }

    ?>
</body>
</html>

