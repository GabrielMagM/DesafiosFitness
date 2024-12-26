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

    public function getAvailableChallenges($id_user) {
        try {
            return $this->client->getAvailableChallenges($id_user);
        } catch (SoapFault $e) {
            // Maneja el error de la forma que necesites
            //echo " " . $e->getMessage();
            return null; // Devuelve null en caso de error
        }
    }

    public function getChallenge($id_challenge) {
        return $this->client->getChallenge($id_challenge);
    }

    public function getStagesByChallenge($id_challenge, $id_user) {
        return $this->client->getStagesByChallenge($id_challenge, $id_user);
    }

}
?>