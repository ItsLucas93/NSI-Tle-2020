<!DOCTYPE HTML>  
<html lang="fr">

<head>
  <title>ZEBI MA RESA</title>
  <meta charset="utf-8">
  <link rel="icon" href="/favicon.ico"/>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>

<?php 
include 'db/db.php';
global $conn;
global $debugmod;
global $dbtable1;
?>

<h1>RESERVATION POUR L'HOTEL MEH ZEBI</h1>

<!-- Form for insert data in DB -->
<form method="post">
  Nom : <input type="text" name="lastname" id="lastname" placeholder="Last Name" required>
  <br><br>
  Prénom : <input type="text" name="firstname" id="firstname" placeholder="First Name" required>
  <br><br>
  E-mail : <input type="email" name="email" id="email" placeholder="E-mail" required>
  <br><br>
  Date de réservation : <input type="date" name="date" id="date" required>
  <br><br>
  <input type="submit" name="submit" id='submit' value="Soumettre">
</form>


<?php

  if(isset($_POST['submit'])) {

    // Collect data from form
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $email = $_POST['email'];
    $date = $_POST['date'];

    // Display Alert box with data
    if(!empty($lastname) && !empty($firstname) && !empty($email) && !empty($date)) {
      echo "<script>alert('Votre réservation : \\nNom : ". $lastname . "\\nPrénom " . $firstname . "\\nEmail : " . $email . "\\nDate : " . $date . "')</script>";

    }

    // SQL Command
    $sql = "INSERT INTO " . $dbtable1 ."(clientFirstName, clientLastName, clientemail, resadate) VALUES('".$_POST["lastname"]."','".$_POST["firstname"]."','".$_POST["email"]."','".$_POST["date"]."')";
    // Query Command
    if ($conn->query($sql) === TRUE) {
      if ($debugmod == TRUE) { 
        echo "New record created successfully"; 
      }
    } else {
      if ($debugmod == TRUE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }
  }
?>

<br>

<!-- Display Data from DB -->
<table>
  <h2>LISTE DES RESERVATIONS MEH ZEBI</h2>
  <th scope="col">Id</th>
  <th scope="col">FirstName</th>
  <th scope="col">LastName</th>
  <th scope="col">Email</th>
  <th scope="col">Date</th>
  <th scope="col">Dans</th>
  

<?php
    // SQL Command
    $sql = "SELECT * FROM " . $dbtable1;
    $q = $conn->query($sql);
    while($resa = $q->fetch_assoc())
    { ?>
        <form method="post">
        <tr scope="row">
          <?php echo "<td>" . $resa["clientId"]. "</td><td>" . $resa["clientFirstName"]. "</td><td>" . $resa["clientLastName"] . "</td><td>" . $resa["clientemail"] . "</td><td>" . date('d F Y', strtotime($resa['resadate'])) . " </td><td>" . ceil((strtotime($resa['resadate']) - time() )/60/60/24) . " jours</td>";?>
        </tr>
        </form>

<?php }
?>
</table>
<br>


<!-- Delete data from ID in DB -->
<h2>SUPPRIMER UNE RESERVATION MEH ZEBI</h2>
<form method="post">
  <input type="number" name="ID" id="ID" placeholder="ID to delete" required>
  <input type="submit" name="delete" value="Supprimer">
  <?php     
  if(isset($_POST['delete'])){
      // SQL Command
      $sql = "DELETE FROM " . $dbtable1 ." WHERE clientId = " . $_POST['ID'];         
      if ($conn->query($sql) === TRUE) {
        echo '<meta http-equiv="Refresh" CONTENT="0.01; url=">';
        if ($debugmod == TRUE) {
          echo "ID DELETED";
        } else {
          echo "Error : " . $sql . "<br>" . $conn->error;
       }
     }
   }
?>
</form>

<!-- Update data in DB -->
<h2>MODIFIER UNE INFO MEH ZEBI</h2>
<form method="post">
  <input type="number" name="id_update" id="id_update" placeholder="N°ID" required>
  <input type="text" name="lastname" id="lastname" placeholder="Last Name" required>
  <input type="text" name="firstname" id="firstname" placeholder="First Name" required>
  <input type="email" name="email" id="email" placeholder="E-mail" required>
  <input type="date" name="date" id="date" required>
  <input type="submit" name="submit_update" id='submit_update' value="Soumettre">
</form>

<?php

  if(isset($_POST['submit_update'])) {

    // Collect data from form
    $id = $_POST['id_update'];
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $email = $_POST['email'];
    $date = $_POST['date'];

    if(!empty($id) && !empty($lastname) && !empty($firstname) && !empty($email) && !empty($date)) {
      echo "<script>alert('UPDATE : \\nNom : ". $lastname . "\\nPrénom " . $firstname . "\\nEmail : " . $email . "\\nDate : " . $date . "')</script>";

    }

    $sql = "UPDATE " . $dbtable1 . " SET clientFirstName = '" . $firstname . "', clientLastName = '" . $lastname . "', clientemail = '" . $email . "', resadate = '" . $date . "' WHERE clientId = " . $id;
    if ($conn->query($sql) === TRUE) {
      if ($debugmod == TRUE) { 
        echo "New record created successfully"; 
      }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $sql = "UPDATE " . $dbtable1 . " SET clientLastName = '" . $lastname . "' WHERE clientId = " . $id;
    if ($conn->query($sql) === TRUE) {
      if ($debugmod == TRUE) { 
        echo "New record created successfully"; 
      }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $sql = "UPDATE " . $dbtable1 . " SET clientemail = '" . $email . "' WHERE clientId = " . $id;
    if ($conn->query($sql) === TRUE) {
      if ($debugmod == TRUE) { 
        echo "New record created successfully"; 
      }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $sql = "UPDATE " . $dbtable1 . " SET resadate = '" . $date . "' WHERE clientId = " . $id;
    if ($conn->query($sql) === TRUE) {
      if ($debugmod == TRUE) { 
        echo "New record created successfully"; 
      }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    echo '<meta http-equiv="Refresh" CONTENT="0.01; url=">';
}
?>

</body>
</html>