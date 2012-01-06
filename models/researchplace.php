<?php
    class ResearchPlace {
        public static function GetByUpgradeId( $id, $type ){
            // it's safe to use type in a query, as we set it manually
            $r = db_array( "
                SELECT rp.* FROM
                    researchPlace rp
                    LEFT JOIN $type u
                        ON u.researchedAtId = rp.id AND
                           u.researchedAtType = rp.type
                WHERE u.id=:id;
            ", compact( 'id' ) );
            return !empty( $r ) ? $r[ 0 ] : false;
        }
    }
?>
