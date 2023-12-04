<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1.0"-->
    <link rel="stylesheet" href="../assets/css/login.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Include SweetAlert2 library -->
    <script src="https://js.hcaptcha.com/1/api.js" async defer></script>
   

</head>

<body>
    <div id="register" class="modal-body modal-dialog">
        <div class="modal-content col-lg-18">
            <div id="register-row" class="row justify-content-center align-items-center">
                <div id="register-column" class="col-md-6">
                    <div id="register-box" class="col-md-12">
                        <form id="register-form" class="form" action="../controllers/loginController.php" method="POST"><br>
                            <img src="../assets/img/imgusuario.png" class="imgusuario">
                            <h3 class="text-center text-info">Registrarse</h3>
                            <div class="form-group">
                                <label for="username" class="text-info">Nombre:</label><br>
                                <input required type="text" name="txtNombre" id="txtNombre" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="username" class="text-info">Direccion:</label><br>
                                <input required type="text" name="txtDireccion" id="txtDireccion" class="form-control">
                            </div>
                           
                            <div class="form-group">
                                <label for="username" class="text-info">Correo:</label><br>
                                <input required type="email" name="txtCorreo" id="txtCorreo" class="form-control">
                                <input type="hidden" name="action" value="register">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Contraseña:</label><br>
                                <input required type="password" name="txtPwd" id="txtPwd" class="form-control">
                            </div>

                            <div class="h-captcha" data-sitekey="7f03544c-1656-4b73-b242-407809005fa3" data-required="true"></div>
                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="Register">
                            </div>

                            <div id="login-link" class="text-right"><br>
                                <a href="login.php" class="text-info">Login</a><br>
                            </div><br>
                        </form><br>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#register-form').submit(function(e) {
                e.preventDefault();

                var isCaptchaCompleted = hcaptcha.getResponse();

                if (!isCaptchaCompleted) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Captcha incompleto',
                        text: 'Por favor, completa el captcha antes de registrar.',
                    });
                    return;
                }

                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: $(this).serialize(),
                    success: function(response) {
                        console.log(response);
                        if (response.redirect) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Registro exitoso',
                                text: 'Ahora puedes iniciar sesión.',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = response.redirect;
                                }
                            });
                        } else {

                            Swal.fire({
                                icon: 'error',
                                title: 'Error al registrar',
                                text: 'Por favor contacta al administrador.',
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX request failed:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error al registrar',
                            text: error,
                        });
                    }
                });
            });
        });
    </script>



</body>

</html>