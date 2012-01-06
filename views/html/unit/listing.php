<ul class="itemlisting">
    <li class="terran">
        <h2><a href="race/terran">Terran</a></h2>
        <ul><?php
            foreach( $units[ 'terran' ] as $unit ){
                ?><li><a href="unit/<?php
                    echo $unit[ 'id' ];
                ?>"><?php
                    echo $unit[ 'name' ];
                ?></a></li><?php
            }
        ?></ul>
    </li>
    <li class="protoss">
        <h2><a href="race/protoss">Protoss</a></h2>
        <ul><?php
            foreach( $units[ 'protoss' ] as $unit ){
                ?><li><a href="unit/<?php
                    echo $unit[ 'id' ];
                ?>"><?php
                    echo $unit[ 'name' ];
                ?></a></li><?php
            }
        ?></ul>
    </li>
    <li class="zerg">
        <h2><a href="race/zerg">Zerg</a></h2>
        <ul><?php
            foreach( $units[ 'zerg' ] as $unit ){
                ?><li><a href="unit/<?php
                    echo $unit[ 'id' ];
                ?>"><?php
                    echo $unit[ 'name' ];
                ?></a></li><?php
            }
        ?></ul>
    </li>
</ul>
