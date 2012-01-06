<?php
    class Controller {
        public static function handle( $params ){
            global $settings;
            global $user;
            global $controller;
            global $method;
            global $format;

            $settings = require( "settings.php" );

            if ( $settings[ "testing" ] ) {
                error_reporting( E_ALL | E_WARNING | E_NOTICE );
            }

            require( "models/db.php" );
            require( "models/user.php" );
            
            if( isset( $_SESSION[ "user" ] ) ){
                $user = $_SESSION[ "user" ];
            }
            else{
                $user = User::GetCookieData();
            }

            // insert here any new controllers
            $controllerWhitelist = array( "home", "building", "hero", "unit", "buildingupgrade", "unitupgrade", "addon", "world", "race", "session", "user", "admin" );
            $controller = "home";

            if ( isset( $params[ "controller" ] ) ) {
                $controller = $params[ "controller" ];
            }
            if ( !in_array( $controller, $controllerWhitelist ) ) {
                include "views/$format/header.php";
                include "views/$format/404.php";
                include "views/$format/footer.php";
                return; 
            }

            $method = "view";
            if ( isset( $params[ "method" ] ) ) {
                $method = $params[ "method" ];
            }
            
            $format = "html";
            if( isset( $params[ "format" ] ) ){
                $format = $params[ "format" ];
            }

            
            if( in_array( $method, array( "create", "update", "delete" ) ) ){
                $_SERVER[ "REQUEST_METHOD" ] == "POST" or die( "Non-idempotent REST method cannot be applied with the idempotent HTTP request method '" . $_SERVER[ "REQUEST_METHOD" ] . "'" );
            }
            

            // if not logged in, allow only session or user/create
            if( $user === false and !( 
                    $controller == "session" or
                    $controller == "user" and $method == "create" 
                ) ){
                $controller = "session";
                $method = "view";
            }

            // this is safe as $controller is whitelisted
            require( "controllers/$controller.php" );
            unset( $params[ "controller" ], $params[ "method" ] );
            if( !is_callable( "{$controller}Controller::$method" ) ){
                include "views/$format/header.php";
                include "views/$format/404.php";
                include "views/$format/footer.php";
                return; 
            }
            
            if ( in_array( $method, array( "view", "listing" ) ) ){
                require( "views/$format/header.php" );
            }
            call_user_func( array( $controller . "controller", $method ), $params );
            if ( in_array( $method, array( "view", "listing" ) ) ){
                require( "views/$format/footer.php" );
            }
        }
    }
?>
