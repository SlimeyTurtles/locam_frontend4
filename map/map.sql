CREATE TABLE places (
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255),
  picture VARCHAR(255),
  details TEXT,
  lat FLOAT,
  lng FLOAT
);