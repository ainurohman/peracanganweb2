<?php

$connect = mysqli_connect('localhost', 'root', '', 'pagination');

$show_page = 3;
$page = isset($_GET['halaman']) && is_numeric($_GET['halaman']) ? $_GET['halaman'] : 1;
$pages = ($page>1) ? ($page * $show_page) - $show_page : 0;    

$mahasiswa = mysqli_query($connect,'SELECT * FROM mahasiswa')->num_rows;
$total_pages = ceil($mahasiswa / $show_page);

$data_mahasiswa = mysqli_query($connect,"SELECT * FROM mahasiswa LIMIT $pages, $show_page");
$nomor = $pages+1;
                
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>Pagination</title>
  </head>
  <body>
    <div class="container mt-4">
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">Nama</th>
                <th scope="col">Nim</th>
                <th scope="col">Jurusan</th>
                </tr>
            </thead>
            <tbody>
                <?php while($result = mysqli_fetch_assoc($data_mahasiswa)): ?>
                <tr>
                    <td><?php echo $result['nama']; ?></td>
                    <td><?php echo $result['nim']; ?></td>
                    <td><?php echo $result['jurusan']; ?></td>
                </tr>
                <?php endwhile; ?>
        </table>

        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item">
                <?php if($page > 1): ?>
                <a class="page-link" href="?halaman=<?php echo $page-1 ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
                <?php endif; ?>
                </li>
                <?php 
                for($x=1;$x<=$total_pages;$x++){
                    ?> 
                    <li class="page-item"><a class="page-link" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
                    <?php
                }
                ?>
                
                <li class="page-item">
                <?php if($page < $total_pages): ?>
                <a class="page-link" href="?halaman=<?php echo $page+1 ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
                <?php endif; ?>
                </li>
            </ul>
        </nav>
    </div>
 
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
  </body>
</html>