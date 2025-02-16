<!DOCTYPE html>
<html>
<head>
<title>Update l'étudiant</title>    
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="projet.css">

</head>
<body>

<div class="head">
  <div class="links">
  <div class="log"> <span>M</span><span>U</span><span>S</span><span>I</span><span>Q</span><span>U</span><span>E</span>  <span>T</span><span>I</span><span>M</span><span>E</span></div>
  <div class="link">
  <a href="categories.php">Home</a>
  <a href="add_musique.php">Add Musique</a>    
        
    </div>
  </div>
</div>


  <div class="add">
  <?php 
      $pdo = new PDO("mysql:host=localhost;dbname=musique_db", "root", "");
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            
            $sql = "SELECT * FROM musiques WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
        ?>


      <h2>Détails</h2>

      <form action="update_musique.php?id=<?php echo $id; ?>" method="post">
          
          <p> Titre: <input type="text" name="titre" placeholder="titre" value="<?php print $row['titre']; ?>"></p>
          <p> Genre: <input type="text" name="genre" placeholder="genre" value="<?php print $row['genre']; ?>"></p>
          <p> Auteur: <input type="text" name="auteur" placeholder="auteur" value="<?php print $row['auteur']; ?>"></p>
          <p> Prix: <input type="text" name="prix" placeholder="prix" value="<?php print $row['prix']; ?>"></p>
          <p> Image: <input type="text" name="image" placeholder="image" value="<?php print $row['image']; ?>"></p>


        
        <input type="submit" class="btn btn-danger" name="delete" value="Delete">
        <input type="submit" class="btn btn-success" name="update" value="Update">



          
            
        </form>

        <?php 
        } 
        ?>

  <?php 
        if (isset($_POST['update'])) {
            $id = $_GET['id'];
            $titre = $_POST['titre'];
            $genre = $_POST['genre'];
            $auteur = $_POST['auteur'];
            $prix = $_POST['prix'];
            $image = $_POST['image'];
    
            if ($_POST['update'] === 'Update') {
                try {
                    $sql = "UPDATE musiques SET titre = :titre, genre = :genre, auteur = :auteur, prix = :prix, image = :image WHERE id = :id";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':titre', $titre);
                    $stmt->bindParam(':genre', $genre);
                    $stmt->bindParam(':auteur', $auteur);
                    $stmt->bindParam(':prix', $prix);
                    $stmt->bindParam(':image', $image);
                    $stmt->bindParam(':id', $id);  // Ajout du paramètre manquant
                    $stmt->execute();
        
                    if ($stmt->rowCount() > 0) {
                        echo "<h3>The Musique was updated successfully!</h3>";
                    } else {
                        echo "Aucune ligne mise à jour. Veuillez vérifier les paramètres.";
                    }
                } catch (PDOException $e) {
                    echo "Erreur lors de la mise à jour : " . $e->getMessage();
                }
            }
        }

        if (isset($_POST['delete'])) {
            $id = $_GET['id'];

            $sql = "DELETE FROM musiques WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo "<p>L'étudiant a été supprimé avec succès !</p>";
            } else {
                echo "Une erreur s'est produite lors de la suppression de l'étudiant.";
            }
        }
    ?>

  </div>
</body>
</html>
