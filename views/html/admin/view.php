<form method="post" action="?controller=building&method=update">
    <h2>Select a building to edit</h2>
    <select name="buildingid" class="select">
        <option>Select One</option><?php
        foreach( $buildings as $building ){
            ?><option value="<?= $building[ 'id' ] ?>"><?= $building[ 'name' ] ?></option><?php
        }
    ?></select>
    <div class="item">
        <input type="hidden" name="id" />
        <div class="block inline">
            <label>Name</label>
            <input type="text" name="name" value="" />
        </div>
        <div class="block inline">
            <label>Race</label>
            <select name="raceId">
                <option value="1">Terran</option>
                <option value="2">Protoss</option>
                <option value="3">Zerg</option>
            </select>
        </div>
        <div class="eof"></div>
        <div class="block inline">
            <label>Health</label>
            <input type="text" name="health" value="" />
        </div>
        <div class="block inline">
            <label>Minerals</label>
            <input type="text" name="minerals" value="" />
        </div>
        <div class="eof"></div>
        <div class="block inline">
            <label>Gas</label>
            <input type="text" name="gas" value="" />
        </div>
        <div class="block inline">
            <label>Time</label>
            <input type="text" name="time" value="" />
        </div>
        <div class="eof"></div>
        <div class="block inline">
            <label>units</label>
            <select multiple="multiple" name="units"></select>
        </div>
        <div class="block inline">
            <label>building upgrades</label>
            <select multiple="multiple" name="buildingupgrades"></select>
        </div>
        <div class="block inline">
            <label>unit upgrades</label>
            <select multiple="multiple" name="unitupgrades"></select>
        </div>
        <div class="block inline">
            <label>affected by upgrades</label>
            <select multiple="multiple" name="upgrades"></select>
        </div>
        <div class="block inline">
            <label>addons</label>
            <select multiple="multiple" name="addons"></select>
        </div>
        <div>
            <input type="submit" value="Edit" class="button green" />
        </div>
    </div>
</form>
