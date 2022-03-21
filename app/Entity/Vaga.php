<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Vaga
{


    /**
     * Identificaor único da vaga
     * @var integer 
     */

    public $id;

    /**
     * titulo da vaga
     * @var string
     */

    public $titulo;

    /**
     * Descrição da vaga pode conter (HTML)
     * @var string 
     */

    public $descricao;

    /**
     * Define se a vaga está ativa 
     * @var string (s/n)
     */

    public $ativo;

    /**
     * Data  de publicação da vaga 
     * @var string
     */

    public $data;

    /**
     * Método responsavél por cadastrar uma nova vaga no banco 
     * @return boolean
     */

    public function cadastrar()
{
        // definir a data 

        $this->data = date('Y-m-d H:i:s');

        // inserir a vaga no banco  

        $obDatabase = new Database('vagas');
        $this->id = $obDatabase->insert([
            'titulo' => $this->titulo,
            'descricao' => $this->descricao,
            'ativo' => $this->ativo,
            'data' => $this->data
        ]);

        // retonar sucesso

        return true;
    }

    /**
     * Método responsalvél por atualizar as vagas do banco de dados 
     * @return boolean
     */

    public function atualizar(){
        return (new Database('vagas'))->update('id ='.$this->id,[
            'titulo' => $this->titulo,
            'descricao' => $this->descricao,
            'ativo' => $this->ativo,
            'data' => $this->data
        ]);
    }

    /**
     * Métofo responsavél por excluir a vaga do banco 
     * @return boolean
     */
    public function excluir(){
        return (new Database('vagas')) ->delete('id ='.$this->id);
    }

    /**
     * Método responsavél por obter as vagas do banco de dados
     * @param string $where
     * @param string $order
     * @param string $limit
     * @return array
     */

    public static function getVagas($where = null, $order = null, $limit = null){
        return (new Database('vagas'))->select($where,$order,$limit)
                                      ->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    /**
     * Método responsalvel por buscar uma vaga com base no ID
     * @param integer $id 
     * @return Vaga
     */


    public static function getVaga($id){
        return (new Database('vagas'))->select('id = '.$id)
                                      ->fetchObject(self::class);
    }
}
