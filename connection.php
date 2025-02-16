<!DOCTYPE html>
<html lang="en">

<head>
    <title>PHP Form Handling</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./projet.css">
</head>

<body>

<div class="head">
    <div class="links">
        <div class="log">
            <span>M</span><span>U</span><span>S</span><span>I</span><span>Q</span><span>U</span><span>E</span>
            <span>T</span><span>I</span><span>M</span><span>E</span>
        </div>
        <div class="link">
            <a href="inscription.php">Inscription</a>
        </div>
    </div>
</div>

<div class="add">
    <h2>Connexion</h2>
    <form action="connection.php" method="post">
        <p>Pseudo: <input type="text" name="pseudo" placeholder="Pseudo d'utilisateur" required></p>
        <p>Mot de Passe: <input type="password" name="mot_de_passe" placeholder="Mot de Passe" required></p>
        <input type="submit" class="btn btn-success" name="login" value="Connexion">
    </form>

    <?php
    session_start(); // Démarrer la session

    if (isset($_POST['pseudo']) && isset($_POST['mot_de_passe'])) {
        // Récupérer les données du formulaire
        $pseudo = $_POST['pseudo'];
        $mot_de_passe = $_POST['mot_de_passe'];

        // Connexion à la base de données
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=musique_db", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Requête pour vérifier si l'utilisateur existe
            $sql = "SELECT * FROM utilisateur WHERE pseudo = :pseudo";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':pseudo', $pseudo);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Vérifier si l'utilisateur existe et si le mot de passe correspond
            if ($user && password_verify($mot_de_passe, $user['mot_de_passe'])) {
                // Enregistrement de l'ID utilisateur dans la session
                $_SESSION['utilisateur_id'] = $user['pseudo'];
                
                // Redirection conditionnelle
                if ($user['pseudo'] === 'root') {
                    header("Location: categories.php");
                } else {
                    header("Location: projet.php");
                }
                exit(); // Terminer le script après la redirection
            } else {
                echo "<h3>Pseudo ou mot de passe incorrect.</h3>";
            }
        } catch (PDOException $e) {
            echo "Erreur de connexion à la base de données: " . $e->getMessage();
        }
    }
    ?>
</div>

</body>
</html>
