DROP TABLE IF EXISTS track_location;

 ALTER TABLE members
ADD PRIMARY KEY (user);

CREATE TABLE IF NOT EXISTS track_location (
	username VARCHAR(16),
	longitude FLOAT(50) NOT NULL,
	latitude FLOAT(50) NOT NULL,
	timeinserted TIMESTAMP,
    INDEX (username),
    constraint fk_username foreign key (username) references members (user)
 )ENGINE=INNODB;

$dbhost  = 'mudfoot.doc.stu.mmu.ac.uk';    // Unlikely to require changing
  $dbname  = 'arpalikh';   // Modify these...
  $dbuser  = 'arpalikh';   // ...variables according
  $dbpass  = 'Vanscerq9';   // ...to your installation
  $appname = "Robin's Nest"; // ...and preference

 INSERT INTO track_location( username, Longitude, Latitude ) VALUES
('precious',53.45551661,-2.20387357),
('precute',53.34449746,-2.62169753),
('tester',53.19437626,-2.23692047),
('precious',53.21522543,-2.18690225),
('precute',53.48561991,-2.62849273),
('tester',53.64061229,-2.10444331),
('precious',53.50698651,-1.85367605),
('precute',53.45584082,-2.24311406),
('tester',53.48840145,-2.33170429),
('precious',53.38828411,-2.4197408),
('precute',53.46547558,-2.30107771),
('tester',53.72865823,-2.27814896),
('precious',53.70286008,-1.98653508),
('precute',53.72810346,-2.4161873),
('tester',53.4568401,-2.19871072),
('precute',53.36988868,-1.95277612),
('precious',53.44227313, -2.25966568),
('tester',53.46262597, -2.21216908),
('precute',53.42767836, -2.25190446),
('precious',53.47892684, -2.26321216),
('precute',53.44895278, -2.28943837),
('tester',53.45877473, -2.27989024),
('tester',53.43667437, -2.2149833);