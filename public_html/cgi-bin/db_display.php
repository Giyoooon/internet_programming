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

// define variables and set to empty values
$idnumber = $name = $email = $phone = $paymethod  = $callfirst = "";
$topping ="";

//$idnumber = "1";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $idnumber = test_input($_POST["idnumber"]);
  $name = test_input($_POST["name"]);
  $email = test_input($_POST["email"]);
  $phone = test_input($_POST["phone"]);
  $topping = test_input($_POST["topping"]);
  $paymethod = test_input($_POST["paymethod"]);
  $callfirst = test_input($_POST["callfirst"]);
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}



$sql = concat_search_query($idnumber, $name, $email, $phone, $topping, $paymethod, $callfirst);
echo "<br>SQL QUERY<br>".$sql."<br>";

$result = $connect->query($sql);

if($result == TRUE){
	echo "<br>New order search successfully <br>";
}
echo "/id/ /idnumber/ /name/ /email/ /phone/ /topping/ /pay/ /call/<br>";
if(!empty($result->num_rows)){
    while($row = $result->fetch_assoc()){
        echo $row["id"]."/ /".$row["idnumber"]."/ /".$row["name"]."/ /".$row["email"]."/ /".$row["phone"]."/ /".$row["topping"]."/ /".$row["paymethod"]."/ /".$row["callfirst"]."/<br>";
    }
} else {
    echo "<br>No record<br>";
}


function concat_search_query($idnumber, $name, $email, $phone, $topping, $paymethod, $callfirst){
    $search = "SELECT * FROM pizza_order_php";
    $cnt = 0;
    //if ($idnumber !== NULL) $cnt++;
    if($idnumber != "") $cnt++;
    if ($name != "") $cnt++;
    if ($email != "") $cnt++;
    if ($phone != "") $cnt++;
    if ($topping != "") $cnt++;
    if ($paymethod != "") $cnt++;
    if ($callfirst != "") $cnt++;
    echo "<br> Not null object = ".$cnt."<br>";
    if($cnt !== 0){// 
        $search .= " WHERE";
        $tmp_cnt = 0;
        if ($idnumber != ""){
            $search .= " idnumber = '$idnumber'";
            $tmp_cnt++;
        }
        if ($name != "" ){
            if($tmp_cnt != 0) $search .= " AND";
            $search .= " name = '$name'";
            $tmp_cnt++;
        }
        if ($email != "" ){
            if($tmp_cnt != 0) $search .= " AND";
            $search .= " email = '$email'";
            $tmp_cnt++;
        }
        if ($topping != "" ){
            if($tmp_cnt != 0) $search .= " AND";
            $search .= " topping = '$topping'";
            $tmp_cnt++;
        }
        if ($paymethod != "" ){
            if($tmp_cnt != 0) $search .= " AND";
            $search .= " payment = '$paymethod'";
            $tmp_cnt++;
        }
        if ($callfirst != "" ){
            if($tmp_cnt != 0) $search .= " AND";
            $search .= " callfirst = '$callfirst'";
        }
    }

    return $search;
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
