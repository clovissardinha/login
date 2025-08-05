<div class="about-pag col-md-12 ml-auto mr-auto mt-5 bg-light">
    <div class="container">
        <main class="w-100 ">

            <?php echo form_open('recuperaSenha') ?>
            <h1 class="h3 mb-3 text-center "><span>Recuperar senha de Administrador</span> </h1>
            <div class="form-floating">
                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="nome@exemplo.com">
                <label for="floatingInput">Email </label>
            </div>

            <button class="btn btn-primary w-100 py-2" type="submit">Enviar</button>
            <?php echo form_close() ?>
            <p class="text-center mt-2"><a href="<?php echo base_url() ?>">VOLTAR</a></p>
        </main>

    </div>
</div>
<?php if (session()->has('mensagem')) : ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('mensagem') ?>
    </div>
<?php endif; ?>
</div>