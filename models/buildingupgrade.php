<?php
    class BuildingUpgrade {
        public static function ListByResearchPlace( $id, $type ){
            return db_array( "
                SELECT * FROM
                    buildingUpgrade
                WHERE
                    researchedAtId=:id AND
                    researchedAtType=:type;
            ", compact( 'id', 'type' ) );
        }
        public static function ListByAffectedBuilding( $id ) {
            return db_array( "
                SELECT bu.* FROM
                    buildingUpgrade bu
                    LEFT JOIN buildingUpgradeBuilding bbu
                        ON bu.id = bbu.buildingUpgradeId
                WHERE bbu.buildingId=:id;
            ", compact( 'id' ) );
        }
        public static function GetById( $id ){
            $r = db_array( "
                SELECT bu.*, description = \"Pending\", r.name race FROM 
                    buildingUpgrade bu
                    LEFT JOIN researchPlace rp
                        ON bu.researchedAtId = rp.id
                    LEFT JOIN race r
                        ON rp.raceId = r.id
                WHERE bu.id=:id;
            ", compact( 'id' ) );
            return !empty( $r ) ? $r[ 0 ] : false;
        }
        public static function ListByRaceId( $id ){
            switch( $id ){
                case 1:
                    $table = "terranBuildingUpgrade";
                    break;
                case 2:
                    $table = "protossBuildingUpgrade";
                    break;
                case 3:
                    $table = "zergBuildingUpgrade";
                    break;
            }
            return db_array( "SELECT * FROM $table;" );
        }
    }
?>
