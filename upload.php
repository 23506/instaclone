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
<form enctype="multipart/form-data" method="post" action="upload.php">
    <fieldset>
<!--        <input type="hidden" name="MAX_FILE_SIZE" value="32768">-->
        <label for="title">Title</label>
        <input type="text" name="title" id="title">
        <input type="file" name="image"> <br>
        <label for="description">Omschrijving (max 140 tekens) </label>
        <textarea name="description" id="description"> </textarea>


        <input type="submit" id="submit" value="submit" name="submit">


        <?php
        if (isset($_POST['submit'])) {
            require_once('connectvars.php');
            $dbc = mysqli_connect(HOST, USER, PASS, DBNAME) or die('Error connectie');
            $title = mysqli_real_escape_string($dbc,trim($_POST['title']));
            $description = mysqli_real_escape_string($dbc, trim($_POST['description']));
            $temp = $_FILES['image']['tmp_name'];
            $target = 'images/' . time() . $_FILES['image']['name'];

            if (!empty($description)) {
                $succes = move_uploaded_file($temp, $target);
                if ($succes) {

                    $query = "INSERT INTO 23506_instaclone VALUES (0,NOW(),'$title','$description','$target','soufiane')";
                    $result = mysqli_query($dbc, $query) or die('Error databasing.');
                    echo '<br>Gelukt!';
                } else {
                    echo "error";
                }
            }

        }


        ?>
    </fieldset>
</form>

</body>
</html>