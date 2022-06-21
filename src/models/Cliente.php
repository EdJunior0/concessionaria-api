<?php

namespace src\models;

class Cliente
{

  private $cpf, $nome, $endereco;

  public function getCpf()
  {
    return $this->cpf;
  }

  public function setCpf($cpf)
  {
    $this->cpf = $cpf;
  }

  public function setNome($nome)
  {
    $this->nome = $nome;
  }

  public function getNome()
  {
    return $this->nome;
  }

  public function setEndereco($endereco)
  {
    $this->endereco = $endereco;
  }

  public function getEndereco()
  {
    return $this->endereco;
  }


}
