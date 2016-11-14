
        <form method="POST" action="<?php echo Resources::url("Settings/addUser"); ?>">
            <table>
                <thead><tr><th colspan="2" align="center" onclick="show();">New User</th></tr></thead>
                <tbody>
                    <tr><td><label for="fname">First Name</label></td><td><input type="text" name="fname" id="fname"/></td></tr>
                    <tr><td><label for="lname">Last Name</label></td><td><input type="text" name="lname" id="lname"/></td></tr>
                    <tr><td><label for="uname">Username</label></td><td><input type="text" name="uname" id="uname"/></td></tr>
                    <tr><td><label for="cname">Cluster</label></td><td><input type="text" name="cname" id="cname"/></td></tr>
                    <tr><td><label for="password">Password</label></td><td><input type="text" name="password" id="password"/></td></tr>
                    <tr><td><label for="userlevel">Userlevel</label></td><td><input type="text" name="userlevel" id="userlevel"/></td></tr>
                    <tr><td><label for="auth">Authenticate</label></td><td><input type="text" name="auth" id="auth"/></td></tr>
                    <tr><td colspan="2" align="center"><input type="submit" id="submit" value="Create New"/></td></tr>
                </tbody>    
            </table>    
        </form>
        