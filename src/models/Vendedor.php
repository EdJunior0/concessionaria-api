<?php

namespace src\models;

class Vendedor
{

  private $cod_vendedor, $nome;

  public function getCodVendedor()
  {
    return $this->cod_vendedor;
  }

  public function setCodVendedor($id)
  {
    $this->cod_vendedor = $id;
  }

  public function setNome($nome)
  {
    $this->nome = $nome;
  }

  public function getNome()
  {
    return $this->nome;
  }
}
