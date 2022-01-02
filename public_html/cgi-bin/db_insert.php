<html>
<body>

<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

echo ("MySQL - PHP Connect Test <br/>");
$hostname = "localhost";
$username = "cse20161565";
$password = "cse20161565";
$dbname = "db_cse20161565";

$connect = new mysqli($hostname, $username, $password, $dbname) 
     or die("DB Connection Failed");
//$sql = mysql_select_db($dbname,$connect);
 
if($connect) {
 echo("MySQL Server Connect Success!");
}
else {
 echo("MySQL Server Connect Failed!");
}

//$sql = "INSERT INTO pizza_order (name, address, phone, topping, paymethod, callfirst, ordertime) VALUES ($name, $address, $phone, $topping, $paymethod, $callfirst, NOW())";

/*
$sql = "CREATE TABLE IF NOT EXISTS pizza_order_php (
id int(6) unsigned AUTO_INCREMENT PRIMARY KEY,
idnumber varchar(100),
name VARCHAR(100),
email VARCHAR(200),
phone VARCHAR(30),
topping VARCHAR(15),
paymethod VARCHAR(20),
callfirst VARCHAR(10),
ordertime TIMESTAMP
)";

if($connect->query($sql) === TRUE){
	echo "New pizza_order table created successfully! <br>";
} else{
	echo "<br>Error!<br>".$sql."<br>".$connect->error;
}
*/

// define variables and set to empty values
$name = $email = $phone = $paymethod  = $callfirst = "";
$topping ="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $idnumber = test_input($_POST["idnumber"]);
  $name = test_input($_POST["name"]);
  $email = test_input($_POST["email"]);
  $phone = test_input($_POST["phone"]);
  $topping = test_input($_POST["topping"]);
//  $topping2 = test_input($_POST["topping2"]);
//  $topping3 = test_input($_POST["topping3"]);
  $paymethod = test_input($_POST["paymethod"]);
  $callfirst = test_input($_POST["callfirst"]);
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$sql = "INSERT INTO pizza_order_php (idnumber, name, email, phone, topping, paymethod, callfirst ) VALUES ('$idnumber', '$name', '$email', '$phone', '$topping', '$paymethod', '$callfirst')";

if($connect->query($sql) === TRUE){
	echo "<br>New order created successfully <br>";
} else{
	echo "<br>Error!<br>".$sql."<br>".$connect->error;
}

$connect->close();
?>

<?php
echo "<h2>Your Input:</h2>";
echo "ID : "  ;
echo $idnumber;
echo "<br>";
echo "Name : "  ;
echo $name;
echo "<br>";
echo "Email Address : "  ;
echo $email;
echo "<br>";
echo "Phone Number : "  ;
echo $phone;
echo "<br>";
echo "Topping : " ; 
echo $topping;
echo "<br>";
echo "Pay Method : "  ;
echo $paymethod;
echo "<br>";
echo "Call First : ";
echo $callfirst;
echo "<br>";
?>

</body>
</html>
