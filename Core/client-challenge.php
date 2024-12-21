<?php
class Challenges {
    private $client;

    public function __construct() {
        $this->client = new SoapClient(null, array(
            'location' => "http://localhost/DesafiosFitness/DesafiosFitness/Core/service-challenge.php",
            'uri'      => "http://localhost/DesafiosFitness/DesafiosFitness/Core/service-challenge.php",
            'trace'    => 1,
        ));
    }

    public function getChallenges() {
        return $this->client->getChallenges();
    }

    public function getChallenge($id_challenge) {
        return $this->client->getChallenge($id_challenge);
    }

    public function getStagesByChallenge($id_challenge, $id_user) {
        return $this->client->getStagesByChallenge($id_challenge, $id_user);
    }

}
?>