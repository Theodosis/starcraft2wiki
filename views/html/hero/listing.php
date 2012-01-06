<ul class="itemlisting">
    <li class="terran">
        <h2><a href="race/terran">Terran</a></h2>
        <ul><?php
            foreach( $heros[ 'terran' ] as $hero ){
                ?><li><a href="hero/<?php
                    echo $hero[ 'id' ];
                ?>"><?php
                    echo $hero[ 'name' ];
                ?></a></li><?php
            }
        ?></ul>
    </li>
    <li class="protoss">
        <h2><a href="race/protoss">Protoss</a></h2>
        <ul><?php
            foreach( $heros[ 'protoss' ] as $hero ){
                ?><li><a href="hero/<?php
                    echo $hero[ 'id' ];
                ?>"><?php
                    echo $hero[ 'name' ];
                ?></a></li><?php
            }
        ?></ul>
    </li>
    <li class="zerg">
        <h2><a href="race/zerg">Zerg</a></h2>
        <ul><?php
            foreach( $heros[ 'zerg' ] as $hero ){
                ?><li><a href="hero/<?php
                    echo $hero[ 'id' ];
                ?>"><?php
                    echo $hero[ 'name' ];
                ?></a></li><?php
            }
        ?></ul>
    </li>
</ul>
