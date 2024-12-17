create database medical;
use medical;
create table Patient(
NumPatient int auto_increment,
NumSocial int not null,
FirstName Varchar(255) not null,
LastName Varchar(255) not null,
primary key(NumPatient)
);
create table Physician(
NumMedecin int auto_increment,
FirstName Varchar(255) not null,
LastName Varchar(255) not null,
primary key(NumMedecin)
);
create table Diagnostic(
NumDiagnostic int auto_increment,
Describ Varchar(1000) not null,
primary key(NumDiagnostic)
);
create table Treatment(
NumTreatment int auto_increment,
Describ Varchar(1000) not null,
primary key(NumTreatment)
);
create table EnteredFile(
NumFile int auto_increment,
VisitDate Varchar(255) not null,
NumPatient int not null,
NumMedecin int not null,
NumTreatment int not null,
NumDiagnostic int not null,
primary key(NumFile),
foreign key (NumPatient) references Patient(NumPatient),
foreign key (NumMedecin) references Physician(NumMedecin),
foreign key (NumTreatment) references Treatment(NumTreatment),
foreign key (NumDiagnostic) references Diagnostic(NumDiagnostic)
);
ALTER TABLE patient AUTO_INCREMENT = 111111;
INSERT INTO Patient (NumSocial, FirstName, LastName) VALUES 
(12345678, 'Delisle', 'Pierre'),
(87654321, 'Delisle', 'Sylvain'),
(23244333, 'Tremblay', 'Sylvain');

INSERT INTO Physician (NumMedecin, FirstName, LastName) VALUES 
(12345, 'René', 'Lajoie'), 
(67899, 'Céline', 'Dion');


INSERT INTO Diagnostic (Describ) VALUES 
('Migraine'),
('Fracture au bras');

INSERT INTO Treatment (Describ) VALUES 
('2 Cachets à toutes les 4 heures'),
('Placer le bras dans un plâtre');

INSERT INTO EnteredFile (VisitDate, NumPatient, NumMedecin, NumTreatment, NumDiagnostic) VALUES 
('2008-04-25', 111111, 12345, 1, 1),
('2008-04-26', 111111, 67899, 2, 2),
('2008-04-25', 111112, 12345, 1, 1),
('2008-04-26', 111112, 67899, 2, 2);