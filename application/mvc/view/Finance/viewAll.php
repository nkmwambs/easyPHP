Query:<br><br>
<form id="qryFrm">
<fieldset style="width:150px;border:1px black solid;">
    <legend>Select Type</legend>
    <input type="radio" class='tblList' name="tblList" value="0" checked="checked"/>Voucher<br>
    <input type="radio" class='tblList' name="tblList" value="1"/>Plans<br>
    <!--<input type="radio" class='tblList' name="tblList" value="2"/>Plans<br>-->
</fieldset>

    <textarea style="display:block;" rows="3" id="results_sql" name="results_sql" readonly>
        &nbsp;
    </textarea><br>
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
    <?php echo a_tag("Finance/viewAll","<button>Reset</button>");?>
    </fieldset>
</div>