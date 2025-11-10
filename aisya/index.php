<?php
include "db.php";

$search = isset($_GET['search']) ? $_GET['search'] : "";
$limit = 5;
$page  = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

$total = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS t FROM students WHERE name LIKE '%$search%'")
)['t'];
$pages = ceil($total / $limit);

$data = mysqli_query($conn, "SELECT * FROM students 
    WHERE name LIKE '%$search%' 
    LIMIT $start,$limit");
?>

<form method="GET">
    <input type="text" name="search" value="<?= $search ?>">
    <button>Cari</button>
</form>

<a href="add.php">+ Tambah</a>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th><th>Nama</th><th>Umur</th><th>Kelas</th><th>Foto</th><th>Aksi</th>
    </tr>
    <?php while($r = mysqli_fetch_assoc($data)){ ?>
    <tr>
        <td><?= $r['id'] ?></td>
        <td><?= $r['name'] ?></td>
        <td><?= $r['age'] ?></td>
        <td><?= $r['class'] ?></td>
        <td><img src="uploads/<?= $r['photo'] ?>" width="70"></td>
        <td>
            <a href="edit.php?id=<?= $r['id'] ?>">Edit</a> |
            <a href="delete.php?id=<?= $r['id'] ?>">Hapus</a>
        </td>
    </tr>
    <?php } ?>
</table>

<?php for($i=1;$i<=$pages;$i++){ ?>
    <a href="?page=<?= $i ?>&search=<?= $search ?>"><?= $i ?></a>
<?php } ?>
