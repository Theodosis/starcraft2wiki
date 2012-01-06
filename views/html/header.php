<?php
    global $settings;
    global $controller;
    global $category;
    global $user;
    header( 'Content-Type: text/html; charset=UTF-8' );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <base href="<?= $settings[ 'base_url' ] ?>" />
        <title>StarCraft2 WIKI</title>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" type="text/css" href="css/default.css" />
        <link rel="stylesheet" type="text/css" href="css/panel.css" />
        <link rel="stylesheet" type="text/css" href="css/layout.css" />
        <link rel="stylesheet" type="text/css" href="css/itemlisting.css" />
        <link rel="stylesheet" type="text/css" href="css/itemview.css" />
        <link rel="stylesheet" type="text/css" href="css/homeview.css" />
        <link rel="stylesheet" type="text/css" href="css/world.css" />
        <link rel="stylesheet" type="text/css" href="css/session.css" />
        <link rel="stylesheet" type="text/css" href="css/admin.css" />
    </head>
    <body>
        <div id="container">
            <div id="header"><?php
                if( $user ){
                    ?><ul class="menu left">
                        
                        <li><a href="buildings">Buildings</a></li>
                        <li><a href="units">Units</a></li>
                        <li><a href="heros">Heros</a></li>
                    </ul>
                    <ul class="menu right">
                        <li><a href="worlds">Worlds</a></li>
                        <li><form method="post" action="logout"><div><input type="submit" value="Logout" /></div></form></li>
                        <?php
                            if( $user[ 'rights' ] != 0 ){
                                ?><li><a href="admin">AdminPanel</a></li><?php
                            }
                        ?>
                    </ul><?php
                }
                else{
                    ?><ul class="menu right">
                        <li class="register"><a href="register">Register</a></li>
                        <li class="login"><a href="login">Login</a></li>
                    </ul><?php
                }
                ?>
                <h1><a href="">StarCraft WIKI</a></h1>
            </div>
            <div id="content" class="<?php
                echo $controller . "_" . $method;
            ?>">
