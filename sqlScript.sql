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

INSERT INTO `members` (`user`, `pass`) VALUES ('precute', 'precute');
INSERT INTO `members` (`user`, `pass`) VALUES ('tester', 'tester');
INSERT INTO `members` (`user`, `pass`) VALUES ('precious', 'password');

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

alter table track_location
add shareLocation char;

/** to select mutual friends**/
select friends.user, friends.friend, track_location.Longitude, track_location.Latitude, track_location.timeinserted
from track_location
join  friends 
where friends.user ="precute"
group by user;

/** to select my followers **/
select friends.user, friends.friend, track_location.Longitude, track_location.Latitude, track_location.timeinserted,track_location.shareLocation
from track_location
join  friends 
where friends.friend ="precious" and track_location.shareLocation = 0
group by user;

CREATE TABLE IF NOT EXISTS products (
  id varchar(10) NOT NULL,
  name varchar(512) NOT NULL,
  description text NOT NULL,
  price decimal(10,2) NOT NULL,
  details text NOT NULL,
  created timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
);
INSERT INTO `products` (`id`, `name`, `description`, `price`, `details`) VALUES ('RN-TSH1', 'Robin\'s Nest T-Shirt', 'A timeless classic - The world’s favourite garment in its purest shape. An essential basic for every day.', 15.00, 'An everyday essential, this basic t-shirt is made from soft pima cotton. A regular fit, it has short sleeves and a classic round neckline.');
INSERT INTO `products` (`id`, `name`, `description`, `price`, `details`) VALUES ('RN-MUG1', 'Robin\'s Nest Mug', 'A porcelain body mug with printed Robin\'s Nest branding.', 8.00, 'Capacity: 330ml Material: Fine china; Freezer, microwave, dishwasher and oven safe.');
INSERT INTO `products` (`id`, `name`, `description`, `price`, `details`) VALUES ('RN-BEA1', 'Robin\'s Nest Beanie Hat', 'Wrap up your accessories game with our beanies.', '16.50', 'Our beanies are made from 100% soft-touch acrylic in a double layer knit. Machine washable.');
INSERT INTO `products` (`id`, `name`, `description`, `price`, `details`) VALUES ('RN-BAG1', 'Robin\'s Nest Tote Bag', 'Our totes are great for carrying shopping!', '9.5', '100% Cotton, Two-Tone Tote Bag with two strong handles.');
INSERT INTO `products` (`id`, `name`, `description`, `price`, `details`) VALUES ('RN-TNK1', 'Robin\'s Nest Tank Top', 'Great for summer.', '17', '65% Polyester, 35% Cotton\nMachine Wash - Cold (30° max)');
INSERT INTO `products` (`id`, `name`, `description`, `price`, `details`) VALUES ('RN-USB1', 'Robin\'s Nest USB Stick', 'Say goodbye to lost data with the Robin\'s Nest USB. ', '8', 'Its 2GB capacity will keep your files, photos and music safe and sound. Features a removable cap.');
INSERT INTO `products` (`id`, `name`, `description`, `price`, `details`) VALUES ('RN-PEN1', 'Robin\'s Nest Ballpoint Pen', 'Great grip Robin\'s Nest branded ballpoint.', '3.50', 'Black ink ballpoint pen with long ink life.');


