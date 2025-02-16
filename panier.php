<!DOCTYPE html>
<html lang="en">

<head>
<title>Panier</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="./projet.css">
</head>

<body>

<div class="head">
  <div class="links">
    <div class="log"> <span>M</span><span>U</span><span>S</span><span>I</span><span>Q</span><span>U</span><span>E</span>  <span>T</span><span>I</span><span>M</span><span>E</span></div>
    <div class="link">
        <a href="projet.php">Home</a>
    </div>
  </div>
</div>

<section class="Afficher">
  <div class="search">
    <h2>Votre Panier</h2>
    
    <?php
session_start();

// Connexion à la base de données
$pdo = new PDO("mysql:host=localhost;dbname=musique_db", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$utilisateur_id = $_SESSION['utilisateur_id'] ?? 1; // Remplacez par l'ID utilisateur si nécessaire

// Vérifier si le formulaire de suppression d'un article a été soumis
if (isset($_POST['article_id'])) {  // Utilisation de `article_id` directement ici
    $article_id = $_POST['article_id'];
    // Supprimer l'article du panier pour cet utilisateur
    $sql = "DELETE FROM panier WHERE id = :article_id AND utilisateur_id = :utilisateur_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['article_id' => $article_id, 'utilisateur_id' => $utilisateur_id]);
    echo "<p>L'article a été supprimé avec succès.</p>";
}

// Vérifier si le formulaire de suppression du panier a été soumis
if (isset($_POST['vider_panier'])) {
    // Supprimer tout le contenu du panier pour cet utilisateur
    $sql = "DELETE FROM panier WHERE utilisateur_id = :utilisateur_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['utilisateur_id' => $utilisateur_id]);
    echo "<p>Votre panier a été vidé avec succès.</p>";
}

// Récupérer les éléments du panier pour l'utilisateur connecté
$sql = "SELECT * FROM panier WHERE utilisateur_id = :utilisateur_id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['utilisateur_id' => $utilisateur_id]);

$panier = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($panier) > 0) {
    $total = 0;
    print "<h3>Articles dans votre panier : " . count($panier) . "</h3>";
    print "<hr>";

    foreach ($panier as $item) {
        echo "<div class='panier-item'>";
        echo "<div style='text-align: center;'>";
        echo "Titre : " . $item['titre'] . " ";
        // Formulaire pour supprimer un article spécifique
        echo "<form action='' method='post' style='display:inline;'>";
        echo "<input type='hidden' name='article_id' value='" . $item['id'] . "'>";
        // Remplacez l'URL par le chemin de votre image de poubelle
        echo "<input type='image' src='https://img.icons8.com/material-outlined/24/000000/trash.png' alt='Supprimer' title='Supprimer' style='vertical-align: middle;'>";
        echo "</form>";
        echo "<br>Prix : " . $item['prix'] . "€<br>";
        $total += $item['prix'];
        echo "</div>";
        echo "</div>";
    }

    // Affichage du total
    print "<h4>Total : " . $total . "€</h4>";
    echo "<form action='paiement.php' method='post'>"; 
    echo "<input type='submit' name='Payer' class='btn' value='Payer'>";
    echo "</form>";// Lien vers la page de paiement
    
    // Formulaire pour vider le panier
    echo "<form action='' method='post'>"; 
    echo "<input type='submit' name='vider_panier' class='btn' value='Vider le panier'>";
    echo "</form>";
} else {
    echo "<p>Votre panier est vide.</p>";
}
?>

  </div>
</section>

</body>
</html>
