-- initialize database

CREATE TABLE IF NOT EXISTS credentials (
  dbuser varchar(255),
  dbpass varchar(255),
  dbname varchar(255),
  dbhost varchar(255)
);

INSERT IGNORE INTO credentials (
  dbhost,
  dbname,
  dbuser,
  dbpass
) VALUES (
  'localhost',
  'tmydblocal',
  'root',
  'mariocart64'
);
