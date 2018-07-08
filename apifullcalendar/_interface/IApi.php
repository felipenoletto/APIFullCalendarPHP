<?php 

    interface IApi {

        public function insert($apiDTO);
        public function update($apiDTO);
        public function readAll();
        public function readById($id);
        public function delete($id);

    }

?>