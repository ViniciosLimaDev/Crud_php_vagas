<?php

namespace App\Db;

use \PDO;
use \PDOException;


class Database {

    /**
     * host de conexão com o banco dados 
     * @var string
     */
    const HOST = 'localhost';

    /**
     * Nome do banco de dados 
     * @var string
     */

    const NAME = 'crud_php';

    /**
     * Usuário do banco
     * @var string
     */
    const USER = 'root';

    /**
     * Senha de acesso do banco de dados
     * @var string 
     */
    const PASS = '';

    /**
     * Nome da tabela a ser manipulada
     * @var string
     */

    private $table;

    /**
     *  Instancia de conexão com banco de dados PDO
     * @var PDO
     */

    private $connection;

    /**
     * Define a tabela e intancia e conexão
     * @param string $table
     */

    public function __construct($table = null)
    {
        $this->table = $table;
        $this->setConnection();
    }

    /**
     *  Método responsavél por criar uma conexão como banco de dados
     */
    private function setConnection(){
        try {
            $this->connection = new PDO('mysql:host=' . self::HOST . ';dbname=' . self::NAME, self::USER, self::PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }
    }

    /**
     * Método responsalvel por executar queries dentro do banco de dados 
     * @param string $query
     * @param array $params
     * @return PDOStatement
     */


    public function execute($query,$params = [])  {
        try {
            $statement = $this->connection->prepare($query);
            $statement->execute($params);
            return $statement;
        } catch (PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }
    }


    /**
     * Método responsalvél por inserir dados no banco
     * @param array $values [ field => value ]
     * @return integer ID inserido
     */

    public function insert($values)
    {
        // DADOS DA QUERY

        $fields = array_keys($values);
        $binds = array_pad([], count($fields),'?');


        //MONTA A QUERY
        $query = 'INSERT INTO '.$this->table.' (' .implode(' , ',$fields).') VALUES (' .implode(', ',$binds).')';


        //EXECUTAR O INSERT
        $this->execute($query, array_values($values));

        //RETORNA O ID INSERIDO
        return $this->connection->lastInsertId();
    }


    /**
     * Método responsavél por obter as vagas do banco de dados
     * @param string $where
     * @param string $order
     * @param string $limit
     * @param string $fields
     * @return PDOStatement
     */

    public function select($where = null, $order = null, $limit = null)  {

        //DADOS DA QUERY

        $where = strlen($where) ? 'WHERE' . $where : '';
        $where = strlen($order) ? 'ORDER BY' . $order : '';
        $where = strlen($limit) ? 'LIMIT' . $limit : '';

        //MONTA A QUERY
        $query = 'SELECT * FROM '.$this->table.' ' .$where.' ' .$order.' '.$limit;

        //EXECUTA A QUERY
        return $this->execute($query);
    }


    /**
     * Método responsavél por executar atualização no banco de daods
     * @param string $where
     * @param array $value [$field => value]
     * @return boolean
     */

    public function update($where, $values)
    {
        // DADOS DA QUERY

        $fields = array_keys($values);

        //MONTA QUERY
        $query = 'UPDATE '. $this->table .' SET ' . implode('=?,', $fields) . '=? WHERE ' . $where;
        
        //EXECUTAR A QUERY
        $this->execute($query,array_values($values));
        return true;
    }

    /**
     * Método responsavél por excluir a vaga do banco de dados
     * @param string $whre
     * @return boolean
     */

    public function delete($where){

        //Monta query
        $query = 'DELETE FROM ' .$this->table. ' WHERE '.$where;

        //Executa query
        $this->execute($query);

        //RETORNA SUCESSO
        return true;
    }
}
