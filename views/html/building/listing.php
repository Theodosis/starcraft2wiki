<ul class="itemlisting">
    <li class="terran">
        <h2><a href="race/terran">Terran</a></h2>
        <ul><?php
            foreach( $buildings[ 'terran' ] as $building ){
                ?><li><a href="building/<?php
                    echo $building[ 'id' ];
                ?>"><?php
                    echo $building[ 'name' ];
                ?></a></li><?php
            }
        ?></ul>
    </li>
    <li class="protoss">
        <h2><a href="race/protoss">Protoss</a></h2>
        <ul><?php
            foreach( $buildings[ 'protoss' ] as $building ){
                ?><li><a href="building/<?php
                    echo $building[ 'id' ];
                ?>"><?php
                    echo $building[ 'name' ];
                ?></a></li><?php
            }
        ?></ul>
    </li>
    <li class="zerg">
        <h2><a href="race/zerg">Zerg</a></h2>
        <ul><?php
            foreach( $buildings[ 'zerg' ] as $building ){
                ?><li><a href="building/<?php
                    echo $building[ 'id' ];
                ?>"><?php
                    echo $building[ 'name' ];
                ?></a></li><?php
            }
        ?></ul>
    </li>
</ul>
