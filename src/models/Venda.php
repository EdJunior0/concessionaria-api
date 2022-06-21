<?php

namespace src\models;

class Venda
{

  private $cod_veiculo, $cod_vendedor, $cpf_cliente, $data_venda;

  public function getCodVeiculo()
  {
    return $this->cod_veiculo;
  }

  public function setCodVeiculo($cod_veiculo)
  {
    $this->cod_veiculo = $cod_veiculo;
  }

  public function setCodVendedor($cod_vendedor)
  {
    $this->cod_vendedor = $cod_vendedor;
  }

  public function getCodVendedor()
  {
    return $this->cod_vendedor;
  }

  public function setCpfCliente($cpf_cliente)
  {
    $this->cpf_cliente = $cpf_cliente;
  }

  public function getCpfCliente()
  {
    return $this->cpf_cliente;
  }

  public function setDataVenda($data_venda)
  {
    $this->data_venda = $data_venda;
  }

  public function getDataVenda()
  {
    return $this->data_venda;
  }
}
