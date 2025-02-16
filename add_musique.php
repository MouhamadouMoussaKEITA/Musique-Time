
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
        <a href="categories.php">Home</a>
        <a href="add_musique.php">Add Musique</a>       
    </div>
  </div>
</div>

</fieldset>
    
    <div class="add">
        <h2>Add Musique</h2>
        <form action="add_musique.php" method="post">
            <p>Titre: <input type="text" name="titre" placeholder="titre"> </p>
            <p>Genre: <input type="text" name="genre" placeholder="genre"></p>
            <p>Auteur: <input type="text" name="auteur" placeholder="auteur"></p>
            <p>Prix: <input type="text" name="prix" placeholder="prix"></p>
            <p>Image: <input type="text" name="image" placeholder="image"></p>
            <input type="submit" class="btn btn-success" name="sm" value="add-musique">
            
        </form>

    <?php 
    if(isset($_POST['titre']) && isset($_POST['genre'])&&isset($_POST['auteur']) && isset($_POST['image'])&& isset($_POST['prix'])){
        print "<h3>Inserting DATA</h3>";
        $pdo = new PDO("mysql:host=localhost;dbname=musique_db", "root", "");
        
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $titre = $_POST['titre'];
        $genre = $_POST['genre'];
        $auteur = $_POST['auteur'];
        $image = $_POST['image'];
        $prix = $_POST['prix'];
        
        $sql = "INSERT INTO musiques (titre, genre, auteur, prix, image) VALUES (:titre, :genre,:auteur,:prix,:image)";
        $stmt = $pdo->prepare($sql);
        
        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':genre', $genre);
        $stmt->bindParam(':auteur', $auteur);
        $stmt->bindParam(':prix', $prix);
        $stmt->bindParam(':image', $image);
        

        $stmt->execute();
        
        if($stmt->rowCount() > 0) {
            print "<h3>Musique &lt;&lt;<b>$titre </b>&gt;&gt; Added </h3>"; 
        }
        else {
            print "<h3>Student not Added</h3>"; 
        }
    }
    ?>
    </div>

</body>

</html>

