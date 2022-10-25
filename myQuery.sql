-- Seleziona tutti i professori che insegnano al dipartimento n.2 
-- Dipartimento di Fisica e astronomia (contati una sola volta)

SELECT DISTINCT teachers.name, teachers.surname, teachers.email, 
teachers.office_address, degrees.department_id
FROM `teachers` 
INNER JOIN course_teacher
ON teachers.id = course_teacher.teacher_id
INNER JOIN courses
ON course_teacher.course_id = courses.id
INNER JOIN degrees 
ON degrees.id = courses.degree_id
WHERE degrees.department_id = 2
ORDER BY teachers.surname ASC; 
