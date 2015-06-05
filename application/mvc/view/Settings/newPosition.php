<?php

?>
<html>
    <head>
        <title>Positions Entry Form</title>
    </head>
    <body>
        <form method="POST" action="<?php echo url_tag("Settings/getEntry"); ?>">
            <label for="postion"/><input type="text" name="dsgn" id="dsgn"/><input type="submit" value="Go"/>
        </form>
        </br>
        <?php echo a_tag("Welcome/show","Home");?>
    </body>
</html>