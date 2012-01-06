<?php
    class BuildingUpgradeController {
        public static function View( $params ) {
            global $format;
            require_once 'models/buildingupgrade.php';
            require_once 'models/building.php';
            require_once 'models/researchplace.php';

            $upgrade = BuildingUpgrade::GetById( $params[ 'id' ] );
            if( empty( $upgrade ) ){
                include "views/$format/404.php";
                return;
            }
            $affected = Building::ListByUpgradeId( $upgrade[ 'id' ] );
            
            $researched = ResearchPlace::GetByUpgradeId( $upgrade[ 'id' ], 'buildingUpgrade' );
            
            $type = 'building';
            
            include "views/$format/upgrade/view.php";
        }
    }

?>
