<?php
            date_default_timezone_set("Asia/Kolkata");
            include("dbcon1.php");
            session_start();    
            $tbl = "table_".$_SESSION['sid'];
			$sndid = $_SESSION['sid'];
            $query = "select max(id) from $tbl";
            $time = date("Y-m-d H:i:s");
            $query1 = "update record set section = '0' ,status = '1' ,logged_in = '$time'  where id = $sndid";
               mysqli_query($con,$query1);    
            $run = mysqli_query($con,$query);
            $data = mysqli_fetch_assoc($run);
            $maxid = "maxid_".$sndid;    
            $_SESSION[$maxid] = $data["max(id)"];  
                
            
?>
<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="chat.css">
    <script src="chat.js" type="text/javascript"></script>
	<script src="jquery.min.js"></script>
</head>




<body>
    <audio id = "aud">
<source src = "sound.mp3" type = "audio/mp3">
</audio>
    <div class="desktop-view">
        <div class="header" id="header">
            <div class="container-head">
                <div class="pic">
                    <div></div>
                </div>
                <span class="name">
                <div><?php
                    
                echo $_SESSION['name'];
                    ?></div>
            </span>
                <div class="setting">
                    <div class="hamburg" id="hamburg">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
            </div>
        </div>
       

        <div class="container-chat">
                    <?php
                   include("section.php");
                    ?>
        </div>
        <!--settings-->
        <section class="setting-section" id="setting-section">
            <div id="cross">
                <img src="resources/close.png">
            </div>
            <div class="setting-image" id="setting-pic">

            </div>
            <div class="setting-bio" id="setting-name">
                <div class="bio-name"><?=$_SESSION['name']?></div>
                <div class="bio-status" tabindex="-1">
                    <?php
                        if(!empty($_SESSION['bio'])){
                            echo $_SESSION['bio'];
                            
                        }
                    else{
                        
                       echo "This is my awesome status and im here hello."; 
                    }
                    
                    ?>
                    
                   </div>
            </div>
            <div class="setting-options" id="setting-optn">
                <div class="setting-optn-container">
                <div class="optn-flex">
                    <svg width="33" height="33" viewBox="0 0 33 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g id="power_settings_new_24px">
                        <path id="icon/action/power_settings_new_24px" fill-rule="evenodd" clip-rule="evenodd" d="M15.1277 4.87126H17.8081V17.8409H15.1277V4.87126ZM22.3781 9.52735L24.2812 7.68566C26.8812 9.82565 28.5296 12.9902 28.5296 16.5439C28.5296 22.9898 23.1286 28.2165 16.4679 28.2165C9.80712 28.2165 4.40614 22.9898 4.40614 16.5439C4.40614 12.9902 6.05458 9.82565 8.65455 7.68566L10.5442 9.51438C8.44012 11.1745 7.08653 13.7036 7.08653 16.5439C7.08653 21.5631 11.2813 25.6226 16.4679 25.6226C21.6544 25.6226 25.8492 21.5631 25.8492 16.5439C25.8492 13.7036 24.4956 11.1745 22.3781 9.52735Z" fill="#F0F0F0"/>
                        </g>
                        </svg>  
                    <a href = "logout.php"><span>Log Out</span></a>
                </div>
                <div class="optn-flex" id = "bio" data-maxlength = "50">
                    <svg width="33" height="34" viewBox="0 0 33 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g id="create_24px">
                        <path id="icon/content/create_24px" fill-rule="evenodd" clip-rule="evenodd" d="M25.0032 5.34315L28.1393 8.4792C28.6619 9.00188 28.6619 9.8462 28.1393 10.3689L25.6867 12.8214L20.661 7.79571L23.1136 5.34315C23.3682 5.08852 23.7032 4.9545 24.0517 4.9545C24.4001 4.9545 24.7352 5.07512 25.0032 5.34315ZM4.40446 24.0522V29.078H9.43018L24.2527 14.2554L19.227 9.22971L4.40446 24.0522ZM8.31782 26.3976H7.08485V25.1646L19.227 13.0225L20.46 14.2554L8.31782 26.3976Z" fill="#F0F0F0"/>
                        </g>
                        </svg>
                        <span>Edit Bio</span>
                </div>
                <div class="optn-flex">
                    <svg width="40" height="41" viewBox="0 0 40 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g id="person_24px">
                        <path id="icon/social/person_24px" fill-rule="evenodd" clip-rule="evenodd" d="M19.9491 7.15817C16.3185 7.15817 13.3778 10.0988 13.3778 13.7294C13.3778 17.3601 16.3185 20.3007 19.9491 20.3007C23.5797 20.3007 26.5204 17.3601 26.5204 13.7294C26.5204 10.0988 23.5797 7.15817 19.9491 7.15817ZM23.2347 13.7294C23.2347 11.9223 21.7562 10.4438 19.9491 10.4438C18.142 10.4438 16.6635 11.9223 16.6635 13.7294C16.6635 15.5365 18.142 17.0151 19.9491 17.0151C21.7562 17.0151 23.2347 15.5365 23.2347 13.7294ZM29.806 30.1576C29.4774 28.9912 24.3847 26.872 19.9491 26.872C15.5299 26.872 10.47 28.9748 10.0922 30.1576H29.806ZM6.80656 30.1576C6.80656 25.7877 15.5628 23.5863 19.9491 23.5863C24.3354 23.5863 33.0916 25.7877 33.0916 30.1576V33.4432H6.80656V30.1576Z" fill="#F0F0F0"/>
                        </g>
                        </svg>
                       
                        <span><input type="file" name = "imga" id = "imga" style = "display:none;"/>Edit Image</span>
                </div>
            </div>
            </div>
        </section>

        <!--main application interface for chat-->
        <section class="chat-app" id="chat-app">
            <div class="chat-header" id="chat-header">
                <div class="container-head">
                    <div class="user-pic">
                        <div></div>
                    </div>
                    <span class="name">
                    <div id = "nn"></div>
                    </span>
                    <div class="chat-app-back">
                        <svg id="chat-app-back" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M257.5 445.1l-22.2 22.2c-9.4 9.4-24.6 9.4-33.9 0L7 273c-9.4-9.4-9.4-24.6 0-33.9L201.4 44.7c9.4-9.4 24.6-9.4 33.9 0l22.2 22.2c9.5 9.5 9.3 25-.4 34.3L136.6 216H424c13.3 0 24 10.7 24 24v32c0 13.3-10.7 24-24 24H136.6l120.5 114.8c9.8 9.3 10 24.8.4 34.3z"/></svg>
                    </div>
                </div>
            </div>


            <div class="chat-body" id="chat-body">

				   

                <div class="chat-convo">
                
                </div>
            </div>
            <div class="chat-box">
                <div class="chat-type" id="chat-type">
                    <textarea placeholder="Type Here.." id = "text"></textarea>
                </div>
                <div class="chat-send">
                    <svg xmlns="http://www.w3.org/2000/svg" width="46" height="46" viewBox="0 0 46 46" class = "send">
                    <g id="Group_8" data-name="Group 8" transform="translate(-0.381 -0.367)">
                      <circle id="Ellipse_1" data-name="Ellipse 1" cx="23" cy="23" r="23" transform="translate(0.381 0.367)" fill="#fff"/>
                      <path id="Subtraction_1" data-name="Subtraction 1" d="M25.64,22.893H14L12.886,5.283l-1.113,17.61H0L12.82,0,25.64,22.893Z" transform="translate(37.85 10.339) rotate(90)" fill="#285ae2"/>
                    </g>
                  </svg>
                </div>
            </div>
          
        </section>
    </div>
