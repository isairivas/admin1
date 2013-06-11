<div id="login">
    <div class="content">
        <h3>Login Goiti </h3>
        <div class="logo">
            <img  alt="Login" title="Login" src="<?php echo Proyect::getURLHome().'images/logo.png' ?>" />
        </div>
        <br/>
        <div class="form">
            <form action="<?php echo Proyect::getURLHome().'login/authenticate'; ?>" method="post">
                <input type="hidden" name="login[key]" value="<?php echo $_SESSION['lw.rys.login.key']; ?>" />
                <p>
                    <label>Usuario</label><br/>
                    <input type="text" name="login[usuario]" />
                </p>
                <p>
                    <label>Password</label><br/>
                    <input type="password" name="login[password]" />
                </p>
                <p>
                    <input type="submit" class="submit" value="Entrar" />
                </p>
            </form>
        </div>
    </div>
    
    <div class="footer">
    </div>
</div>