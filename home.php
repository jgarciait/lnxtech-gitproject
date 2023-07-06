<!DOCTYPE html>
<?php

include('header.php');

?>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="css/Style.css">
</head>

<body>
     <form action="login.php" method="post">

        <h2>iReportApp</h2>

        <?php if (isset($_GET['error'])) { ?>

            <p class="error"><?php echo $_GET['error']; ?></p>

        <?php } ?>

        <label>PIN</label>

        <input type="password" name="password" placeholder="Employee Pin"><br> 

        <button type="submit">Login</button>

     </form>
</body>
</html>