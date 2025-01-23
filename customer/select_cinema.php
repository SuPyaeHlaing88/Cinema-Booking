<?php require_once('./layout/header.php') ?>
<?php
    if(isset($_GET['movie_id'])){
        $movie_id = $_GET['movie_id'];
        $_SESSION['screening'] = ['movie_id' => $movie_id];
    }
?>
<section>
    <h1>Hello</h1>
</section>

<?php require_once('./layout/footer.php') ?>