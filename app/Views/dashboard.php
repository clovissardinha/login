// view com dados do usuário
// app/Views/dashboard.php
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= $titulo ?? 'Dashboard' ?></title>
</head>
<body>
    <header>
        <h1>Bem-vindo, <?= esc($usuario['nome']) ?>!</h1>
        <nav>
            <a href="<?= base_url('Dashboard') ?>">Dashboard</a>
            <a href="<?= base_url('Admin') ?>">Admin</a>
            <a href="<?= base_url('Logout') ?>">Logout</a>
        </nav>
    </header>
    
    <main>
        <h2>Dashboard</h2>
        <p>Você está logado como: <?= esc($usuario['nome']) ?></p>
        <p>ID do usuário: <?= esc($usuario['id']) ?></p>
    </main>
</body>
</html>
