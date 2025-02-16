<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./projet.css">
</head>
<body>

<div class="head">
    <div class="links">
        <div class="log">
            <span>M</span><span>U</span><span>S</span><span>I</span><span>Q</span><span>U</span><span>E</span>
            <span>T</span><span>I</span><span>M</span><span>E</span>
        </div>
    </div>
    <div class="link">
        <a href="projet.php">Home</a>
        <a href="panier.php">Panier</a>
        <a href="connection.php">Deconnection</a>

        
    </div>
</div>

<div class="add">
    <h2>Paiement</h2>
    <form action="" method="post">
        <p>Numéro de Carte (16 chiffres) : <input type="text" name="carte" placeholder="XXXX XXXX XXXX XXXX" required pattern="\d{16}"></p>
        <p>Date d'Expiration : <input type="month" name="expiration" required></p>
        <input type="submit" class="btn btn-success" name="submit" value="Payer">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        $carte = $_POST['carte'];
        $expiration = $_POST['expiration'];

        // Vérification des conditions
        $erreurs = [];

        // Vérifier que le dernier chiffre est identique au premier
        if (strlen($carte) == 16 && $carte[0] != $carte[15]) {
            $erreurs[] = "Le dernier chiffre doit être identique au premier.";
        }

        // Vérification de la date d'expiration
        $date_expiration = DateTime::createFromFormat('Y-m', $expiration);
        $date_actuelle = new DateTime();
        $date_limite = (clone $date_actuelle)->modify('+3 months');

        if ($date_expiration <= $date_limite) {
            $erreurs[] = "La date d'expiration doit être supérieure à la date d'aujourd'hui + 3 mois.";
        }

        // Affichage des erreurs ou du succès
        if (!empty($erreurs)) {
            foreach ($erreurs as $erreur) {
                echo "<p style='color: red;'>$erreur</p>";
            }
        } else {
            echo "<p style='color: green;'>Paiement effectué avec succès!</p>";
            // Ici, vous pouvez traiter le paiement
        }
    }
    ?>
</div>

</body>
</html>
