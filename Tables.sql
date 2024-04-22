CREATE TABLE Breed
(
	BreedID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	Breed VARCHAR(40) 
);

CREATE TABLE Intake
(
	IntakeID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	Animal_Condition VARCHAR(10),
	IntakeType VARCHAR(25),
	FoundLocation VARCHAR(70),
	IntakeDate DATETIME,
	IntakeAge INT
);

CREATE TABLE AnimalType
(
	TypeID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	Animal_Type VARCHAR(25)
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

CREATE TABLE Animal
(
	AnimalID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
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

CREATE TABLE Animal_Breed
(
	AnimalID INT NOT NULL,
	FOREIGN KEY (AnimalID)
	REFERENCES Animal(AnimalID),
	BreedID INT NOT NULL,
	FOREIGN KEY (BreedID)
	REFERENCES Breed(BreedID),
    PRIMARY KEY(AnimalID, BreedID)
);

INSERT INTO Breed (Breed) VALUES ("Beagle Mix"); 
INSERT INTO Breed (Breed) VALUES ("Domestic Shorthair Mix"); 
INSERT INTO Breed (Breed) VALUES ("Miniature Pinscher Mix"); 
INSERT INTO Breed (Breed) VALUES ("Rottweiler Mix"); 
INSERT INTO Breed (Breed) VALUES ("Labrador Retriever Mix"); 
INSERT INTO Breed (Breed) VALUES ("Hawk"); 
INSERT INTO Breed (Breed) VALUES ("Chihuahua Shorthair Mix"); 
INSERT INTO Breed (Breed) VALUES ("Pit Bull Mix"); 
INSERT INTO Breed (Breed) VALUES ("Border Collie Mix"); 
INSERT INTO Breed (Breed) VALUES ("Siamese Mix"); 

INSERT INTO Intake (Animal_Condition, IntakeType, FoundLocation, IntakeAge) VALUES ("Sick", "Stray", "Texas", 120); 
INSERT INTO Intake (Animal_Condition, IntakeType, FoundLocation, IntakeAge) VALUES ("Normal", "Owner Surrender", "Texas", 150); 
INSERT INTO Intake (Animal_Condition, IntakeType, FoundLocation, IntakeAge) VALUES ("Normal", "Stray", "Texas", 200); 
INSERT INTO Intake (Animal_Condition, IntakeType, FoundLocation, IntakeAge) VALUES ("Normal", "Stray", "Texas", 210); 
INSERT INTO Intake (Animal_Condition, IntakeType, FoundLocation, IntakeAge) VALUES ("Normal", "Stray", "Texas", 60); 
INSERT INTO Intake (Animal_Condition, IntakeType, FoundLocation, IntakeAge) VALUES ("Normal", "Public Assist", "Texas", 14); 
INSERT INTO Intake (Animal_Condition, IntakeType, FoundLocation, IntakeAge) VALUES ("Sick", "Stray", "Texas", 2556); 
INSERT INTO Intake (Animal_Condition, IntakeType, FoundLocation, IntakeAge) VALUES ("Normal", "Stray", "Texas", 120); 
INSERT INTO Intake (Animal_Condition, IntakeType, FoundLocation, IntakeAge) VALUES ("Normal", "Owner Surrender", "Texas", 120); 
INSERT INTO Intake (Animal_Condition, IntakeType, FoundLocation, IntakeAge) VALUES ("Injured", "Stray", "Texas", 365); 

INSERT INTO Outcome (OutcomeType, OutcomeDate, OutcomeAge) VALUES ("Partner", "2013-11-07", 365); 
INSERT INTO Outcome (OutcomeType, OutcomeDate, OutcomeAge) VALUES ("Rabies Risk", "2013-10-14", 242); 
INSERT INTO Outcome (OutcomeType, OutcomeDate, OutcomeAge) VALUES ("Partner", "2014-04-03", 365); 
INSERT INTO Outcome (OutcomeType, OutcomeDate, OutcomeAge) VALUES (NULL, "2018-01-08", 365); 
INSERT INTO Outcome (OutcomeType, OutcomeDate, OutcomeAge) VALUES ("Partner", "2014-08-03", 120); 
INSERT INTO Outcome (OutcomeType, OutcomeDate, OutcomeAge) VALUES ("Partner", "2017-09-16", 44); 
INSERT INTO Outcome (OutcomeType, OutcomeDate, OutcomeAge) VALUES ("Partner", "2020-12-03", 2921); 
INSERT INTO Outcome (OutcomeType, OutcomeDate, OutcomeAge) VALUES ("Partner", "2014-10-09", 451); 
INSERT INTO Outcome (OutcomeType, OutcomeDate, OutcomeAge) VALUES ("Partner", "2017-10-15", 270); 
INSERT INTO Outcome (OutcomeType, OutcomeDate, OutcomeAge) VALUES ("Partner", "2016-04-24", 395); 

INSERT INTO AnimalType (Animal_Type) VALUES ("Dog"); 
INSERT INTO AnimalType (Animal_Type) VALUES ("Cat"); 
INSERT INTO AnimalType (Animal_Type) VALUES ("Bird"); 

INSERT INTO Animal (AnimalType, Breed, Color, DateOfBirth, Name, Intake, Outcome, Gender) VALUES (1, 1, "White_Brown", "2012-11-06", "Lucy", 1, 1,"Female");
INSERT INTO Animal (AnimalType, Breed, Color, DateOfBirth, Name, Intake, Outcome, Gender) VALUES (1, 5, "Brown", "2014-07-07", "Edgar", 2, 2, "Male");
INSERT INTO Animal (AnimalType, Breed, Color, DateOfBirth, Name, Intake, Outcome, Gender) VALUES (1, 3, "Black_White", "2013-10-11", "Josh", 3, 3, "Male");
INSERT INTO Animal (AnimalType, Breed, Color, DateOfBirth, Name, Intake, Outcome, Gender) VALUES (1, 8, "Red_White", "2017-03-23", "Johnny", 4, 4, "Male");
INSERT INTO Animal (AnimalType, Breed, Color, DateOfBirth, Name, Intake, Outcome, Gender) VALUES (2, 2, "Brown_Tabby", "2014-06-02", "Elsa", 5, 5, "Female");
INSERT INTO Animal (AnimalType, Breed, Color, DateOfBirth, Name, Intake, Outcome, Gender) VALUES (2, 10, "Black_Brown", "2017-07-16", "Winnie", 6, 6, "Female");
INSERT INTO Animal (AnimalType, Breed, Color, DateOfBirth, Name, Intake, Outcome, Gender) VALUES (2, 2, "Black_White", "2013-12-01", "Oreo", 7, 7, "Male");
INSERT INTO Animal (AnimalType, Breed, Color, DateOfBirth, Name, Intake, Outcome, Gender) VALUES (1, 7, "White", "2013-11-10", "Sandy", 8, 8, "Female");
INSERT INTO Animal (AnimalType, Breed, Color, DateOfBirth, Name, Intake, Outcome, Gender) VALUES (1, 4, "Black_Brown", "2017-05-15", "Kash", 9, 9, "Male");
INSERT INTO Animal (AnimalType, Breed, Color, DateOfBirth, Name, Intake, Outcome, Gender) VALUES (3, 6, "Black", "2016-03-24", "Shades", 10, 10, "Male");

INSERT INTO RegisteredUsers (firstName, lastName, Username, Password) VALUES ("Anna", "Swann", "aswann2", "umwEagle123");
INSERT INTO RegisteredUsers (firstName, lastName, Username, Password) VALUES ("Katie", "Heyn", "kheyn", "xtfyjaqF");
INSERT INTO RegisteredUsers (firstName, lastName, Username, Password) VALUES ("Maria", "Hernandez", "mhernan5", "QpDEEMiD");
