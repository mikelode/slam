<?php
/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 03/03/2016
 * Time: 10:26 AM
 */

namespace Logistica\Custom;


class OleDbConnection
{
    private $conn;

    public function __construct()
    {
        $this->conn = new \COM("ADODB.Connection") or die("Error al Iniciar ADO");
    }

    public function openDataOleDb($path)
    {
        try{
            $this->conn->Open('Provider=VFPOLEDB.1;Mode=ReadWrite;Collating Sequence=MACHINE; Data Source="'.$path.'"');
            if(!$this->conn){
                throw new Exception("No se pudo conectar a la base de datos");
            }
            else{
                $msg = 'Conectado';
            }
        }
        catch (Exception $e){
            $msg = $e->getMessage();
        }
        return $msg;
    }

    public function makeQueryOleDb($query)
    {
        $rs = $this->conn->Execute($query);
        return $rs;
    }

    public function closeDataOleDb()
    {
        $this->conn->Close();
    }
}