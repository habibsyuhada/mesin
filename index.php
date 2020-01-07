<?php
	include("config.php");
	$mesin_1 = mysqli_fetch_array(mysqli_query($conn, "SELECT WO, DATE(record_date) as dates FROM data_mesin WHERE nomor_mesin = 1 ORDER BY record_date DESC LIMIT 1"));
	$mesin_2 = mysqli_fetch_array(mysqli_query($conn, "SELECT WO, DATE(record_date) as dates FROM data_mesin WHERE nomor_mesin = 2 ORDER BY record_date DESC LIMIT 1"));
	$mesin_3 = mysqli_fetch_array(mysqli_query($conn, "SELECT WO, DATE(record_date) as dates FROM data_mesin WHERE nomor_mesin = 3 ORDER BY record_date DESC LIMIT 1"));
	$mesin_4 = mysqli_fetch_array(mysqli_query($conn, "SELECT WO, DATE(record_date) as dates FROM data_mesin WHERE nomor_mesin = 4 ORDER BY record_date DESC LIMIT 1"));
	$mesin_5 = mysqli_fetch_array(mysqli_query($conn, "SELECT WO, DATE(record_date) as dates FROM data_mesin WHERE nomor_mesin = 5 ORDER BY record_date DESC LIMIT 1"));

	$getTrends = mysqli_query($conn, "SELECT nomor_mesin, date(record_date) as dates, count(*) as jumlah FROM data_mesin GROUP BY nomor_mesin, date(record_date) ORDER BY nomor_mesin, record_date DESC");

	while($d=mysqli_fetch_array($getTrends)){
	if($d['nomor_mesin'] == 1){
		$nomor1[$d['dates']] = $d['jumlah'];
	}else if($d['nomor_mesin'] == 2){
		$nomor2[$d['dates']] = $d['jumlah'];
	}else if($d['nomor_mesin'] == 3){
		$nomor3[$d['dates']] = $d['jumlah'];
	}else if($d['nomor_mesin'] == 4){
		$nomor4[$d['dates']] = $d['jumlah'];
	}else if($d['nomor_mesin'] == 5){
		$nomor5[$d['dates']] = $d['jumlah'];
	}
	}
	$date_now = date("Y-m-d");
	$date_before = date("Y-m-d",strtotime("-7 days"));

	while($date_before != $date_now){
	$record_date[] = $date_before;
	if(isset($nomor1[$date_before])){
		$mesin1[] = $nomor1[$date_before];
	}else{
		$mesin1[] = 0;
	}
	
	if(isset($nomor2[$date_before])){
		$mesin2[] = $nomor2[$date_before];
	}else{
		$mesin2[] = 0;
	}
	
	if(isset($nomor3[$date_before])){
		$mesin3[] = $nomor3[$date_before];
	}else{
		$mesin3[] = 0;
	}
	
	if(isset($nomor4[$date_before])){
		$mesin4[] = $nomor4[$date_before];
	}else{
		$mesin4[] = 0;
	}
	
	if(isset($nomor5[$date_before])){
		$mesin5[] = $nomor5[$date_before];
	}else{
		$mesin5[] = 0;
	}
	$date_before = date("Y-m-d",strtotime($date_before . "+1 days"));
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Dashboard</title>
		<link href="dist/css/bootstrap.min.css" rel="stylesheet">
		<link href="dist/css/jquery-ui.min.css" rel="stylesheet">
		<link href="dist/css/style.css" rel="stylesheet">
	  <!-- <script type="text/javascript" src="dist/js/jquery-3.4.1.slim.min.js"></script> -->
	  <!-- <script type="text/javascript" src="dist/js/jquery-1.12.4.js"></script> -->
	  <script type="text/javascript" src="dist/js/jquery-3.4.1.min.js"></script>
	  <script type="text/javascript" src="dist/js/bootstrap.min.js"></script>
	  <script type="text/javascript" src="dist/js/popper.min.js"></script>
	  <script type="text/javascript" src="dist/js/jquery-ui.min.js"></script>
	  <script type="text/javascript" src="dist/js/jquery.knob.min.js"></script>

	  <script type="text/javascript" src="dist/js/Chart.bundle.min.js"></script>

	  <style type="text/css">
	  	.keterangan_chart{
	  		text-align: center;
	  		margin-top: -1.5em;
	  		font-size: 1rem;
	  	}
	  	@media screen and (min-width: 1200px) {
			  #folder1{
			  	position: relative;
			  	left: 50%;
			  	transform: translateX(-50%);
			  	float: both;
			  }
			  #folder2{
			  	/*top : 5vh;*/
					left: -30%;
					position: relative;
			  }
			  #folder2b{
			  	float: right;
			  	/*top : 5vh;*/
			  	position: relative;
			  }
			  #folder3{
			  	/*top : -1vh;*/
			  	position: relative;
			  }
			  #folder3b{
			  	float: right;
			  	/*top : 5vh;*/
			  	position: relative;
			  }
			  #folder4{
			  	/*top : 5vh;*/
			  	position: relative;
			  }
			  #folder5{
			  	float: right;
			  	/*top : 5vh;*/
			  	position: relative;
			  }
			  .clear{
				  clear: both;
				}
			}
	  </style>
	</head>
	<body>
		<div class="container-fluid">
			<br>
				
			<div id="folder1" class="folder folder-25 card bg-transparent d-flex border-0 draggable">
				<div class="folder-header" >
			  	<div class="card-header bg-transparent rounded-0 p-2"></div>
				</div>
			  <div class="card-body resizable-1">
			    <div class="row align-items-center justify-content-center">
			    	<div class="col-4">
			    		<img id="img_1" src="" width="80%">
			    	</div>
			    	<div class="col">
			    		<h5 class="card-title"><span id="title_1">-</span></h5>
			    		Costumer No: <span id="costumer_1"></span><br>
			    		Date: <span id="date_1"></span><br>
			    		<!-- Progress: <span id="progress_1"></span><br> -->
			    	</div>
			    </div>
					<div class="row align-items-center justify-content-center mt-1" style="flex-wrap: nowrap;">
						<div class="col-3">
							<canvas id="autoburst" height="100%"></canvas>
						</div>
						<div class="col-9">
							<div class="row">
								<div class="col-sm-3">
									<input type="text" name="knob_1-1" class="knob" value="0" data-width="95%" data-height="95%" data-fgColor="#2d89ef" data-thickness="0.2" data-angleArc="250" data-angleOffset="-125" readonly>
									<div class="keterangan_chart">Keterangan</div>
								</div>
								<div class="col-sm-3">
									<input type="text" name="knob_1-2" class="knob" value="0" data-width="95%" data-height="95%" data-fgColor="#ffc40d" data-thickness="0.2" data-angleArc="250" data-angleOffset="-125" readonly>
									<div class="keterangan_chart">Keterangan</div>
								</div>
							</div>
						</div>
			    	
			    </div>
			  </div>
			</div>						

			<div id="folder2" class="folder folder-25 card bg-transparent d-flex border-0 draggable">
				<div class="folder-header" >
			  	<div class="card-header bg-transparent rounded-0 p-2"></div>
				</div>
			  <div class="card-body resizable-1">
			    <div class="row align-items-center justify-content-center">
			    	<div class="col-4">
			    		<img id="img_2" src="" width="80%">
			    	</div>
			    	<div class="col">
			    		<h5 class="card-title"><span id="title_2">-</span></h5>
			    		Costumer No: <span id="costumer_2"></span><br>
			    		Date: <span id="date_2"></span><br>
			    		<!-- Progress: <span id="progress_2"></span><br> -->
			    	</div>
			    </div>
					<div class="row align-items-center justify-content-center mt-1" style="flex-wrap: nowrap;">
						<div class="col-3">
							<canvas id="elemendorf1" height="100%"></canvas>
						</div>
						<div class="col-9">
							<div class="row">
								<div class="col-sm-3">
									<input type="text" name="knob_2-1" class="knob" value="0" data-width="95%" data-height="95%" data-fgColor="#2d89ef" data-thickness="0.2" data-angleArc="250" data-angleOffset="-125" readonly>
									<div class="keterangan_chart">Keterangan</div>
								</div>
								<div class="col-sm-3">
									<input type="text" name="knob_2-2" class="knob" value="0" data-width="95%" data-height="95%" data-fgColor="#ffc40d" data-thickness="0.2" data-angleArc="250" data-angleOffset="-125" readonly>
									<div class="keterangan_chart">Keterangan</div>
								</div>
							</div>
						</div>
			    	
			    </div>
			  </div>
			</div>

			<div id="folder2b" class="folder folder-25 card bg-transparent d-flex border-0 draggable">
				<div class="folder-header" >
			  	<div class="card-header bg-transparent rounded-0 p-2"></div>
				</div>
			  <div class="card-body resizable-1">
			    <div class="row align-items-center justify-content-center">
			    	<div class="col-4">
			    		<img id="img_2b" src="" width="80%">
			    	</div>
			    	<div class="col">
			    		<h5 class="card-title"><span id="title_2b">-</span></h5>
			    		Costumer No: <span id="costumer_2b"></span><br>
			    		Date: <span id="date_2b"></span><br>
			    		<!-- Progress: <span id="progress_2"></span><br> -->
			    	</div>
			    </div>
					<div class="row align-items-center justify-content-center mt-1" style="flex-wrap: nowrap;">
						<div class="col-3">
							<canvas id="elemendorf2" height="100%"></canvas>
						</div>
						<div class="col-9">
							<div class="row">
								<div class="col-sm-3">
									<input type="text" name="knob_2b-1" class="knob" value="0" data-width="95%" data-height="95%" data-fgColor="#2d89ef" data-thickness="0.2" data-angleArc="250" data-angleOffset="-125" readonly>
									<div class="keterangan_chart">Keterangan</div>
								</div>
								<div class="col-sm-3">
									<input type="text" name="knob_2b-2" class="knob" value="0" data-width="95%" data-height="95%" data-fgColor="#ffc40d" data-thickness="0.2" data-angleArc="250" data-angleOffset="-125" readonly>
									<div class="keterangan_chart">Keterangan</div>
								</div>
							</div>
						</div>
			    	
			    </div>
			  </div>
			</div>						
			
			<div class="clear"></div>

			<div id="folder4" class="folder folder-25 card bg-transparent d-flex border-0 draggable">
				<div class="folder-header">
			  	<div class="card-header bg-transparent rounded-0 p-2"></div>
				</div>
			  <div class="card-body resizable-1">
			    <div class="row align-items-center justify-content-center">
			    	<div class="col-4">
			    		<img id="img_4" src="" width="80%">
			    	</div>
			    	<div class="col">
			    		<h5 class="card-title"><span id="title_4">-</span></h5>
			    		Costumer No: <span id="costumer_4"></span><br>
			    		Date: <span id="date_4"></span><br>
			    		<!-- Progress: <span id="progress_4"></span><br> -->
			    	</div>
			    </div>
					<div class="row align-items-center justify-content-center mt-1" style="flex-wrap: nowrap;">
						<div class="col-3">
							<canvas id="testometric1" height="100%"></canvas>
						</div>
						<div class="col-9">
							<div class="row">
								<div class="col-sm-3">
									<input type="text" name="knob_4-1" class="knob" value="0" data-width="95%" data-height="95%" data-fgColor="#2d89ef" data-thickness="0.2" data-angleArc="250" data-angleOffset="-125" readonly>
									<div class="keterangan_chart">Keterangan</div>
								</div>
								<div class="col-sm-3">
									<input type="text" name="knob_4-2" class="knob" value="0" data-width="95%" data-height="95%" data-fgColor="#ffc40d" data-thickness="0.2" data-angleArc="250" data-angleOffset="-125" readonly>
									<div class="keterangan_chart">Keterangan</div>
								</div>
								<div class="col-sm-3">
									<input type="text" name="knob_4-3" class="knob" value="0" data-width="95%" data-height="95%" data-fgColor="#ff0080" data-thickness="0.2" data-angleArc="250" data-angleOffset="-125" readonly>
									<div class="keterangan_chart">Keterangan</div>
								</div>
								<div class="col-sm-3">
									<input type="text" name="knob_4-3" class="knob" value="0" data-width="95%" data-height="95%" data-fgColor="#9f00a7" data-thickness="0.2" data-angleArc="250" data-angleOffset="-125" readonly>
									<div class="keterangan_chart">Keterangan</div>
								</div>
							</div>
						</div>
			    	
			    </div>
			  </div>
			</div>

			<div id="folder5" class="folder folder-25 card bg-transparent d-flex border-0 draggable">
				<div class="folder-header" >
			  	<div class="card-header bg-transparent rounded-0 p-2"></div>
				</div>
			  <div class="card-body resizable-1">
			    <div class="row align-items-center justify-content-center">
			    	<div class="col-4">
			    		<img id="img_5" src="" width="80%">
			    	</div>
			    	<div class="col">
			    		<h5 class="card-title"><span id="title_5">-</span></h5>
			    		Costumer No: <span id="costumer_5"></span><br>
			    		Date: <span id="date_5"></span><br>
			    		<!-- Progress: <span id="progress_5"></span><br> -->
			    	</div>
			    </div>
					<div class="row align-items-center justify-content-center mt-1" style="flex-wrap: nowrap;">
						<div class="col-3">
							<canvas id="statimat" height="100%"></canvas>
						</div>
						<div class="col-9">
							<div class="row">
								<div class="col-sm-3">
									<input type="text" name="knob_5-1" class="knob" value="0" data-width="95%" data-height="95%" data-fgColor="#2d89ef" data-thickness="0.2" data-angleArc="250" data-angleOffset="-125" readonly>
									<div class="keterangan_chart">Keterangan</div>
								</div>
								<div class="col-sm-3">
									<input type="text" name="knob_5-2" class="knob" value="0" data-width="95%" data-height="95%" data-fgColor="#ffc40d" data-thickness="0.2" data-angleArc="250" data-angleOffset="-125" readonly>
									<div class="keterangan_chart">Keterangan</div>
								</div>
								<div class="col-sm-3">
									<input type="text" name="knob_5-3" class="knob" value="0" data-width="95%" data-height="95%" data-fgColor="#ff0080" data-thickness="0.2" data-angleArc="250" data-angleOffset="-125" readonly>
									<div class="keterangan_chart">Keterangan</div>
								</div>
								<div class="col-sm-3">
									<input type="text" name="knob_5-4" class="knob" value="0" data-width="95%" data-height="95%" data-fgColor="#9f00a7" data-thickness="0.2" data-angleArc="250" data-angleOffset="-125" readonly>
									<div class="keterangan_chart">Keterangan</div>
								</div>
								<!-- <div class="col-sm-2">
									<input type="text" name="knob_5-5" class="knob" value="0" data-width="95%" data-height="95%" data-fgColor="#99b433" data-thickness="0.2" data-angleArc="250" data-angleOffset="-125" readonly>
									<div class="keterangan_chart">Keterangan</div>
								</div>
								<div class="col-sm-2">
									<input type="text" name="knob_5-6" class="knob" value="0" data-width="95%" data-height="95%" data-fgColor="#ff7675" data-thickness="0.2" data-angleArc="250" data-angleOffset="-125" readonly>
									<div class="keterangan_chart">Keterangan</div>
								</div> -->
							</div>
							<div class="row">
								<!-- <div class="col-sm-3">
									<input type="text" name="knob_5-1" class="knob" value="0" data-width="95%" data-height="95%" data-fgColor="#2d89ef" data-thickness="0.2" data-angleArc="250" data-angleOffset="-125" readonly>
									<div class="keterangan_chart">Keterangan</div>
								</div>
								<div class="col-sm-3">
									<input type="text" name="knob_5-2" class="knob" value="0" data-width="95%" data-height="95%" data-fgColor="#ffc40d" data-thickness="0.2" data-angleArc="250" data-angleOffset="-125" readonly>
									<div class="keterangan_chart">Keterangan</div>
								</div>
								<div class="col-sm-3">
									<input type="text" name="knob_5-3" class="knob" value="0" data-width="95%" data-height="95%" data-fgColor="#ff0080" data-thickness="0.2" data-angleArc="250" data-angleOffset="-125" readonly>
									<div class="keterangan_chart">Keterangan</div>
								</div>
								<div class="col-sm-3">
									<input type="text" name="knob_5-4" class="knob" value="0" data-width="95%" data-height="95%" data-fgColor="#9f00a7" data-thickness="0.2" data-angleArc="250" data-angleOffset="-125" readonly>
									<div class="keterangan_chart">Keterangan</div>
								</div> -->
								<div class="col-sm-3">
									<input type="text" name="knob_5-5" class="knob" value="0" data-width="95%" data-height="95%" data-fgColor="#99b433" data-thickness="0.2" data-angleArc="250" data-angleOffset="-125" readonly>
									<div class="keterangan_chart">Keterangan</div>
								</div>
								<div class="col-sm-3">
									<input type="text" name="knob_5-6" class="knob" value="0" data-width="95%" data-height="95%" data-fgColor="#ff7675" data-thickness="0.2" data-angleArc="250" data-angleOffset="-125" readonly>
									<div class="keterangan_chart">Keterangan</div>
								</div>
							</div>
						</div>
			    	
			    </div>
			  </div>
			</div>

			<div class="clear"></div>

			<div id="folder3" class="folder folder-25 card bg-transparent d-flex border-0 draggable">
				<div class="folder-header" >
			  	<div class="card-header bg-transparent rounded-0 p-2"></div>
				</div>
			  <div class="card-body resizable-1">
			    <div class="row align-items-center justify-content-center">
			    	<div class="col-4">
			    		<img id="img_3" src="" width="80%">
			    	</div>
			    	<div class="col">
			    		<h5 class="card-title"><span id="title_3">-</span></h5>
			    		Costumer No: <span id="costumer_3"></span><br>
			    		Date: <span id="date_3"></span><br>
			    		<!-- Progress: <span id="progress_3"></span><br> -->
			    	</div>
			    </div>
					<div class="row align-items-center justify-content-center mt-1" style="flex-wrap: nowrap;">
						<div class="col-3">
							<canvas id="testometric2" height="100%"></canvas>
						</div>
						<div class="col-9">
							<div class="row">
								<div class="col-sm-3">
									<input type="text" name="knob_3-1" class="knob" value="0" data-width="95%" data-height="95%" data-fgColor="#2d89ef" data-thickness="0.2" data-angleArc="250" data-angleOffset="-125" readonly>
									<div class="keterangan_chart">Keterangan</div>
								</div>
								<div class="col-sm-3">
									<input type="text" name="knob_3-2" class="knob" value="0" data-width="95%" data-height="95%" data-fgColor="#ffc40d" data-thickness="0.2" data-angleArc="250" data-angleOffset="-125" readonly>
									<div class="keterangan_chart">Keterangan</div>
								</div>
								<div class="col-sm-3">
									<input type="text" name="knob_3-3" class="knob" value="0" data-width="95%" data-height="95%" data-fgColor="#ff0080" data-thickness="0.2" data-angleArc="250" data-angleOffset="-125" readonly>
									<div class="keterangan_chart">Keterangan</div>
								</div>
								<div class="col-sm-3">
									<input type="text" name="knob_3-4" class="knob" value="0" data-width="95%" data-height="95%" data-fgColor="#9f00a7" data-thickness="0.2" data-angleArc="250" data-angleOffset="-125" readonly>
									<div class="keterangan_chart">Keterangan</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-3">
									<input type="text" name="knob_3-5" class="knob" value="0" data-width="95%" data-height="95%" data-fgColor="#99b433" data-thickness="0.2" data-angleArc="250" data-angleOffset="-125" readonly>
									<div class="keterangan_chart">Keterangan</div>
								</div>
								<div class="col-sm-3">
									<input type="text" name="knob_3-6" class="knob" value="0" data-width="95%" data-height="95%" data-fgColor="#ff7675" data-thickness="0.2" data-angleArc="250" data-angleOffset="-125" readonly>
									<div class="keterangan_chart">Keterangan</div>
								</div>
								<div class="col-sm-3">
									<input type="text" name="knob_3-7" class="knob" value="0" data-width="95%" data-height="95%" data-fgColor="#ee1111" data-thickness="0.2" data-angleArc="250" data-angleOffset="-125" readonly>
									<div class="keterangan_chart">Keterangan</div>
								</div>
							</div>
						</div>
			    	
			    </div>
			  </div>
			</div>

			<div id="folder3b" class="folder folder-25 card bg-transparent d-flex border-0 draggable">
				<div class="folder-header" >
			  	<div class="card-header bg-transparent rounded-0 p-2"></div>
				</div>
			  <div class="card-body resizable-1">
			    <div class="row align-items-center justify-content-center">
			    	<div class="col-4">
			    		<img id="img_3b" src="" width="80%">
			    	</div>
			    	<div class="col">
			    		<h5 class="card-title"><span id="title_3b">-</span></h5>
			    		Costumer No: <span id="costumer_3b"></span><br>
			    		Date: <span id="date_3b"></span><br>
			    		<!-- Progress: <span id="progress_3"></span><br> -->
			    	</div>
			    </div>
					<div class="row align-items-center justify-content-center mt-1" style="flex-wrap: nowrap;">
						<div class="col-3">
							<canvas id="testometric3" height="100%"></canvas>
						</div>
						<div class="col-9">
							<div class="row">
								<div class="col-sm-3">
									<input type="text" name="knob_3b-1" class="knob" value="0" data-width="95%" data-height="95%" data-fgColor="#2d89ef" data-thickness="0.2" data-angleArc="250" data-angleOffset="-125" readonly>
									<div class="keterangan_chart">Keterangan</div>
								</div>
								<div class="col-sm-3">
									<input type="text" name="knob_3b-2" class="knob" value="0" data-width="95%" data-height="95%" data-fgColor="#ffc40d" data-thickness="0.2" data-angleArc="250" data-angleOffset="-125" readonly>
									<div class="keterangan_chart">Keterangan</div>
								</div>
								<div class="col-sm-3">
									<input type="text" name="knob_3b-3" class="knob" value="0" data-width="95%" data-height="95%" data-fgColor="#ff0080" data-thickness="0.2" data-angleArc="250" data-angleOffset="-125" readonly>
									<div class="keterangan_chart">Keterangan</div>
								</div>
								<div class="col-sm-3">
									<input type="text" name="knob_3b-4" class="knob" value="0" data-width="95%" data-height="95%" data-fgColor="#9f00a7" data-thickness="0.2" data-angleArc="250" data-angleOffset="-125" readonly>
									<div class="keterangan_chart">Keterangan</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-3">
									<input type="text" name="knob_3b-5" class="knob" value="0" data-width="95%" data-height="95%" data-fgColor="#99b433" data-thickness="0.2" data-angleArc="250" data-angleOffset="-125" readonly>
									<div class="keterangan_chart">Keterangan</div>
								</div>
								<div class="col-sm-3">
									<input type="text" name="knob_3b-6" class="knob" value="0" data-width="95%" data-height="95%" data-fgColor="#ff7675" data-thickness="0.2" data-angleArc="250" data-angleOffset="-125" readonly>
									<div class="keterangan_chart">Keterangan</div>
								</div>
								<div class="col-sm-3">
									<input type="text" name="knob_3b-7" class="knob" value="0" data-width="95%" data-height="95%" data-fgColor="#ee1111" data-thickness="0.2" data-angleArc="250" data-angleOffset="-125" readonly>
									<div class="keterangan_chart">Keterangan</div>
								</div>
							</div>
						</div>
			    	
			    </div>
			  </div>
			</div>

		</div>
		<script type="text/javascript">
  $(function () {
    ctx = document.getElementById('autoburst').getContext('2d');
    data = {"labels":<?=json_encode($record_date)?>,"datasets":[{"label":"Total Test","data":<?=json_encode($mesin1)?>,"fill":false,"borderColor":"#d63031","lineTension":0.1}]};
    myChart = new Chart(ctx, {
      type: 'line',
      data: data,
      options: {
                responsive: !0,
                maintainAspectRatio: !1,
                title: {
                    display: !1,
                    text: "Chart.js Line Chart"
                },
                legend: {
                    display: !1
                },
                layout: {
                    padding: {
                        left: 10,
                        right: 10,
                        top: 10,
                        bottom: 10
                    }
                },
                tooltips: {
                    mode: "index",
                    intersect: !1
                },
                hover: {
                    mode: "nearest",
                    intersect: !0
                },
                scales: {
                    xAxes: [{
                        display: !1,
                        scaleLabel: {
                            display: !0,
                            labelString: "Month"
                        }
                    }],
                    yAxes: [{
                        display: !1,
                        scaleLabel: {
                            display: !0,
                            labelString: "Value"
                        }
                    }]
                }
            }
    });

    ctx1 = document.getElementById('elemendorf1').getContext('2d');
    data = {"labels":<?=json_encode($record_date)?>,"datasets":[{"label":"Total Test","data":<?=json_encode($mesin2)?>,"fill":false,"borderColor":"#d63031","lineTension":0.1}]};
    myChart = new Chart(ctx1, {
      type: 'line',
      data: data,
      options: {
                responsive: !0,
                maintainAspectRatio: !1,
                title: {
                    display: !1,
                    text: "Chart.js Line Chart"
                },
                legend: {
                    display: !1
                },
                layout: {
                    padding: {
                        left: 10,
                        right: 10,
                        top: 10,
                        bottom: 10
                    }
                },
                tooltips: {
                    mode: "index",
                    intersect: !1
                },
                hover: {
                    mode: "nearest",
                    intersect: !0
                },
                scales: {
                    xAxes: [{
                        display: !1,
                        scaleLabel: {
                            display: !0,
                            labelString: "Month"
                        }
                    }],
                    yAxes: [{
                        display: !1,
                        scaleLabel: {
                            display: !0,
                            labelString: "Value"
                        }
                    }]
                }
            }
    });
    
    ctx2 = document.getElementById('elemendorf2').getContext('2d');
    data = {"labels":<?=json_encode($record_date)?>,"datasets":[{"label":"Total Test","data":<?=json_encode($mesin2)?>,"fill":false,"borderColor":"#d63031","lineTension":0.1}]};
    myChart = new Chart(ctx2, {
      type: 'line',
      data: data,
      options: {
                responsive: !0,
                maintainAspectRatio: !1,
                title: {
                    display: !1,
                    text: "Chart.js Line Chart"
                },
                legend: {
                    display: !1
                },
                layout: {
                    padding: {
                        left: 10,
                        right: 10,
                        top: 10,
                        bottom: 10
                    }
                },
                tooltips: {
                    mode: "index",
                    intersect: !1
                },
                hover: {
                    mode: "nearest",
                    intersect: !0
                },
                scales: {
                    xAxes: [{
                        display: !1,
                        scaleLabel: {
                            display: !0,
                            labelString: "Month"
                        }
                    }],
                    yAxes: [{
                        display: !1,
                        scaleLabel: {
                            display: !0,
                            labelString: "Value"
                        }
                    }]
                }
            }
    });

    ctx1 = document.getElementById('testometric1').getContext('2d');
    data = {"labels":<?=json_encode($record_date)?>,"datasets":[{"label":"Total Test","data":<?=json_encode($mesin3)?>,"fill":false,"borderColor":"#d63031","lineTension":0.1}]};
    myChart = new Chart(ctx1, {
      type: 'line',
      data: data,
      options: {
                responsive: !0,
                maintainAspectRatio: !1,
                title: {
                    display: !1,
                    text: "Chart.js Line Chart"
                },
                legend: {
                    display: !1
                },
                layout: {
                    padding: {
                        left: 10,
                        right: 10,
                        top: 10,
                        bottom: 10
                    }
                },
                tooltips: {
                    mode: "index",
                    intersect: !1
                },
                hover: {
                    mode: "nearest",
                    intersect: !0
                },
                scales: {
                    xAxes: [{
                        display: !1,
                        scaleLabel: {
                            display: !0,
                            labelString: "Month"
                        }
                    }],
                    yAxes: [{
                        display: !1,
                        scaleLabel: {
                            display: !0,
                            labelString: "Value"
                        }
                    }]
                }
            }
    });

    ctx1 = document.getElementById('testometric2').getContext('2d');
    data = {"labels":<?=json_encode($record_date)?>,"datasets":[{"label":"Total Test","data":<?=json_encode($mesin3)?>,"fill":false,"borderColor":"#d63031","lineTension":0.1}]};
    myChart = new Chart(ctx1, {
      type: 'line',
      data: data,
      options: {
                responsive: !0,
                maintainAspectRatio: !1,
                title: {
                    display: !1,
                    text: "Chart.js Line Chart"
                },
                legend: {
                    display: !1
                },
                layout: {
                    padding: {
                        left: 10,
                        right: 10,
                        top: 10,
                        bottom: 10
                    }
                },
                tooltips: {
                    mode: "index",
                    intersect: !1
                },
                hover: {
                    mode: "nearest",
                    intersect: !0
                },
                scales: {
                    xAxes: [{
                        display: !1,
                        scaleLabel: {
                            display: !0,
                            labelString: "Month"
                        }
                    }],
                    yAxes: [{
                        display: !1,
                        scaleLabel: {
                            display: !0,
                            labelString: "Value"
                        }
                    }]
                }
            }
    });

    ctx1 = document.getElementById('statimat').getContext('2d');
    data = {"labels":<?=json_encode($record_date)?>,"datasets":[{"label":"Total Test","data":<?=json_encode($mesin4)?>,"fill":false,"borderColor":"#d63031","lineTension":0.1}]};
    myChart = new Chart(ctx1, {
      type: 'line',
      data: data,
      options: {
                responsive: !0,
                maintainAspectRatio: !1,
                title: {
                    display: !1,
                    text: "Chart.js Line Chart"
                },
                legend: {
                    display: !1
                },
                layout: {
                    padding: {
                        left: 10,
                        right: 10,
                        top: 10,
                        bottom: 10
                    }
                },
                tooltips: {
                    mode: "index",
                    intersect: !1
                },
                hover: {
                    mode: "nearest",
                    intersect: !0
                },
                scales: {
                    xAxes: [{
                        display: !1,
                        scaleLabel: {
                            display: !0,
                            labelString: "Month"
                        }
                    }],
                    yAxes: [{
                        display: !1,
                        scaleLabel: {
                            display: !0,
                            labelString: "Value"
                        }
                    }]
                }
            }
    });

    ctx1 = document.getElementById('testometric3').getContext('2d');
    data = {"labels":<?=json_encode($record_date)?>,"datasets":[{"label":"Total Test","data":<?=json_encode($mesin3)?>,"fill":false,"borderColor":"#d63031","lineTension":0.1}]};
    myChart = new Chart(ctx1, {
      type: 'line',
      data: data,
      options: {
                responsive: !0,
                maintainAspectRatio: !1,
                title: {
                    display: !1,
                    text: "Chart.js Line Chart"
                },
                legend: {
                    display: !1
                },
                layout: {
                    padding: {
                        left: 10,
                        right: 10,
                        top: 10,
                        bottom: 10
                    }
                },
                tooltips: {
                    mode: "index",
                    intersect: !1
                },
                hover: {
                    mode: "nearest",
                    intersect: !0
                },
                scales: {
                    xAxes: [{
                        display: !1,
                        scaleLabel: {
                            display: !0,
                            labelString: "Month"
                        }
                    }],
                    yAxes: [{
                        display: !1,
                        scaleLabel: {
                            display: !0,
                            labelString: "Value"
                        }
                    }]
                }
            }
    });
  });
