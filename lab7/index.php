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

<?php
$jsonData = file_get_contents("websys.json");
$data = json_decode($jsonData, true);
$course = $data["websys_course"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Course Content</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pirata+One&display=swap" rel="stylesheet">
</head>

<div class="site">
    <div class="sidebar-content">
        <h1>Web Systems Content</h1>
        <button onclick="location.reload()">Refresh</button>
        <h2>Lectures</h2>
        <ul>
            <?php foreach ($course["lectures"] as $key => $lecture): ?>
                <li class="item" 
                    data-title="<?= htmlspecialchars($lecture["title"]) ?>"
                    data-description="<?= htmlspecialchars($lecture["description"]) ?>">
                    <?= htmlspecialchars($lecture["title"] ?: ucfirst($key)) ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <h2>Labs</h2>
        <ul>
            <?php foreach ($course["labs"] as $key => $lab): ?>
                <li class="item"
                    data-title="<?= htmlspecialchars($lab["title"]) ?>"
                    data-description="<?= htmlspecialchars($lab["description"]) ?>">
                    <?= htmlspecialchars($lab["title"] ?: ucfirst($key)) ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div id="content">
        <h2>Select a lecture or lab</h2>
        <p></p>
    </div>
    <script>
    document.querySelectorAll('.item').forEach(item => {
        item.addEventListener('click', () => {
            const title = item.dataset.title;
            const desc = item.dataset.description;

            const main = document.getElementById('content');
            main.innerHTML = `
                <h2>${title}</h2>
                <p>${desc}</p>
            `;
        });
    });
    </script>
</div>
</html>