<?php
    class AddonController {
        public static function View( $params ) {
            global $format;
            require_once 'models/addon.php';
            require_once 'models/building.php';
            require_once 'models/unitupgrade.php';
            require_once 'models/buildingupgrade.php';

            $addon = Addon::GetById( $params[ 'id' ] );
            if( empty( $addon ) ){
                include "views/$format/404.php";
                return;
            }
            $buildings = Building::ListByAddon( $params[ 'id' ] );
            $unitUpgrades = UnitUpgrade::ListByResearchplace( $params[ 'id' ], 2 );
            $buildingUpgrades = BuildingUpgrade::ListByResearchplace( $params[ 'id' ], 2 );
            

            include "views/$format/addon/view.php";
        }
    }

?>
