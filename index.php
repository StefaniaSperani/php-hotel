<!-- Descrizione
Partiamo da questo array di hotel. https://www.codepile.net/pile/OEWY7Q1G
Stampare tutti i nostri hotel con tutti i dati disponibili.
Iniziate in modo graduale.
Prima stampate in pagina i dati, senza preoccuparvi dello stile.
Dopo aggiungete Bootstrap e mostrate le informazioni con una tabella.
Bonus:
1 - Aggiungere un form ad inizio pagina che tramite una richiesta GET permetta di filtrare gli hotel che hanno un parcheggio.
2 - Aggiungere un secondo campo al form che permetta di filtrare gli hotel per voto 
(es. inserisco 3 ed ottengo tutti gli hotel che hanno un voto di tre stelle o superiore) -->

<?php

$hotels = [
    [
        'name' => 'Hotel Belvedere',
        'description' => 'Hotel Belvedere Descrizione',
        'parking' => true,
        'vote' => 4,
        'distance_to_center' => 10.4
    ],
    [
        'name' => 'Hotel Futuro',
        'description' => 'Hotel Futuro Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 2
    ],
    [
        'name' => 'Hotel Rivamare',
        'description' => 'Hotel Rivamare Descrizione',
        'parking' => false,
        'vote' => 1,
        'distance_to_center' => 1
    ],
    [
        'name' => 'Hotel Bellavista',
        'description' => 'Hotel Bellavista Descrizione',
        'parking' => false,
        'vote' => 5,
        'distance_to_center' => 5.5
    ],
    [
        'name' => 'Hotel Milano',
        'description' => 'Hotel Milano Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 50
    ],

];


if ((isset($_GET['parking']) && !empty($_GET['parking'])) || (isset($_GET['vote']) && !empty($_GET['vote']))) {
    $parking = $_GET ? $_GET['parking'] : '';
    $vote = $_GET ? $_GET['vote'] : '';
    $hotelsTemp = [];
    foreach ($hotels as $hotel) {
        if ($hotel['parking'] == true && $parking == 'true') {
            $hotelsTemp[] = $hotel;
            if ($_GET['vote']) {
                $hotelsTemp = array_filter($hotelsTemp, fn($vote) => $vote['vote'] >= $_GET['vote']);
            }
            ;
        } elseif ($hotel['parking'] == false && $parking == 'false') {
            $hotelsTemp[] = $hotel;
            if ($_GET['vote']) {
                $hotelsTemp = array_filter($hotelsTemp, fn($vote) => $vote['vote'] >= $_GET['vote']);
            }
            ;
        } else {
            $hotelsTemp[] = $hotels;
        }
        ;
    }
    $hotels = $hotelsTemp;
    //var_dump($hotels);
}
;



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/style.css">
    <title>PHP Hotel</title>
</head>

<body>
    <main>
        <div class="container">
            <h1 class="py-3 text-center text-capitalize">Our Hotels <i class="fa-solid fa-star fa-lg"></i></h1>

            <form action="index.php" method="GET">
                <select class="form-select w-25 mb-3" name="parking" id="parking">
                    <option selected value="">Select parking options</option>
                    <option value="true" name="true">Hotel with parking</option>
                    <option value="false" name="false">Hotel without parking</option>
                </select>
                <input type="number" name="vote" value="vote" min="1" max="5" step="1"> </br>
                <button type="submit" class="btn btn-dark my-3"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>

            <table class="table table-dark table-striped text-capitalize">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Parking</th>
                        <th scope="col">Vote</th>
                        <th scope="col">Distance to center</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($hotels as $item) { ?>
                    <tr>
                        <th scope="row">
                            <?php echo $item['name'] ?>
                        </th>
                        <td>
                            <?php echo $item['description'] ?>
                        </td>
                        <td>
                            <?php echo $item['parking'] ?>
                        </td>
                        <td>
                            <?php echo $item['vote'] ?>
                        </td>
                        <td>
                            <?php echo $item['distance_to_center'] ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>