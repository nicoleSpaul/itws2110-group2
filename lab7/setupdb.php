<?php
require_once __DIR__ . '/db.php';

try {
    // Create database
    $sql = <<<SQL
    CREATE DATABASE IF NOT EXISTS websystems CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
    USE websystems;
SQL;
    $pdo->exec($sql);
    echo "Database 'websystems' ready.<br>";

    // Create courses and students tables
    $sql = <<<SQL
    CREATE TABLE IF NOT EXISTS courses (
      crn INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
      prefix VARCHAR(4) NOT NULL,
      number SMALLINT(4) UNSIGNED NOT NULL,
      title VARCHAR(255) NOT NULL,
      section VARCHAR(10),
      year YEAR
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    CREATE TABLE IF NOT EXISTS students (
      RIN INT(9) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
      RCSID CHAR(7),
      first_name VARCHAR(100) NOT NULL,
      last_name VARCHAR(100) NOT NULL,
      alias VARCHAR(100) NOT NULL,
      phone INT(10),
      street VARCHAR(255),
      city VARCHAR(100),
      state CHAR(2),
      zip CHAR(10)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    CREATE TABLE IF NOT EXISTS grades (
      id INT AUTO_INCREMENT PRIMARY KEY,
      crn INT(11) UNSIGNED NOT NULL,
      RIN INT(9) UNSIGNED NOT NULL,
      grade INT(3) NOT NULL,
      FOREIGN KEY (crn) REFERENCES courses(crn),
      FOREIGN KEY (RIN) REFERENCES students(RIN)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
SQL;
    $pdo->exec($sql);
    echo "Tables created successfully.<br>";

    // Add courses
    $sql = <<<SQL
    INSERT INTO courses (crn, prefix, number, title, section, year) VALUES
      (37514, 'CSCI', 1100, 'Introduction to Computer Science', '01', 2025),
      (37730, 'MATH', 2010, 'Multivar Calculus & Matrix Algebra', '01', 2025),
      (73048, 'ITWS', 2110, 'Web Systems Development', '01', 2025),
      (35797, 'PHYS', 1100, 'Physics I', '01', 2025)
    ON DUPLICATE KEY UPDATE title=VALUES(title);
SQL;
    $pdo->exec($sql);
    echo "Courses inserted.<br>";

    // Add students
    $sql = <<<SQL
    INSERT INTO students (RIN, RCSID, first_name, last_name, alias, phone, street, city, state, zip) VALUES
      (662057099, 'wongp4', 'Priscilla', 'Wong', 'priscilla', 1231231231, '1 College Ave', 'Troy', 'NY', '12180'),
      (662057098, 'sitc', 'Courteney', 'Sit', 'courteney', 1231231232, '2 College Ave', 'Troy', 'NY', '12180'),
      (662057097, 'spauln', 'Nicole', 'Spaulding', 'nicole', 1231231233, '3 College Ave', 'Troy', 'NY', '12180'),
      (662057096, 'siongd', 'Dana', 'Siong Sin', 'dana', 1231231234, '4 College Ave', 'Troy', 'NY', '12180')
    ON DUPLICATE KEY UPDATE first_name=VALUES(first_name);
SQL;
    $pdo->exec($sql);
    echo "Students inserted.<br>";

    // Add grades
    $sql = <<<SQL
    INSERT INTO grades (crn, RIN, grade) VALUES
      (37514, 662057099, 94),
      (37730, 662057098, 88),
      (73048, 662057097, 91),
      (35797, 662057096, 85),
      (37514, 662057099, 82),
      (37730, 662057098, 79),
      (73048, 662057097, 89),
      (35797, 662057096, 94),
      (37514, 662057099, 87),
      (37730, 662057098, 92)
    ON DUPLICATE KEY UPDATE grade=VALUES(grade);
SQL;
    $pdo->exec($sql);
    echo "Grades inserted.<br>";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
