<?php

    // Classe Api
    class ApiDTO {

        // Variaveis
        private $id;
        private $title;
        private $start;
        private $end;
        private $color;

        public function __construct() {}

        // GET id
        public function getId(){
            return $this->id;
        }

        // SET id
        public function setId($id) {
            $this->id = $id;
        }

        // GET title
        public function getTitle(){
            return $this->title;
        }

        // SET title
        public function setTitle($title) {
            $this->title = $title;
        }

        // GET inicio
        public function getStart(){
            return $this->start;
        }

        // SET inicio
        public function setStart($start) {
            $this->start = $start;
        }

        // GET fim
        public function getEnd(){
            return $this->end;
        }

        // SET fim
        public function setEnd($end) {
            $this->end = $end;
        }

        // GET color
        public function getColor(){
            return $this->color;
        }

        // SET color
        public function setColor($color) {
            $this->color = $color;
        }

    } 

?>