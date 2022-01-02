<html>
<body>
<?php

include('simplehtmldom_1_9_1/simple_html_dom.php');

// Create DOM from URL or file
// echo file_get_html('http://www.chosun.com/')->plaintext;

$url = $_POST["url"];
//echo $url."<br>" ;

$html = file_get_html($url);

if($html == ""){
	echo $url.' connect fail. <br>';
	return;
}
else{
	echo $url.' connected <br>';
}


echo $url.' ANCHOR <br><br>-------------------------------------<br> ' ;
// Find all links
$cnt = 1;
$visitedSite = array();
$anchorArr = array();
array_push($visitedSite, $url);
echo $cnt.": ".$url.'<br>';
$cnt++;
$start = get_time();
$flag = false;
foreach($html->find('a') as $element){
	if($cnt > 20){
		$flag = true;
		break;
	}
	$site = $element->href;
	if($site[0] == 'h' && $site[1] == 't' && $site[2] == 't' && $site[3] == 'p'){
			if(in_array($site, $visitedSite) === false){
				array_push($anchorArr,$site);
				array_push($visitedSite,$site);
				echo $cnt.': '.$site .'<br>';
				$cnt++;
			}
	}
}

if($flag === false){
	foreach($anchorArr as $newUrl){
		$html = file_get_html($newUrl);
		if($html == ""){
			$flag = true;
			continue;
		}
		foreach($html->find('a') as $element){
			if($cnt > 20){
				break;
			}
			$site = $element->href;
			if($site[0] == 'h' && $site[1] == 't' && $site[2] == 't' && $site[3] == 'p'){
				if(in_array($site, $visitedSite) === false){
					array_push($anchorArr,$site);
					array_push($visitedSite,$site);
					echo $cnt.': '.$site .'<br>';
					$cnt++;
				}
			}
		}
	}

}
echo '-------------------------------------<br> ' ;
if($flag === false){
	echo 'we tried, but we only find '.--$cnt.' site. <br>';
}
$end = get_time();
echo "Total time : ".number_format($end-$start,6)."sec <br>";
/*
$newArr = array();
$total_time = [];
foreach($anchorArr as $newUrl){
	$start = get_time();

	$newHtml = file_get_html($newUrl);
	if($newHtml == ""){
		echo $newUrl.' connect failed. <br><br>';
		continue;
	}
	echo $newUrl." ANCHOR <br>-------------------------------------------<br>";
	$anchornum = 0;
	foreach($newHtml->find('a') as $newElement){
		$site = $newElement->href;
		if($site[0] == 'h' && $site[1] == 't' && $site[2] == 't' && $site[3] == 'p'){
			if(in_array($site, $visitedSite) === false){
				array_push($newArr,$site);
				array_push($visitedSite,$site);
				echo $depth.': '.$site .'<br>';
				$anchornum++;
			}
		}
	}
	$end = get_time();
	$time = $end - $start;
	$total_time[] = $time;
	echo '-------------------------------------------<br>total '.$anchornum.' time : '.number_format($time, 6).'<br><br>';
	$totalAnchor += $anchornum;
}
$time_mean = array_sum($total_time);
echo "Total Anchor : ".$totalAnchor.", Total time : ".number_format($time_mean, 6)."sec<br>";

*/
function get_time(){
	$t = explode(' ', microtime());
	return (float)$t[0]+(float)$t[1];
}

?>

</body>
</html>


