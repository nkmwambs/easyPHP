<?php

?>

        <div id="password-container">
            <h4>Password Reset</h4>
            <div id="msg"></div>
            <table style="width:100px;">
                <colgroup><col width="45%"><col width="55%"></colgroup>
                <tr><td>Username</td><td><input type="text" name="username" id="username" alt="User Name" placeholder="User Name (Email Address)"/></td></tr>
                <tr><td colspan="2" align='center'><a href="home.php" style="font-size: x-large;color: red;padding: 5px; text-decoration: none;pointer-events: pointer;" title="Back">&#8634;</a><button onclick="resetPass();">Submit</button><button onclick="clearInputs();">Clear</button></td></tr>
            </table>
        </div>
