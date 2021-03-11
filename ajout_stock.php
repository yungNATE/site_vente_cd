<html>
  <?php
    session_start();
    if (isset($_SESSION['login']) && isset($_SESSION['pwd'])) {
  ?>
  <form action="ajoutScript.php" method="post">
    <p>Titre : <input type="text" name="title" /></p>
    <p>Genre : <input type="text" name="gender" /></p>
    <p>Auteur : <input type="text" name="autor" /></p>
    <p>Prix : <input type="text" name="price" /></p>
    <p>URL de la pochette: <input type="text" name="cover"/></p>
    <p><input type="submit" value="OK"></p>
  </form>
  <?php
    }
    else {
      echo 'On se log peut-être ? Non ?'; echo '<br />';
      echo '<a href="./login_adminRoom.php">Se connecter</a>';
    }
  ?>
</html>
