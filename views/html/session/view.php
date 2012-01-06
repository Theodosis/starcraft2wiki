<?php
    $register = $exists || $error;
    $login = $loginerror;
?>
<form method="post" action="login" class="login"<?php
    if( $login ){
        ?> style="display: block;"<?php
    }
?>>
    <h2>Login</h2>
    <?php
        if( $loginerror ){
            ?><p>Wrong credentials.</p><?php
        }
    ?>
    <div>
        <input class="text" type="text" name="username" placeholder="Username" />
    </div>
    <div>
        <input class="text" type="password" name="password" placeholder="Password" />
    </div>
    <div>
        <input class="button green" type="submit" value="Go!" />
    </div>
   <div class="eof"></div> 
</form>
<form method="post" action="register" class="register"<?php
    if( $login ){
        ?> style="display: none;"<?php
    }
?>>
    <h2>Register</h2>
    <?php
        if( $exists ){
            ?><p>Username or Email already exist.</p><?php
        }
        if( $error ){
            ?><p>Incorrect email address, or short fields</p><?php
        }
    ?>
    <div>
        <input class="text" type="text" name="firstname" placeholder="Firstname" />
        <input class="text" type="text" name="lastname" placeholder="Lastname" />
    </div>
    <div>
        <input class="text" type="text" name="email" placeholder="E-mail" />
        <input class="text" type="text" name="username" placeholder="Username" />
    </div>
    <div>
        <input class="text" type="password" name="password" placeholder="Password" />
    </div>
    <div>
        <input class="button green" type="submit" value="Go!" />
    </div>
   <div class="eof"></div> 
</form>
