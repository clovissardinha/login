<!doctype html>
<html lang="br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <main>
    <div class="container">
      <div class="col-md-12 text-center ">
        <h1 class=" bg-primary text-white"><img class="m-auto " src="<?php echo base_url('/imagens/Sispeq_ Logo.png') ?>" alt="logo" width="60%" ></h1>
        <p>Você está logado como: <?= $usuario['nome'] ?> ID:<?= $usuario['id'] ?></p>
      </div>

      <!-- Abrimos a linha AQUI -->
      <div class="row">
