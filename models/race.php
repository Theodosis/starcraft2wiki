<?php
    class Race {
        public static function GetByName( $name ){
            $r = db_array( "
                SELECT * 
                    FROM race
                WHERE name=:name;
            ", compact( 'name' ) );
            return !empty( $r ) ? $r[ 0 ] : false;
        }
    }
?>
