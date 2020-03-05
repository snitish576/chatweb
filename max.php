    <?php
            include("dbcon1.php");
            session_start();    
            $tbl = "table_".$_SESSION['sid'];
			$sndid = $_SESSION['sid'];
            $query = "select max(id) from $tbl";
            $run = mysqli_query($con,$query);
            $data = mysqli_fetch_assoc($run);
            $max = "maxid_".$sndid;  
            $id = $_SESSION[$max]; 


                if(isset($_POST['bid'])&&isset($_POST['bio'])){
                    
                    $bio = mysqli_escape_string($con,$_POST['bio']);
                    if(empty($bio)){
                        $bio = "I am an introvert";
                        echo "100";
                    }
                    
                    $id = $_POST['bid'];
                    $q = "update record set bio = '$bio' where id = $id";
                    if(mysqli_query($con,$q))
                        $_SESSION['bio'] = $bio;
                    else
                        echo mysqli_error($con);
                    
                    exit();
                }
                
            
            $maxid = $data['max(id)'];    
                  if($maxid>$id){
                    $query = "select id,msg,key_from from $tbl where id = $maxid";
                    $run =  mysqli_query($con,$query);
                      if($run){
                          $data = mysqli_fetch_assoc($run);
                       
                          $query1 = "SELECT count(msg),key_from from $tbl where status = 0 group by key_from";
                        $result1 =  mysqli_query($con,$query1);
                            $d = array();
                          while($r = mysqli_fetch_assoc($result1)){
                    
                    $d["ct"] = $r["count(msg)"]; 
                        
                    }
                       echo json_encode(array($data,$d));   
                          $_SESSION[$max] = $data["id"];
                      }
                      else{
                          echo mysqli_error($con);
                          
                      }
                  }
                else{
                    echo "100";
                }    
        
        ?>