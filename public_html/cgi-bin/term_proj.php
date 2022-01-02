<html>
	<head>
		<meta charset="UTF-8">
		<title>검색결과</title>
		<link href="css/style.css" rel="stylesheet" type="text/css">
	</head>
<body style="backgroundcolor : rgba(255,255,128, .5)">

<?php
	include('simplehtmldom_1_9_1/simple_html_dom.php');

	$category = $award = $target = $region = "";
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		$category = $_POST["category"];
		$award = $_POST["award"];
		$target = $_POST["target"];
		$region = $_POST["region"];
	}
	$url = "https://allforyoung.com/posts/category/2/?sort=hits";
	$site = "https://allforyoung.com";
	if($category != ""){
		$url = $url."&".$category;
	}
	if($award != ""){
		$url = $url."&".$award;
	}
	if($target != ""){
		$url = $url."&".$target;
	}
	if($region != ""){
		$url = $url."&".$region;
	}

	$html = file_get_html($url);
	if($html == ""){
		echo "empty!";
	}
	$cnt = 0;

	$ID_link = array();
	$IMG_link = array();
	$dday = array();
	$info_org = array();
	$info_name = array();
	$subject  = array();
	$reward = array();
	foreach($html->find('div.postCard__container') as $compArr){
		if($cnt >= 10) break;
		/*
		array_push($ID_link, $site.$compArr->find('a',0)->herf);
		array_push($IMG_link, $compArr->find('a',0)->find('img',0)->src);
		array_push($dday, $compArr->find('span',0)->text());
		array_push($info_org, $compArr->find('p.info__org',0)->text());
		array_push($info_name, $compArr->find('p.info__name',0)->text());
		array_push($subject, $compArr->find('div.info__tag',0)->find('span',0)->text());
		array_push($reward, $compArr->find('div.info__tag',0)->find('span',1)->text());
		*/
		//echo $cnt."<br>";
		echo "<center> <div style='display:inline'>";
		echo $compArr."<br><br>";
		echo "</div> </center>";
		$cnt += 1;
		
	}
?>
<p id = test></p>

<!--
<script>
	var idLink = <?php echo json_encode($ID_link)?>;
	var imgLink = <?php echo json_encode($IMG_link)?>	
	var dday = <?php echo json_encode($dday)?>
	var info_org = <?php echo json_encode($info_org)?>
	var info_name = <?php echo json_encode($info_name)?>
	var subject = <?php echo json_encode($subject)?>
	var reward = <?php echo json_encode($reward)?>

	console.log(idLink);
	
</script>
-->

</body>
</html>
