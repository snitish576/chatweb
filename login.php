
<html>

<head>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link href="log_in.css" type="text/css" rel="stylesheet">
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="form-login">
            <div class="txt-login">Log In</div>
            <form action="" method="post">
                <div class="inputs">
                    <span class="inputs-info">Email:</span><span class="inputs-feed"><input type="email" name="email" required=""></span>
                </div>
                <div class="inputs">
                    <span class="inputs-info">Password:</span><span class="inputs-feed"><input  type="password" name="password" required=""></span>
                </div>
                <div class="btn-login">
                    <button type="submit" id="btn-login" name = "login">Log In</button>
                </div>
                <div class="na-form">
                    Dont have an account? <a href="/index.php">Sign up Now.</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
<?php
include("dbcon1.php");
session_start();

function updatestatus(){
	include("dbcon1.php");
	$id = $_SESSION['sid'];
	
	$q1 = "select id,logged_in,status from record where status = 1 and id != '$id' ";
	$run = 	mysqli_query($con,$q1);
		if($run){
			
			while($row = mysqli_fetch_array($run)){
				$logintime = strtotime($row['logged_in']);
				$t = time() - $logintime;
				$rid = $row['id']; 
				if($t>120){
					
					$q2 = "update record set status = 0 where id = '$rid'";
						mysqli_query($con,$q2);
				
				}
					
			
		}
	}

}


if(isset($_SESSION['sid'])){
	updatestatus();
	header("location:chat.php");
	exit();

}
 if(isset($_POST['login'])){
	$em = $_POST['email'];
	$pass = md5($_POST['password']);
	$query = "select * from record where email = '$em' and pass = '$pass'";
	$run = mysqli_query($con,$query);
	$num = mysqli_num_rows($run);
	$data = mysqli_fetch_assoc($run);
		
	if($num==1){
		$id = $data["id"];
		$name = $data["name"];
		$email = $data["email"];
        $bio = $data['bio'];
		$_SESSION['name'] = $name;
		$_SESSION['sid'] = $id;
		$_SESSION['email'] = $email;
		$_SESSION['bio'] = $bio;		
		updatestatus();
		header("location:chat.php");
	}
	else{ 
		?>
		<script>
		swal("Email or Password is not correct","","error");
		</script>
		
	<?php
	}
	


}


?>

