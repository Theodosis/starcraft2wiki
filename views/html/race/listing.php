<h2 class="race"><?= $race[ 'name' ] ?></h2>
<ul class="itemlisting">
    <li class="left">
        <h3><a href="buildings">Buildings</a></h3>
        <ul><?php
            foreach( $buildings as $building ){
                ?><li><a href="building/<?php
                    echo $building[ 'id' ];
                ?>"><?php
                    echo $building[ 'name' ];
                ?></a></li><?php
            }
        ?></ul>
    </li>
    <li class="middle">
        <h3><a href="units">Units</a></h3>
        <ul><?php
            foreach( $units as $unit ){
                ?><li><a href="building/<?php
                    echo $unit[ 'id' ];
                ?>"><?php
                    echo $unit[ 'name' ];
                ?></a></li><?php
            }
        ?></ul>
    </li>
    <li class="right">
        <h3><a href="heros">heros</a></h3>
        <ul><?php
            foreach( $heros as $hero ){
                ?><li><a href="hero/<?php
                    echo $hero[ 'id' ];
                ?>"><?php
                    echo $hero[ 'name' ];
                ?></a></li><?php
            }
        ?></ul>
    </li>
</ul>
