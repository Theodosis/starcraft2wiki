<div class="itemview">
    <h2><?= $world[ 'name' ] ?> (world)</h2>
    <div class="side">
        <img src="http://images3.wikia.nocookie.net/__cb20090113163151images/thumb/a/a1/Assimilator_SC2_Game3.jpg/180px-Assimilator_SC2_Game3.jpg" alt="world" />
        <div class="panel details">
            <h3>Details</h3>
            <div class="body">
                <ul>
                    <li class="structure">
                        <h4>Details</h4>
                        <ul>
                            <li>
                                <span>difficulty</span>
                                <strong><?= $world[ 'difficulty' ] ?></strong>
                            </li>
                            <li>
                                <span>Players</span>
                                <strong><?= $world[ 'minPlayers' ] ?> - <?= $world[ 'maxPlayers' ] ?></strong>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="main">
        <p><?= $world[ 'description' ] ?></p>
        
    </div>
</div>
