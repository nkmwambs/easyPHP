<?php
echo Resources::a_href("Students/newStudent/public/0",Resources::img("plus.png",array("title"=>"New Record"))." New Profile",array("class"=>"url"))." ".Resources::a_href("Students/draftStudentRecords/public/0",Resources::img("diskedit.png",array("title"=>"Draft Record"))." Draft Profile",array("class"=>"url"))." ".Resources::a_href("Students/manageStudents/public/0",Resources::img("manage2.png",array("title"=>"Manage Record"))." Manage Profile",array("class"=>"url"));
?>
<br>
<hr width='85%' style="float: left;"><br>
Search Student:<br><br>
<form id="qryFrm">
    <textarea rows="3" id="results_sql" name="results_sql" readonly>
        &nbsp;
    </textarea>
</form>
<div id="fieldset_wrapper">
    <fieldset class="fieldsets" style="width:100px;float: left;border:1px black solid;">
        <legend id="select" class="selectable" onclick="showContent(this);">Select</legend>
    </fieldset>
    <fieldset class="fieldsets" style="width:100px;float: left;border:1px black solid;">
        <legend id="search" class="selectable"  onclick="showContent(this);">Search</legend>
    </fieldset>
    <fieldset class="fieldsets" style="width:100px;float: left;border:1px black solid;">
        <legend id="sort" class="selectable"  onclick="showContent(this);">Sort</legend>
    </fieldset>
    <fieldset style="width:70px;float: left;border:1px black solid;">
        <legend id="limit">Limit</legend>
        <input type="text" style="max-width:50px" value="50" name="limit" id="limit"/>
    </fieldset>
    <fieldset style="width:130px;float: left;border:1px black solid;">
        <legend>Action</legend>
        <button onclick="searchResults();">Search</button>
    <?php echo Resources::a_href("Students/searchStudent","<button>Reset</button>");?>
    </fieldset>
</div>
