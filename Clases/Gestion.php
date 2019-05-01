<?php
require_once("Abstracta.php");
class Gestion extends Abstracta
{
	public $id_contenido;
    public $id_usuario;
    public $aVotado;
    public $aReportado;

    function __construct()
    {
        $this->db_name = 'memes';
    }
	public function set($datos = Array())
	{
		foreach ($datos as $campo => $valor) {
			$$campo = $valor;
		}
		$this->query = "INSERT INTO gestion(id_contenido,id_usuario,aVotado,aReportado) VALUES('$id_contenido', '$id_usuario', '$aVotado' ,'$aReportado')";
		$this->execute_single_query();
	}
	public function get($id_usuario="",$id_contenido="")
	{
		$this->query = "SELECT * FROM gestion where id_usuario ='$id_usuario' and id_contenido ='$id_contenido'";
		$this->get_results_from_query();
		return $this->rows;
	}
	public function get_todos()
	{
		$this->query = "SELECT * FROM control";
		$this->get_results_from_query();
		return $this->rows;
	}
	public function edit($datos = Array())
	{
		foreach ($datos as $campo => $valor) {
			$$campo = $valor;
		}

		$this->query = "UPDATE gestion set  aVotado = '$aVotado' , aReportado ='$aReportado' where id_contenido ='$id_contenido' and id_usuario ='$id_usuario'";
		$this->execute_single_query();

	}
	public function delete($datos = Array())
	{
		foreach ($datos as $campo => $valor) {
			$$campo = $valor;
		}
		$this->query = "DELETE FROM gestion WHERE id_usuario ='$id_usuario' and id_contenido ='$id_contenido'";
		$this->execute_single_query();

	}
	public function deletePorIdContenido($id_contenido = "")
	{

		$this->query = "DELETE FROM gestion WHERE id_contenido ='$id_contenido'";
		$this->execute_single_query();

	}


	public function deletePorUsu($id_usuario = "")
	{
		$this->query = "DELETE FROM gestion WHERE id_usuario ='$id_usuario'";
		$this->execute_single_query();

	}
}
?>