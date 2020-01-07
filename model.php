<?php
	include("config.php");
	
	$getid = mysqli_query($conn, "SELECT max(id_pemesanan) as max_id, nomor_mesin FROM `data_mesin` GROUP BY nomor_mesin ORDER BY nomor_mesin");
	while($mx=mysqli_fetch_array($getid)){
		switch ($mx['nomor_mesin']) {
			case 1:
				$max_id=$mx['max_id'];
				$mesin_data = mysqli_fetch_array(mysqli_query($conn, "SELECT AVG(meanD_1) avg_d1, AVG(meanP_1) avg_p1, wo, record_date FROM data_mesin WHERE id_pemesanan=$max_id"));

				$data['title_1'] 	= 'Auto Burst m229';
				$data['img_1'] 		= 'img/machines/Autoburst.png';
				$data['costumer_1'] = $mesin_data['WO'];
				$data['date_1'] 	= date("d M Y",strtotime($mesin_data['record_date']));
				$data['progress_1'] = $mesin_data['avg_d1'];
				$data['knob_1-1'] = $mesin_data['avg_d1'];
				$data['knob_1-2'] = $mesin_data['avg_p1'];	
			break;

			case 2:
				$data['title_2'] 		= 'Elemendrof Fx3750';
				$data['img_2'] 			= 'img/machines/Autoburst.png';
				$data['costumer_2'] = 'C007';
				$data['date_2'] 		= '26-12-2019';
				$data['progress_2'] = '60%';
				$data['knob_2-1'] = rand(10,100);
				$data['knob_2-2'] = rand(10,100);
			
				$data['title_2b'] 		= 'Elemendrof Fx3750';
				$data['img_2b'] 			= 'img/machines/Autoburst.png';
				$data['costumer_2b'] = 'C007';
				$data['date_2b'] 		= '26-12-2019';
				$data['progress_2b'] = '60%';
				$data['knob_2b-1'] = rand(10,100);
				$data['knob_2b-2'] = rand(10,100);
			break;

			case 3:
				$data['title_3'] 		= 'Testometric M250 2.5 AT';
				$data['img_3'] 			= 'img/machines/Autoburst.png';
				$data['costumer_3'] = 'C007';
				$data['date_3'] 		= '26-12-2019';
				$data['progress_3'] = '60%';
				$data['knob_3-1'] = rand(10,100);
				$data['knob_3-2'] = rand(10,100);
				$data['knob_3-3'] = rand(10,100);
				$data['knob_3-4'] = rand(10,100);
				$data['knob_3-5'] = rand(10,100);
				$data['knob_3-6'] = rand(10,100);
				$data['knob_3-7'] = rand(10,100);

				$data['title_3b'] 		= 'Testometric M250 2.5 AT';
				$data['img_3b'] 			= 'img/machines/Autoburst.png';
				$data['costumer_3b'] = 'C007';
				$data['date_3b'] 		= '26-12-2019';
				$data['progress_3b'] = '60%';
				$data['knob_3b-1'] = rand(10,100);
				$data['knob_3b-2'] = rand(10,100);
				$data['knob_3b-3'] = rand(10,100);
				$data['knob_3b-4'] = rand(10,100);
				$data['knob_3b-5'] = rand(10,100);
				$data['knob_3b-6'] = rand(10,100);
				$data['knob_3b-7'] = rand(10,100);
			break;

			case 4:
				$data['title_4'] 		= 'Testometric M350 10AT';
				$data['img_4'] 			= 'img/machines/Autoburst.png';
				$data['costumer_4'] = 'C007';
				$data['date_4'] 		= '26-12-2019';
				$data['progress_4'] = '60%';
				$data['knob_4-1'] = rand(10,100);
				$data['knob_4-2'] = rand(10,100);
				$data['knob_4-3'] = rand(10,100);
				$data['knob_4-4'] = rand(10,100);
			break;

			case 5:
				$data['title_5'] 		= 'Textechno Statimat DS';
				$data['img_5'] 			= 'img/machines/Autoburst.png';
				$data['costumer_5'] = 'C007';
				$data['date_5'] 		= '26-12-2019';
				$data['progress_5'] = '60%';
				$data['knob_5-1'] = rand(10,100);
				$data['knob_5-2'] = rand(10,100);
				$data['knob_5-3'] = rand(10,100);
				$data['knob_5-4'] = rand(10,100);
				$data['knob_5-5'] = rand(10,100);
				$data['knob_5-6'] = rand(10,100);
			break;

		}
	
	
	
	// $data['knob_5-7'] = rand(10,100);

	// $data['title_6'] 		= 'Elemendrof';
	// $data['img_6'] 			= 'img/machines/Autoburst.png';
	// $data['costumer_6'] = 'C007';
	// $data['date_6'] 		= '26-12-2019';
	// $data['progress_6'] = '60%';
	// $data['knob_6-1'] = rand(10,100);
	// $data['knob_6-2'] = rand(10,100);
	// $data['knob_6-3'] = rand(10,100);
	// $data['knob_6-4'] = rand(10,100);
	// $data['knob_6-5'] = rand(10,100);
	// $data['knob_6-6'] = rand(10,100);
	// $data['knob_6-7'] = rand(10,100);
	echo json_encode($data);
	}
?>