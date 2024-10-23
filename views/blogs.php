<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
  <?php
    $usersObj = new \classes\UsersView();
    $usersObj2 = new \classes\UsersContr();
    $usersObj2->createUser('Iet', 'Sanders', '1999-07-07');
    echo $usersObj->showUser('Iet');
  ?>
</body>
</html>