<!DOCTYPE html>
<html lang="pt-br">

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

    <link rel="stylesheet" href="../css/login.css">

    <title>Login</title>
</head>

<body>
<div class="login-box">
        <!-- <h2>Login</h2> -->
        <div class="container-logo">
        <img src="../img/logo.png" alt="" class="logo">
        </div>
        <form method="POST" action="../config/test_login.php" >
          <div class="user-box">
            <input type="text" name="email" required="">
            <label>E-mail</label>
          </div>
          <div class="user-box">
            <input type="password" name="password" required="">
            <label>Senha</label>
          </div >
          <div>
          <div class="container d-flex justify-content-center">
            <input type="submit" name="submit" id="submit" class=" btn01 btn  btn-dark mx-2" value="LOGIN">
            <a href="./cadastro.php" class="btn01 btn btn-dark">CADASTRO</a>
            </div>
          </div>
        </form>
      </div>  
    </body>

</html>