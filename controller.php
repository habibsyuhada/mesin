<?php
	include("config.php");
	$mesin_1 = mysqli_fetch_array(mysqli_query($conn, "SELECT WO, DATE(record_date) as dates, AVG(meanD_1) as avg1, AVG(meanP_1) as avg2 FROM data_mesin WHERE nomor_mesin = 1 ORDER BY record_date DESC LIMIT 1"));
	$mesin_2 = mysqli_fetch_array(mysqli_query($conn, "SELECT WO, DATE(record_date) as dates, AVG(arah_2) as avg1, AVG(meanSP_2) as avg2 FROM data_mesin WHERE nomor_mesin = 2 and nomor_pc=1 ORDER BY record_date DESC LIMIT 1"));
	$mesin_2b = mysqli_fetch_array(mysqli_query($conn, "SELECT WO, DATE(record_date) as dates, AVG(arah_2) as avg1, AVG(meanSP_2) as avg2 FROM data_mesin WHERE nomor_mesin = 2 and nomor_pc=2 ORDER BY record_date DESC LIMIT 1"));
	$mesin_3 = mysqli_fetch_array(mysqli_query($conn, "SELECT WO, DATE(record_date) as dates, AVG(arah_3) as avg1, AVG(kain_3) as avg2, AVG(forcepeakN_3) as avg3, AVG(forcepeakKgf_3) as avg4, AVG(elongpeak_3) as avg5, AVG(forceopeningN_3) as avg6, AVG(forceopeningKgf_3) as avg7 FROM data_mesin WHERE nomor_mesin = 3 and nomor_pc=1 ORDER BY record_date DESC LIMIT 1"));
	$mesin_3b = mysqli_fetch_array(mysqli_query($conn, "SELECT WO, DATE(record_date) as dates, AVG(arah_3) as avg1, AVG(kain_3) as avg2, AVG(forcepeakN_3) as avg3, AVG(forcepeakKgf_3) as avg4, AVG(elongpeak_3) as avg5, AVG(forceopeningN_3) as avg6, AVG(forceopeningKgf_3) as avg7 FROM data_mesin WHERE nomor_mesin = 3 and nomor_pc=2 ORDER BY record_date DESC LIMIT 1"));
	$mesin_4 = mysqli_fetch_array(mysqli_query($conn, "SELECT WO, DATE(record_date) as dates, AVG(fab_4) as avg1, AVG(eab_4) as avg2, AVG(ten_4) as avg3, AVG(gtd_4) as avg4 FROM data_mesin WHERE nomor_mesin = 4 ORDER BY record_date DESC LIMIT 1"));
	$mesin_5 = mysqli_fetch_array(mysqli_query($conn, "SELECT WO, DATE(record_date) as dates, AVG(tlomaxLong_5) as avg1, AVG(epsilonlomaxLong_5) as avg2, AVG(tlomaxTrans_5) as avg3, AVG(epsilonlomaxTrans_5) as avg4, AVG(penetration_5) as avg5, AVG(puncturedepth_5) as avg6 FROM data_mesin WHERE nomor_mesin = 5 ORDER BY record_date DESC LIMIT 1"));
	
	$data['title_1'] 	= 'Auto Burst m229';
	$data['img_1'] 		= 'img/machines/Autoburst.png';
	$data['costumer_1'] = $mesin_1['WO'];
	$data['date_1'] 	= date("d M Y",strtotime($mesin_1['dates']));
	// $data['progress_1'] = '70%';
	$data['knob_1-1']	= $mesin_1['avg1'];
	$data['knob_1-2'] 	= $mesin_1['avg2'];	
	

	$data['title_2'] 	= 'Elemendrof Fx3750';
	$data['img_2'] 		= 'img/machines/elmendorf_fx3750.png';
	$data['costumer_2'] = $mesin_2['WO'];
	$data['date_2'] 	= date("d M Y",strtotime($mesin_2['dates']));
	// $data['progress_2'] = '60%';
	$data['knob_2-1'] 	= $mesin_2['avg1'];
	$data['knob_2-2'] 	= $mesin_2['avg2'];

	$data['title_2b'] 	= 'Elemendrof Fx3750';
	$data['img_2b'] 	= 'img/machines/elmendorf_fx3750.png';
	$data['costumer_2b']= $mesin_2b['WO'];
	$data['date_2b'] 	= date("d M Y",strtotime($mesin_2b['dates']));
	// $data['progress_2b']= '60%';
	$data['knob_2b-1'] 	= $mesin_2b['avg1'];
	$data['knob_2b-2'] 	= $mesin_2b['avg2'];


	$data['title_3'] 	= 'Testometric M250 2.5 AT';
	$data['img_3'] 		= 'img/machines/testometric_m250_2.png';
	$data['costumer_3'] = $mesin_3['WO'];
	$data['date_3'] 	= date("d M Y",strtotime($mesin_3['dates']));
	// $data['progress_3'] = '60%';
	$data['knob_3-1'] 	= $mesin_3['avg1'];
	$data['knob_3-2'] 	= $mesin_3['avg2'];
	$data['knob_3-3'] 	= $mesin_3['avg3'];
	$data['knob_3-4'] 	= $mesin_3['avg4'];
	$data['knob_3-5'] 	= $mesin_3['avg5'];
	$data['knob_3-6'] 	= $mesin_3['avg6'];
	$data['knob_3-7'] 	= $mesin_3['avg7'];

	$data['title_3b'] 	= 'Testometric M350 10AT';
	$data['img_3b'] 	= 'img/machines/testometric_m350_10AT.png';
	$data['costumer_3b']= $mesin_3b['WO'];
	$data['date_3b'] 	= date("d M Y",strtotime($mesin_3b['dates']));
	// $data['progress_3b']= '60%';
	$data['knob_3b-1'] 	= $mesin_3b['avg1'];
	$data['knob_3b-2'] 	= $mesin_3b['avg2'];
	$data['knob_3b-3'] 	= $mesin_3b['avg3'];
	$data['knob_3b-4'] 	= $mesin_3b['avg4'];
	$data['knob_3b-5'] 	= $mesin_3b['avg5'];
	$data['knob_3b-6'] 	= $mesin_3b['avg6'];
	$data['knob_3b-7'] 	= $mesin_3b['avg7'];


	$data['title_4'] 	= 'Textechno Statimat DS';
	$data['img_4'] 		= 'img/machines/ID212.png';
	$data['costumer_4'] = $mesin_4['WO'];
	$data['date_4'] 	= date("d M Y",strtotime($mesin_4['dates']));
	// $data['progress_4'] = '60%';
	$data['knob_4-1'] 	= $mesin_4['avg1'];
	$data['knob_4-2'] 	= $mesin_4['avg2'];
	$data['knob_4-3'] 	= $mesin_4['avg3'];
	$data['knob_4-4'] 	= $mesin_4['avg4'];


	$data['title_5'] 	= 'Zwickroel';
	$data['img_5'] 		= 'img/machines/ID175472.png';
	$data['costumer_5'] = $mesin_5['WO'];
	$data['date_5'] 	= date("d M Y",strtotime($mesin_5['dates']));
	// $data['progress_5'] = '60%';
	$data['knob_5-1'] 	= $mesin_5['avg1'];
	$data['knob_5-2'] 	= $mesin_5['avg2'];
	$data['knob_5-3'] 	= $mesin_5['avg3'];
	$data['knob_5-4'] 	= $mesin_5['avg4'];
	$data['knob_5-5'] 	= $mesin_5['avg5'];
	$data['knob_5-6'] 	= $mesin_5['avg6'];

	echo json_encode($data);
?>