DROP DATABASE IF EXISTS byog;
CREATE DATABASE byog;

USE byog;

CREATE TABLE users (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50) NOT NULL,
  password VARCHAR(128) NOT NULL
);


CREATE TABLE settings (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  icon_url VARCHAR(128),
  home_url VARCHAR(255),
  private_snippet VARCHAR(255),
  FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE snippets (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  content MEDIUMTEXT,
  owner_id INT NOT NULL,
  FOREIGN KEY (owner_id) REFERENCES users(id)
);

INSERT INTO users (
  name,
  password
) VALUES ('admin', 'admin');


INSERT INTO users (
  name,
  password
) VALUES ('jon', 'doe');

INSERT INTO settings (user_id, icon_url, home_url, private_snippet)
VALUES (1, 'http://www.cheesesfromswitzerland.com/fileadmin/_processed_/csm_content_gruyere_70deb08889.jpg',
'https://culshoefer.com', 'private snippet');