</script>
		<script type="text/javascript">
		// $('.folder').resize(function(){
		// 	change_fontsize();
		// });

		$( document ).ready(function() {
		    $( ".draggable" ).draggable({
		    	// scroll: false,
		    	cursor: "move",
		    	handle: ".card-header",
		    	// containment: "parent"
		    });
		    $( ".resizable-1" ).resizable({
		    	alsoResize: "#folder1"
		    });
		    $( ".resizable-2" ).resizable({
		    	alsoResize: "#folder2"
		    });
		    $( ".resizable-3" ).resizable({
		    	alsoResize: "#folder3"
		    });
		    $( ".resizable-4" ).resizable({
		    	alsoResize: "#folder4"
		    });
		    $( ".resizable-5" ).resizable({
		    	alsoResize: "#folder5"
		    });
		    $( ".resizable-6" ).resizable({
		    	alsoResize: "#folder6"
		    });

				// change_val_knob("knob_1-1", 0);
			 //  change_val_knob("knob_1-2", 0);
				// change_val_knob("knob_2-1", 0);
			 //  change_val_knob("knob_2-2", 0);
				// change_val_knob("knob_2b-1", 0);
			 //  change_val_knob("knob_2b-2", 0);
				// change_val_knob("knob_3-1", 0);
			 //  change_val_knob("knob_3-2", 0);
				// change_val_knob("knob_3-3", 0);
				// change_val_knob("knob_3-4", 0);
				// change_val_knob("knob_3-5", 0);
				// change_val_knob("knob_3-6", 0);
				// change_val_knob("knob_3-7", 0);
				// change_val_knob("knob_3b-1", 0);
			 //  change_val_knob("knob_3b-2", 0);
				// change_val_knob("knob_3b-3", 0);
				// change_val_knob("knob_3b-4", 0);
				// change_val_knob("knob_3b-5", 0);
				// change_val_knob("knob_3b-6", 0);
				// change_val_knob("knob_3b-7", 0);
				// change_val_knob("knob_4-1", 0);
			 //  change_val_knob("knob_4-2", 0);
				// change_val_knob("knob_4-3", 0);
				// change_val_knob("knob_4-4", 0);
				// change_val_knob("knob_5-1", 0);
			 //  change_val_knob("knob_5-2", 0);
				// change_val_knob("knob_5-3", 0);
				// change_val_knob("knob_5-4", 0);
				// change_val_knob("knob_5-5", 0);
				// change_val_knob("knob_5-6", 0);
			  load_data();
		  });

		  var load_data=function(){
		    $.ajax({
		      url: 'controller.php',
		      type: 'GET',
		      async: true,
		      dataType: "json",
		      success: function (data) {
		        put_data(data);

						change_fontsize();
		        setTimeout(load_data, 10000);
		      }
		    });    
		  };

		  function change_fontsize() {
		  	$('.keterangan_chart').each(function(key, value){
			    var target = $(this).parent().find('.knob');
			    var fontsize = $(target).css('font-size');
			    $(this).css('font-size', fontsize);
			  });
		  }

		  async function put_data(data) {
		  	await $("#title_1").text(data["title_1"]);
		  	await $("#img_1").attr("src", data["img_1"]);
		  	await $("#costumer_1").text(data["costumer_1"]);
		    await $("#date_1").text(data["date_1"]);
		    await $("#progress_1").text(data["progress_1"]);
		    change_val_knob("knob_1-1", data["knob_1-1"]);
		    change_val_knob("knob_1-2", data["knob_1-2"]);

		    await $("#title_2").text(data["title_2"]);
		  	await $("#img_2").attr("src", data["img_2"]);
		  	await $("#costumer_2").text(data["costumer_2"]);
		    await $("#date_2").text(data["date_2"]);
		    await $("#progress_2").text(data["progress_2"]);
		    change_val_knob("knob_2-1", data["knob_2-1"]);
		    change_val_knob("knob_2-2", data["knob_2-2"]);

			await $("#title_2b").text(data["title_2b"]);
		  	await $("#img_2b").attr("src", data["img_2b"]);
		  	await $("#costumer_2b").text(data["costumer_2b"]);
		    await $("#date_2b").text(data["date_2b"]);
		    await $("#progress_2b").text(data["progress_2b"]);
		    change_val_knob("knob_2b-1", data["knob_2b-1"]);
		    change_val_knob("knob_2b-2", data["knob_2b-2"]);

		    await $("#title_4").text(data["title_4"]);
		  	await $("#img_4").attr("src", data["img_4"]);
		  	await $("#costumer_4").text(data["costumer_4"]);
		    await $("#date_4").text(data["date_4"]);
		    await $("#progress_4").text(data["progress_4"]);
		    change_val_knob("knob_4-1", data["knob_4-1"]);
		    change_val_knob("knob_4-2", data["knob_4-2"]);
		    change_val_knob("knob_4-3", data["knob_4-3"]);
		    change_val_knob("knob_4-4", data["knob_4-4"]);

		    await $("#title_5").text(data["title_5"]);
		  	await $("#img_5").attr("src", data["img_5"]);
		  	await $("#costumer_5").text(data["costumer_5"]);
		    await $("#date_5").text(data["date_5"]);
		    await $("#progress_5").text(data["progress_5"]);
		    change_val_knob("knob_5-1", data["knob_5-1"]);
		    change_val_knob("knob_5-2", data["knob_5-2"]);
		    change_val_knob("knob_5-3", data["knob_5-3"]);
		    change_val_knob("knob_5-4", data["knob_5-4"]);
		    change_val_knob("knob_5-5", data["knob_5-5"]);
		    change_val_knob("knob_5-6", data["knob_5-6"]);

		    await $("#title_3").text(data["title_3"]);
		  	await $("#img_3").attr("src", data["img_3"]);
		  	await $("#costumer_3").text(data["costumer_3"]);
		    await $("#date_3").text(data["date_3"]);
		    await $("#progress_3").text(data["progress_3"]);
		    change_val_knob("knob_3-1", data["knob_3-1"]);
		    change_val_knob("knob_3-2", data["knob_3-2"]);
		    change_val_knob("knob_3-3", data["knob_3-3"]);
		    change_val_knob("knob_3-4", data["knob_3-4"]);
		    change_val_knob("knob_3-5", data["knob_3-5"]);
		    change_val_knob("knob_3-6", data["knob_3-6"]);
		    change_val_knob("knob_3-7", data["knob_3-7"]);

			await $("#title_3b").text(data["title_3b"]);
		  	await $("#img_3b").attr("src", data["img_3b"]);
		  	await $("#costumer_3").text(data["costumer_3b"]);
		    await $("#date_3b").text(data["date_3b"]);
		    await $("#progress_3b").text(data["progress_3b"]);
		    change_val_knob("knob_3b-1", data["knob_3b-1"]);
		    change_val_knob("knob_3b-2", data["knob_3b-2"]);
		    change_val_knob("knob_3b-3", data["knob_3b-3"]);
		    change_val_knob("knob_3b-4", data["knob_3b-4"]);
		    change_val_knob("knob_3b-5", data["knob_3b-5"]);
		    change_val_knob("knob_3b-6", data["knob_3b-6"]);
		    change_val_knob("knob_3b-7", data["knob_3b-7"]);
		  }

		  function change_val_knob(name, value){
		  	var knob = $("input[name="+name+"]");
		  	var val_1 = $(knob).val();
		  	var val_2 = value;
		  	$(knob).knob();
	      $({
	        value: val_1
	      }).animate({
	        value: val_2
	      },{
          duration: 2000,
          easing: 'swing',
          step: function() {
            $(knob).val(Math.ceil(this.value)).trigger('change');
          }
	      });
		  }

		  $(".knob").knob({
	      draw: function () {

	        // "tron" case
	        if (this.$.data('skin') == 'tron') {

	          var a = this.angle(this.cv)  // Angle
	              , sa = this.startAngle          // Previous start angle
	              , sat = this.startAngle         // Start angle
	              , ea                            // Previous end angle
	              , eat = sat + a                 // End angle
	              , r = true;

	          this.g.lineWidth = this.lineWidth;

	          this.o.cursor
	          && (sat = eat - 0.3)
	          && (eat = eat + 0.3);

	          if (this.o.displayPrevious) {
	            ea = this.startAngle + this.angle(this.value);
	            this.o.cursor
	            && (sa = ea - 0.3)
	            && (ea = ea + 0.3);
	            this.g.beginPath();
	            this.g.strokeStyle = this.previousColor;
	            this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
	            this.g.stroke();
	          }

	          this.g.beginPath();
	          this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
	          this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
	          this.g.stroke();

	          this.g.lineWidth = 2;
	          this.g.beginPath();
	          this.g.strokeStyle = this.o.fgColor;
	          this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
	          this.g.stroke();

	          return false;
	        }
	      }
    	});

    	// function load_chart_line(id_container, date, data) {
    	// 	ctx1 = document.getElementById(id_container).getContext('2d');
		   //  data = {"labels": date,"datasets":[{"label":"Total Test","data": data,"fill":false,"borderColor":"#d63031","lineTension":0.1}]};
		   //  myChart = new Chart(ctx1, {
		   //    type: 'line',
		   //    data: data,
		   //    options: {
     //        responsive: !0,
     //        maintainAspectRatio: !1,
     //        title: {
     //          display: !1,
     //          text: "Chart.js Line Chart"
     //        },
     //        legend: {
     //        	display: !1
     //        },
     //        layout: {
     //          padding: {
     //            left: 10,
     //            right: 10,
     //            top: 10,
     //            bottom: 10
     //          }
     //        },
     //        tooltips: {
     //          mode: "index",
     //          intersect: !1
     //        },
     //        hover: {
     //          mode: "nearest",
     //          intersect: !0
     //        },
     //        scales: {
     //          xAxes: [{
     //            display: !1,
     //            scaleLabel: {
     //              display: !0,
     //              labelString: "Month"
     //            }
     //          }],
     //          yAxes: [{
     //            display: !1,
     //            scaleLabel: {
     //              display: !0,
     //              labelString: "Value"
     //            }
     //          }]
     //        }
     //      }
		   //  });
    	// }
		</script>
	</body>
</html>