<?php
// Inclui o arquivo de configuração
require __DIR__ . "/Config/config.php";

// Obtém o caminho da URI solicitada
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Divide o caminho da URI em um array
$uri = explode('/', $uri);

// Verifica se a URI não corresponde à estrutura esperada para a API
if ((isset($uri[1]) && $uri[1] != 'api') || (isset($uri[2]) && $uri[2] != 'v1')) {
    // Se não corresponder, envia um cabeçalho 404 Not Found e encerra o script
    header("HTTP/1.1 404 Not Found");
    exit();
} else if ((isset($uri[3]) && $uri[3] != 'user') || !isset($uri[4])) {
    // Se a URI não contiver 'user' no terceiro segmento ou o quarto segmento estiver ausente, envia um cabeçalho 404 Not Found e encerra o script
    header("HTTP/1.1 404 Not Found");
    exit();
}

// Inclui a classe UserController
require ROOT_PATH . "/Controller/Api/UserController.php";

// Cria uma instância da classe UserController
$user = new UserController();

// Constrói o nome do método com base no quarto segmento da URI
$methodName = $uri[4] . 'Action';

// Chama o método apropriado na instância UserController
$user->{$methodName}();
?>
