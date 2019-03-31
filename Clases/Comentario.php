<?php
require_once("Abstracta.php");
class Comentario extends Abstracta
{
	public $id_comentario;
    public $id_usuario;
    public $id_contenido;
    public $comentario;

    function __construct()
    {
        $this->db_name = 'memes';
    }
	public function set($datos = Array())
	{
		foreach ($datos as $campo => $valor) {
			$$campo = $valor;
		}
		$this->query = "INSERT INTO comentarios(id_usuario,id_contenido,comentario) VALUES('$id_usuario', '$id_contenido', '$comentario')";
		$this->execute_single_query();
	}
	public function get($id_usuario="",$id_contenido="")
	{
		$this->query = "SELECT * FROM comentarios where id_usuario ='$id_usuario' and id_contenido ='$id_contenido'";
		$this->get_results_from_query();
		return $this->rows;
	}
	public function get_todos()
	{
		$this->query = "SELECT * FROM comentarios ORDER BY id_comentario DESC";
		$this->get_results_from_query();
		return $this->rows;
	}
	public function edit($datos = Array())
	{
		foreach ($datos as $campo => $valor) {
			$$campo = $valor;
		}
		$this->query = "UPDATE comentarios set  comentario = '$comentario' where id_usuario ='$id_usuario' and id_contenido ='$id_contenido'";
		$this->execute_single_query();

	}
	public function delete($id_contenido = Array())
	{
		$this->query = "DELETE FROM comentarios WHERE id_contenido='$id_contenido'";
		$this->execute_single_query();

	}

	public function deletePorUsu($id_usuario ="")
	{
		$this->query = "DELETE FROM comentarios WHERE id_usuario='$id_usuario'";
		$this->execute_single_query();

	}

}
?>