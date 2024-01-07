<?php
class UserController extends BaseController
{
    /**
     * "/user/list" Endpoint - Get list of users
     */
    public function listAction()
    {
        // Inicializa variáveis para mensagens de erro e informações da requisição
        $erroDescription = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $stringParamsArray = $this->getStringParams();

        
        // Verifica se o método da requisição é GET
        if (strtoupper($requestMethod) == 'GET') {
            try {
                // Instancia um modelo de usuário
                $userModel = new UserModel();

                // Define um limite padrão de 10 usuários
                $intLimit = 10;
                
                // Se o parâmetro 'limit' estiver presente na URL, atualiza o limite
                if (isset($stringParamsArray['limit']) && $stringParamsArray['limit']) {
                    $intLimit = $stringParamsArray['limit'];
                }

                // Obtém a lista de usuários do modelo
                $usersArray = $userModel->getUsers($intLimit);

                // Converte a lista de usuários para JSON
                $responseData = json_encode($usersArray);
            } catch (Error $e) {
                // Captura erros, define uma mensagem de erro e um cabeçalho de erro HTTP 500
                $erroDescription = $e->getMessage().' Something went wrong! Please contact support.';
                $errorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            // Se o método da requisição não for GET, define uma mensagem de erro e um cabeçalho de erro HTTP 422
            $erroDescription = 'Method not supported';
            $errorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }

        // Envia a saída
        if (!$erroDescription) {
            // Se não houver erros, envia a resposta com dados JSON e um cabeçalho HTTP 200 OK
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            // Se houver erros, envia uma resposta de erro com uma mensagem JSON e o cabeçalho HTTP correspondente ao erro
            $this->sendOutput(json_encode(array('error' => $erroDescription)), 
                array('Content-Type: application/json', $errorHeader)
            );
        }
    }
}
