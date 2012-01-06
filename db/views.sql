-- hero
CREATE VIEW terranHero AS
    SELECT * FROM
        hero
    where raceid in ( SELECT id from race where name = 'Terran' );
CREATE VIEW protossHero AS
    SELECT * FROM
        hero
    where raceid in ( SELECT id from race where name = 'Protoss' );
CREATE VIEW zergHero AS
    SELECT * FROM
        hero
    where raceid in ( SELECT id from race where name = 'Zerg' );


-- building
CREATE VIEW terranBuilding AS
    SELECT * FROM
        building
    where raceid in ( SELECT id from race where name = 'Terran' );
CREATE VIEW protossBuilding AS
    SELECT * FROM
        building
    where raceid in ( SELECT id from race where name = 'Protoss' );
CREATE VIEW zergBuilding AS
    SELECT * FROM
        building
    where raceid in ( SELECT id from race where name = 'Zerg' );


-- unit
CREATE VIEW terranUnit AS
    SELECT * FROM
        unit
    where buildingid in (select id from terranBuilding); 
CREATE VIEW protossUnit AS
    SELECT * FROM
        unit
    where buildingid in (select id from protossBuilding);    
CREATE VIEW zergUnit AS
    SELECT * FROM
        unit
    where buildingid in (select id from zergBuilding);
    

-- skill
CREATE VIEW terranSkills AS
    SELECT * FROM
        skill
    WHERE unitId IN ( SELECT id FROM terranUnit );
CREATE VIEW protossSkills AS
    SELECT * FROM
        skill
    WHERE unitId IN ( SELECT id FROM protossUnit );
CREATE VIEW zergSkills AS
    SELECT * FROM
        skill
    WHERE unitId IN ( SELECT id FROM zergUnit );

    
-- buildingBuildingAddon
CREATE VIEW terranBuildingBuildingAddon AS
    SELECT * FROM
        buildingBuildingAddon
    WHERE buildingId IN ( SELECT id FROM terranBuilding );
CREATE VIEW protossBuildingBuildingAddon AS
    SELECT * FROM
        buildingBuildingAddon
    WHERE buildingId IN ( SELECT id FROM protossBuilding );
CREATE VIEW zergBuildingBuildingAddon AS
    SELECT * FROM
        buildingBuildingAddon
    WHERE buildingId IN ( SELECT id FROM zergBuilding );
    

-- buildingAddon
CREATE VIEW terranBuildingAddon AS
    SELECT * FROM
        buildingAddon
    WHERE id IN ( SELECT buildingAddonId FROM terranBuildingBuildingAddon );
CREATE VIEW protossBuildingAddon AS
    SELECT * FROM
        buildingAddon
    WHERE id IN ( SELECT buildingAddonId FROM protossBuildingBuildingAddon );
CREATE VIEW zergBuildingAddon AS
    SELECT * FROM
        buildingAddon
    WHERE id IN ( SELECT buildingAddonId FROM zergBuildingBuildingAddon );


-- buildingUpgradeBuilding
CREATE VIEW terranBuildingUpgradeBuilding AS
	SELECT * FROM
		buildingUpgradeBuilding
	WHERE buildingId IN ( SELECT id FROM terranBuilding );
CREATE VIEW protossBuildingUpgradeBuilding AS
	SELECT * FROM
		buildingUpgradeBuilding
	WHERE buildingId IN ( SELECT id FROM protossBuilding );
CREATE VIEW zergBuildingUpgradeBuilding AS
	SELECT * FROM
		buildingUpgradeBuilding
	WHERE buildingId IN ( SELECT id FROM zergBuilding );
    

-- buildingUpgrade
CREATE VIEW terranBuildingUpgrade AS
	SELECT * FROM
		buildingUpgrade
	WHERE id in ( SELECT buildingUpgradeId FROM terranBuildingUpgradeBuilding );
CREATE VIEW protossBuildingUpgrade AS
	SELECT * FROM
		buildingUpgrade
	WHERE id in ( SELECT buildingUpgradeId FROM protossBuildingUpgradeBuilding );
CREATE VIEW zergBuildingUpgrade AS
	SELECT * FROM
		buildingUpgrade
	WHERE id in ( SELECT buildingUpgradeId FROM zergBuildingUpgradeBuilding );


-- unitUpgradeUnit
CREATE VIEW terranUnitUpgradeUnit AS
	SELECT * FROM
		unitUpgradeUnit
	WHERE unitId in ( SELECT id FROM terranUnit );
CREATE VIEW protossUnitUpgradeUnit AS
	SELECT * FROM
		unitUpgradeUnit
	WHERE unitId in ( SELECT id FROM protossUnit );
CREATE VIEW zergUnitUpgradeUnit AS
	SELECT * FROM
		unitUpgradeUnit
	WHERE unitId in ( SELECT id FROM zergUnit );


-- unitUpgrade
CREATE VIEW terranUnitUpgrade AS
	SELECT * FROM
		unitUpgrade
	WHERE id in ( SELECT unitId FROM terranUnitUpgradeUnit );
CREATE VIEW protossUnitUpgrade AS
	SELECT * FROM
		unitUpgrade
	WHERE id in ( SELECT unitId FROM protossUnitUpgradeUnit );
CREATE VIEW zergUnitUpgrade AS
	SELECT * FROM
		unitUpgrade
	WHERE id in ( SELECT unitId FROM zergUnitUpgradeUnit );
	
	
	
	
	
-- assisting view represending a research place (place where upgrades take place)
CREATE VIEW researchPlace AS			
	SELECT a.id, a.name, a.minerals, a.gas, a.time, a.health, a.raceid, type=1
		FROM building as a
	UNION
	SELECT a.id, a.name, a.minerals, a.gas, a.time, a.health, c.raceid, type=2
		FROM buildingAddon as a
			LEFT JOIN buildingBuildingAddon as b
				ON a.id = b.buildingAddonId
			LEFT JOIN building as c
				ON b.buildingId = c.id;
				
				
				