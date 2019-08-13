<?php
    require_once 'config/db.php';
    $db = new DBClass();
    $connection = $db->getConnection();
    
    require_once 'entidades/pessoa/visualizar.php';
    
    session_start();
    if(isset($_SESSION["mensagem"])){
        $mensagem = $_SESSION["mensagem"];
        unset($_SESSION["mensagem"]);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>CRUD Teste</title>
</head>
<body>

    <div class="container">
        <div class="col">
            <div class="jumbotron">
                <h1 class="display-4">CRUD de Teste!</h1>
                <p class="lead">Vamos fazer um CRUD de Usuário.</p>
                <hr class="mt-4">
                <?php
                    if (isset($mensagem)) {
                        ?>
                        <div id="mensagem" class="alert alert-success alert-dismissible fade show mb-0" role="alert">
                            <?= $mensagem ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                <?php }
                ?>
            </div>
        </div>
    </div>

    <div class="container">
        <form id="formUsuario" action="entidades/pessoa/criar.php" method="post" class="ml-3">
            <div class="form-group row align-items-end">
                <div class="col">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" name="nome" id="nome">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="senha">Senha</label>
                        <input type="password" class="form-control" name="senha" id="senha" placeholder="" maxlength="8">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <button type="submit" id="cadastrar" class="btn btn-primary">Cadastrar</button>
                        <input type="hidden" name="id" id="id" value>
                    </div>
                </div>
            </div>
        </form>
        <div class="row mt-4 p-3">
            <div class="col">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Senha</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($usuarios as $usuario) {
                            ?>
                            <tr>
                                <td id="nome<?= $usuario['id']?>"><?= $usuario['nome']?></td>
                                <td id="email<?= $usuario['id']?>"><?= $usuario['email']?></td>
                                <td id="senha<?= $usuario['id']?>"><?= $usuario['senha']?></td>
                                <td>
                                    <button class="btn btn-success btn-sm" data-editar="<?= $usuario['id']?>">Editar</button>
                                    <button class="btn btn-danger btn-sm" onclick="confirm('Deseja mesmo excluir este usuário?')" data-excluir="<?= $usuario['id']?>">Excluir</button>
                                </td>
                            </tr>
                        <?php }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script>
    let mensagem = $('#mensagem');
    if (mensagem) {
        setTimeout(() => {
            mensagem.alert('close');
        }, 5000);
    }

    $('[data-editar]').click(function () {
        const id = $(this).data('editar');
        const nome = $(`#nome${id}`).text();
        const email = $(`#email${id}`).text();
        const senha = $(`#senha${id}`).text();

        $('#nome').val(nome);
        $('#email').val(email);
        $('#senha').val(senha);
        $('#id').val(id);
        $('#formUsuario').prop('action', 'entidades/pessoa/editar.php');
        $('#cadastrar').text('Editar');
    });

    $('[data-excluir]').click(function () {
        const id = $(this).data('excluir');

        $('#id').val(id);
        $('#nome').prop('required', false);
        $('#email').prop('required', false);
        $('#senha').prop('required', false);

        $('#formUsuario').prop('action', 'entidades/pessoa/excluir.php').submit();
    })
</script>
</body>
</html>