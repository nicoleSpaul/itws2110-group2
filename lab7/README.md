## Part 2 Commands

1. Add address fields (street, city, state, zip) to the students table

ALTER TABLE students
ADD COLUMN street VARCHAR(255),
ADD COLUMN city VARCHAR(100),
ADD COLUMN state CHAR(2),
ADD COLUMN zip CHAR(10);

2. Add section and year fields to the courses table

ALTER TABLE courses
ADD COLUMN section VARCHAR(10),
ADD COLUMN year YEAR;

3. CREATE a grades table containing id (int primary key, auto increment), crn (foreign key), RIN (foreign key), and grade (int 3 not null) 

CREATE TABLE IF NOT EXISTS grades (
  id INT AUTO_INCREMENT PRIMARY KEY,
  crn INT(11) UNSIGNED NOT NULL,
  RIN INT(9) UNSIGNED NOT NULL,
  grade INT(3) NOT NULL,
  FOREIGN KEY (crn) REFERENCES courses(crn),
  FOREIGN KEY (RIN) REFERENCES students(RIN)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

4. INSERT at least 4 courses into the courses table

INSERT INTO courses (crn, prefix, number, title) VALUES
            (37514, 'CSCI', 1100, 'Introduction to Computer Science'),
            (37730, 'MATH', 2010, 'Multivar Calculus & Matrix Algebra'),
            (73048, 'ITWS', 2110, 'Web Systems Development'),
            (35797, 'PHYS', 1100, 'Physics I');

5. INSERT at least 4 students into the students table

INSERT INTO students (RIN, RCSID, first_name, last_name, alias, phone, street, city, state, zip)
VALUES
(662057099, 'wongp4', 'Priscilla', 'Wong', 'priscilla', 1231231231, '1 College Ave', 'Troy', 'NY', '12180'),
(662057098, 'sitc', 'Courteney', 'Sit', 'courteney', 1231231232, '2 College Ave', 'Troy', 'NY', '12180'),
(662057097, 'spauln', 'Nicole', 'Spaulding', 'nicole', 1231231233, '3 College Ave', 'Troy', 'NY', '12180'),
(662057096, 'siongd', 'Dana', 'Siong Sin', 'dana', 1231231234, '4 College Ave', 'Troy', 'NY', '12180');

6. ADD 10 grades into the grades table

INSERT INTO grades (crn, RIN, grade)
VALUES
(37514, 662057099, 94),
(37730, 662057098, 88),
(73048, 662057097, 91),
(35797, 662057096, 85),
(37514, 662057099, 82),
(37730, 662057098, 79),
(73048, 662057097, 89),
(35797, 662057096, 94),
(37514, 662057099, 87),
(37730, 662057098, 92);

7. List all students in the following sequences; in lexicographical order by RIN, last name, RCSID, and first name. Remember that lexicographical order is determined by your collation.

SELECT * FROM students ORDER BY RIN, last_name, RCSID, first_name;

8. List all students RIN, name, and address if their grade in any course was higher than a 90

SELECT DISTINCT s.RIN, s.first_name, s.last_name, s.street, s.city, s.state, s.zip
FROM students s
JOIN grades g ON s.RIN = g.RIN
WHERE g.grade > 90;

9. List out the average grade in each course

SELECT c.title, AVG(g.grade) AS average_grade
FROM grades g
JOIN courses c ON g.crn = c.crn
GROUP BY c.crn;

10. List out the number of students in each course

SELECT c.title, COUNT(DISTINCT g.RIN) AS num_students
FROM grades g
JOIN courses c ON g.crn = c.crn
GROUP BY c.crn;

## Priscilla README

In this lab, we had to collaborate with our groups to create a new version of LMS for Web Systems. We faced challenges with understanding how to collaborate on the database and how to host the website on AWS. After these initial challenges, we were able to complete our parts. I worked on Part 2 of the lab where I had to use SQL to modify and create existing tables. I used online references to go over SQL syntax before performing the tasks.

## Dana README

This lab was the most challenging lab for me so far. It wasa difficult to understand how to view my php files since we were using AWS instead of Azure like we did in Intro to ITWS. However, after my group helped me out, I was able to complete the spooky CSS styling for part 4 and set up the side bar and main content area. I used online PHP resources to see how to do the refresh button and use PHP to add JSON data into the sidebar.

Resources:
https://www.w3schools.com/sql/sql_syntax.asp
https://www.codecademy.com/article/sql-commands