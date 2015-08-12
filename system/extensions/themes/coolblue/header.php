<?php
$sess = Resources::session(); 
?>
<html>
    <head>
        <title><?php echo $sess->fname;?> - Toolkit | Compassion Kenya</title>
        <?php
        //Resources::link_tag(array("coolBlue_template.css","elements.css","designerTables.css","error.css"));
        Resources::link(array("elements.css"));
		Resources::script(array("js.js","xmlhttp.js","designerTables.js","mce/tinymce.min.js"));
            //link_tag();
            //script_tag();
        ?>

    </head>
    <body onload="sumEcj(); ppbfCalc(<?php echo $sess->userlevel;?>);">
        <div id='overlay'></div>
    <ul id='extra_access'>    
    <?php
    //echo $sess->username;
        if($sess->username!=='Guest'){
            echo '<li>'.Resources::img("welcome.png").'Welcome '.$sess->fname.'<span style="float:right;">&Del;</span>';
            echo '<ul>';
            echo '<li>'.Resources::img("register.png")." ". Resources::a_href("Register/userRegister/public/0","Register User",array("onclick"=>"")).'</li><hr>';
            if(isset($_SESSION['adm'])){echo '<li>'.Resources::img("switch.png").' '.Resources::a_href("Welcome/switchUser","Switch User").'</li><hr>';}
            echo "<li>".Resources::img("logout.png")." ".Resources::a_href("Welcome/logout/public/1","Log Out",array())."</li><hr>";
            echo '</ul>';
        }else{
            echo '<li>'.Resources::img("welcome.png").'Welcome '.$sess->fname.' <span style="float:right;">&Del;</span>';
            echo '<ul>';
            echo '<li id="login_link">'. Resources::img("lock.png")." ". Resources::a_href("Welcome/login/public/1","Login").'</li><hr>';
            //echo '<li>'.Resources::img("register.png")." ". Resources::a_href("Register/userRegister/public/0","Register User",array("onclick"=>"")).'</li><hr>';
            echo '</ul>';
        }
        ?> 
    </ul>
        <div id="container">
            <div id="header" class="cntr"><div><?php echo Resources::img("logo.png",  array("style"=>"position:absolute;top:0px;left:0px;width:18%;heigth:24%;")); ?></div><div id='logo'><div style="position: absolute;top: 0px;display: inline-block;width:700px;left: 230px;display:none;"><h4>Compassion Kenya - Toolkit</h4></div></div></div>
            
            <div id="hdr-menu">
                <ul id="list-menu">
                    
                      <?php
 	foreach ($data as $value) {
		echo '<li>'.Resources::img($value["img"]).' '.Resources::a_href($value["url"],$value["name"],array('onclick'=>'recentItems("'.$value['name'].'","'.$value['url'].'","'.$sess->ID.'","'.$value['img'].'");')).'</li>';
	 }
                      ?>
                </ul><br><br>
                </div>
            <br>
            
            <div id="breadcrump"><?php 
                if(isset($sess->adm)&&$sess->adm==='1'){echo "<div class='alerts'>The Site is in Offline Mode.</div> ";} 
                //if(isset($sess->adm)&&$sess->adm==='2'&&$sess->adm!=="1"){echo "<div class='alerts'>You are on a Switch Mode (Your user profile is ".$_SESSION['username_backup']." ".Resources::img("user.png",array("id"=>"".$_SESSION['username_backup']."","onclick"=>'switchUser(this);',"style"=>'cursor:pointer;')).")</div>";}
                ?>
            </div>
            <div><?php //echo $_SESSION['REDIRECT'];?></div>
            <br>