<?php
    class Unit {
        public static function ListAllByRace(){
            $units = db_array( "
                SELECT u.*, b.raceId as raceId FROM
                    unit u
                    LEFT JOIN building b
                        ON u.buildingId = b.id
                ORDER BY raceId;
            " );
            $b = array(
                "terran" => array(),
                "protoss" => array(),
                "zerg" => array()
            );

            foreach( $units as $unit ){
                switch( $unit[ 'raceId' ] ){
                    case 1:
                        $b[ 'terran' ][] = $unit;
                        break;
                    case 2:
                        $b[ 'protoss' ][] = $unit;
                        break;
                    case 3:
                        $b[ 'zerg' ][] = $unit;
                }
            }
            return $b;
        }
        public static function ListByRaceId( $id ){
            switch( $id ){
                case 1:
                    $table = "terranUnit";
                    break;
                case 2:
                    $table = "protossUnit";
                    break;
                case 3:
                    $table = "zergUnit";
                    break;
            }
            return db_array( "SELECT * FROM $table;" );
        }
        public static function ListByBuildingId( $id ){
            return db_array( "
                SELECT * FROM 
                    unit
                WHERE buildingId=:id;
            ", compact( 'id' ) );
        }
        public static function ListByUpgradeId( $id ){
            return db_array( "
                SELECT u.* FROM
                    unit u
                    LEFT JOIN unitUpgradeUnit uuu
                        ON u.id = uuu.unitId
                WHERE
                    uuu.unitUpgradeId=:id;
            ", compact( 'id' ) );
        }
        public static function GetById( $id ){
            $r = db_array( "
                SELECT u.*, b.name as building, b.id as buildingId, r.name as race, role=\"Pending\", armor=\"Pending\", description=\"Pending\" FROM 
                    unit u
                    LEFT JOIN building b
                        ON u.buildingId = b.id
                    LEFT JOIN race r
                        ON b.raceId = r.id
                WHERE u.id=:id;
            ", compact( 'id' ) );
            return !empty( $r ) ? $r[ 0 ] : false;
        }
    }

?>
