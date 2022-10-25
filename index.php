<!-- Utilizzando il database db-university, effettuate delle interrogazioni via PHP e mostrate 
il risultato in pagina. Va bene una lista di qualcosa recuperato dal DB University, quindi libero 
sfogo alla fantasia! -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.2/css/bootstrap.min.css" integrity="sha512-CpIKUSyh9QX2+zSdfGP+eWLx23C8Dj9/XmHjZY2uDtfkdLGo0uY12jgcnkX9vXOgYajEKb/jiw67EYm+kBf+6g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>University</title>
</head>
<body>
    <h1>Professori che insegnano al Dipartimento di Fisica ed Astronomia</h1>
    <h2>(Dipartimento n.2)</h2>

    <?php
        define('DB_SERVERNAME', 'localhost:8889');
        define('DB_USERNAME', 'root');
        define('DB_PASSWORD', 'root');
        define('DB_NAME', 'db_university');
        $conn = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

        if($conn && $conn->connect_error){
            echo('Impossibile accedere... riprova più tardi');
            die();
        }

        $sql = 'SELECT DISTINCT teachers.name, teachers.surname, teachers.email, teachers.office_address, degrees.department_id FROM `teachers` INNER JOIN course_teacher ON teachers.id = course_teacher.teacher_id INNER JOIN courses ON course_teacher.course_id = courses.id INNER JOIN degrees  ON degrees.id = courses.degree_id WHERE degrees.department_id = 2 ORDER BY teachers.surname ASC';

        $teachers_result = $conn->query($sql);

        if($teachers_result && $teachers_result->num_rows > 0){
            echo('<div class="container">');
            while( $teacher = $teachers_result->fetch_assoc() ){
                ?>
                <div class="row">
                    <div class="col-2 my-2"><?= $teacher['surname'] ?></div>
                    <div class="col-2 my-2"><?= $teacher['name'] ?></div>
                    <div class="col-4 my-2"><?= $teacher['email'] ?></div>
                    <div class="col-4 my-2"><?= $teacher['office_address'] ?></div>
                    
                </div>
                <?php
            }
            echo('</div>');
        }elseif($teachers_result){
            ?>
            <div>Non ci sono insegnanti nel dipartimento di Fisica ed Astronomia</div>
            <?php
        }
        else{
            echo('error...');
            die();
        }

    ?>





    
</body>
</html>