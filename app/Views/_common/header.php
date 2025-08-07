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
    <div class="container-float">
      <div class="col-md-12 text-center mt-1 ">
        <h1 class=" bg-secondary text-white"><img  src="<?php echo base_url('/imagens/Sispeq_ Logo.png') ?>" alt="logo" width="60%" ></h1>
        <p class="text-primary">Você está logado como: <?= $usuario['nome'] ?> ID:<?= $usuario['id'] ?></p>
      </div>
      <div>
        
      </div>

      <!-- Abrimos a linha AQUI -->
      <div class="row">
