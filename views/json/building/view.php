<?php
    $building = array_merge( $building, compact( 
        'units', 'allUnits',
        'unitUpgrades', 'allUnitUpgrades',
        'buildingUpgrades', 'allBuildingUpgrades',
        'upgrades',
        'addons', 'allAddons'
    ) );
    echo json_encode( $building );
?>
