<?php

$mensagem = '';

if (isset($_GET['status'])) {
    switch ($_GET['status']) {
        case 'success':
            $mensagem = '<div class="alert alert-success"> Ação executada com sucesso!</div>';
            break;
        case 'error':
            $mensagem = '<div class="alert alert-danger"> Ação não executada!</div>';
            break;
    }
}

$resultados = '';
foreach ($vagas as $vaga) {
    $resultados .= '<tr>
                        <td>' . $vaga->id . '</td>
                        <td>' . $vaga->titulo . '</td>
                        <td>' . $vaga->descricao . '</td>
                        <td>' . ($vaga->ativo == 's' ? 'ATIVO' : 'INATIVO') . '</td>
                        <td>' . date('d/m/Y á\s  H:i:s', strtotime($vaga->data)) . '</td>
                        <td>
                            <a href="editar.php?id=' . $vaga->id . '">
                                <button type="button" class="btn btn-primary">Editar</button>
                            </a>
                            <a href="excluir.php?id=' . $vaga->id . '">
                                <button type="button" class="btn btn-danger">Excluir</button>
                            </a>
                        </td>
                    </tr>';
}

$resultados = strlen($resultados) ? $resultados : '<tr>
                                                        <td colspan="6" class="text-center">Nenhuma vaga encontrada</td>
                                                   </tr>';

?>

<main>
    <?= $mensagem ?>
    <section>
        <a href="cadastrar.php">
            <button class="btn btn-success">Nova vaga</button>
        </a>
    </section>

    <section>
        <form method="get">
            <div class="row p-0 m-0 my-4">
                <div class="col-5 p-0 m-0">
                    <label for="">Bucar por titulo</label>
                    <input class="form-control" type="text" name="buscar" value="<?= $busca ?>">
                </div>
                <div class="col-5 p-0 m-0 d-flex align-items-end mx-3">
                    <button class="btn btn-primary" type="submit">Filtar</button>
                </div>
            </div>
        </form>
    </section>

    <section>

        <table class="table bg-light mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Descrição</th>
                    <th>Status</th>
                    <th>Data</th>
                    <th>Acões</th>
                </tr>
            </thead>

            <tbody>
                <?= $resultados ?>
            </tbody>

        </table>

    </section>


</main>