</body>
</html>
<script>
    
        var xml = new XMLHttpRequest();
        var q;
        var aud = document.getElementById("aud");
          setInterval(function(){

                    $.ajax({          
                        type:"post",
                        url:"max.php",
                        success:function(data){
                            
                        if(data.trim()!="100"){
                          
                             obj = JSON.parse(data);
                           
                             var lm = obj[0].msg;
                                if(lm.length>13){
                                    lm = lm.substr(0,13)+"...";
                                }
                             var count = obj[1].ct;
                             var id = obj[0].key_from;
                            $("#usf_"+id).html("<div class = 'messageno'><span>"+count+"</span></div>");
                            $("#lm_"+id).html(lm);    
                            
                            }
                    } 
                    }); 
              
            },1000);

         setInterval(function(){
            
            $.ajax({
                   type:"post",
                   url:"status.php",
                   data:{staid:"<?= $_SESSION['sid'] ?>"},
                   success:function(d){
                            
                            if(d.trim()!=""){
                            var obj =JSON.parse(d);
                                for(i in obj){
                                        if(obj[i]=='1'){
                                      $("#st_"+i).html("<div class='status-sign'></div>");
                                    
                                    }
                                    else{
                                        $("#st_"+i).html("");
                                    }

                                }
                            }
      
                   } 

            });


        }, 5000);
         
                        
                        $(document).ready(function(){
                         var prval;
						$(".user-details").click(function(){
							 q = $(this).attr('id');
							var qq = $(this);
                            var nameid  = "name_"+q;
							$('.chat-convo').load("getmsg.php?id="+q).fadeIn("slow");
							name = $("#name_"+q).html().trim();
							$("#nn").html(name);
				            var clear = setInterval(getdata,1000);
                            
						});
						
						$("#text").keyup(function(event){
						var id = q;
                               
						var text = document.getElementById("text").value;
						if(event.keyCode == 13 && text.trim().length!=0 && !event.shiftKey){
								
							insert(text,id); 
						}
						});
						
						$(".send").click(function(){
						var id = q;
    
						var text = document.getElementById("text").value;;
        
					if(text.trim().length<=0){
					alert("type something");
					return false;
					}
					else{
						insert(text,id);
					}

					});
                            
                    $("#bio").click(function(){
                             
                           prval = $(".bio-status").html();
                         
                            $(".bio-status").attr('contenteditable','true');
                             $(".bio-status").focus();
                            });    
                    $(".bio-status").blur(function(){
                       
                       var val = $(".bio-status").html().trim();
                                    if(val.length>100){
                                       
                                        alert("Bio cannot be more than 100 characters");
                                        $(".bio-status").html(prval); 
                                        throw new Error("Bio to long");
                                    }

                    var xhr =   $.ajax({
                          type:"post",
                          url : "max.php",
                           data:{bid:"<?=$_SESSION['sid']?>",bio:val.trim()},
                           success:function(data){
                              
                               if(data.trim()=="100"){

                                   $(".bio-status").html("I am an introvert");
                                  
                               }
                              xhr.abort();
                            
                           }
                           
                       });
                       
                       
                    });        
                            
						
});
        function insert(text,id){
	
		var pat = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;
		
        if(pat.test(text)){
           
			text = encodeURIComponent(text);
		}
			
	        
			
			     xml.onreadystatechange = function(){
				
				if(this.readyState == 4 && this.status == 200){
					
				var val = this.responseText;
               
                    
                  obj = JSON.parse(val);
                    
			 var ind = val.indexOf("Error");
			 var lastind = val.length-1;
			 var ll = val.substr(ind,lastind);
			 if(val.includes("Error in connecting")){
				$(".chat-convo").append("<div class='chat-right'><div class='right'><span>"+obj.msg+"</span><span class='right-time'><span>"+obj.time+"</span></span></div></div>"); 
				document.getElementById("text").value = "";
			     $('#chat-body').scrollTop($('#chat-body')[0].scrollHeight);
				 
			 }
			 else{

                $(".chat-convo").append("<div class='chat-right'><div class='right'><span>"+obj.msg+"</span><span class='right-time'><span>"+obj.time+"</span></span></div></div>"); 
			     document.getElementById("text").value = "";
			     $('#chat-body').scrollTop($('#chat-body')[0].scrollHeight);
			 }
					
				}
				
			};
			
			xml.open("POST","insert.php",true);
			xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xml.send("msg="+text+"&rcvid="+id);
	}

   



function getdata(){
	
	var id = q;
	
	xml.onreadystatechange = function(){
		
		if(this.readyState == 4 &&this.status ==200){
			
			var v = this.responseText.trim();
		  
            if(v!='100'){ 
                      
                      obj = JSON.parse(v);
                
                            if(obj!=null){
                               
      $(".chat-convo").append("<div class='chat-left'><div class='left'><span>"+obj.msg+"</span></div></div>");  
				            $('#chat-body').scrollTop($('#chat-body')[0].scrollHeight); 
                               aud.play();    
                            }      
                
                  }
            
		/*	if(v.includes("101")||v.includes("Session Time Out Relogin")){
			clearInterval(clear);
			alert("Error : "+v.trim());
			window.open("login.php","_self");
			}
			else if(v.includes("100")){
				
			}
			else if(v==''){
			
			}
			else{
				$(".parent").append("<div class = 'left'>"+v+"</div>");
				aud.play();
				$('.parent').scrollTop($('.parent')[0].scrollHeight);
				
			}*/
			
		}
		
	};
	xml.open("POST","getdata.php",true);
	xml.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xml.send("rcvid="+id);
	
	
	
}

</script>

