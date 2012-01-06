<?php
    require_once 'models/unit.php';
    class UnitController {
        public static function View( $params ) {
            global $format;
            require_once 'models/unit.php';
            require_once 'models/unitupgrade.php';
            
            $unit = Unit::GetById( $params[ 'id' ] );
            if( empty( $unit ) ){
                include "views/$format/404.php";
                return;
            }
            
            $unitUpgrades = UnitUpgrade::ListByAffectedUnit( $unit[ 'id' ] );
            include "views/$format/unit/view.php";
        }
        public static function Listing(){
            global $format;
            $units = Unit::ListAllByRace();
            include "views/$format/unit/listing.php";
        }
    }

?>
