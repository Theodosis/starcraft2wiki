<?php
    class UnitUpgrade {
        public static function ListByResearchPlace( $id, $type ){
            return db_array( "
                SELECT * FROM
                    unitUpgrade
                WHERE
                    researchedAtId=:id AND
                    researchedAtType=:type;
            ", compact( 'id', 'type' ) );
        }
        public static function ListByAffectedUnit( $id ){
            return db_array( "
                SELECT uu.* FROM
                    unitUpgrade uu
                    LEFT JOIN unitUpgradeUnit uuu
                        ON uu.id = uuu.unitUpgradeId
                WHERE
                    uuu.unitid=:id;
            ", compact( 'id' ) );
        }
        public static function GetById( $id ){
            $r = db_array( "
                SELECT uu.*, description = \"Pending\", r.name race FROM 
                    unitUpgrade uu
                    LEFT JOIN researchPlace rp
                        ON uu.researchedAtId = rp.id
                    LEFT JOIN race r
                        ON rp.raceId = r.id
                WHERE uu.id=:id;
            ", compact( 'id' ) );
            return !empty( $r ) ? $r[ 0 ] : false;
        }
        public static function ListByRaceId( $id ){
            switch( $id ){
                case 1:
                    $table = "terranUnitUpgrade";
                    break;
                case 2:
                    $table = "protossUnitUpgrade";
                    break;
                case 3:
                    $table = "zergUnitUpgrade";
                    break;
            }
            return db_array( "SELECT * FROM $table;" );
        }
    }
?>
