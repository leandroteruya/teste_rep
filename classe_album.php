<?php
class Album extends Executa
{
	private $id;
	private $nome; 
	private $estado;
	private $data_hora;
	private $tipo_album;
	private $criterio;
	
	private $limite;
	private $ordenador;
	private $termo_busca;
	
	private $busca;			
	private $q;			
	private $prefixo;
	
	function __construct()
	{
		parent::__construct();
		$this->prefixo = $this->prefixo();
	}

	function __destruct()
	{
		
	}
	
	public function selecionar()
	{
		$q = "				

		SELECT
		id 
		,nome 
		,estado
		,data_hora
		,tipo_album
		";
		
		$q .= "FROM ".$this->prefixo."_tbl_album 
		WHERE 
		1=1  
		";
		
		$q .= !empty($this->termo_busca) ? "AND nome LIKE '%".$this->termo_busca."%' " : " ";
		$q .= !empty($this->nome) ? "AND nome = '".$this->nome."' " : " ";
		$q .= !empty($this->id) ? "AND id = '".$this->id."' " : " ";
		$q .= !empty($this->estado) ? "AND estado = '".$this->estado."' " : " ";
		$q .= !empty($this->data_hora) ? "AND data_hora = '".$this->data_hora."' " : " ";
		$q .= !empty($this->tipo_album) ? "AND tipo_album = '".$this->tipo_album."' " : " ";
		$q .= !empty($this->criterio) ? "AND ".$this->criterio." " : " ";
 		
		$q .= !empty($this->ordenador) ? "ORDER BY ".$this->ordenador."" : " ORDER BY id DESC ";
		
		$q .= !empty($this->limite) ? " LIMIT 0, ".$this->limite." " : " ";
		
		$this->sql = $q;
		$stmt = $this->executar();

		//verifica se houve um retorno maior que 0
		if($stmt->rowCount() > 0)
		{
			return $stmt;
		}
		else
		{
			return false;
		}
	}
	
	public function inserir()
	{
		$q = "
		
		INSERT INTO ".$this->prefixo."_tbl_album
		(
		
		nome,
		estado,
		data_hora,
		tipo_album
		
		)
		VALUES 
		(
		
		'".$this->nome."',
		'".$this->estado."',
		'".$this->data_hora."',
		'".$this->tipo_album."'
		
		)";
		
		//Envia a string de consulta
		$this->sql = $q;
		$stmt = $this->executar();
		
		//verifica se houve um retorno maior que 0
		if($stmt->rowCount() > 0)
		{
			return $stmt;
		}
		else
		{
			return false;
		}
	}
	
	
	public function editar()
	{
		$q = "
		
		UPDATE ".$this->prefixo."_tbl_album SET 
		
		nome = '".$this->nome."', 
		estado = '".$this->estado."'
		
		WHERE id='".$this->id."'
		
		";
		
		//Envia a string de consulta
		$this->sql = $q;
		$stmt = $this->executar();
		
		//verifica se houve um retorno maior que 0
		if($stmt->rowCount() > 0)
		{
			return $stmt;
		}
		else
		{
			return false;
		}
	}

	//Edita o nome ou o estado, só um deles
	public function editar_nome()
	{
		$q = "
		
		UPDATE ".$this->prefixo."_tbl_album SET ";
		
		$q .= !empty($this->nome) ? " nome = '".$this->nome."' " : " ";
		$q .= !empty($this->estado) ? " estado = '".$this->estado."' " : " ";
		
		$q .= "
		
		WHERE id='".$this->id."'
		
		";
		
		//Envia a string de consulta
		$this->sql = $q;
		$stmt = $this->executar();
		
		//verifica se houve um retorno maior que 0
		if($stmt->rowCount() > 0)
		{
			return $stmt;
		}
		else
		{
			return false;
		}
	}
	
	public function excluir()
	{
		$q = "				

		DELETE FROM ".$this->prefixo."_tbl_album WHERE id='".$this->id."'";
		//die($q);
		//Envia a string de consulta
		$this->sql = $q;
		$stmt = $this->executar();
		
		//verifica se houve um retorno maior que 0
		if($stmt->rowCount() > 0)
		{
			return $stmt;
		}
		else
		{
			return false;
		}
	}
	
	
	public function ultimo_id()
	{
		$q = "
		
		SELECT LAST_INSERT_ID(id) AS id  FROM ".$this->prefixo."_tbl_album ORDER BY id DESC LIMIT 1
		
		";
		
		//Envia a string de consulta
		$this->sql = $q;
		$stmt = $this->executar();
		
		//verifica se houve um retorno maior que 0
		if($stmt->rowCount() > 0)
		{
			return $stmt;
		}
		else
		{
			return false;
		}
	}
	
	
	
	function set($prop, $value)
	{
      $this->$prop = $value;
	}
}

?>