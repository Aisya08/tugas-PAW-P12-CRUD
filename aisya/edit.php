<?php
include "db.php";
$id = $_GET['id'];

$d = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM students WHERE id=$id"));

if(isset($_POST['update'])){
    $name = $_POST['name'];
    $age  = $_POST['age'];
    $class = $_POST['class'];

    if($_FILES['photo']['name'] != ""){
        $photo = $_FILES['photo']['name'];
        move_uploaded_file($_FILES['photo']['tmp_name'], "uploads/".$photo);
    } else {
        $photo = $d['photo'];
    }

    mysqli_query($conn, "UPDATE students SET 
        name='$name', age='$age', class='$class', photo='$photo'
        WHERE id=$id");

    header("Location: index.php");
}
?>

<form method="POST" enctype="multipart/form-data">
    Nama: <input type="text" name="name" value="<?= $d['name'] ?>"><br>
    Umur: <input type="number" name="age" value="<?= $d['age'] ?>"><br>
    Kelas: <input type="text" name="class" value="<?= $d['class'] ?>"><br>
    Foto Baru: <input type="file" name="photo"><br>
    <button name="update">Update</button>
</form>
