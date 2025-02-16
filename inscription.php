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
            <a href="connection.php">Connection</a>
        </div>
    </div>
</div>

<div class="add">
    <h2>Inscription</h2>
    <form action="inscription.php" method="post">
        <p>Pseudo: <input type="text" name="pseudo" placeholder="Pseudo" required></p>
        <p>Nom: <input type="text" name="nom" placeholder="Nom complet" required></p>
        <p>Mot de Passe: <input type="password" name="mot_de_passe" placeholder="Mot de Passe" required></p>
        <input type="submit" class="btn btn-success" name="sm" value="Inscription">
    </form>

    <?php 
    if (isset($_POST['sm'])) {
        print "<h3>Inserting DATA</h3>";
        $pdo = new PDO("mysql:host=localhost;dbname=musique_db", "root", "");
        
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $pseudo = $_POST['pseudo'];
        $nom = $_POST['nom'];
        $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT); // Hachage du mot de passe
        
        $sql = "INSERT INTO utilisateur (pseudo, nom, mot_de_passe) VALUES (:pseudo, :nom, :mot_de_passe)";
        $stmt = $pdo->prepare($sql);
        
        $stmt->bindParam(':pseudo', $pseudo);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':mot_de_passe', $mot_de_passe);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            print "<h3>User &lt;&lt;<b>$pseudo</b>&gt;&gt; Added </h3>"; 
        } else {
            print "<h3>User not Added</h3>"; 
        }
    }
    ?>
</div>

</body>

</html>
