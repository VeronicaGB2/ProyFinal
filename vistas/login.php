
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1.0"-->
    <link rel="stylesheet" href="../assets/css/login.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
    <div id="login" class="modal-body modal-dialog">
        <div class="modal-content col-lg-18">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="validar.php" method="post"><br>
                            <img src="../assets/img/imgusuario.png" class="imgusuario">
                            <h3 class="text-center text-info">Login</h3>
                            <div class="form-group">
                                <label for="username" class="text-info">Correo:</label><br>
                                <input type="text" name="txtCorreo" id="txtCorreo" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">contraseña:</label><br>
                                <input type="text" name="txtPwd" id="txtPwd" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="remember-me" class="text-info"><span>Remember me</span> <span><input
                                            id="remember-me" name="remember-me" type="checkbox"></span></label><br>
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="submit">
                            </div>
                            <div id="register-link" class="text-right"><br>
                                <a href="#" class="text-info">Registrarse</a><br>
                            </div><br>
                        </form><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>