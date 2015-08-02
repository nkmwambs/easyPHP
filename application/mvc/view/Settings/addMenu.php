<?php

?>
<form method="post" action="<?php echo Resources::url('Settings/getMenu');?>">
<table>
    <tr><th colspan=2"">Add Menu Items</th></tr>
    <tr><th>Self ID</th><td><input style="width:375px;" type="text" name="selfID" placeholder="Hint: controller (Top Menu) or method_controller (Navigation)"/></td></tr>
    <tr><th>Title</th><td><input style="width:375px;" type="text" name="selfTitle"/></td></tr>
    <tr><th>URL</th><td><input style="width:375px;" type="text" name="url" placeholder="Hint: Controller/method"/></td></tr>
    <tr><th>User Levels</th><td><input style="width:375px;" type="text" name="usrlvl" placeholder="Hint: UserOneLevel,UserTwoLevel"/></td></tr>
    <tr><th>Expiry Date</th><td><textarea style="overflow-y: auto;" rows="5" cols="44" name="todate" placeholder="Hint: UserOnelevelID=FullDate,UserTwolevelID=FullDate"></textarea></td></tr>
    <tr><th>Reoccurence</th><td><textarea style="overflow-y: auto;"  rows="5" cols="44"  name="reoccur" placeholder="Hint: UserOneLevelID=LowerDay-UpperDay,UserTwoLevel=LowerDay-UpperDay"></textarea></td></tr>
    <tr><td colspan="2" align='center'><input type="submit" value="Submit"/></td></tr>
</table>
</form>
