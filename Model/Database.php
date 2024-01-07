<?php
class DataBase {

    // Função para selecionar dados do banco de dados
    public function select(int $limit) {
        try {
            // Lê o conteúdo do arquivo do banco de dados (supondo que seja um arquivo JSON)
            $users = json_decode(file_get_contents(DATABASE_FILE), true);

            // Limita o número de resultados com base no parâmetro $limit
            $users = array_slice($users, 0, $limit);

            // Retorna os dados obtidos do banco de dados
            return $users;
        } catch (Exception $e) {
            // Em caso de erro, lança uma exceção com a mensagem do erro original
            throw new Exception($e->getMessage());
        }

        // Essa linha nunca será alcançada, pois a função já retornou dentro do bloco try
        return false;
    }
}
