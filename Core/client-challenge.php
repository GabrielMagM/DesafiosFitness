<?php
class Challenges {
    private $client;

    public function __construct() {
        $this->client = new SoapClient(null, array(
            'location' => "http://localhost/PHP/DesafiosFitness/Core/service-challenge.php",
            'uri'      => "http://localhost/PHP/DesafiosFitness/Core/service-challenge.php",
            'trace'    => 1,
        ));
    }

    public function obtenerDesafios() {
        return $this->client->obtenerDesafios();
    }

    public function obtenerDesafio($id_challenge) {
        return $this->client->obtenerDesafio($idDesafio);
    }

    public function obtenerRetosPorDesafio($id_challenge, $id_user) {
        return $this->client->obtenerRetosPorDesafio($id_challenge, $id_user);
    }

}
?>