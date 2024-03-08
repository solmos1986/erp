<!DOCTYPE html>
<html lang="es" data-topbar-color="dark">

<head>
    <meta charset="utf-8" />
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Theme Config Js -->
    <script src="{{ asset('js/head.js') }}"></script>

    <!-- Bootstrap css -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- App css -->
    <link href="{{ asset('css/app.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Icons css -->
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
</head>

<body class="authentication-bg authentication-bg-pattern">
    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-4">
                    <div class="card bg-pattern">
                        <div class="card-body p-4">
                            <div class="text-center w-75 m-auto">
                                <div class="auth-brand">
                                    <a href="index.html" class="logo logo-dark text-center">
                                        <span class="logo-lg">
                                            <img src="{{ asset('images/logo-dark.png') }}" alt=""
                                                height="22">
                                        </span>
                                    </a>
                                    <a href="index.html" class="logo logo-light text-center">
                                        <span class="logo-lg">
                                            <img src="{{ asset('images/logo-light.png') }}" alt=""
                                                height="22">
                                        </span>
                                    </a>
                                </div>
                                <p class="text-muted mb-4 mt-3">Ingrese su usuario y contraseña para acceder al sistema.
                                </p>
                            </div>
                            <form action="{{ route('auth.validate') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="usuario" class="form-label">Usuario</label>
                                    <input class="form-control" type="usuario" name="usuario" id="usuario" required=""
                                        placeholder="Usuario">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Contraseña</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password" class="form-control" name="password"
                                            placeholder="Ingresa tu contraseña">
                                        <div class="input-group-text" data-password="false">
                                            <span class="password-eye"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" name="remember" class="form-check-input" id="checkbox-signin" checked>
                                        <label class="form-check-label" for="checkbox-signin">Recordar
                                            contraseña</label>
                                    </div>
                                </div>
                                <div class="text-center d-grid">
                                    <button class="btn btn-primary" type="submit">Iniciar </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row mt-3">
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('/js/vendor.min.js') }}"></script>
    <!-- Authentication js -->
    <script src="{{ asset('js/pages/authentication.init.js') }}"></script>
</body>

</html>
