<?php
require_once("Abstracta.php");
class Usuario extends Abstracta
{
	public $id_usuario;
	public $nombre;
	public $apellidos;
	public $email;
	public $pas;
	public $tipoUsr;

	function __construct()
	{
		$this->db_name = 'memes';
	}
	public function set($datos = array())
	{
		foreach ($datos as $campo => $valor) {
			$$campo = $valor;
		}
		$this->query = "INSERT INTO usuarios(nombre,apellidos,email,pas,tipoUsr) VALUES('$nombre', '$apellidos', '$email', '$pas', '$tipoUsr')";
		$this->execute_single_query();
	}
	public function get($email = "")
	{
		$this->query = "SELECT * FROM usuarios where email ='$email'";
		$this->get_results_from_query();
		return $this->rows;
	}
	public function getPorId($id_usuario = "")
	{
		$this->query = "SELECT * FROM usuarios where id_usuario ='$id_usuario'";
		$this->get_results_from_query();
		return $this->rows;
	}
	public function get_todos()
	{
		$this->query = "SELECT * FROM usuarios";
		$this->get_results_from_query();
		return $this->rows;
	}
	public function getPaginado($inicio="")
    {
        $inicio = $inicio-1;
        $this->query = "SELECT * FROM usuarios ORDER BY id_usuario ASC LIMIT " . ($inicio * 10) . ", 10";
        $this->get_results_from_query();
        return $this->rows;
    }
	public function edit($datos = array())
	{
		/*foreach ($datos as $campo => $valor) {
			$$campo = $valor;
		}
		$this->query = "UPDATE usuarios set  descripcion = '$descripcion', pvp = '$pvp', existencias='$existencias' where cod_prod ='$cod_prod'";
		$this->execute_single_query();*/

	}
	public function delete($id_usuario="")
	{
		
		$this->query = "DELETE FROM usuarios WHERE id_usuario='$id_usuario'";
		$this->execute_single_query();
	}


	public function deletePorUsu($id_usuario="")
	{
		$this->query = "DELETE FROM usuarios WHERE id_usuario='$id_usuario'";
		$this->execute_single_query();
	}
}
?>