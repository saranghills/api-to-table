<?php 

	//phpinfo();
    $csv_file = file('../data/iicid.csv');

$lastid = $csv_file[array_key_last($csv_file)];


	$count = $_POST['count'];
	$dataset = $_POST['dataset'];
	

	if($count  == 0 ) {
		$start = 0;
	}else{
		$start = $count * 5 ;
	}

	//echo $count.' to'. $start .'<br> ';

	$csv_file = array_slice($csv_file, $start, 5);



	$arr = [];
	$arr1 = [];
	foreach($csv_file as $value){
		
		
		$value = trim($value);

		
		if($dataset == 'institutes'){
			
				$response = file_get_contents('https://api.mic.gov.in/api/getInstitutePerDetail?iicId='.$value);
		
				$response = array_push( $arr, json_decode($response, true));

			
		}elseif( $dataset == 'presidents'){
			
				
				$response = file_get_contents('https://api.mic.gov.in/api/getPresidentDetails?iicId='.$value);
				
				$arr1 = json_decode($response, true);
				$arr1['iicId'] = trim($value) ;
				$response = array_push( $arr,$arr1);
				
			
		}elseif( $dataset == 'convenors'){
				$response = file_get_contents('https://api.mic.gov.in/api/getConvenerDetails?iicId='.$value);
		
				$arr1 = json_decode($response, true);
				$arr1['iicId'] = trim($value) ;
				$response = array_push( $arr,$arr1);
			
		}elseif( $dataset == 'councils'){
				$response = file_get_contents('https://api.mic.gov.in/api/getIicCouncilDetails?iicId='.$value);
		
				$response = array_push( $arr, json_decode($response, true));
			
			
			
		}

	}


	foreach($arr as $td){
	

		if($dataset == 'institutes'){
			
			if( array_key_exists('iicId', $td) ) {
				
				
				echo '<tr>';
				echo '<td>'.$td['iicId'].'</td>';
				echo '<td>'.$td['instituteName'].'</td>';
				echo '<td>'.$td['instituteState'].'</td>';
				echo '<td>'.$td['instituteCity'].'</td>';
				echo '<td>'.$td['regional_zone'].'</td>';
				echo '<td>'.$td['theme'].'</td>';
				echo '</tr>';
			
			}

		}elseif( $dataset == 'presidents'){

			if( array_key_exists('name', $td) ) {
				echo '<tr>';
				echo '<td>'.$td['iicId'].'</td>';
				echo '<td>'.$td['name'].'</td>';
				echo '<td>'.$td['designation'].'</td>';
				echo '<td>'.$td['email'].'</td>';
				echo '<td>'.$td['nomination'].'</td>';
				echo '</tr>';
			}
		}elseif($dataset == 'convenors'){
			
			if( array_key_exists('name', $td) ) {
				echo '<tr>';
				echo '<td>'.$td['iicId'].'</td>';
				echo '<td>'.$td['name'].'</td>';
				echo '<td>'.$td['designation'].'</td>';
				echo '<td>'.$td['email'].'</td>';
				echo '<td>'.$td['details'].'</td>';
				echo '</tr>';
			}

		}elseif($dataset == 'councils'){
		
			foreach($td as  $values){
				if(is_array($values) && array_key_exists('dataImpact', $values)){

					foreach($values as $value){
						
						foreach ($value as $td1){
							
							
				echo '<tr>';
					echo '<td>'.$td1['userId'].'</td>';
					echo '<td>'.$td1['memberType'].'</td>';	
					echo '<td>'.$td1['name'].'</td>';	
					echo '<td>'.$t1d['department'].'</td>';	
					echo '<td>'.$td1['experience_years'].'</td>';	
					echo '<td>'.$td1['CV_upload'].'</td>';	
					echo '<td>'.$td1['roles'].'</td>';	
					echo '<td>'.$td1['email'].'</td>';	
					echo '<td>'.$td1['gender'].'</td>';	
					echo '<td>'.$td1['mobile'].'</td>';	
					echo '<td>'.$td1['organization'].'</td>';	
					echo '<td>'.$td1['designation'].'</td>';	
					echo '<td>'.$td1['stream'].'</td>';	
					echo '<td>'.$td1['qualification'].'</td>';	
					echo '<td>'.$td1['dateCreated'].'</td>';	
					echo '<td>'.$td1['nomination_status'].'</td>';	
				echo '</tr>';
							
						}
						
										
					//exit;
			//if( array_key_exists('userId', $td1) ) {

				
		//	}						
					}
				}
		
			
			}


		}

		
	}
   
?>
