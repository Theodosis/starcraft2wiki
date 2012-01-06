<div class="itemview">
    <h2><?= $addon[ 'name' ] ?> (addon)</h2>
    <div class="side">
        <img src="" alt="addon" />
        <div class="panel details">
            <h3>Details</h3>
            <div class="body">
                <ul>
                    <li class="structure">
                        <h4>Structure</h4>
                        <ul>
                            <li>
                                <span>Race</span>
                                <strong><?= $addon[ 'race' ] ?></strong>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <h4>Production</h4>
                        <ul>
                            <li>
                                <span>Minerals</span>
                                <strong><?= $addon[ 'minerals' ] ?></strong>
                            </li>
                            <li>
                                <span>Gas</span>
                                <strong><?= $addon[ 'gas' ] ?></strong>
                            </li>
                            <li>
                                <span>Build time</span>
                                <strong><?= $addon[ 'time' ] ?></strong>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <h4>Protection</h4>
                        <ul>
                            <li>
                                <span>Hit points</span>
                                <strong><?= $addon[ 'health' ] ?></strong>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="main">
        <p><?= $addon[ 'description' ] ?></p>
        
        <?php
            if( isset( $buildings ) && count( $buildings ) ){
                ?><h3>Compatible Buildings</h3>
                <ul class="imagelist">
                    <?php
                    foreach( $buildings as $building ){
                        ?><li>
                            <a href="building/<?= $building[ 'id' ] ?>">
                                <img src="http://tinyurl.com/824rfma" alt="<?= $building[ 'name' ] ?>" title="<?= $building[ 'name' ] ?>" />
                            </a>
                        </li><?php
                    }
                ?></ul><?php
            }
            
            if( isset( $unitUpgrades ) && count( $unitUpgrades ) ){
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
            
            if( isset( $buildingUpgrades ) && count( $buildingUpgrades ) ){
                ?><h3>Building Upgrades</h3>
                <ul class="imagelist">
                    <?php
                    foreach( $buildingUpgrades as $up ){
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
