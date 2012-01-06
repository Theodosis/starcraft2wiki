<?php
    class Addon {
        public static function ListByBuildingId( $id ){
            return db_array( "
                SELECT ba.* FROM
                    buildingAddon ba
                    LEFT JOIN buildingBuildingAddon bba
                        ON ba.id = bba.buildingAddonId
                WHERE
                    bba.buildingId=:id;
            ", compact( 'id' ) );
        }
        public static function getById( $id ){
            $r = db_array( "
                SELECT TOP 1 ba.*, r.name race, description = \"Pending\" FROM
                    buildingAddon ba
                    LEFT JOIN buildingBuildingAddon bba
                        ON ba.id = bba.buildingAddonId
                    LEFT JOIN building b
                        ON b.id = bba.buildingId
                    LEFT JOIN race r
                        ON b.raceId = r.id
                WHERE ba.id=:id;
            ", compact( 'id' ) );
            return !empty( $r ) ? $r[ 0 ] : false;
        }
        public static function ListByRaceId( $id ){
            switch( $id ){
                case 1:
                    $table = "terranBuildingAddon";
                    break;
                case 2:
                    $table = "protossBuildingAddon";
                    break;
                case 3:
                    $table = "zergBuildingAddon";
                    break;
            }
            return db_array( "SELECT * FROM $table;" );
        }
    }
?>
