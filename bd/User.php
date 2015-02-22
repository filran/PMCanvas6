<?php
include("conexao.php");

class User{

	public function cadastra($login, $email, $nome, $canvas_id, $foto){	
		$user = new User();
		$valida = $user->validacadastro($login, $email, $nome);

		if( !$valida ){
			return false;
		}else{	
			$sql = "INSERT INTO `user` (`login`,`email`,`nome`,`canvas_id`,`foto`) VALUES ('$login','$email','$nome','$canvas_id','$foto')";
			mysql_query($sql);

			if( mysql_affected_rows() > 0 ){
				return true;
			}else{
				return false;
			}
		}
	}

	private function validacadastro($login, $email, $nome){
		$sql = "SELECT * FROM `user` WHERE `login`='$login' AND `email`='$email' AND `nome`='$nome'";
		$rs = mysql_query($sql);

		if( mysql_affected_rows() > 0 ){
			return false; //já tem alguém com esses dados
		}else{
			return true;
		}
	}

	public function atualizadados( $user_id , $dados ){
		$sql = "UPDATE `user` SET `login`='".$dados['login']."',`email`='".$dados['email']."',`nome`='".$dados['nome']."',`foto`='".$dados['foto']."' WHERE `id`=".$user_id;
		$rs = mysql_query($sql);

		if( mysql_affected_rows() > 0 ){
			return true;
		}else{
			return false;
		}
	}

	public function gravacanvas( $user_id, $canvas_id ){
		$sql = "UPDATE `user` SET `canvas_id`=$canvas_id WHERE `id`=$user_id";
		$rs = mysql_query($sql);

		if( mysql_affected_rows() > 0 ){
			return true;
		}else{
			return false;
		}
	}

	public function removecanvas( $user_id ){
		$sql = "UPDATE `user` SET `canvas_id`=0 WHERE `id`=$user_id";
		$rs = mysql_query($sql);

		if( mysql_affected_rows() > 0 ){
			return true;
		}else{
			return false;
		}
	}

	public function login( $login , $email ){
		$dados = array();
		$sql = "SELECT * FROM `user` WHERE `login`='$login' AND `email`='$email'";
		$rs = mysql_query($sql);

		if( mysql_affected_rows() > 0 ){
			while ($row = mysql_fetch_assoc($rs)) {
				$dados["id"] = $row["id"];
				$dados["login"] = $row["login"];
				$dados["email"] = $row["email"];
				$dados["nome"] = $row["nome"];
				$dados["foto"] = $row["foto"];
				$dados["canvas_id"] = $row["canvas_id"];
			}
			return $dados;			
		}else{
			return false;
		}
	}



#	private function verificalogin($login , $email){
#		$sql = "SELECT * FROM `user` WHERE `login`='$login' AND `email`='$email' ";
#		$rs = mysql_query($sql);

#		if( mysql_affected_rows() > 0 ){
#			return false; //já existe alguem com esses dados
#		}else{
#			return true;
#		}
#	}

}

?>
