  <section class="container">
    <div class="login">
      <h1>Login to Toolkit</h1>
     <form id='frmLogin'>
        <p><input type="text" name="username" id='username' value="" placeholder="Username"></p>
        <p><input type="password" name="password" value="" placeholder="Password"></p>
        <p class="remember_me">
          <label>
            <input type="checkbox" name="remember_me" id="remember_me">
            Remember me on this computer
          </label>
        </p>
        
      </form>
    <p class="submit"><button onclick="login();">Login</button></p>

    </div>

    <div class="login-help">
      <p  style="color:black;">Forgot your password? <?php echo Resources::a_href("Welcome/forgotPass", "Click here to reset it",array("style"=>'color:black;')); ?></p>
    </div>
  </section>

  <section class="about">
    <p class="about-links">
      <a href="http://www.forum.compassionkenya.com/forum" target="_blank">Our Forum</a>
      <a href="http://www.compassionkenya.org" target="_blank">Our Website</a>
    </p>
    <p class="about-author">
      &copy; 2012&ndash;2013 <!--<a href="http://thibaut.me" target="_blank">Thibaut Courouble</a> -
      <a href="http://www.cssflow.com/mit-license" target="_blank">MIT License</a><br>
      Original PSD by <a href="http://www.premiumpixels.com/freebies/clean-simple-login-form-psd/" target="_blank">Orman Clark</a>-->
  </section>
