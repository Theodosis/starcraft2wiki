<?php
    class User {
        public static function HasPermission( $rights, $race ){
            $racebin = 1 << ( $race - 1 );
            return !!( $racebin & $rights );
        }
        public static function GetCookieData() {
            global $settings;

            if ( !isset( $_COOKIE[ $settings[ 'cookiename' ] ] ) ) {
                return false;
            }
            $cookie = $_COOKIE[ $settings[ 'cookiename' ] ];
            $cookieparts = explode( ':' , $cookie );
            if ( count( $cookieparts ) != 2 ) {
                return false;
            }
            $userid = ( int )$cookieparts[ 0 ];
            $authtoken = $cookieparts[ 1 ];
            if ( $userid <= 0 ) {
                return false;
            }
            if ( !preg_match( '#^[a-zA-Z0-9]{32}$#', $authtoken ) ) {
                throw New Exception( 'invalid auth' );
                return false;
            }
            return User::AuthtokenValidation( $userid, $authtoken );
        }

        public static function AuthtokenValidation( $userid, $authtoken )  {
            if ( !is_int( $userid ) || !$userid || !$authtoken || $authtoken == "" ) {
                return false;
            }
            $res = db(
                'SELECT
                    id, username, authtoken, rights, email
                FROM
                    [user]
                WHERE
                    id = :userid AND
                    authtoken = :authtoken
                LIMIT 1;',
                compact( 'userid', 'authtoken' )
            );
            
            if ( mssql_num_rows( $res ) ) {
                $row = mssql_fetch_array( $res );
                $row[ 'id' ] = (int)$row[ 'id' ];
                return $row;
            }
            
            return false;
        }

        public static function Login( $username, $password ) {
            if( !$username || !$password ) {
                return false;
            }
            $res = db(
                'SELECT TOP 1
                    id, username, authtoken, rights, email
                FROM
                    [user]
                WHERE
                    username = :username
                    AND password = :password;',
                compact( 'username', 'password' )
            );
            if( !mssql_num_rows( $res ) ){
                return false;
            }
            $row = mssql_fetch_array( $res );
            $row[ 'id' ] = ( int )$row[ 'id' ];
            $row[ 'authtoken' ] = User::RenewAuthtoken( $row[ 'id' ] ); 
            
            return $row;
        }

        public static function Logout(){
            global $user;
            $id = ( int )$user[ 'id' ];
            $res = db(
                'UPDATE [user]
                    SET
                        authtoken=""
                    WHERE
                        id = :id;',
                    compact( 'id' )
            );
        }
        
        public static function RenewAuthtoken( $userid ) {
            $userid = ( int )$userid;

            // generate authtoken
            // first generate 16 random bytes
            // generate 8 pseurandom 2-byte sequences 
            // (that's bad but generally conventional pseudorandom generation algorithms do not allow very high limits
            // unless they repeatedly generate random numbers, so we'll have to go this way)
            $bytes = array(); // the array of all our 16 bytes
            for ( $i = 0; $i < 8 ; ++$i ) {
                $bytesequence = rand( 0, 65535 ); // generate a 2-bytes sequence
                // split the two bytes
                // lower-order byte
                $a = $bytesequence & 255; // a will be 0...255
                // higher-order byte
                $b = $bytesequence >> 8; // b will also be 0...255
                // append the bytes
                $bytes[] = $a;
                $bytes[] = $b;
            }
            // now that we have 16 "random" bytes, create a string of 32 characters,
            // each of which will be a hex digit 0...f
            $authtoken = ''; // start with an empty string
            foreach ( $bytes as $byte ) {
                // each byte is two authtoken digits
                // split them up
                $first = $byte & 15; // this will be 0...15
                $second = $byte >> 4; // this will be 0...15 again
                // convert decimal to hex and append
                // order doesn't really matter, it's all random after all
                $authtoken .= dechex( $first ) . dechex( $second );
            }
            db(
                'UPDATE
                    [user]
                SET
                    authtoken=:authtoken
                WHERE
                    id=:userid;
                ', compact( 'userid', 'authtoken' )
            );

            return $authtoken;
        }
        public static function Register( $firstname, $lastname, $email, $username, $password ){
            $id = db_insert( 'user', compact( 'firstname', 'lastname', 'email', 'username', 'password' ) );
            if( $id === false ){
                return false;
            }
            $token = User::RenewAuthtoken( $id );
            $r = db_array( "
                SELECT 
                    id, firstname, lastname, username, email, authtoken, rights 
                FROM 
                    [user]
                WHERE id=:id;
            ", compact( 'id' ) );
            return $r[ 0 ];
        }
        public static function Conflicts( $username, $email ){
            $r = db_array( "
                SELECT * FROM [user]
                WHERE username=:username OR
                      email=:email;
            ", compact( 'username', 'email' ) );
            return count( $r ) != 0;
        }
        public static function ValidEmail( $email ) {
            // Partially incorrect:
            // * Will allow some invalid domain names such as domains containing same-label siblings.
            // * Won't allow the ' character in usernames, which can be valid
            //

            return ( bool )preg_match( '/^              # start of string
                [a-z0-9%_+.-]+                          # username (can contain any of a-z, 0-9, and the symbols %, _, +, . and -
                @                                       # @ symbol at the middle of the e-mail address
                (                                       # after-@-symbol part; can be either a domain name...
                    (                                   # domain node (parts between the dots)
                        [a-z0-9]                        # must start with a letter or number (not a dash)
                        [a-z0-9-]{0,62}                 # must be at most 63 characters long, and at least 1
                        (?<!-)                          # cannot end in a dash
                        \.                              # each part is separated from the next with a dot                        
                    )*                                  # can have any number of domain nodes (even zero if this is a
                                                        # top-level domain such as in admin@edu)
                    (                                   # top-level domain
                        [a-z]{2,4}                      # country domain such as .gr, .de, .nl;
                                                        # special cases such as .aero, .com, .edu;
                        |museum                         # and the special "museum" case 
                    )
                |                                       # ...or an IP address
                    (([0-9]|[1-9][0-9]|(1[0-9][0-9]|2([0-4][0-9]|5[0-5])))\.){3} # (0-255).(0-255).(0-255).
                    ([0-9]|[1-9][0-9]|(1[0-9][0-9]|2([0-4][0-9]|5[0-5])))        # (0-255)
                    (?<!0\.0\.0\.0)                                              # ...but it cannot be 0.0.0.0
                )
                $                                       # end of string
                                        /ix', $email );
        }
    }
?>
