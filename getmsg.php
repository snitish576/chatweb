<html>
<body>
<?php
session_start();
include("dbcon1.php");

if(isset($_SESSION['sid'])&&!empty($_SESSION['sid'])){
    
$sndid = $_SESSION['sid'];
$rcvid = $_GET['id'];

}
else{
    
	die("<h1>Session Time Out Relogin<br><a href = '/login.php'>Login</a></h1>");

}
if($con&&!empty($rcvid)){
	$tbl = "table_".$_SESSION['sid'];
    $tbl1 = "table_".$rcvid;
$query = "select msg,time,key_from,key_to from $tbl where (key_from = '$sndid' and key_to = '$rcvid' )or (key_from = '$rcvid' and key_to = '$sndid') ;";
$query1 = "update record set section = '1' where id = $sndid";
    mysqli_query($con,$query1);
$query2 = "update $tbl set status = 1 where key_from = $rcvid;";
$query3 = "update $tbl1 set status = 1 where key_from = $rcvid";    
    mysqli_query($con,$query2);
    mysqli_query($con,$query3);
      
$result = mysqli_query($con,$query);
 
   if($result){
	   
		     while($row = mysqli_fetch_assoc($result)){
		  if($row['key_from']==$sndid){
			?>
			   <div class="chat-right">
                        <div class="right">
                            <span><?=$row['msg']?> </span>
                            <span class="right-time"><span><?=$row['time']?></span></span>
                        </div>
                    </div>
			  <script>$('#chat-body').scrollTop($('#chat-body')[0].scrollHeight);</script>
		  <?php
            }
		  else{
			?>
			 <div class="chat-left">
                        <div class="left">
                            <span><?=$row['msg']?></span>
                             <span class="right-time"><span><?=$row['time']?></span></span>
                        </div>
                    </div>
			 <script>$('#chat-body').scrollTop($('#chat-body')[0].scrollHeight);</script>
		<?php  
        }
	  
	  }

   }
   else{
		echo "<font color = red align = 'center' size = '5'>Something went wrong try after some time</font>";
	   
   }


}else{
	echo "<font color = red align = 'center' size = '5'>Something went wrong try after some time</font>";
	
	
}
    runscript();
function runscript(){
	include("dbcon1.php");
			if(!isset($_SESSION['sid'])){
				
				header("location:login.php");
				
			}
			else{
				$sndid = $_SESSION['sid'];
				$rcvid = $_GET['id'];
			$tbl = "table_".$_SESSION['sid']; 	
           $query = "select max(id) from $tbl where key_from = '$rcvid';";
                
			
        if($result = mysqli_query($con,$query)){    
             
            $r = mysqli_fetch_assoc($result);
           
            $k = 'key_'.$rcvid;
            $_SESSION[$k] = $r['max(id)'];        
      
        }
    else{
       die("<h1>Session Time Out Relogin<br><a href = '/login.php'>Login</a></h1>");
    }
}
}

?>
