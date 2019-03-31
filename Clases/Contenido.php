<?php
require_once("Abstracta.php");

class Contenido extends Abstracta
{

    public $id_contenido;
    public $id_usuario;
    public $titulo;
    public $imagen;
    public $votos_positivos;
    public $votos_negativos;
    public $categoria;
    public $reportes;


    function __construct()
    {
        $this->db_name = 'memes';
    }
    public function set($datos = array())
    {
        foreach ($datos as $campo => $valor) {
            $$campo = $valor;
        }
        $this->query = "INSERT INTO contenido(id_usuario,titulo,imagen,votos_positivos,votos_negativos,categoria,reportes) VALUES('$id_usuario', '$titulo', '$imagen', '$votos_positivos', '$votos_negativos', '$categoria', '$reportes')";

        $this->execute_single_query();
    }
    public function get($id_contenido = "")
    {
        $this->query = "SELECT * FROM contenido where id_contenido ='$id_contenido'";
        $this->get_results_from_query();
        return $this->rows;
    }
    public function getTitulo($titulo = "")
    {
        $this->query = "SELECT * FROM contenido where titulo ='$titulo'";
        $this->get_results_from_query();
        return $this->rows;
    }
    public function getPaginado($inicio="",$categoria="")
    {
        $inicio = $inicio-1;
        if($categoria==""){
            $this->query = "SELECT * FROM contenido ORDER BY id_contenido DESC LIMIT " . ($inicio * 10) . ", 10";
        }else{
            $this->query = "SELECT * FROM contenido WHERE categoria ='$categoria' ORDER BY id_contenido DESC LIMIT " . ($inicio * 10) . ", 10";
        }
        $this->get_results_from_query();
        return $this->rows;
    }
    public function get_todos()
    {
        $this->query = "SELECT * FROM contenido";
        $this->get_results_from_query();
        return $this->rows;
    }

    public function getReportados()
    {
        $this->query = "SELECT * FROM contenido WHERE reportes > 0";
        $this->get_results_from_query();
        return $this->rows;
    }

    public function getCategoria($categoria= "")
    {
        $this->query = "SELECT * FROM contenido WHERE categoria like '%$categoria%';";
        $this->get_results_from_query();
        return $this->rows;
    }
    public function edit($datos = array())
    {
        foreach ($datos as $campo => $valor) {
            $$campo = $valor;
        }
        $this->query = "UPDATE contenido set   id_usuario = '$id_usuario', titulo = '$titulo', imagen = '$imagen', categoria='$categoria', votos_positivos='$votos_positivos',votos_negativos='$votos_negativos',reportes='$reportes' where id_contenido ='$id_contenido'";
        $this->execute_single_query();

    }
    public function delete($id_contenido = "")
    {
        $this->query = "DELETE FROM contenido WHERE id_contenido='$id_contenido'";
        $this->execute_single_query();

    }

	public function deletePorUsu($id_usuario ="")
	{
		$this->query = "DELETE FROM contenido WHERE id_usuario='$id_usuario'";
		$this->execute_single_query();

	}
}
?>