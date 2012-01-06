CREATE TABLE race(
	id int IDENTITY PRIMARY KEY,
	name varchar(10) UNIQUE NOT NULL 
);
CREATE TABLE building(
	id int IDENTITY PRIMARY KEY,
	name varchar(50) NOT NULL UNIQUE,
	health int NOT NULL CHECK( health > 0 ),
	minerals int NOT NULL CHECK( minerals > 0 ),
	gas int CHECK( gas >= 0 ) NOT NULL,
	time int NOT NULL CHECK( time > 0 ),
	raceId int NOT NULL FOREIGN KEY REFERENCES race(id),
	buildingId int FOREIGN KEY REFERENCES building(id)
);
CREATE TABLE buildingAddon(
	id int IDENTITY PRIMARY KEY,
	name varchar(50) NOT NULL UNIQUE,
	health int NOT NULL CHECK( health > 0 ),
	minerals int NOT NULL CHECK( minerals > 0 ),
	gas int CHECK( gas >= 0 ),
	time int NOT NULL CHECK( time > 0 ),
);
CREATE TABLE unit (
	id int IDENTITY PRIMARY KEY,
	name varchar(50) NOT NULL UNIQUE,
	health int NOT NULL CHECK( health > 0 ),
	energy int CHECK( energy >= 0 ),
	minerals int NOT NULL CHECK( minerals > 0 ),
	gas int CHECK( gas >= 0 ),
	time int NOT NULL CHECK( time > 0 ),
	supply int NOT NULL CHECK( supply > 0 AND supply <= 20 ),
	buildingId int NOT NULL FOREIGN KEY REFERENCES building(id)
);
CREATE TABLE hero (
	id int IDENTITY PRIMARY KEY,
	name varchar(50) NOT NULL UNIQUE,
	health int NOT NULL CHECK( health > 0 ),
	energy int CHECK( energy >= 0 ),
	raceId int NOT NULL FOREIGN KEY REFERENCES race(id)
);
create table world(
	id int identity primary key,
	name varchar(50) not null UNIQUE,
	difficulty varchar(20) not null check( difficulty in ( 'hard' , 'easy' , 'medium' , 'hell like' ) ),
	minPlayers int not null check ( minPlayers > 1 ),
	maxPlayers int not null check ( maxPlayers <=8 )
);


create table [user] (
	id int primary key identity,
	firstname varchar(100) not null,
	lastname varchar(100) not null,
	email varchar(100) not null UNIQUE check ( email like '^[A-Za-z0-9\._-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$' ),
	username varchar(50) not null UNIQUE,
	password char(32) not null,
	authtoken char(32) not null,
	created datetime default(getdate()),
	rights int default(10)
);
create table skill(
	id int primary key identity,
	name varchar(50) not null UNIQUE,
	energy int not null check(energy >=0),
	cooldown int not null check(cooldown >=0),
	description text,
	unitId int NOT NULL foreign key references unit(id)
);
create table unitUpgrade(
	id int identity primary key,
	name varchar(50) not null,
	minerals int NOT NULL CHECK( minerals > 0 ),
	gas int CHECK( gas >= 0 ),
	time int NOT NULL CHECK( time > 0 ),
	researchedAtId int NOT NULL,
    researchedAtType tinyint check (researchedAtType in (1,2)),

	constraint unique_name_researchedAt_unit unique(name,researchedAtId, researchedAtType)
);
create table buildingUpgrade(
	id int identity primary key,
	name varchar(50) not null,
	minerals int NOT NULL CHECK( minerals > 0 ),
	gas int CHECK( gas >= 0 ),
	time int NOT NULL CHECK( time > 0 ),
	researchedAtId int NOT NULL,
    researchedAtType tinyint check (researchedAtType in (1,2)),
    constraint unique_name_researchedAt_building unique(name,researchedAtId, researchedAtType)
);
create table unitUpgradeUnit(
	id int IDENTITY PRIMARY KEY,
	unitId int NOT NULL FOREIGN KEY REFERENCES unit(id),
	unitUpgradeId int NOT NULL FOREIGN KEY REFERENCES unitUpgrade(id),
    constraint unique_uuu_entry unique(unitId, unitUpgradeId)
);
create table buildingUpgradeBuilding(
	id int IDENTITY PRIMARY KEY,
	buildingId int NOT NULL FOREIGN KEY REFERENCES building(id),
	buildingUpgradeId int NOT NULL FOREIGN KEY REFERENCES buildingUpgrade(id),
    constraint unique_bub_entry unique(buildingId, buildingUpgradeId)
);
create table buildingBuildingAddon(
	id int IDENTITY PRIMARY KEY,
	buildingId int NOT NULL FOREIGN KEY REFERENCES building(id),
	buildingAddonId int NOT NULL FOREIGN KEY REFERENCES buildingAddon(id),
    constraint unique_bba_entry unique(buildingId, buildingAddonId)
);




CREATE TRIGGER min_max 
	ON world 
FOR INSERT, UPDATE
AS 
	DECLARE 
		@min int,
		@max int,
		@worldId int
	SELECT 
		@min = minPlayers, 
		@max = maxPlayers,
		@worldId = id
	FROM inserted
	IF @min > @max
	BEGIN
		UPDATE world
		SET maxPlayers = @min
		WHERE id = @worldId
	END;