<?php
//echo "URL access denied without login. Please click ".Resources::a_href("Login/login",Resources::img("home.png"))." refresh";

?>
<div id="error_log" style="color:red;position: absolute;top:20px;left: 280px;"></div>        
<h3 style="margin-left:280px;">School Management System</h3>
        <?php 
            echo Resources::img("logo.png",array("id"=>"welcome_logo"));
        ?>
        
  	<div id="login">
  		Login to School Manager
            <form id="frmlogin">	
                            <input type="text" name="txtusername" placeholder="Username" class="se log_txt"/>
                            <input type="password" name="txtPassword" placeholder="Password" class="se log_txt"/><br>
                            <?php echo Resources::img("login.png",array("title"=>"Login","style"=>"border:2px green solid;","onclick"=>"log(\"frmlogin\");"))."<br>";
                            echo Resources::a_href("Login/forgotPass/public/1","Forgot Password? Click here");
                            ?>
			</form>
	</div>
        <?php 
            //echo Resources::img("anim_book_two.gif",array("id"=>"bookgif"));
            
        ?>