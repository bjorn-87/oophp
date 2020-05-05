--
-- Setup for the article:
-- https://dbwebb.se/kunskap/kom-igang-med-php-pdo-och-mysql
--

--
-- Create the database with a test user
--
DROP DATABASE IF EXISTS oophp;
CREATE DATABASE IF NOT EXISTS oophp;

DROP USER IF EXISTS 'user'@'localhost';
CREATE USER 'user'@'localhost'
IDENTIFIED
WITH mysql_native_password -- Only MySQL > 8.0.4
BY 'pass'
;

GRANT ALL
ON oophp.*
TO 'user'@'localhost'
;

USE oophp;
