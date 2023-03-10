<?php 


	//phpinfo();
    $csv_file = file('iicid.csv');
 


	$count = $_POST['data1'];
	
	
	if($count  == 0 ) {
		$start = 0;
	}else{
		$start = $count * 10 ;
	}

echo $count.' to'. $start .'<br> ';

	$csv_file = array_slice($csv_file, $start, 10);


$arr = [];
	foreach($csv_file as $value){
		
		
		$value = trim($value);
		$response = file_get_contents('https://api.mic.gov.in/api/getIicCouncilDetails?iicId='.$value);
		
		$response =  json_decode($response, true);
		$response = array_push($arr, $response['data']);

	}
?>


<?php
echo '<pre>';
print_r($arr);
echo  '</pre>';
$i = 0;

foreach($arr as $td){
	
	if(isset($td['iicId'])) {
	echo '<tr>';
	//echo '<td>'.$i++.'</td>';
	echo '<td>'.$td['iicId'].'</td>';
	echo '<td>'.$td['name'].'</td>';
	echo '<td>'.$td['designation'].'</td>';
	echo '<td>'.$td['email'].'</td>';
	echo '<td>'.$td['details'].'</td>';
	echo '</tr>';
	}
}
   
?>
