<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- link css boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- script do boostrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../css/cadastro.css">
    <title>ENGINE MASTERS</title>
</head>
<body>
    <div class="login-box">
        <div class="container-logo">
            <img src="../img/logo.png" alt="" class="logo">
        </div>
        <form action="../controllers/Person.php" method="POST">
            <div class="user-box">
                <input type="text" name="name" id="nome" class="inputUser" required>
                <label for="nome" class="labelInput">Nome completo</label>
            </div>
            <div class="user-box">
                <input type="text" name="email" id="email" class="inputUser" required>
                <label for="email" class="labelInput">Email</label>
            </div>
            <div class="user-box">
                <input type="password" name="password" id="password" class="inputUser" required>
                <label for="password" class="labelInput">Senha</label>
            </div>
            <div class="container d-flex justify-content-center">
                <input type="submit" name="submitPerson" id="submit" class="btn  btn-dark mx-2 w-100">
            </div>
        </form>
    </div>
</body>
</html>