<?php
    class UserController {
        public static function Create( $params ){
            global $user;
            global $settings;
            $firstname = $params[ 'firstname' ];
            $lastname = $params[ 'lastname' ];
            $email = $params[ 'email' ];
            $username = $params[ 'username' ];
            $password = $params[ 'password' ];
            
            if( !( 
                strlen( $firstname ) > 4 and
                strlen( $lastname ) > 4 and
                User::ValidEmail( $email ) and
                strlen( $username ) > 4 and
                strlen( $password ) > 4 
                ) ){
                header( "Location: {$settings[ 'base_url' ]}?error" );
                exit();
            }
            if( User::Conflicts( $username, $email ) ){
                header( "Location: {$settings[ 'base_url' ]}?exists" );
                exit();
            }
            
            $user = User::Register( $firstname, $lastname, $email, $username, md5( $password ) );
            $_SESSION[ 'user' ] = $user;
            setcookie( $settings[ 'cookiename' ], $user[ 'id' ] . "|" . $user[ 'authtoken' ], time() + 60 * 60 * 24 * 365 ); //login for a year
            header( "Location: {$settings[ 'base_url' ]}" );
        }
    }
?>
