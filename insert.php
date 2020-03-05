<?php
session_start();
include("dbcon1.php");

if(isset($_SESSION['sid'])&&!empty($_SESSION['sid']))
{
$rcvid = $_POST['rcvid'];
$sndid = $_SESSION['sid'];
$msg = htmlentities($_POST['msg']);

}
else{
	die("<h1>Session Time Out Relogin<br><a href = '/login.php'>Login</a></h1>");
}

if($con&&!empty($msg)&&!empty($rcvid)){
if($msg!=""){
	$tbl = "table_".$_SESSION['sid'];
	$tbl1 = "table_".$rcvid;
    $t = date("h:i a");
    $query = "select section from record where id = $rcvid";
            
    $run = mysqli_query($con,$query);
        if($run){
            $data = mysqli_fetch_assoc($run);
            $status = $data["section"];
        }
        else{
            echo mysqli_error($con);
            
        }    

    
$query = "insert into $tbl values(?,?,?,?,?,?);";  
$query1 = "insert into $tbl1 values(?,?,?,?,?,?);";

    $st = mysqli_prepare($con,$query); 
    $st1 = mysqli_prepare($con,$query1);
    
    if($st&&$st1){
        
        mysqli_stmt_bind_param($st,'iiissi',$id,$sndid,$rcvid,$msg,$t,$status);
        mysqli_stmt_bind_param($st1,'iiissi',$id,$sndid,$rcvid,$msg,$t,$status);
                
        
        if(mysqli_stmt_execute($st)&&mysqli_stmt_execute($st1)){
                 $arr = array("time"=>$t,"msg"=>$msg);
    
                    echo json_encode($arr);
                
                
            }
        
    }
    else{
        
   echo json_encode(mysqli_error($con));
}


}

} 
else{
    
    echo json_encode("Error in connecting Please Re-login After Some time");

}

?>