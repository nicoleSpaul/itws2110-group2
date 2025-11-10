<?php
require_once __DIR__ . '/db.php';

$sql = <<<SQL
CREATE DATABASE IF NOT EXISTS websystems;
USE websystems;
CREATE TABLE IF NOT EXISTS courses (
  crn INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  prefix VARCHAR(4) NOT NULL,
  number SMALLINT(4) UNSIGNED NOT NULL,
  title VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
CREATE TABLE IF NOT EXISTS students (
  RIN INT(9) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  RCSID CHAR(7),
  first_name VARCHAR(100) NOT NULL,
  last_name VARCHAR(100) NOT NULL,
  alias VARCHAR(100) NOT NULL,
  phone INT(10)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
SQL;

try {
    $pdo->exec($sql);
    echo "Table 'courses' and 'students' created successfully or already exists.";
} catch (PDOException $e) {
    echo "Error creating table: " . $e->getMessage();
}

try {
    $sql = "INSERT INTO courses (crn, prefix, number, title) VALUES
            (37514, 'CSCI', 1100, 'Introduction to Computer Science'),
            (37730, 'MATH', 2010, 'Multivar Calculus & Matrix Algebra'),
            (73048, 'ITWS', 2110, 'Web Systems Development'),
            (35797, 'PHYS', 1100, 'Physics I');";
    
    $pdo->exec($sql);

    $stmt = $pdo->query("SELECT * FROM courses;");
    
    $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<pre>";
    print_r($courses);
    echo "</pre>";

} catch (PDOException $e) {
    if ($e->errorInfo[1] == 1062) {
        echo "Error: Could not insert. A course with one of those CRNs already exists.";
    } else {
        echo "Error inserting rows: " . $e->getMessage();
    }
}
?>