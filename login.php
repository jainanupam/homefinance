<html>
<head><title>Login page</title> </head>
<body>

  <center>
  User name:

  <?php
  require_once 'connection.php';

  $userName = $_POST['userName'];
  $password = $_POST['password'];
  $userId=-1;

  echo $userName."<br>";

  // SQL query to fetch the user id from the database
  $sql = "select user_id from users where user_name = ? and password = ?";

  // prepare statement from the query;
  if($stmt = $conn->prepare($sql)){

    // bind parameters;
    $stmt->bind_param("ss", $userName, $password);

    // execute statement
    $stmt->execute();

    // bind result variable
    $stmt->bind_result($userId);

    $stmt->fetch();

    if($userId == NULL){
      echo "incorrect user name or password";
      exit();
    } else {
      echo "Welcome user ".$userId;
    }

    echo "<br><br>";

    $stmt->close();
  }
  ?>

  Insert the new expenditure details:
  <form action="enter_data.php" method="post">
  <table>
    <tr>
      <td>Amount :</td>
      <td><input type="text" name="amount"/> </td>
    </tr>
    <tr>
      <td>Particulars :</td>
      <td><textarea name="particulars" ></textarea> </td>
    </tr>
    <tr>
      <td>Group expense? </td>
      <td>
        Yes <input type="radio" value="1" name="exType" checked="true" />
        No <input type="radio" value="0" name="exType" />
      </td>
    </tr>
    <tr>
      <td>Date of expense:</td>
      <td><input type="text" name="expenseDate" /> </td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" />
    </tr>

  </table>
  <input type="hidden" name="userId" value="<?php echo $userId; ?>" />
</form>

  <?php
    $conn->close();
  ?>

  <table border="1">
    <tr>
      <td><a href="edit_profile.html" >Edit Profile</a></td>
      <td><a href="calculate_summary.php" >Monthly summary</a></td>
    </tr>
  </table>
 </center>
</body>
</html>
