<html>
<head>
  <title>Record insertion</title>
</head>
<body>
  <?php
  require_once 'connection.php';

  $amount = $_POST['amount'];
  $particulars = $_POST['particulars'];
  $exType = $_POST['exType'];
  $expeneDate = $_POST['expenseDate'];
  $userId = $_POST['userId'];

  echo $userId;

  // SQL statement
  $sql = "Insert into expenses_data values(?, ?, ?, ?)";

  // Get the prepared statement
  if($stmt = $conn->prepare($sql)){
    // Bind the values
    $stmt->bind_param("idsi", $userId, $amount, $particulars, $exType, $expeneDate);

    // execute the statement
    if($stmt->execute()){
      echo "Inserted the data successfully!!";
    } else {
      echo "Problem!";
    }

    // close the statement
    $stmt->close();
  }

   ?>

   <?php
   $conn->close();
    ?>


</body>
</html>
