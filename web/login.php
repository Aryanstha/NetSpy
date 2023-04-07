<?php
session_start();
include "config.php";
include "./assets/components/login-arc.php";



if(isset($_COOKIE['logindata']) && $_COOKIE['logindata'] == $key['token'] && $key['expired'] == "no"){
    $_SESSION['IAm-logined'] = 'yes';
	header("location: panel.php");
}


elseif(isset($_SESSION['IAm-logined'])){
	header('location: panel.php');
	exit;
}


else{ 
	
	?>


    <!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>NetSpy🔎 | Login</title>
		<link href="./assets/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="./assets/css/style.css">
	</head>

	<body>
	<div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-2"></div>
            <div class="col-lg-6 col-md-8 login-box">
                <div class="col-lg-12 login-key">
                    <i class="fa fa-key" aria-hidden="true"></i>
                </div>
                <div class="col-lg-12 login-title">
                    ADMIN PANEL
                </div>

                <div class="col-lg-12 login-form">
                    <div class="col-lg-12 login-form">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label class="form-control-label">USERNAME</label>
                                <input name="username" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">PASSWORD</label>
                                <input name="password" type="password" class="form-control" i>
                            </div>

                            <div class="col-lg-12 loginbttm">
                                <div class="col-lg-6 login-btm login-text">
                                    <!-- Error Message -->
                                </div>
                                <div class="col-lg-6 login-btm login-button">
                                    <button type="submit" class="btn btn-outline-primary">LOGIN</button>
                                </div>
                            </div>
                      
		  <?php
		
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				if(isset($_POST['username']) && isset($_POST['password'])){
					$username = $_POST['username'];
					$password = $_POST['password'];


					if(isset($CONFIG[$username]) && $CONFIG[$username]['password'] == $password){
						
						$_SESSION['IAm-logined'] = $username;

						echo '<script>location.href="panel.php"</script>';
						
					}else{
						echo '<p style="color:red" ><br>Username or password is incorrenct!</p>';
					}
				}
			}
			
		  ?>
		  </form>
                    </div>
                </div>
                <div class="col-lg-3 col-md-2"></div>
            </div>
        </div>
	</body>
	</html>



	<?php
}

?>