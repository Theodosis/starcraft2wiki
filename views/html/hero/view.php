<div class="itemview">
    <h2><?= $hero[ 'name' ] ?> (hero)</h2>
    <div class="side">
        <img src="http://images3.wikia.nocookie.net/__cb20090113163151/starcraft/images/thumb/a/a1/Assimilator_SC2_Game3.jpg/180px-Assimilator_SC2_Game3.jpg" alt="hero" />
        <div class="panel details">
            <h3>Details</h3>
            <div class="body">
                <ul>
                    <li class="structure">
                        <h4>Structure</h4>
                        <ul>
                            <li>
                                <span>Race</span>
                                <strong><?= $hero[ 'race' ] ?></strong>
                            </li>
                            <li>
                                <span>Role</span>
                                <strong><?= $hero[ 'role' ] ?></strong>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <h4>Protection</h4>
                        <ul>
                            <li>
                                <span>Hit points</span>
                                <strong><?= $hero[ 'health' ] ?></strong>
                            </li>
                            <li>
                                <span>Energy</span>
                                <strong><?= $hero[ 'energy' ] ?></strong>
                            </li>
                            <li>
                                <span>Armor</span>
                                <strong><?= $hero[ 'armor' ] ?></strong>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="main">
        <p><?= $hero[ 'description' ] ?></p>
    </div>
</div>
