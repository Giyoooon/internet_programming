<html>
<body>
<?php
	include ('simplehtmldom_1_9_1/simple_html_dom.php');
	
	error_reporting(E_ALL);
	ini_set("display_errors",1);
	
	$hostname="localhost";
	$username="cse20161565";
	$password="cse20161565";
	$dbname = "db_cse20161565";
	$tablename = date("Y-m-d");	
	$connect = new mysqli($hostname, $username, $password, $dbname) or die("DB Connection failed.");
	if($connect)
	{
		echo("Mysql connect success!<br>");
		echo($tablename."<br>");
	}
	else
		echo("connect fail!<br>");
	
	$sql = "CREATE TABLE IF NOT EXISTS ".$tablename." (
	id int(6)unsigned AUTO_INCREMENT PRIMARY KEY,
	INFO_NAME varchar(200),
	LINK varchar(200),
	IMG_LINK varchar(200),
	D-DAY varchar(10),
	SUBJECT varchar(100),
	REWARD varchar(100),
	INFO_ORG varchar(200),
	)";
	
	if($connect->query($sql) === TRUE){
		echo "table make SUCCESS!<br>";
	}

	$url = 'https://allforyoung.com';
	$hits = '/posts/category/2/?sort=hits';
	$page = '&page=';
	
	$pageArr = array('1', '2', '3', '4','5','6');

	foreach($pageArr as $pagenum){
		$html = file_get_html($url.$hits.$page.$pagenum);


		foreach($html->find('div.postCard__container') as $compArr){

			$ID_link = $url.$compArr->find('a',0)->href;
			$IMG_link = $compArr->find('a',0)->find('img',0)->src;
			$DDay = $compArr->find('span', 0)->text();
			$INFO_org = $compArr->find('p.info__org', 0)->text();
			$INFO_name = $compArr->find('p.info__name', 0)->text();
			$Subject = $compArr->find('div.info__tags',0)->find("span", 0)->text();
			$Reward = $compArr->find('div.info__tags',0)->find('span',1)->text();
			$sql = "INSERT INTO ".$tablename." (INFO_NAME, LINK, IMG_LINK, D-DAY, SUBJECT, REWARD, INFO_ORG) VALUES('$INFO_name', '$ID_link', '$IMG_link', '$DDay', '$Subject', '$Reward', '$INFO_org')";
			if($connect->query($sql) === TRUE){
				echo "QUERY success! <br>";
			}

		}
	}
?>
</body>
</html>
