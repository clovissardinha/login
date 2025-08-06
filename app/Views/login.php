<!doctype html>
<html lang="br" data-bs-theme="auto">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Clovis Sardinha">
    <meta name="generator" content="Hugo 0.122.0">
    <title>Login</title>
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

</head>

<body class="d-flex align-items-center py-4 bg-body-tertiary">
    <?php if (session()->has('mensagem')) : ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('mensagem') ?>
        </div>
    <?php endif; ?>
    <div container class=" col-md-8 m-auto">
        <main class="form-signin w-100 ">
            <div class="text-center">
                <img class="mb-4 " src="<?php echo base_url('/imagens/Sispeq_ Logo.png') ?>" alt="" width="60%" >
                <h1 class="h3 mb-3 fw-normal ">Por favor faça o Login - área restrita</h1>
            </div>
            <?php echo form_open('Login') ?>
            <div class="form-floating">
                <input type="email" class="form-control" name="email" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Email </label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">senha</label>
            </div>

            <div class="form-check text-start my-3">
                <input class="form-check-input" type="checkbox" name="remember" value="remember-me" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Remember me
                </label>
            </div>
            <button class="btn btn-primary w-100 py-2 ">Entrar</button>
            <?php echo form_close() ?>

            <div class="mt-3 text-center">Esqueceu a senha? <a href="<?php echo base_url('EsqueciSenha') ?>">ENTRE AQUI</a> </div>
        </main>
    </div>
    <script src="<?php echo base_url('/assets/js/bootstrap.bundle.js') ?>"></script>
</body>

</html>