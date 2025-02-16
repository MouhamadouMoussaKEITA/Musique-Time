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
  <div class="log"> <span>M</span><span>U</span><span>S</span><span>I</span><span>Q</span><span>U</span><span>E</span>  <span>T</span><span>I</span><span>M</span><span>E</span></div>
    <div class="link">
        <a href="projet.php">Home</a>
        <a href="panier.php">Panier</a>
        <a href="connection.php">Deconnection</a>

        
    </div>
  </div>
</div>

<section class="Afficher">
  <div class="search">
    <form class="form" action = "projet.php" method = "post">
      <input  type = "text" name = "titre" placeholder="musiques">
      <input type = "submit" class="btn" name="ss" value = "Search">
    </form>


    <?php 
      $pdo = new PDO("mysql:host=localhost;dbname=musique_db", "root", "");
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      if (isset($_POST['ss'])) {

        $titre = $_POST['titre'];
        $sql = "SELECT * FROM musiques WHERE titre = '$titre' ";
        $stmt = $pdo->query($sql);
        print "<h3>Musiques: ".$stmt->rowCount()."</h3>"; 
        print "<hr>";
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          $repertoire_images = 'images/'; 
          $image = $row['image'];
          $chemin_image_complet = $repertoire_images . $image;

          echo "<div style='display: flex; align-items: center; margin-bottom: 10px;'>";
          echo "<img src='$chemin_image_complet' alt='Image de musique' style='width: 30px; height: 30px; margin-right: 10px;' />";
          echo "<h4 style='margin: 0;'><a href='projet.php?id=" . $row['id'] . "'>" . $row['titre'] . "</a></h4>";
          echo "</div>";
          echo "<hr>";
      }

      } 
      else{
        $sql = "SELECT * FROM musiques";
        $stmt = $pdo->query($sql);

        print "<h3>Categories: ".$stmt->rowCount()."</h3>"; 
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          $repertoire_images = 'images/'; 
          $image = $row['image'];
          $chemin_image_complet = $repertoire_images . $image;

          echo "<div style='display: flex; align-items: center; margin-bottom: 10px;'>";
          echo "<img src='$chemin_image_complet' alt='Image de musique' style='width: 30px; height: 30px; margin-right: 10px;' />";
          echo "<h4 style='margin: 0;'><a href='projet.php?id=" . $row['id'] . "'>" . $row['titre'] . "</a></h4>";
          echo "</div>";
          echo "<hr>";
      }
      }
    ?>
  </div>   
  <?php 
    if (isset($_GET['id'])) {
      print "<div class='hide' style='display:block;'>";   
      print "<h2>Musique</h2>";
      
      // Récupérer les informations de la musique
      $sql = "SELECT * FROM musiques WHERE id = :id"; 
      $stmt = $pdo->prepare($sql);
      $stmt->execute(['id' => $_GET['id']]);
      $musique = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($musique) {
        $repertoire_images = 'images/'; 
        $image = $musique['image'];
        $chemin_image_complet = $repertoire_images . $image;
    
    
      
        echo "<div style='text-align: center;'>
        <img src='$chemin_image_complet' alt='Image de musique' style='width: 150px; height: 100px;' />
         </div>". "<br>";        echo "Titre : " . $musique['titre'] . "<br>";
        echo "Genre : " . $musique['genre'] . "<br>";
        echo "Auteur : " . $musique['auteur'] . "<br>";
        echo "Prix : " . $musique['prix'] . "€<br>";

        // Formulaire pour ajouter au panier
        if (isset($_POST['add_to_cart'])) {
          session_start();
          $utilisateur_id = $_SESSION['utilisateur_id'] ?? 1; // Remplacer par l'ID utilisateur si la gestion des utilisateurs est en place
          
          // Insertion dans la table panier
          $sql = "INSERT INTO panier (musique_id, utilisateur_id, titre, genre, auteur, prix, image) VALUES (:musique_id, :utilisateur_id, :titre, :genre, :auteur, :prix, :image)";
          $stmt = $pdo->prepare($sql);
          $stmt->execute([
            'musique_id' => $musique['id'],
            'utilisateur_id' => $utilisateur_id,
            'titre' => $musique['titre'],
            'genre' => $musique['genre'],
            'auteur' => $musique['auteur'],
            'prix' => $musique['prix'],
            'image' => $musique['image']
          ]);
        }

        // Formulaire pour ajouter au panier
        print "<form action='' method='post'>";  
        print "<input type='submit' name='add_to_cart' class='btn' value='Panier'>";
        print "</form>";

        print "<h3><b class='b'>✋</b>🔴🔵<b>✋</b><b class='t'>🤏</b>🟣 ^_^</h3>";
      }
    }
  ?>
     
  </div>

</section>

</body>
</html>
