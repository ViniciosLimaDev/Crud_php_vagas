<main>
    <section>
        <a href="index.php">
            <button class="btn btn-success">Voltar</button>
        </a>
    </section>

    <h2 class="mt-3"><?=TITLE?></h2>

    <form method="POST">
        <div class="form-grup">
            <label for="">Título</label>
            <input type="text" class="form-control" name="titulo" value="<?=$obVaga->titulo?>">
        </div>
        <div class="form-grup">
            <label for="">Descriçãõ</label>
            <textarea class="form-control" name="descricao" cols="30" rows="5"><?=$obVaga->descricao?></textarea>
        </div>
        <div class="form-grup">
            <label for="">Status</label>
            <div>
                <div class="form-check form-check-inline">
                    <label class="form-control">
                        <input type="radio" name="ativo" value="s" checked> Ativo
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-control">
                        <input type="radio" name="ativo" value="n"<?=$obVaga->ativo == 'n' ? 'checked' : '' ?>> Inativo
                    </label>
                </div>

            </div>
        </div>
        <div class="form-grupo mt-3">
            <button type="submit" class="btn btn-success">enviar</button>
        </div>
    </form>
</main>