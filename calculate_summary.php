<html>
<head>
  <title>Summary</title>
</head>
<body>
  <form method="post" action="$_SERVER[php_self]">
  </form>
<?php
require_once 'connection.php';

$total_expense = 0;

//$month = $_POST['month'];
$month=8;

// SQL query for the data
$sql = "Select sum(amount) as total_expense from expenses_data where month(dated) = ?";

// prepare the statement
if($stmt = $conn->prepare($sql)){
  // bind the parameters
  $stmt->bind_param("i", $month);

  // execute the statement
  $stmt->execute();

  // bind the result variables
  $stmt->bind_result($total_expense);

  $stmt->fetch();

  $stmt->close();
} else {
  echo "can't initialize the total expenditure statement";
}

/*
Time to get the user-wise data.
*/
$user_id=-1;
$user_amt=0;
$sql = "Select user_id, sum(amount) as expense from expenses_data where month(dated) = ? group by user_id";

// prepare the statement
if($stmt = $conn->prepare($sql)){
  // bind the parameters
  $stmt->bind_param("i", $month);

  // execute the statement
  $stmt->execute();

  // bind the result variables
  $stmt->bind_result($result_id, $result_ex);

//var_dump($result_id);

  //$result = mysqli_query($conn, $stmt);

  $i = 0;
  $user_ids = array();
  $expenses = array();
  while($stmt->fetch()){
    //var_dump($result);
    $i += 1;
    $user_ids[] = $result_id;
    $expenses[] = $result_ex;
    //echo 'User ID: '.$result_id.' expense: '.$result_ex.' <br>';
  }

  // calculate average expense to be made by each member
  $avg = $total_expense / $i;

  echo 'Total expense: '.$total_expense.'. Per person expense: '.$avg.'<br><br>';

  for($j=0; $j<$i; $j++){
    $diff = $expenses[$j] - $avg;
    echo 'User ID: '.$user_ids[$j].' total expense made: '.$expenses[$j].
    ' balance: '.$diff.' <br>';
  }

  $stmt->close();
} else {
  echo "can't initialize the user-wise expenditure statement";
}
 ?>
</body>
</html>
