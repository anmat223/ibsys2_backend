CREATE TABLE Planungsperiode (
	nummer int PRIMARY KEY	
);

CREATE TABLE Teil (
	id int NOT NULL AUTO_INCREMENT,
  nummer int UNIQUE, 
	anzahl int, 
	preis double,
	PRIMARY KEY (id)
);

CREATE TABLE Produktionsteil (
	id int NOT NULL AUTO_INCREMENT,
  teil int, 
	dreifachTeil TINYINT(1), 
	sicherheitsbestand int, 
	PRIMARY KEY (id),
	FOREIGN KEY (teil) REFERENCES Teil(nummer)
);

CREATE TABLE Kaufteil (
	id int NOT NULL AUTO_INCREMENT,
  teil int, 
	eingehendeBestellungen int,
	abweichung double, 
	diskontmenge int,
	lieferzeit double, 
	anfangsbestand int,
  p1 int,
  p2 int,
  p3 int,
	PRIMARY KEY (id),
	FOREIGN KEY (teil) REFERENCES Teil(nummer)
); 

CREATE TABLE Bedarf (
	kaufteil int, 
	produktionsteil int, 
	anzahl int,
	PRIMARY KEY (kaufteil, produktionsteil), 
	FOREIGN KEY (kaufteil) REFERENCES Kaufteil(teil),
	FOREIGN KEY (produktionsteil) REFERENCES Produktionsteil(teil)
);

CREATE TABLE TeilProPeriode (
	periode int, 
	teil int, 
	PRIMARY KEY (periode, teil),
	FOREIGN KEY (periode) REFERENCES Planungsperiode(nummer),
	FOREIGN KEY (teil) REFERENCES Produktionsteil(teil)
);

CREATE TABLE Periode (
	nummer int,
	PRIMARY KEY (nummer)
);

CREATE TABLE Bestellung (
	periode int,
	kaufteil int, 
	ne int,
	anzahl int,
	PRIMARY KEY (periode, kaufteil),
	FOREIGN KEY (periode) REFERENCES Periode(nummer),
	FOREIGN KEY (kaufteil) REFERENCES Kaufteil(teil)
);

CREATE TABLE Produktion (
	periode int, 
	produktionsteil int, 
	lagerbestandVorperiode int,
	auftrag int,
	PRIMARY KEY (periode, produktionsteil),
	FOREIGN KEY (periode) REFERENCES Periode(nummer),
	FOREIGN KEY (produktionsteil) REFERENCES Produktionsteil(teil)
);

CREATE TABLE Arbeitsplatz (
	nummer int,
	ruestzeit int,
	PRIMARY KEY (nummer)
);

CREATE TABLE TeilProArbeitsplatz (
	arbeitsplatz int, 
	produktionsteil int,
	bearbeitungszeit int,
	PRIMARY KEY (arbeitsplatz, produktionsteil),
	FOREIGN KEY (arbeitsplatz) REFERENCES Arbeitsplatz(nummer),
	FOREIGN KEY (produktionsteil) REFERENCES Produktionsteil(teil)
);

CREATE TABLE Produktionsschritt (
	id int,
	arbeitsplatz int, 
	produktionsteil int, 
	vorgaenger int, 
	nachfolger int, 
	bearbeitungszeit int,
	PRIMARY KEY (id), 
	FOREIGN KEY (arbeitsplatz) REFERENCES Arbeitsplatz(nummer),
	FOREIGN KEY (produktionsteil) REFERENCES Produktionsteil(teil),
	FOREIGN KEY (vorgaenger) REFERENCES Produktionsschritt(id), 
	FOREIGN KEY (nachfolger) REFERENCES Produktionsschritt(id)
);

CREATE TABLE WartendeArtikel (
	arbeitsplatz int, 
	produktionsteil int,
	bearbeitungWarteschlange int,
	anzahl int, 
	bearbeitungszeit int,
	PRIMARY KEY (arbeitsplatz, produktionsteil),
	FOREIGN KEY (arbeitsplatz) REFERENCES Arbeitsplatz(nummer),
	FOREIGN KEY (produktionsteil) REFERENCES Produktionsteil(teil)
);