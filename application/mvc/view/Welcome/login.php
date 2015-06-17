<div id="overlay">

</div>
<div>
  
    <table id="log">
        <thead>
            <tr><th align="center">Toolkit Registered Users</th></tr>
        </thead>
        <tbody>
            <form>
            <tr><td align="center" id="logError"><?php echo $data; ?></td></tr>
            <tr><td align="center"><input type="text" name="username" id="username" placeholder="Username"/></td></tr>
            <tr><td align="center"><input type="password" name="password" id="password" placeholder="Password"/></td></tr>
            <tr><td align="center"><button formaction="<?php echo Resources::url("welcome/login");?>" formmethod="post">Login</button></form><?php echo Resources::a_href("welcome/logout","<button>Home</button>")?></td></tr>
        </tbody>
    </table>
    
</div>
<?php
