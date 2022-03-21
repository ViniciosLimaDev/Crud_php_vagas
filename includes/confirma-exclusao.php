<main>

    <h2 class="mt-3">Excluir vaga</h2>

    <form method="post" action="">
        <p>Tem certeza que deseja excluir a vaga<strong><?=$obVaga->titulo?></strong>?</p>
    <a href="index.php">
            <button type="button" class="btn btn-success">Cancelar</button>
        </a>
        <div class="form-grupo mt-3">
            <button type="submit" name="excluir" class="btn btn-danger">Excluir</button>
        </div>
    </form>
</main>