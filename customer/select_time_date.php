<?php require_once('./layout/header.php') ?>
<?php
    if(isset($_GET['cinema_id']) && isset($_SESSION['screening'])){
        $cinema_id = $_GET['cinema_id'];
        $session_arr =  $_SESSION['screening'];
        $_SESSION['screening'] = ['movie_id' => $session_arr['movie_id'], 'cinema_id' => $cinema_id];
        var_dump($_SESSION['screening']);
    }
?>
<section>
    <h1>Hello</h1>
</section>

<?php require_once('./layout/footer.php') ?>