<?php
 
?>
<div id="error_log" style="color:red;position: absolute;top:20px;left: 280px;"></div>        
<h3 style="margin-left:260px;">School Management System</h3>
        <?php 
            echo img_tag("logo.png",array("id"=>"welcome_logo"));
        ?>
        
  	<div id="login">
  		Login to School Manager
                <form id="frmlogin">	
                            <input type="text" name="txtusername" placeholder="Username" class="se log_txt"/>
                            <input type="password" name="txtPassword" placeholder="Password" class="se log_txt"/><br>
                            <?php echo img_tag("login.png",array("title"=>"Login","style"=>"border:2px green solid;","onclick"=>"log(\"frmlogin\");"))."<br>";
                            echo a_tag("Login/forgotPass/public/1","Forgot Password? Click here");
                            ?>
			</form>
		</div>
        <?php 
            echo img_tag("anim_book_two.gif",array("style"=>"position:absolute;bottom:0px;left:260px;"));
            
        ?>