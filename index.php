<?php
header('Content-Type: application/json; charset=utf-8');
include_once 'config/database.php';
include_once 'class/login.php';
include_once 'class/cliente.php';
include_once 'class/cliente-endereco.php';

$tmp = str_replace('/rest-api/','',$_SERVER['REQUEST_URI']);
$tmp = str_replace('rest-api/','',$tmp);
$tmp = explode('/',$tmp);
$rota = $tmp[0];
$id = !empty($tmp[1]) ? $tmp[1] : null;

$metodo = $_SERVER["REQUEST_METHOD"];

$database = new Database();
$db = $database->getConnection();

switch ($rota) {

  case 'login':
    if($metodo == 'POST'){
      $email = !empty($_POST['email']) ? $_POST['email'] : null;
      $senha = !empty($_POST['senha']) ? $_POST['senha'] : null;

      if($email == null || $senha == null){
        $retorno = array('status' => '202', 'mensagem' => 'Email ou senha nao informados.');
        $code = 200;
      }else{
        $loginDB = new Login($db);
        $loginDB->email = $email;
        $loginDB->senha = md5($senha);

        $stmt = $loginDB->getLogin();
        if($stmt > 0){
            $retorno = array('status' => '200', 'mensagem' => 'Login realizado com sucesso');
            $code = 200;
        }else{
          $retorno = array('status' => '201', 'mensagem' => 'Email ou senha invalidos');
          $code = 200;
        }
      }
    }else{
      $retorno = array('status' => '500', 'mensagem' => 'Metodo nao autoriazado para login.');
      $code = 500;
    }
  break;

  case 'clientes':
    if($metodo == 'POST' || $metodo == 'GET' || $metodo == 'DELETE'){
      switch ($metodo) {
        case 'GET':
          $clienteDB = new Cliente($db);
          $clienteDB->id = $id;
          $stmt = $clienteDB->listClientes();
          if($clienteDB->total_count > 0){
            $retorno = array('status' => '200', 'total' => $clienteDB->total_count, 'dados' => $stmt);
            $code = 200;
          }else{
            $retorno = array('status' => '200', 'total' => '0', 'mensagem' => 'Nenhum cliente cadastrado.');
            $code = 200;
          }
        break;

        case 'POST':
          $telefone = str_replace('(','',$_POST['telefone']);
          $telefone = str_replace(')','',$telefone);
          $telefone = str_replace(' ','',$telefone);
          $telefone = str_replace('-','',$telefone);

          $cpf = str_replace('-','',$_POST['cpf']);
          $cpf = str_replace('.','',$cpf);

          $clienteDB = new Cliente($db);
          $clienteDB->nome = $_POST['nome'];
          $clienteDB->email = $_POST['email'];
          $clienteDB->data_nascimento = date('Y-m-d',strtotime($_POST['data_nascimento']));
          $clienteDB->cpf = $cpf;
          $clienteDB->rg = $_POST['rg'];
          $clienteDB->telefone = $telefone;

          if($id <= 0 || $id == null){
            $stmt = $clienteDB->cadCliente();
            $retorno = array('status' => '200', 'mensagem' => 'Cliente cadastrado com sucesso.', 'id' => $clienteDB->id);
          }else{
            $clienteDB->id = $id;
            $stmt = $clienteDB->updateCliente();
            $retorno = array('status' => '200', 'mensagem' => 'Cadastro do Cliente atualizado com sucesso.');
          }
          $code = 200;
        break;

        case 'DELETE':
          if($id > 0){
            $retorno = array('status' => '200', 'mensagem' => 'Cliente removido com sucesso.');
            $code = 200;
            $clienteDB = new Cliente($db);
            $clienteDB->id = $id;
            $stmt = $clienteDB->deleteCliente();

            $enderecoDB = new ClienteEndereco($db);
            $enderecoDB->id_cliente = $id;
            $stmt2 = $enderecoDB->deleteEndereco();
          }else{
            $retorno = array('status' => '500', 'mensagem' => 'Nao foi possivel remover o cliente.', 'id' => $clienteDB->id);
            $code = 200;
          }
        break;

        default:
          $retorno = array('status' => '500', 'mensagem' => 'Metodo nao autoriazado para cliente.');
          $code = 200;
        break;
      }
    }else{
      $retorno = array('status' => '500', 'mensagem' => 'Metodo nao autoriazado para cliente.');
      $code = 500;
    }
  break;

  case 'cliente-enderecos':
    if($metodo == 'POST' || $metodo == 'GET' || $metodo == 'DELETE'){
      switch ($metodo) {
        case 'GET':
          $enderecoDB = new ClienteEndereco($db);
          $enderecoDB->id_cliente = $id;
          $stmt = $enderecoDB->listEnderecos();
          if($enderecoDB->total_count > 0){
            $retorno = array('status' => '200', 'total' => $enderecoDB->total_count, 'dados' => $stmt);
            $code = 200;
          }else{
            $retorno = array('status' => '200', 'total' => '0', 'mensagem' => 'Nenhum cliente endereco cadastrado.');
            $code = 200;
          }
        break;

        case 'POST':
          if(!empty($_POST['cep'])){
            foreach ($_POST['cep'] as $key => $value) {
              $cep = str_replace('-','',$_POST['cep'][$key]);
              $enderecoDB = new ClienteEndereco($db);
              $enderecoDB->id_cliente = $_POST['id_cliente'];
              $enderecoDB->cep = $cep;
              $enderecoDB->logradouro = $_POST['logradouro'][$key];
              $enderecoDB->numero = $_POST['numero'][$key];
              $enderecoDB->complemento = empty($_POST['complemento'][$key]) ? '' : $_POST['complemento'][$key];
              $enderecoDB->bairro = $_POST['bairro'][$key];
              $enderecoDB->cidade = $_POST['cidade'][$key];
              $enderecoDB->estado = $_POST['estado'][$key];

              $id_endereco = empty($_POST['id_endereco'][$key]) ? 0 : $_POST['id_endereco'][$key];
              if($id_endereco <= 0){
                $stmt = $enderecoDB->cadEndereco();
                $retorno = array('status' => '200', 'mensagem' => 'Cliente endereco cadastrado com sucesso.', 'id_endereco' => $id_endereco);
              }else{
                $enderecoDB->id = $id_endereco;
                $stmt = $enderecoDB->updateEndereco();
                $retorno = array('status' => '200', 'mensagem' => 'Cliente endereco atualizado com sucesso.', 'id_endereco' => $id_endereco);
              }
            }
            $code = 200;
          }else{
            $retorno = array('status' => '200', 'mensagem' => 'Nenhum cliente endereco cadastrado.');
            $code = 200;
          }
        break;

        case 'DELETE':
          if($id > 0){
            $retorno = array('status' => '200', 'mensagem' => 'Cliente endereco removido com sucesso.');
            $code = 200;
            $enderecoDB = new ClienteEndereco($db);
            $enderecoDB->id = $id;
            $stmt2 = $enderecoDB->deleteEnderecoID();
          }else{
            $retorno = array('status' => '500', 'mensagem' => 'Nao foi possivel remover o cliente endereco.', 'id' => $clienteDB->id);
            $code = 200;
          }
        break;

        default:
          $retorno = array('status' => '500', 'mensagem' => 'Metodo nao autoriazado para cliente endereco.');
          $code = 200;
        break;
      }
    }else{
      $retorno = array('status' => '500', 'mensagem' => 'Metodo nao autoriazado para cliente-endereco.');
      $code = 500;
    }
  break;


  default:
    $retorno = array('status' => '500', 'mensagem' => 'Rota nao definida');
    $code = 500;
  break;
}

echo json_encode($retorno, JSON_PRETTY_PRINT);
http_response_code($code);
?>
