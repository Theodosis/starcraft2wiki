<?php
    require_once 'models/hero.php';
    class HeroController {
        public static function View( $params ) {
            global $format;
            require_once 'models/hero.php';
            
            $hero = hero::GetById( $params[ 'id' ] );
            if( empty( $hero ) ){
                include "views/$format/404.php";
                return;
            }
            include "views/$format/hero/view.php";
        }
        public static function Listing(){
            global $format;
            $heros = hero::ListAllByRace();
            include "views/$format/hero/listing.php";
        }
    }

?>
