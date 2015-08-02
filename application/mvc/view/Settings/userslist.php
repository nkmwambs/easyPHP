
    <form method="post" action="<?php echo Resources::url("Settings/userslist")?>">
        <label for='userlevel'>User Level</label> <select name='userlevel'><option value="1">ICP</option><option value="2">PF</option><option value="5">HS</option><option value="3">Finance</option></select>
        <label for="cname">Cluster</label> <input type="text" name="cname"/></br>
        <input type="submit" value="Search"/>
    </form>
    <table class="designerTable" style="border-collapse: collapse;">
		<thead><tr><th>First Name</th><th>Last Name</th><th>Cluster</th><th>User Level</th></tr></thead>
                <tbody>
		<?php 

			foreach ($data as $title => $record)
			{
				echo '<tr><td><a href='.Resources::url("Settings/userslist/userlevel/1/cname/".$record->cname."").'>'.$record->fname.'</a></td><td>'.$record->lname.'</td><td>'.$record->cname.'</td><td>'.$record->userlevel.'</td></tr>';
			}

		?>
                </tbody>
	</table>