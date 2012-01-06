<?php
    require_once 'models/building.php';
    class BuildingController {
        public static function View( $params ) {
            global $format;
            require_once 'models/unit.php';
            require_once 'models/unitupgrade.php';
            require_once 'models/buildingupgrade.php';
            require_once 'models/addon.php';
            $building = Building::GetById( $params[ 'id' ] );
            if( empty( $building ) ){
                include "views/$format/404.php";
                return;
            }
            $units = Unit::ListByBuildingId( $building[ 'id' ] );
            $unitUpgrades = UnitUpgrade::ListByResearchplace( $building[ 'id' ], 1 );
            $buildingUpgrades = BuildingUpgrade::ListByResearchplace( $building[ 'id' ], 1 );
            $upgrades = BuildingUpgrade::ListByAffectedBuilding( $building[ 'id' ] );
            $addons = Addon::ListByBuildingId( $building[ 'id' ] );
            
            if( isset( $params[ 'verbose' ] ) ){
                $allUnits = Unit::ListByRaceId( $building[ 'raceId' ] );
                $allBuildingUpgrades = BuildingUpgrade::ListByRaceId( $building[ 'raceId' ] );
                $allUnitUpgrades = UnitUpgrade::ListByRaceId( $building[ 'raceId' ] );
                $allAddons = Addon::ListByRaceId( $building[ 'raceId' ] );
            }

            include "views/$format/building/view.php";
        }
        public static function Listing(){
            global $user;
            global $format;
            $buildings = Building::ListAllByRace();
            include "views/$format/building/listing.php";
        }
        public static function Update( $params ){
            global $user;
            global $format;
            $building = Building::GetById( $params[ 'id' ] );
            if( !$building || 
                !User::HasPermission( $user[ 'rights' ], $building[ 'raceId' ] ) ||
                !User::HasPermission( $user[ 'rights' ], $params[ 'raceId' ] ) ){
                include "views/$format/404.php";
                return;
            }

            db_update( 'building', array( 'id' => $params[ 'id' ] ), array(
                'name' => $params[ 'name' ],
                'raceId' => $params[ 'raceId' ],
                'health' => $params[ 'health' ],
                'minerals' => $params[ 'minerals' ],
                'gas' => $params[ 'gas' ],
                'time' => $params[ 'time' ]
            ) );
            header( 'Location: ' . $_SERVER[ 'HTTP_REFERER' ] );
        }
    }

?>
