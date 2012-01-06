<?php
    class SessionController {
        public static function View( $params ){
            global $format;
            global $user;
            global $settings;
            if( $user !== false ){
                header( "Location: {$settings[ 'base_url' ]}" );
                return;
            }
            
            $exists = isset( $params[ 'exists' ] );
            $error  = isset( $params[ 'error' ] );
            $loginerror = isset( $params[ 'loginerror' ] );
            include "views/$format/session/view.php";
        }
        public static function Create( $params ) {
            global $user;
            global $settings;
            if( $user !== false ){
                header( "Location: {$settings[ 'base_url' ]}" );
                return;
            }
            
            $user = User::Login( $params[ 'username' ], md5( $params[ 'password' ] ) );
            if( $user !== false ){
                $_SESSION[ 'user' ] = $user;
                setcookie( $settings[ 'cookiename' ], $user[ 'id' ] . "|" . $user[ 'authtoken' ], time() + 60 * 60 * 24 * 365 ); //login for a year
                header( "Location: {$settings[ 'base_url' ]}" );
                return;
            }
            header( "Location: {$settings[ 'base_url' ]}?loginerror" );
        }
        public static function Delete(){
            global $settings;
            User::Logout();
            setcookie( $settings[ 'cookiename' ], "", time() - 24 * 3600 ); //a day ago - just to be sore for timezones, clock adjustments etc
            unset( $_SESSION[ 'user' ] );
            header( "Location: {$settings[ 'base_url' ]}" );
        }
    }

?>
