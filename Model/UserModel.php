<?php
// Inclui a classe Database
require_once ROOT_PATH . "/Model/Database.php";

// Definição da classe UserModel, que estende a classe Database
class UserModel extends Database {
    
    // Método que retorna um array de usuários com base no limite especificado
    public function getUsers($limit) : array {
        // Chama o método 'select' da classe Database (herdado)
        // Este método provavelmente realiza uma consulta ao banco de dados para obter os usuários
        return $this->select($limit);
    }
}
?>
