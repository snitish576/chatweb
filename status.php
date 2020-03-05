<?php
    session_start();
    include("dbcon1.php");
    date_default_timezone_set("Asia/Kolkata");

    if(isset($_SESSION['sid'])){
     
            if(isset($_POST['staid'])){

                $time = date("Y-m-d H:i:s");
                $id = $_POST['staid'];
                $query = "update record set logged_in = '$time' where id = '$id'";
                             
                            mysqli_query($con,$query);
                        
                            $q1 = "select id,logged_in from record where id != '$id' and status = 1 ";
                            $run = mysqli_query($con,$q1);
                            
                            while($row = mysqli_fetch_assoc($run)){

                                  $logintime = strtotime($row['logged_in']);
                                    $t = time() - $logintime;
                                    $rid = $row['id']; 
                                    if($t>120){
                                        $q2 = "update record set status = 0 where id = '$rid'";
                                            mysqli_query($con,$q2);

                                    }
                            }
                            $q3 = "select id,status from record where id != '$id'";
                            $run = mysqli_query($con,$q3);
                            $st = array();
                            while($row = mysqli_fetch_assoc($run)){
                                    $st[$row['id']] = $row['status'];
                                   
                                
                            }
                            $statusid = $_SESSION['stid'];
                            $arrdiff = array_diff_assoc($st,$statusid);
                            if(!empty($arrdiff)){
                              echo json_encode($arrdiff);
                                $_SESSION['stid'] = $st;
                            }
                  
                    

            }
            else{
        header("location:login.php");
            }

    }
    else{
        
        header("location:login.php");
    }
    
       
   

?>