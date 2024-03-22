<?php

class HomeController {
    public $view; // Agrega "public" u otro modificador de visibilidad
    public $pagetitle; // Agrega "public" u otro modificador de visibilidad

    public function home() {
        $this->view = 'home';
        $this->pagetitle = 'Home';
        require_once 'View/' . $this->view . '.php';
    }
}

?>
