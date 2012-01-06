<?php
    class Building {
        public static function ListAllByRace(){
            $buildings = db_array( "
                SELECT * FROM
                    building
                ORDER BY raceId;
            " );
            $b = array(
                "terran" => array(),
                "protoss" => array(),
                "zerg" => array()
            );

            foreach( $buildings as $building ){
                switch( $building[ 'raceId' ] ){
                    case 1:
                        $b[ 'terran' ][] = $building;
                        break;
                    case 2:
                        $b[ 'protoss' ][] = $building;
                        break;
                    case 3:
                        $b[ 'zerg' ][] = $building;
                }
            }
            return $b;
        }
        public static function ListByRaceId( $id ){
            switch( $id ){
                case 1:
                    $table = "terranBuilding";
                    break;
                case 2:
                    $table = "protossBuilding";
                    break;
                case 3:
                    $table = "zergBuilding";
                    break;
            }
            return db_array( "SELECT * FROM $table;" );
        }
        public static function ListByAddon( $id ){
            return db_array( "
                SELECT b.* FROM
                    building b
                    LEFT JOIN buildingBuildingAddon bba
                        ON b.id = bba.buildingId
                WHERE 
                    bba.buildingAddonId=:id;
            ", compact( 'id' ) );
        }
        public static function ListByUpgradeId( $id ){
            return db_array( "
                SELECT b.* FROM
                    building b
                    LEFT JOIN buildingUpgradeBuilding bub
                        ON b.id = bub.buildingId
                WHERE
                    bub.buildingUpgradeId=:id;
            ", compact( 'id' ) );
        }
        public static function GetById( $id ){
            $r = db_array( "
                SELECT b.*, r.name as race, role=\"pending\", armor=\"pending\", description=\"Pending\" FROM 
                    building b
                    LEFT JOIN race r
                        ON b.raceId = r.id
                WHERE b.id=:id;
            ", compact( 'id' ) );
            return !empty( $r ) ? $r[ 0 ] : false;
        }
    }
?>
