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

    public function getChallenge() {
        return $this->client->getChallenge();
    }

    public function getChallengeById($id_challenge) {
        return $this->client->getChallengeById($idDesafio);
    }

    public function getStagesByChallenge($id_challenge, $id_user) {
        return $this->client->getStagesByChallenge($id_challenge, $id_user);
    }

}
?>