<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formular Daten empfangen</title>
</head>

<body>
    <h1>Daten empfangen</h1>
    <?php
    $person = htmlentities($_POST["vorname"]);
    echo "Hallo " . $person . " wie geht es dir?";
    ?>
</body>

</html>