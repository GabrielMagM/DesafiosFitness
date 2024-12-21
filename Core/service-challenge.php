<?php
include 'functions.php';

// Inicializar el servidor SOAP
ini_set("soap.wsdl_cache_enabled", "0"); // Desactivar cache para desarrollo

// Definir la clase del servicio
class ServiciosDesafios {
    private $functions;

    public function __construct() {
        $this->functions = new Functions();
    }

    // Obtener todos los desafíos
    public function getChallenges() {
        $challenges = $this->functions->getChallenges();
        if ($challenges) {
            return $challenges;
        } else {
            throw new SoapFault("Server", "No hay desafíos disponibles.");
        }
    }

    // Obtener desafíos por ID
    public function getChallenge($id_challenge) {
        $challenge = $this->functions->getChallengeById($id_challenge);
        if ($challenge) {
            return $challenge;
        } else {
            throw new SoapFault("Server", "El desafío con ID $id_challenge no existe.");
        }
    }

    // Obtener los stages de un desafío
    public function getStagesByChallenge($id_challenge, $id_user) {
        $stages = $this->functions->getStagesByChallenge($id_challenge, $id_user);
        if ($stages) {
            return $stages;
        } else {
            throw new SoapFault("Server", "No hay retos asociados con el desafío con ID $id_challenge.");
        }
    }

    
}

// Configurar y manejar el servidor SOAP
$options = array('uri' => "http://localhost/DesafiosFitness/DesafiosFitness/Core/service-challenge.php");
$server = new SoapServer(null, $options);
$server->setClass('ServiciosDesafios');

try {
    $server->handle();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>