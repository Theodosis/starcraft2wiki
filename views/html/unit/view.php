<div class="itemview">
    <h2><?= $unit[ 'name' ] ?> (unit)</h2>
    <div class="side">
        <img src="http://images3.wikia.nocookie.net/__cb20090113163151/starcraft/images/thumb/a/a1/Assimilator_SC2_Game3.jpg/180px-Assimilator_SC2_Game3.jpg" alt="unit" />
        <div class="panel details">
            <h3>Details</h3>
            <div class="body">
                <ul>
                    <li class="structure">
                        <h4>Structure</h4>
                        <ul>
                            <li>
                                <span>Race</span>
                                <strong><?= $unit[ 'race' ] ?></strong>
                            </li>
                            <li>
                                <span>Role</span>
                                <strong><?= $unit[ 'role' ] ?></strong>
                            </li>
                            <li>
                                <span>Produced</span>
                                <strong><a href="building/<?= $unit[ 'buildingId' ] ?>"><?= $unit[ 'building' ] ?></a></strong>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <h4>Production</h4>
                        <ul>
                            <li>
                                <span>Minerals</span>
                                <strong><?= $unit[ 'minerals' ] ?></strong>
                            </li>
                            <li>
                                <span>Gas</span>
                                <strong><?= $unit[ 'gas' ] ?></strong>
                            </li>
                            <li>
                                <span>Build time</span>
                                <strong><?= $unit[ 'time' ] ?></strong>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <h4>Protection</h4>
                        <ul>
                            <li>
                                <span>Hit points</span>
                                <strong><?= $unit[ 'health' ] ?></strong>
                            </li>
                            <li>
                                <span>Energy</span>
                                <strong><?= $unit[ 'energy' ] ?></strong>
                            </li>
                            <li>
                                <span>Armor</span>
                                <strong><?= $unit[ 'armor' ] ?></strong>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="main">
        <p><?= $unit[ 'description' ] ?></p>
        
        <?php
            if( count( $unitUpgrades ) ){
                ?><h3>Affected by Upgrades</h3>
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
        ?>
        
    </div>
</div>
