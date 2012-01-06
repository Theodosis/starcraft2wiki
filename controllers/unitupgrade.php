<?php
    class UnitUpgradeController {
        public static function View( $params ) {
            global $format;
            require_once 'models/unitupgrade.php';
            require_once 'models/unit.php';
            require_once 'models/researchplace.php';

            $upgrade = UnitUpgrade::GetById( $params[ 'id' ] );
            if( empty( $upgrade ) ){
                include "views/$format/404.php";
                return;
            }
            $affected = Unit::ListByUpgradeId( $upgrade[ 'id' ] );
            
            $researched = ResearchPlace::GetByUpgradeId( $upgrade[ 'id' ], 'unitUpgrade' );
            
            $type = 'unit';
            
            include "views/$format/upgrade/view.php";
        }
    }

?>
