CREATE TABLE Login (
    user_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    firstName VARCHAR(25), 
    lastName VARCHAR(25), 
    username VARCHAR(12) NOT NULL,
    password VARCHAR(12) NOT NULL,
);

INSERT INTO Login (firstName, lastName, username, password) VALUES ("Anna", "Swann", "aswann2", "umwEagle123");

CREATE TABLE Animal
(
	AnimalID VARCHAR(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	AnimalType INT,
	FOREIGN KEY (AnimalType)
	REFERENCES AnimalType(TypeID),
	Breed INT,
	FOREIGN KEY (Breed)
	REFERENCES Breed(BreedID),
	Color VARCHAR(25),
	DateOfBirth DATETIME,
	Name VARCHAR(25),
	Intake INT,
	FOREIGN KEY (Intake)
	REFERENCES Intake(IntakeID),
	Outcome INT,
	FOREIGN KEY (Outcome)
	REFERENCES Outcome(OutcomeID),
	Gender VARCHAR(6)
);

CREATE TABLE Breed
(
	BreedID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	Breed VARCHAR(40) 
);

CREATE TABLE Animal_Breed
(
	AnimalID VARCHAR(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	FOREIGN KEY (AnimalID)
	REFERENCES Animal(AnimalID),
	BreedID INT NOT NULL AUTO_INCREMENT PRIMARY KEY
	FOREIGN KEY (Breed)
	REFERENCES Breed(BreedID),
);

CREATE TABLE Intake
(
	IntakeID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	Condition VARCHAR(10),
	IntakeType VARCHAR(25),
	FoundLocation VARCHAR(70),
	IntakeDate DATETIME,
	IntakeAge INT
);

CREATE TABLE AnimalType
(
	TypeID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	Type VARCHAR(25)
);

CREATE TABLE Outcome 
(
	OutcomeID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	OutcomeType VARCHAR(25),
	OutcomeDate DATETIME,
	OutcomeAge INT
);

CREATE TABLE RegisteredUsers
(
	UserID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	firstName VARCHAR(25),
	lastName VARCHAR(25),
	Username VARCHAR(12) NOT NULL,
	Password VARCHAR(12) NOT NULL
);