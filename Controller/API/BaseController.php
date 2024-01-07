<?php
class BaseController
{
    // Método mágico chamado quando um método inexistente é invocado.
    public function __call($name, $arguments)
    {
        // Invoca o método sendOutput para enviar uma resposta HTTP 404 Not Found.
        $this->sendOutput('', array('HTTP/1.1 404 Not Found'));
    }

    // Método protegido para obter parâmetros da string de consulta.
    protected function getStringParams() : array
    {
        // Analisa a string de consulta na URL e retorna os parâmetros como um array.
        parse_str($_SERVER['QUERY_STRING'], $query);
        return $query;
    }

    // Método protegido para enviar a saída para o cliente.
    protected function sendOutput($data, $httpHeaders=array())
    {
        // Remove todos os cabeçalhos 'Set-Cookie' para evitar problemas de cache.
        header_remove('Set-Cookie');

        // Adiciona os cabeçalhos HTTP fornecidos como parâmetro.
        if(is_array($httpHeaders) && count($httpHeaders)){
            foreach ($httpHeaders as $httpHeader){
                header($httpHeader);
            }
        }

        // Imprime os dados e encerra o script.
        echo $data;
        exit;
    }
}
