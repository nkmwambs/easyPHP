<!DOCTYPE html>
  <html>
	<head>
            <meta charset="UTF-8">
		<title>School Manager</title>
		<?php
		//When usinng external css or external javascript you must have the values below. Before you them in
		link_tag(array());
		script_tag(array());
		?>
                <script>
                    	$(document).ready(function(){
                        $("#eventDate").datepicker({dateFormat: 'yy-mm-dd',changeMonth:true,changeYear:true});
                        $("#dob").datepicker({dateFormat: 'yy-mm-dd',changeMonth:true,changeYear:true});
                        });
                </script>
	</head>
	
	<body>
		
<div id="overlay"></div> <!--cover all the screen with transparent div-->

<div id="header">
	<div id="logo" ><?php echo img_tag("logo.png",array("id"=>"logo_img"));?></div>

    
    <h2 class="logo_color">Vine Garden School</h2>

    <ul id='extra_access'>    
    <?php
        if(isset($_SESSION)&&$_SESSION['username']!=='Guest'){
            echo '<li>'.img_tag("welcome.png").'Welcome '.$_SESSION['fname'].'<span style="float:right;">&Del;</span>';
            echo '<ul>';
            echo '<li>'.img_tag("register.png")." ". a_tag("Register/userRegister/public/1","Register User",array("onclick"=>"recentItems('Register User','Register/userRegister','0');")).'</li><hr>';
            echo "<li>".img_tag("logout.png")." ".a_tag("Login/logout","Log Out",array())."</li><hr>";
            echo '</ul>';
        }else{
            echo '<li>'.img_tag("welcome.png").'Welcome Guest <span style="float:right;">&Del;</span>';
            echo '<ul>';
            echo '<li id="login_link">'. img_tag("lock.png")." ". a_tag("Login/show_login/public/1","Login",array("onclick"=>"login();")).'</li><hr>';
            echo '<li>'.img_tag("register.png")." ". a_tag("Register/userRegister/public/1","Register User",array("onclick"=>"recentItems('Register User','Register/userRegister',".$_SESSION['ID'].");")).'</li><hr>';
            echo '</ul>';
        }
        ?> 
    </ul>

</div>
 <div id="main_menu">
     
 	<ul id="main_menu_links">
 	<?php
                   // print_r($data);
 	foreach ($data as $value) {
                echo '<li>'.img_tag($value["img"]).' '.a_tag($value["url"],$value["name"],array('onclick'=>'recentItems("'.$value['name'].'","'.$value['url'].'","'.$_SESSION['ID'].'","'.$value['img'].'");')).'</li>';
	 }
 	?>
 	</ul>
 </div>
  <div id="container"> 
      

      
     
  
  	 

		
  
