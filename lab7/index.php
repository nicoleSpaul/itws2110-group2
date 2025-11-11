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
    // echo "Table 'courses' and 'students' created successfully or already exists.";
} catch (PDOException $e) {
    // echo "Error creating table: " . $e->getMessage();
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

    // echo "<pre>";
    // print_r($courses);
    // echo "</pre>";

} catch (PDOException $e) {
    if ($e->errorInfo[1] == 1062) {
        // echo "Error: Could not insert. A course with one of those CRNs already exists.";
    } else {
        // echo "Error inserting rows: " . $e->getMessage();
    }
}

// Part 2

// 1. Add address fields (street, city, state, zip) to the students table
try {
    $sql = "ALTER TABLE students
            ADD COLUMN street VARCHAR(255),
            ADD COLUMN city VARCHAR(100),
            ADD COLUMN state CHAR(2),
            ADD COLUMN zip CHAR(10);";
    
    $pdo->exec($sql);
    // echo "Address fields added to 'students' table successfully.";
} catch (PDOException $e) {
    if ($e->errorInfo[1] == 1060) {
        // echo "Address fields already exist in 'students' table.";
    } else {
        // echo "Error adding address fields: " . $e->getMessage();
    }
}

// 2. Add section and year fields to the courses table
try {
    $sql = "ALTER TABLE courses
            ADD COLUMN section VARCHAR(10),
            ADD COLUMN year YEAR;";
    
    $pdo->exec($sql);
    // echo "Section and year fields added to 'courses' table successfully.";
} catch (PDOException $e) {
    if ($e->errorInfo[1] == 1060) {
        // echo "Section and year fields already exist in 'courses' table.";
    } else {
        // echo "Error adding section and year fields: " . $e->getMessage();
    }
}

// 3. Create a grades table containing id (int primary key, auto increment), crn (foreign key), RIN (foreign key), and grade (int 3 not null) 
try {
    $sql = "CREATE TABLE IF NOT EXISTS grades (
            id INT AUTO_INCREMENT PRIMARY KEY,
            crn INT(11) UNSIGNED NOT NULL,
            RIN INT(9) UNSIGNED NOT NULL,
            grade INT(3) NOT NULL,
            FOREIGN KEY (crn) REFERENCES courses(crn),
            FOREIGN KEY (RIN) REFERENCES students(RIN)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    
    $pdo->exec($sql);
    // echo "Table 'grades' created successfully or already exists.";
} catch (PDOException $e) {
    // echo "Error creating 'grades' table: " . $e->getMessage();
}

// 4. INSERT at least 4 courses into the courses table
try {
    $sql = "INSERT INTO courses (crn, prefix, number, title) VALUES
            (37514, 'CSCI', 1100, 'Introduction to Computer Science'),
            (37730, 'MATH', 2010, 'Multivar Calculus & Matrix Algebra'),
            (73048, 'ITWS', 2110, 'Web Systems Development'),
            (35797, 'PHYS', 1100, 'Physics I')
            ON DUPLICATE KEY UPDATE title=VALUES(title);";
    
    $pdo->exec($sql);
    // echo "Courses inserted successfully or already exist.";
} catch (PDOException $e) {
    // echo "Error inserting courses: " . $e->getMessage();
}

// 5. INSERT at least 4 students into the students table
try {
    $sql = "INSERT INTO students (RIN, RCSID, first_name, last_name, alias, phone, street, city, state, zip) VALUES
            (662057099, 'wongp4', 'Priscilla', 'Wong', 'priscilla', 1231231231, '1 College Ave', 'Troy', 'NY', '12180'),
            (662057098, 'sitc', 'Courteney', 'Sit', 'courteney', 1231231232, '2 College Ave', 'Troy', 'NY', '12180'),
            (662057097, 'spauln', 'Nicole', 'Spaulding', 'nicole', 1231231233, '3 College Ave', 'Troy', 'NY', '12180'),
            (662057096, 'siongd', 'Dana', 'Siong Sin', 'dana', 1231231234, '4 College Ave', 'Troy', 'NY', '12180')
            ON DUPLICATE KEY UPDATE first_name=VALUES(first_name);";
    
    $pdo->exec($sql);
    // echo "Students inserted successfully or already exist.";
} catch (PDOException $e) {
    // echo "Error inserting students: " . $e->getMessage();
}

// 6. ADD 10 grades into the grades table
try {
    $sql = "INSERT INTO grades (crn, RIN, grade) VALUES
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
            ON DUPLICATE KEY UPDATE grade=VALUES(grade);";
    
    $pdo->exec($sql);
    // echo "Grades inserted successfully or already exist.";
} catch (PDOException $e) {
    // echo "Error inserting grades: " . $e->getMessage();
}

try {
    $sql = "ALTER TABLE courses
            ADD COLUMN details JSON;";
    $pdo->exec($sql);
    // echo "Details column added to 'courses' table successfully.";
} catch (PDOException $e) {
    if ($e->errorInfo[1] == 1060) {
        // echo "Details column already exists in 'courses' table.";
    } else {
        // echo "Error adding details column: " . $e->getMessage();
    }
}
?>

<?php
$jsonData = file_get_contents("websys.json");
$data = json_decode($jsonData, true);
$course = $data["websys_course"];
?>

<div class="sidebar">
    <h1>Web Systems Content</h1>
    <h2>Lectures</h2>
    <div class="item-list">
        <?php foreach ($course["lectures"] as $key => $lecture): ?>
            <div class="item">
                <h3><?= htmlspecialchars($lecture["title"] ?: ucfirst($key)) ?></h3>
                <p><?= htmlspecialchars($lecture["description"] ?: "No description available.") ?></p>
            </div>
        <?php endforeach; ?>
    </div>
    <h2>Labs</h2>
    <div class="item-list">
        <?php foreach ($course["labs"] as $key => $lab): ?>
            <div class="item">
                <h3><?= htmlspecialchars($lab["title"] ?: ucfirst($key)) ?></h3>
                <p><?= htmlspecialchars($lab["description"] ?: "No description available.") ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>