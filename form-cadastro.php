<?php
require_once("init.php");
require("data-functions.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Agenda de contatos</title>
</head>

<body class="mx-5 my-5">
    <form action="?act=save" method="POST" name="form1" class="mt-4">
        <h1><strong>Agenda de contatos</strong></h1>
        <div class="p-3 border mt-2 rounded">
        <input type="hidden" name="id" style="width:0px"<?php if (isset($id) && $id != null || $id != "") {

          echo "value=\"{$id}\"";
        } ?> />
        Nome:
        <input type="text" name="nome" <?php if (isset($nome) && $nome != null || $nome != "") {
              echo "value=\"{$nome}\"";
            } 
      ?> />
        E-mail:
        <input type="text" name="email" <?php if (isset($email) && $email != null || $email != "") {
          echo
      "value=\"{$email}\"";        } ?> />
        Celular:
        <input type="text" name="celular" <?php if (isset($celular) && $celular != null || $celular != "") {
          echo
            "value=\"{$celular}\"";
        } ?> />
        <input type="submit" value="salvar" />
        <input type="reset" value="Novo" />
      </div>
    </form>

    <table class="table text-center">
      <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nome</th>
            <th scope="col">E-mail</th>
            <th scope="col">Celular</th>
            <th scope="col">Ações</th>
        </tr>
      </thead>
      <tbody >
        <?php
        try {
          $stmt = $conexao->prepare("SELECT * FROM contatos");
          if ($stmt->execute()) {
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
              echo "<tr>"; 
              echo "<th scope='row'>". $rs->ID . "</th>
              "."<td>". $rs->NOME . "</td>
                      <td>" . $rs->EMAIL . "</td>
                      <td>" . $rs->CELULAR . "</td>
                      <td><center><a href=\"?act=upd&id=" . $rs->ID . "\">[Alterar]</a>"
                . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                . "<a href=\"?act=del&id=" . $rs->ID . "\">[Excluir]</a></center></td>";
              echo "</tr>";
            }
          } else {
            echo "Erro: Não foi possível recuperar os dados do banco de dados";
          }
        } catch (PDOException $erro) {
          echo "Erro: " . $erro->getMessage();
        }
        ?>
      </tbody>
    </table>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>
