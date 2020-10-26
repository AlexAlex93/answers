<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>User Authentication</title>
</head>
<body>
    <nav>
        <ul>
            <?php if ($this->data['user'] == null) {?>
            <li><a href="index.php?login">login</a></li>
            <?php } else { ?>
            <li><a href="index.php?logout">logout</a></li>
            <?php } ?>            
            <li><a href="index.php?user">user</a></li>
        </ul>
    </nav>