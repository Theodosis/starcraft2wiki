<?php
    class Hero {
        public static function ListAllByRace(){
            $heros = db_array( "
                SELECT * FROM
                    hero;
            " );
            $b = array(
                "terran" => array(),
                "protoss" => array(),
                "zerg" => array()
            );

            foreach( $heros as $hero ){
                switch( $hero[ 'raceId' ] ){
                    case 1:
                        $b[ 'terran' ][] = $hero;
                        break;
                    case 2:
                        $b[ 'protoss' ][] = $hero;
                        break;
                    case 3:
                        $b[ 'zerg' ][] = $hero;
                }
            }
            return $b;
        }
        public static function ListByRaceId( $id ){
            switch( $id ){
                case 1:
                    $table = "terranHero";
                    break;
                case 2:
                    $table = "protossHero";
                    break;
                case 3:
                    $table = "zergHero";
                    break;
            }
            return db_array( "SELECT * FROM $table;" );
        }
        public static function GetById( $id ){
            $r = db_array( "
                SELECT h.*, r.name as race, role=\"Pending\", armor=\"Pending\", description=\"Pending\" FROM 
                    hero h
                    LEFT JOIN race r
                        ON h.raceId = r.id
                WHERE h.id=:id;
            ", compact( 'id' ) );
            return !empty( $r ) ? $r[ 0 ] : false;
        }
    }

?>
