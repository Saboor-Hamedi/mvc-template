CREATE TABLE users(
id int(10)  NOT NULL AUTO_INCREMENT, 
username VARCHAR(250) NOT NULL, 
email VARCHAR(100) NOT NULL, 
password vARCHAR(250) NOT NULL, 
create_at DATETIME DEFAULT CURRENT_TIMESTAMP, 
PRIMARY KEY(id)
);
INSERT INTO users (
  username, email,password
) VALUES ('admin','admin@gmail.com','123'),
('guest','guest@gmail.com', '123');
CREATE TABLE posts(
  id int(10) NOT NULL AUTO_INCREMENT, 
  user_id int(10) NOT NULL, 
  paragraph text,
  created_at timestamp DEFAULT CURRENT_TIMESTAMP, 
  update_at timestamp DEFAULT CURRENT_TIMESTAMP, 
  active enum('0','1') DEFAULT '0',
  primary key(id),
  FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
);
INSERT INTO posts (
 user_id,paragraph,active
) VALUES (1, 'I am you text', '0');
