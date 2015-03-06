CREATE TABLE countries(
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  country varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=INNODB;
CREATE TABLE regions(
  id INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  region varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  countries_id INT,
  INDEX index_countries_id (countries_id),
  FOREIGN KEY (countries_id)  REFERENCES countries(id) ON DELETE CASCADE
) ENGINE=INNODB;
CREATE TABLE cities(
  id INT(10) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  city varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  regions_id INT(10) NOT NULL
) ENGINE=INNODB;
START TRANSACTION;
INSERT INTO countries (id,country) VALUES(1,'БЕЛАРУСЬ'),(2,'РОССИЯ'),(3,'USA');
INSERT INTO regions(id,region, countries_id) VALUES(1,'Гродненская область',1),(2,'Гомельская область',1),(3,'Барановичская область область',1),
  (4,'Ростовская область',2),(5,'Волгоградская область',2), (6,'Московская область',2),
  (7,'Washington DC',3),(8,'Florida',3), (9,'COLORADO',3);
INSERT INTO cities(id,city,regions_id) VALUES(1,'Гродно',1),(2,'Ратичи',1),(3,'Фолюш',1),
  (4,'Мозырь',2),(5,'Калинковичи',2),(6,'Гомель',2),
  (7,'Барановичи',3),(8,'Стайки',3),(9,'Мелеховичи',3),
  (10,'Ростов',4),(11,'Куйбышев',4),
  (12,'Волгоград',5),(13,'Сталинград',5),
  (14,'Люберцы',6),(15,'Москва',6),
  (16,'Washington',7),(17,'Obama',7),
  (18,'Florida',8),(19,'Maiami',9),
  (20,'COLORADO CITY 1',7),(21,'Obama2',7);
COMMIT;