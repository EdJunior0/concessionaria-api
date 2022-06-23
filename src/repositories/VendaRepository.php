<?php

namespace src\repositories;

require_once 'vendor/autoload.php';

use src\config\Connection;
use src\models\Venda;

class VendaRepository
{

  public function create(Venda $venda)
  {
    $sql = 'INSERT INTO venda (veiculo_fk_cod_veiculo, vendedor_fk_cod_vendedor, cliente_fk_cpf, data_venda) VALUES (?,?,?,?) RETURNING veiculo_fk_cod_veiculo';

    $stmt = Connection::getConn()->prepare($sql);

    $stmt->bindValue(1, $venda->getCodVeiculo());
    $stmt->bindValue(2, $venda->getCodVendedor());
    $stmt->bindValue(3, $venda->getCpfCliente());
    $stmt->bindValue(4, $venda->getDataVenda());

    $stmt->execute();

    $response = $stmt->fetch();
    return $response;
  }

  public function find()
  {
    $sql = 'SELECT * FROM venda';

    $stmt = Connection::getConn()->prepare($sql);
    $stmt->execute();

    if ($stmt->rowCount() > 0) :
      $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
      return $resultado;
    else :
      return [];
    endif;
  }

  public function findOne($cod_veiculo, $cod_vendedor, $cpf_cliente)
  {
    $sql = 'SELECT * FROM venda WHERE veiculo_fk_cod_veiculo = ? OR vendedor_fk_cod_vendedor = ? OR cliente_fk_cpf = ?';

    $stmt = Connection::getConn()->prepare($sql);

    $stmt->bindValue(1, $cod_veiculo);
    $stmt->bindValue(2, $cod_vendedor);
    $stmt->bindValue(3, $cpf_cliente);

    $stmt->execute();

    $response = $stmt->fetch();

    return array(
      "cod_veiculo" => $response['veiculo_fk_cod_veiculo'],
      "cod_vendedor" => $response['vendedor_fk_cod_vendedor'],
      "cpf_cliente" => $response['cliente_fk_cpf'],
      "data_venda" => $response['data_venda']
    );
  }

  public function findOneByData($data_venda)
  {
    $sql = "SELECT * FROM cliente WHERE data_venda LIKE '%$data_venda%'";

    $stmt = Connection::getConn()->prepare($sql);

    $stmt->execute();

    $response = $stmt->fetch();

    return array(
      "cod_veiculo" => $response['veiculo_fk_cod_veiculo'],
      "cod_vendedor" => $response['vendedor_fk_cod_vendedor'],
      "cpf_cliente" => $response['cliente_fk_cpf'],
      "data_venda" => $response['data_venda']
    );
  }

  public function update(Venda $venda)
  {

    $sql = 'UPDATE venda SET veiculo_fk_cod_veiculo = ?, vendedor_fk_cod_vendedor = ?, cliente_fk_cpf = ?, data_venda = ? WHERE veiculo_fk_cod_veiculo = ? OR vendedor_fk_cod_vendedor = ? OR cliente_fk_cpf = ? OR data_venda = ? RETURNING veiculo_fk_cod_veiculo';

    $stmt = Connection::getConn()->prepare($sql);
    $stmt->bindValue(1, $venda->getCodVeiculo());
    $stmt->bindValue(2, $venda->getCodVendedor());
    $stmt->bindValue(3, $venda->getCpfCliente());
    $stmt->bindValue(4, $venda->getDataVenda());
    $stmt->bindValue(5, $venda->getCodVeiculo());
    $stmt->bindValue(6, $venda->getCodVendedor());
    $stmt->bindValue(7, $venda->getCpfCliente());
    $stmt->bindValue(8, $venda->getDataVenda());

    $stmt->execute();

    $response = $stmt->fetch();
    return $response;
  }

  public function delete($cod_veiculo, $cod_vendedor, $cpf_cliente)
  {

    $sql = 'DELETE FROM venda WHERE veiculo_fk_cod_veiculo = ? OR cod_vendedor = ? OR cpf_cliente = ?';

    $stmt = Connection::getConn()->prepare($sql);
    $stmt->bindValue(1, $cod_veiculo);
    $stmt->bindValue(2, $cod_vendedor);
    $stmt->bindValue(3, $cpf_cliente);
    $stmt->execute();
  }
}
