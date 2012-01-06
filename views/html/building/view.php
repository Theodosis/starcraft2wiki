<div class="itemview">
    <h2><?= $building[ 'name' ] ?> (building)</h2>
    <div class="side">
        <img src="http://images3.wikia.nocookie.net/__cb20090113163151images/thumb/a/a1/Assimilator_SC2_Game3.jpg/180px-Assimilator_SC2_Game3.jpg" alt="building" />
        <div class="panel details">
            <h3>Details</h3>
            <div class="body">
                <ul>
                    <li class="structure">
                        <h4>Structure</h4>
                        <ul>
                            <li>
                                <span>Race</span>
                                <strong><?= $building[ 'race' ] ?></strong>
                            </li>
                            <li>
                                <span>Role</span>
                                <strong><?= $building[ 'role' ] ?></strong>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <h4>Production</h4>
                        <ul>
                            <li>
                                <span>Minerals</span>
                                <strong><?= $building[ 'minerals' ] ?></strong>
                            </li>
                            <li>
                                <span>Gas</span>
                                <strong><?= $building[ 'gas' ] ?></strong>
                            </li>
                            <li>
                                <span>Build time</span>
                                <strong><?= $building[ 'time' ] ?></strong>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <h4>Protection</h4>
                        <ul>
                            <li>
                                <span>Hit points</span>
                                <strong><?= $building[ 'health' ] ?></strong>
                            </li>
                            <li>
                                <span>Armor</span>
                                <strong><?= $building[ 'armor' ] ?></strong>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="main">
        <p><?= $building[ 'description' ] ?></p>
        
        <?php
            if( count( $units ) ){
                ?><h3>Units</h3>
                <ul class="imagelist">
                    <?php
                    foreach( $units as $unit ){
                        ?><li>
                            <a href="unit/<?= $unit[ 'id' ] ?>">
                                <img src="http://tinyurl.com/824rfma" alt="<?= $unit[ 'name' ] ?>" title="<?= $unit[ 'name' ] ?>" />
                            </a>
                        </li><?php
                    }
                ?></ul><?php
            }
            
            if( count( $unitUpgrades ) ){
                ?><h3>Unit Upgrades</h3>
                <ul class="imagelist">
                    <?php
                    foreach( $unitUpgrades as $up ){
                        ?><li>
                            <a href="unitupgrade/<?= $up[ 'id' ] ?>">
                                <img src="http://tinyurl.com/824rfma" alt="<?= $up[ 'name' ] ?>" title="<?= $up[ 'name' ] ?>" />
                            </a>
                        </li><?php
                    }
                ?></ul><?php
            }
            
            if( count( $buildingUpgrades ) ){
                ?><h3>Building Upgrades</h3>
                <ul class="imagelist">
                    <?php
                    foreach( $buildingUpgrades as $up ){
                        ?><li>
                            <a href="buildingupgrade/<?= $up[ 'id' ] ?>">
                                <img src="http://tinyurl.com/824rfma" alt="<?= $up[ 'name' ] ?>" title="<?= $up[ 'name' ] ?>" />
                            </a>
                        </li><?php
                    }
                ?></ul><?php
            }
            
            if( count( $upgrades ) ){
                ?><h3>Affected By Upgrades</h3>
                <ul class="imagelist">
                    <?php
                    foreach( $upgrades as $up ){
                        ?><li>
                            <a href="buildingupgrade/<?= $up[ 'id' ] ?>">
                                <img src="http://tinyurl.com/824rfma" alt="<?= $up[ 'name' ] ?>" title="<?= $up[ 'name' ] ?>" />
                            </a>
                        </li><?php
                    }
                ?></ul><?php
            }

            if( count( $addons ) ){
                ?><h3>Addons</h3>
                <ul class="imagelist">
                    <?php
                    foreach( $addons as $addon ){
                        ?><li>
                            <a href="addon/<?= $addon[ 'id' ] ?>">
                                <img src="http://tinyurl.com/824rfma" alt="<?= $addon[ 'name' ] ?>" title="<?= $addon[ 'name' ] ?>" />
                            </a>
                        </li><?php
                    }
                ?></ul><?php
            }
        ?>
        
    </div>
</div>
