<?php
include "db.php";

if(isset($_POST['save'])){
    $name = $_POST['name'];
    $age  = $_POST['age'];
    $class = $_POST['class'];

    $photo = $_FILES['photo']['name'];
    move_uploaded_file($_FILES['photo']['tmp_name'], "uploads/".$photo);

    mysqli_query($conn, "INSERT INTO students(name, age, class, photo) 
        VALUES('$name','$age','$class','$photo')");
    header("Location: index.php");
}
?>

<form method="POST" enctype="multipart/form-data">
    Nama: <input type="text" name="name" required><br>
    Umur: <input type="number" name="age" required><br>
    Kelas: <input type="text" name="class" required><br>
    Foto: <input type="file" name="photo" required><br>
    <button name="save">Simpan</button>
</form>
