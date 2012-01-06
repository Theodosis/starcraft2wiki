<?php
    class RaceController {
        public static function view( $params ){
            global $format;
            require_once 'models/building.php';
            require_once 'models/unit.php';
            require_once 'models/hero.php';
            require_once 'models/race.php';
            
            $race = Race::GetByName( $params[ 'race' ] );

            if( empty( $race ) ){
                include "views/$format/404.php";
                return;
            }

            $buildings = Building::ListByRaceId( $race[ 'id' ] );
            $units = Unit::ListByRaceId( $race[ 'id' ] );
            $heros = Hero::ListByRaceId( $race[ 'id' ] );


            include "views/$format/race/listing.php";
        }
    }
?>
