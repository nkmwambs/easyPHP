<form id="passReset">
<table style="border: 1px orange solid;">
    <caption>Forgot Login?</caption>
    <tr><th colspan="2" id="error_log" style="color:red;"></th></tr>
    <tr><td>Email</td><td><input type="text" id="email" name="email" onblur="validate(this);"/> </td></tr>
        <tr><td>Your Security Question?</td><td>
                <select id="qstn" name="qstn">
                    <option value="">Select Your Security Question ... </option>
                <?php
                    foreach ($data as $value) {
                        echo "<option value='{$value->qID}'>{$value->qstn}</option>";
                    }
                ?>
                </select>
        </td></tr>
        <tr><td>Security Question Answer?</td><td><input type="text" id="qAns" name="qAns"/></td></tr>
    <tr><td colspan="2">OR</td></tr>
    <tr><td>Provide any former password?</td><td><input type="text" id="password" name="password"/></td></tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr><td colspan="2" align='center'><?php echo img_tag("disksave.png",array("title"=>"Submit","onclick"=>'checkSecurity("passReset");'));?></td></tr>
</table>
</form>