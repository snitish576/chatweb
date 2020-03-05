
<?php
session_start();
include("dbcon1.php");
$flag = false;

    if(isset($_SESSION['sid'])){
       $sndid = $_SESSION['sid'];
       $rcvid = $_POST['rcvid'];
       $k = 'key_'.$rcvid;
       
    }
else{
    die("<h1>Session Time Out Relogin<br><a href = '/login.php'>Login</a></h1>");
}
    if($con&&!empty($rcvid)){
 
       $tbl = "table_".$sndid; 
      $key =  $_SESSION[$k]."<br>";    
      $flag = 0;
           
 $query = "select * from $tbl where key_from = '$rcvid' and id>'$key' ";	
    $result = mysqli_query($con,$query);
        
        if($result){
                
                while($row = mysqli_fetch_assoc($result)){
                $flag = 1;    
                    
                    echo json_encode($row);
                    
                }
           if($flag==1){
                $query = "select max(id) from $tbl where key_from = '$rcvid';";
                $r = mysqli_query($con,$query);
               if($r){
                  $id = mysqli_fetch_assoc($r);
                  $_SESSION[$k] = $id['max(id)'];
                   
           }
               
            
    }else{
            echo '100';
               
           }
        }
        else{
            echo mysqli_error($con);
        }

    }






?>
