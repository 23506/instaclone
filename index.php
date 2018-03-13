<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="style.css" type="text/css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <title>InstaClone - Home</title>
</head>
<body>
<div id="navigationTitle">

    <img src="logo.png" alt="logo" id="logo">
    <h1>Instaclone</h1>
</div>
<nav id="navigationBar">
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="login.php">Login</a></li>
        <li><a href="register.php">Register</a></li>
        <li><a href="upload.php">Upload</a></li>
    </ul>
</nav>

<div id="navigationBox">

    <div id="boxSort">
        <form method="post" action="">
            <label for="sorteer"> Sorteer </label>
            <select name="sorteermenu" id="sorteer">
                <option value="date_asc">datum oploped</option>
                <option value="date_desc">datum aflopend</option>
                <option value="descr_asc">beschrijving oplopend</option>
                <option value="descr_desc">beschrijving aflopend</option>
                <option value="rand">willekeuring</option>
            </select>
            <input type="submit" name="submit_sort" value="sorteren">
        </form>
    </div>
    <div id="boxSearch">
        <label for="inputSearch">Search</label>
    </div>
</div>


<?php

require_once('connectvars.php');
$dbc = mysqli_connect(HOST, USER, PASS, DBNAME) or die('Error connecting');

$column = 'date';
$order = 'DESC';

if (isset($_POST['submit_sort'])) {
    switch ($_POST['sorteermenu']) {
        case 'date_asc':
            $column = 'date';
            $order = 'ASC';
            break;
        case  'date_desc':
            $column = 'date';
            $order = 'DESC';
            break;
        case 'descr_asc':
            $column = 'description';
            $order = 'ASC';
            break;
        case 'descr_desc':
            $column = 'description';
            $order = 'DESC';
            break;
        case 'rand':
            $column = 'rand()';
            $order = '';
            break;

    }

}


$query = "SELECT * FROM 23506_instaclone ORDER BY $column $order";
$result = mysqli_query($dbc, $query);
while ($row = mysqli_fetch_array($result)) {
    $title = $row['title'];
    $target = $row['target'];
    $date = $row['date'];
    $username = $row['username'];
    $description = $row['description'];
    echo '<div class="post" style="border: 10px dashed black;text-align: center"> <img style="height: 500px;width: 500px;" src="' . $target . '" /> <br>';
    echo 'Date: ' . $date . '            Username: ' . $username . '<br>' . $title . "  -  " . $description . "</div> <br>";
}
mysqli_close($dbc);


?>


</body>
</html>