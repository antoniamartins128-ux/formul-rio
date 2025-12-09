<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Muhamad Nauval Azhar">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="This is a login page template based on Bootstrap 5">
    <title>Bootstrap 5 Register Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body>
 <img src="https://eeepmanoelmano.com.br/assets/logo-escola-vertical-dark-814d04a6.svg" alt="Logo da EEEP Manoel Mano" style="width: 100px;" class="mb-4">
    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-sm-center h-100">
                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
                    <div class="text-center my-5">
                 	<div class="text-center">
                   
                    <div class="card shadow-lg">
                        
                        <div class="card-body p-5">
                </div>
                    </div>
                            <h1 class="fs-4 card-title fw-bold mb-4">Register</h1>
                            <form action="login.php" method="post" class="needs-validation">
                                <!--Campo de Nome-->
                                <div class="mb-3">
                                    <label class="mb-2 texte-muted" for="name">Name</label>
                                    <input type="text" name="name" id="" class="form-control" required autofocus>
                                </div>
                                <!--Campo de email-->
                                <div class="mb-3">
                                    <label class="mb-2 texte-muted" for="email">E-mail Address</label>
                                    <input type="remail" name="remail" id="remail" class="form-control" required autofocus>
                                </div>
                                <!--Campo de senha-->
                                <div class="mb-3">
                                    <div class="mb-2 w-100">
                                        <label class="text-muted" for="password">Password</label>
                                    </div>
                                    <input type="password" name="password" id="" class="form-control" required>
                                    <div class="invalid-feedback">
                                        Password is required
                                    </div>
                                </div>
                                <!--Campo lembre-me e campo login-->
                                <div class="d-flex align-items-center ">
                                            <p class="small">By registering you agree with our terms and condition</p>
                                </div>
                                <div class="d-flex align-items-center">
                                    <button type="submit" class="btn btn-primary ms-auto">Register</button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer py-3 border-0">
                            <div class="text-center">
                                Already have an account? <a href="index.php" class="text-dark">Login</a>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-5 text-mutedxd">
                        Copyright &copy; 2025-2025 &mdash; Manoel Mano
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html