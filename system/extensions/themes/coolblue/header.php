<?php
//echo $_SESSION['adm'];
?>
<html>
    <head>
        <title>Toolkit | Compassion Kenya</title>
        <?php
        //Resources::link_tag(array("coolBlue_template.css","elements.css","designerTables.css","error.css"));
        Resources::link_tag(array("elements.css"));
		Resources::script_tag(array("js.js","xmlhttp.js","designerTables.js","mce/tinymce.min.js"));
            //link_tag();
            //script_tag();
        ?>
        <script>
        tinymce.init({
            selector: "textarea.msg",
            theme: "modern",
            width: 650,
            height: 300,
            plugins: [
                 "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                 "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                 "save table contextmenu directionality emoticons template paste textcolor"
           ],
           content_css: "css/content.css",
           toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons", 
           style_formats: [
                {title: 'Bold text', inline: 'b'},
                {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                {title: 'Example 1', inline: 'span', classes: 'example1'},
                {title: 'Example 2', inline: 'span', classes: 'example2'},
                {title: 'Table styles'},
                {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
            ]
         }); 
         
                  
	$(document).ready(function(){
		$("#frmDate").datepicker({dateFormat: 'yy-mm-dd',changeMonth:true,changeYear:true});
                $("#toDate").datepicker({dateFormat: 'yy-mm-dd',changeMonth:true,changeYear:true});                
                $("#attenddate").datepicker({dateFormat: 'yy-mm-dd',changeMonth:true,changeYear:true}); 
                $("#closeDate").datepicker({dateFormat: 'yy-mm-dd',changeMonth:true,changeYear:true}); 
                $("#cjCashOpBal").datepicker({dateFormat: 'yy-mm-dd',changeMonth:true,changeYear:true}); 
                $("#bsCashOpBal").datepicker({dateFormat: 'yy-mm-dd',changeMonth:true,changeYear:true}); 
                $("#osDate").datepicker({dateFormat: 'yy-mm-dd',changeMonth:true,changeYear:true}); 
		});
        </script>
    </head>
    <body onload="sumEcj(); ppbfCalc(<?php echo $_SESSION['userlevel'];?>);">
        <div id='overlay'></div>
    <ul id='extra_access'>    
    <?php
    
        if(isset($_SESSION)&&$_SESSION['username']!=='Guest'){
            echo '<li>'.img_tag("welcome.png").'Welcome '.Users::userCredentials(USERID)->RealName.'<span style="float:right;">&Del;</span>';
            echo '<ul>';
            echo '<li>'.img_tag("register.png")." ". a_tag("Register/userRegister/public/1","Register User",array("onclick"=>"")).'</li><hr>';
            if(isset($_SESSION['adm'])){echo '<li>'.img_tag("switch.png").' '.a_tag("Welcome/switchUser","Switch User").'</li><hr>';}
            echo "<li>".img_tag("logout.png")." ".a_tag("Welcome/logout/public/1","Log Out",array())."</li><hr>";
            echo '</ul>';
        }else{
            echo '<li>'.img_tag("welcome.png").'Welcome Guest <span style="float:right;">&Del;</span>';
            echo '<ul>';
            echo '<li id="login_link">'. img_tag("lock.png")." ". a_tag("Welcome/login/public/1","Login").'</li><hr>';
            echo '<li>'.img_tag("register.png")." ". a_tag("Register/userRegister/public/1","Register User",array("onclick"=>"")).'</li><hr>';
            echo '</ul>';
        }
        ?> 
    </ul>
        <div id="container">
            <div id="header" class="cntr"><?php //echo img_tag("petty.gif",array("width"=>"80px","heigth"=>"90px","title"=>"Petty","style"=>"margin-top:10px;border:5px solid black;")); ?><div><?php echo img_tag("logo.png",  array("style"=>"position:absolute;top:0px;left:0px;width:18%;heigth:24%;")); ?></div><div id='logo'><div style="position: absolute;top: 0px;display: inline-block;width:700px;left: 230px;"><h4>Compassion Kenya - Toolkit</h4></div></div></div>
            
            <div id="hdr-menu">
                <ul id="list-menu">
                    
                      <?php
 	foreach ($data as $value) {
		echo '<li>'.img_tag($value["img"]).' '.a_tag($value["url"],$value["name"],array('onclick'=>'recentItems("'.$value['name'].'","'.$value['url'].'","'.$_SESSION['ID'].'","'.$value['img'].'");')).'</li>';
	 }
                      ?>
                </ul><br><br>
                </div>
            <br>
            
            <div id="breadcrump"><?php 
                if(isset($_SESSION['adm'])&&$_SESSION['adm']==='1'){echo "<div class='alerts'>The Site is in Offline Mode.</div> ";} 
                if(isset($_SESSION['adm'])&&$_SESSION['adm']==='2'&&$_SESSION['admin']!=="1"){echo "<div class='alerts'>You are on a Switch Mode (Your user profile is ".$_SESSION['username_backup']." ".img_tag("user.png",array("id"=>"".$_SESSION['username_backup']."","onclick"=>'switchUser(this);',"style"=>'cursor:pointer;')).")</div>";}
                ?>
            </div>
            <div id="error"></div>
            <br>