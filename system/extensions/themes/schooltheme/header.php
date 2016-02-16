<!DOCTYPE html>
  <html>
	<head>
           <!-- <meta charset="UTF-8">-->
		<title>School Manager</title>
		<?php
		//When usinng external css or external javascript you must have the values below. Before you them in
		Resources::link(array());
		Resources::script(array());
		?>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
                <script>
                    	$(document).ready(function(){
                        $("#eventDate").datepicker({dateFormat: 'yy-mm-dd',changeMonth:true,changeYear:true});
                        $("#dob").datepicker({dateFormat: 'yy-mm-dd',changeMonth:true,changeYear:true});
                        });
                </script>
	</head>
	
<body>
		
<div id="overlay"></div> <!--cover all the screen with transparent div-->
 <div id="container">
<div id="header">
	<div id="logo" ><?php echo Resources::get_logo(array("id"=>"logo_img"));?></div>

    
    <h2 class="logo_color" id='logo_text'><?php echo Resources::get_logo_text();?></h2>

    <ul id='extra_access'>    
    <?php
        if(isset($_SESSION)&&$_SESSION['username']!=='Guest'){
            echo '<li>'.Resources::img("welcome.png").'Welcome '.$_SESSION['fname'].'<span style="float:right;">&Del;</span>';
            echo '<ul>';
            echo '<li>'.Resources::img("register.png")." ". Resources::a_href("Register/userRegister/public/1","Register User",array("onclick"=>"recentItems('Register User','Register/userRegister','0');")).'</li><hr>';
            echo "<li>".Resources::img("logout.png")." ".Resources::a_href("Login/logout","Log Out",array())."</li><hr>";
            echo '</ul>';
        }else{
            echo '<li>'.Resources::img("welcome.png").'Welcome Guest <span style="float:right;">&Del;</span>';
            echo '<ul>';
            echo '<li id="login_link">'. Resources::img("lock.png")." ". Resources::a_href("Login/login","Login").'</li><hr>';
            //echo '<li>'.Resources::img("register.png")." ". Resources::a_href("Register/userRegister/public/1","Register User",array("onclick"=>"recentItems('Register User','Register/userRegister',".$_SESSION['ID'].");")).'</li><hr>';
            echo '</ul>';
        }
        ?> 
    </ul>

</div>
<div id="main_menu">
     
 	<ul id="main_menu_links">
 	<?php
 	foreach ($data as $value) {
                echo '<li>'.Resources::img($value["img"]).' '.Resources::a_href($value["url"],$value["name"],array('onclick'=>'recentItems("'.$value['name'].'","'.$value['url'].'","'.$_SESSION['ID'].'","'.$value['img'].'");')).'</li>';
	 }
 	?>
 	</ul>
 </div>
 
 
 <div id="contain"> 
 	
<?php

echo Resources::load_message();

?>
  	
