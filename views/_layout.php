<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= ucfirst($page) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Register /login  style link -->
     <link rel="stylesheet" href="<?= PATH ?>assets/css/login.css">

    <!-- Profil style -->
    <link rel="stylesheet" href="<?= PATH ?>assets/css/profile.css">

    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>



<body >

    <main>
        <?php include_once 'views/' . $page . '_view.php'; ?>
    </main>

    <footer></footer>
    <!--<script src="<?= PATH ?>assets/js/add_room.js"></script>-->
</body>
</html>