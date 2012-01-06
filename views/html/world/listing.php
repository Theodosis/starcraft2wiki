<ul class="worlds">
<?php
    foreach( $worlds as $world ){
        ?><li>
            <a href="world/<?= $world[ 'id' ] ?>">
                <img src="" alt="<?= $world[ 'name' ] ?>" title="<?= $world[ 'name' ] ?>" />
            </a>
        </li><?php
    }
?>
</ul>
