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
        <a href="connection.php">Deconnection</a>
    </div>
  </div>
</div>

<section class="Afficher">
  <div class="search">
    <form class="form" action = "categories.php" method = "post">
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
          echo "<img onclick src='$chemin_image_complet' alt='Image de musique' style='width: 30px; height: 30px; margin-right: 10px;' />";
          echo "<h4 style='margin: 0;'><a href='categories.php?id=" . $row['id'] . "'>" . $row['titre'] . "</a></h4>";
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
          echo "<img onclick src='$chemin_image_complet' alt='Image de musique' style='width: 30px; height: 30px; margin-right: 10px;' />";
          echo "<h4 style='margin: 0;'><a href='categories.php?id=" . $row['id'] . "'>" . $row['titre'] . "</a></h4>";
          echo "</div>";
          echo "<hr>";
      }
      }
    ?>

      <form action = "categories.php" method = "post">
        <input  type = "submit" class="btn" name="sd" value = "Remove All">
      </form>
      
      <?php 

        if(isset($_POST['sd'])){
          print "<h2>Deleting data</h2>";
            
          $sql =" TRUNCATE TABLE musiques ";
          $stmt = $pdo->prepare($sql);
          $stmt->execute(); 

          if($stmt->rowCount() > 0) {
            print "<p>All Musiques removed</p>"; 
            $sql =" ALTER TABLE musiques AUTO_INCREMENT = 1 ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute()    ;
          }
          
        }
    ?> 
  </div>   

  <?php 
      if(isset($_GET["id"])){
        print "<div class='hide' style='display=block' >";   

        print "<h2>Musique</h2>";
        $sql = "SELECT * FROM musiques WHERE id = ".$_GET["id"]; 
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

       
        While($row = $stmt->fetch(PDO::FETCH_ASSOC)){ 
          $repertoire_images = 'images/'; 
          $image = $row['image'];
          $chemin_image_complet = $repertoire_images . $image;
      
      
        
          echo "<div style='text-align: center;'>
          <img src='$chemin_image_complet' alt='Image de musique' style='width: 100px; height: 100px;' />
           </div>". "<br>";
          echo "Titre : " . $row['titre'] . "<br>";
          echo "Genre : " . $row['genre'] . "<br>";
          echo "Auteur : " . $row['auteur'] . "<br>";
          echo "Prix : " . $row['prix'] . "€<br>";
            
          print "<form action='update_musique.php?id=".$row['id']."' method='post'>";  
          print "<input type='submit' name='hide' class='btn' value='Edit'>";
          print "</form>";

          
          
          print "<h3><b class='b'>✋</b>🔴🔵<b>✋</b><b class='t'>🤏</b>🟣     ^_^</h3>";
        }   
      }
      
      
    ?>
     
  </div>

</section>

</body>
</html>
