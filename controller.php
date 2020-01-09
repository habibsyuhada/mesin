<?php
	include("config.php");
	$mesin_1 = mysqli_fetch_array(mysqli_query($conn, "SELECT WO, DATE(record_date) as dates, meanD_1 as avg1, meanP_1 as avg2 FROM data_mesin WHERE nomor_mesin = 1 ORDER BY record_date DESC LIMIT 1"));
	$mesin_2 = mysqli_fetch_array(mysqli_query($conn, "SELECT WO, DATE(record_date) as dates, arah_2, meanSP_2 as avg2 FROM data_mesin WHERE nomor_mesin = 2 and nomor_pc=1 ORDER BY record_date DESC LIMIT 1"));
	$mesin_2b = mysqli_fetch_array(mysqli_query($conn, "SELECT WO, DATE(record_date) as dates, arah_2, meanSP_2 as avg2 FROM data_mesin WHERE nomor_mesin = 2 and nomor_pc=2 ORDER BY record_date DESC LIMIT 1"));
	$mesin_3 = mysqli_fetch_array(mysqli_query($conn, "SELECT WO, DATE(record_date) as dates, arah_3, kain_3, forcepeakN_3, forcepeakKgf_3, elongpeak_3, forceopeningN_3, forceopeningKgf_3 FROM data_mesin WHERE nomor_mesin = 3 and nomor_pc=1 ORDER BY record_date DESC LIMIT 1"));
	$mesin_3b = mysqli_fetch_array(mysqli_query($conn, "SELECT WO, DATE(record_date) as dates, arah_3, kain_3, forcepeakN_3, forcepeakKgf_3, elongpeak_3, forceopeningN_3, forceopeningKgf_3 FROM data_mesin WHERE nomor_mesin = 3 and nomor_pc=2 ORDER BY record_date DESC LIMIT 1"));
	$mesin_4 = mysqli_fetch_array(mysqli_query($conn, "SELECT WO, DATE(record_date) as dates, fab_4, eab_4, ten_4, wtb_4, tex_4 FROM data_mesin WHERE nomor_mesin = 4 ORDER BY record_date DESC LIMIT 1"));
	$mesin_5 = mysqli_fetch_array(mysqli_query($conn, "SELECT WO, DATE(record_date) as dates, penetration_5, puncturedepth_5 FROM data_mesin WHERE nomor_mesin = 5 ORDER BY record_date DESC LIMIT 1"));
	
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
	$data['knob_2-1'] 	= $mesin_2['arah_2'];
	$data['bar_2-1'] 	= $mesin_2['avg2'];


	$data['title_2b'] 	= 'Elemendrof Fx3750';
	$data['img_2b'] 	= 'img/machines/elmendorf_fx3750.png';
	$data['costumer_2b']= $mesin_2b['WO'];
	$data['date_2b'] 	= date("d M Y",strtotime($mesin_2b['dates']));
	// $data['progress_2b']= '60%';
	$data['knob_2b-1'] 	= $mesin_2b['arah_2'];
	$data['bar_2b-1'] 	= $mesin_2b['avg2'];


	$data['title_3'] 	= 'Testometric M250 2.5 AT';
	$data['img_3'] 		= 'img/machines/testometric_m250_2.png';
	$data['costumer_3'] = $mesin_3['WO'];
	$data['date_3'] 	= date("d M Y",strtotime($mesin_3['dates']));
	// $data['progress_3'] = '60%';
	$data['arah_3'] 				= $mesin_3['arah_3'];
	$data['forcepeakN_3'] 	= $mesin_3['forcepeakN_3']." N";
	$data['forcepeakKgf_3'] = $mesin_3['forcepeakKgf_3']." Kgf";
	$data['elongpeak_3'] 		= $mesin_3['elongpeak_3']."%";


	$data['title_3b'] 	= 'Testometric M350 10AT';
	$data['img_3b'] 	= 'img/machines/testometric_m350_10AT.png';
	$data['costumer_3b']= $mesin_3b['WO'];
	$data['date_3b'] 	= date("d M Y",strtotime($mesin_3b['dates']));
	// $data['progress_3b']= '60%';
	$data['arah_3b'] 				= $mesin_3b['arah_3'];
	$data['forcepeakN_3b'] 	= $mesin_3b['forcepeakN_3']." N";
	$data['forcepeakKgf_3b'] = $mesin_3b['forcepeakKgf_3']." Kgf";
	$data['elongpeak_3b'] 		= $mesin_3b['elongpeak_3']."%";


	$data['title_4'] 	= 'Textechno Statimat DS';
	$data['img_4'] 		= 'img/machines/ID212.png';
	$data['costumer_4'] = $mesin_4['WO'];
	$data['date_4'] 	= date("d M Y",strtotime($mesin_4['dates']));
	// $data['progress_4'] = '60%';
	$data['fab_4'] 	= ($mesin_4['fab_4'] > 100 ? 100 : $mesin_4['fab_4']);
	$data['eab_4'] 	= ($mesin_4['eab_4'] > 100 ? 100 : $mesin_4['eab_4']).'%';
	$data['ten_4'] 	= ($mesin_4['ten_4'] > 100 ? 100 : $mesin_4['ten_4']);
	$data['wtb_4'] 	= ($mesin_4['wtb_4'] > 100 ? 100 : $mesin_4['wtb_4']);
	$data['tex_4'] 	= ($mesin_4['tex_4'] > 100 ? 100 : $mesin_4['tex_4']).' Tex';


	$data['title_5'] 	= 'Zwickroel';
	$data['img_5'] 		= 'img/machines/ID175472.png';
	$data['costumer_5'] = $mesin_5['WO'];
	$data['date_5'] 	= date("d M Y",strtotime($mesin_5['dates']));
	// $data['progress_5'] = '60%';
	$data['penetration_5'] 	= ($mesin_5['penetration_5'] > 100 ? 100 : $mesin_5['penetration_5']);
	$data['puncturedepth_5'] 	= ($mesin_5['puncturedepth_5'] > 100 ? 100 : $mesin_5['puncturedepth_5']);

	echo json_encode($data);
?>