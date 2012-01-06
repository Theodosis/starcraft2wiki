<?php
    class AdminController {
        public static function view( $params ){
            // buildings only, for now
            global $user;
            global $format;
            require "models/building.php";
            if( $user[ 'rights' ] == 0 ){
                include "views/$format/404.php";
                //return;
            }
            $buildings = array();
            $perm = $user[ 'rights' ];
            for( $i = 1; $i <= 3; ++$i ){
                if( $perm & 1 ){
                    $buildings = array_merge( $buildings, Building::ListByRaceId( $i ) );
                    $raceids[] = $i;
                }
                $perm = $perm >> 1;
            }
            include "views/$format/admin/view.php";
        }
    }
?>
