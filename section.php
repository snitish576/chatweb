<?php
include("dbcon1.php");

$id = $_SESSION['sid'];
if(isset($_SESSION['sid'])){
    
    
	$query = "select name,logged_in,id,status from record where id != '$id'";
	
	$result = mysqli_query($con,$query);
    $result1 =  mysqli_query($con,"update record set status = 1 where id = '$id'");
    
    $tbl = "table_".$_SESSION['sid'];
    $query1 = "SELECT count(msg),key_from from $tbl where status = 0 group by key_from";
    $result2 = mysqli_query($con,$query1);
    
	if(!$result||!$result1){
		
	die("error".mysqli_error($con));
		
	}
		function data($id){
			include("dbcon1.php");
			$tbl = "table_".$_SESSION['sid'];
			$sndid = $_SESSION['sid'];
			$rcvid = $id;
			$query = "select msg from $tbl where (key_from = '$sndid' and key_to = '$rcvid' )or (key_from = '$rcvid' and key_to = '$sndid') order by id desc limit 0,1";
			$run =	mysqli_query($con,$query);
				$data = mysqli_fetch_assoc($run);
				$msg = $data['msg'];	
				if(strlen($msg)>15){
						$msg = substr($msg,0,15).'...';	
							return $msg;
					}
				else{
					return $data['msg'];
				}
			}


	?>   
        <div class="container">
             <section class="chat-list" id="chat-list">
		          <?php
                        
                        $d = array();
                        $statusid = array();
                        while($r = mysqli_fetch_assoc($result2)){
                        $d[$r["key_from"]] = $r["count(msg)"]; 
                        }         
    
                            while($row = mysqli_fetch_array($result)){
                            $data = mysqli_fetch_assoc($result2);
                        
                            $id = $row['id'];       
                    
                    ?>
                    
                      <div class="user">
                        <div class="user-container">
                            <div class="user-pic">
                                <div></div>
                            </div>
                            <div class="user-details" id = "<?=$row['id']?>">
                                <div class="user-flex">
                                <div class="user-name" id="name_<?=$row['id']?>">
                                  <?=$row['name']?>
                                </div>
                               
                                    <?php
                                            if(array_key_exists($id,$d)){
                                                ?>
                                            <div class = "usf" id = "usf_<?=$row['id']?>" >
                                             <div class="messageno" id="msg_<?=$row['id']?>">
                                              <span><?=$d[$id]?></span>  
                                            </div>
                                            </div>    
                                    <?php
                                            }
                                            else{
                                                ?>
                                        <div class = "usf" id = "usf_<?=$row['id']?>" >
                                    
                                        </div>
                                    
                                            <?php    
                                            }
                                
                                           
                                    ?>  
                                    
                                    
                                </div>
                                <div class="user-last-mess" id = "lm_<?=$row['id']?>">
                                   <?php
										if(empty(data($row['id'])))
                                            echo "Tap To Message!!";
                                            else
                                                echo data($row['id']);
								   ?>
                                </div>
                            </div>
                            <div class="user-status">
                                <div id = "<?="st_".$row['id']?>">
                                            <?php
                                                $statusid[$row['id']] = $row['status'];
                                                if($row['status']=='1'){
                                                  echo  "<div class='status-sign'></div>";
                                                }
                                               
                                            
                                            ?>
                                </div>
                            </div>
                        </div>
                        <div class="bottom-ruler"></div>
                    </div>
					   
                    <?php
                    
                     }
					$_SESSION['stid'] = $statusid	
                   ?>
                 
</section>
</div>
	<?php
	
}
else{
	
	header("location:login.php");
}