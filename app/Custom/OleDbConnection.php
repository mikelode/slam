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
        $this->conn->Open('Provider=VFPOLEDB.1; Data Source="'.$path.'"');
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