<?php
    class World {
        public static function ListAll(){
            return db_array( "
                SELECT *
                FROM world;
            " );
        }
        public static function GetById( $id ){
            $r = db_array( "
                SELECT *, description=\"Pending\" 
                    FROM world
                WHERE id=:id;
            ", compact( 'id' ) );
            return !empty( $r ) ? $r[ 0 ] : false;
        }
    }
?>
