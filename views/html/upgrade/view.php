<div class="itemview">
    <h2><?= $upgrade[ 'name' ] ?> (<?= $type ?> upgrade)</h2>
    <div class="side">
        <img src="" alt="upgrade" />
        <div class="panel details">
            <h3>Details</h3>
            <div class="body">
                <ul>
                    <li class="structure">
                        <h4>Structure</h4>
                        <ul>
                            <li>
                                <span>Race</span>
                                <strong><?= $upgrade[ 'race' ] ?></strong>
                            </li>
                            <li>
                                <span>Researched</span>
                                <strong><a href="<?= $researched[ 'type' ] == 1 ? "building" : "addon" ?>/<?= $researched[ 'id' ] ?>"><?= $researched[ 'name' ] ?></a></strong>
                                    
                        </ul>
                    </li>
                    <li>
                        <h4>Production</h4>
                        <ul>
                            <li>
                                <span>Minerals</span>
                                <strong><?= $upgrade[ 'minerals' ] ?></strong>
                            </li>
                            <li>
                                <span>Gas</span>
                                <strong><?= $upgrade[ 'gas' ] ?></strong>
                            </li>
                            <li>
                                <span>Build time</span>
                                <strong><?= $upgrade[ 'time' ] ?></strong>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="main">
        <p><?= $upgrade[ 'description' ] ?></p>
        
        <?php
            if( isset( $affected ) && count( $affected ) ){
                ?><h3>Affected <?= $type ?>s</h3>
                <ul class="imagelist">
                    <?php
                    foreach( $affected as $aff ){
                        ?><li>
                            <a href="<?= $type . '/' . $aff[ 'id' ] ?>">
                                <img src="http://tinyurl.com/824rfma" alt="<?= $aff[ 'name' ] ?>" title="<?= $aff[ 'name' ] ?>" />
                            </a>
                        </li><?php
                    }
                ?></ul><?php
            }
        ?>
        
    </div>
</div>
