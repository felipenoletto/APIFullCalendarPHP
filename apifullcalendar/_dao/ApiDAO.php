<?php

    require_once("../_interface/IApi.php");
    require_once("../_config/DB.php");

    class ApiDAO implements IApi {

        public function insert($apiDTO) {

            $title = $apiDTO->getTitle();
            $color = $apiDTO->getColor();
            $start = $apiDTO->getStart();
            $end = $apiDTO->getEnd();

            try {
            
                $sql = "INSERT INTO events(title, color, start, end) VALUES(:title, :color, :start, :end)";
                $stmt = DB::prepare($sql);
                $stmt->bindParam(":title", $title, PDO::PARAM_STR);
                $stmt->bindParam(":color", $color, PDO::PARAM_STR);
                $stmt->bindParam(":start", $start);
                $stmt->bindParam(":end", $end);
                
                return $stmt->execute();
            
            } catch(PDOException $e) {
                echo $e->getMessage();
            }

        }

        public function update($apiDTO) {

            $id = $apiDTO->getId();
            $title = $apiDTO->getTitle();
            $color = $apiDTO->getColor();
            $start = $apiDTO->getStart();
            $end = $apiDTO->getEnd();

            try {
            
                $sql = "UPDATE events SET title = :title, color = :color, start = :start, end = :end WHERE id = :id";
                $stmt = DB::prepare($sql);
                $stmt->bindParam(":title", $title, PDO::PARAM_STR);
                $stmt->bindParam(":color", $color, PDO::PARAM_STR);
                $stmt->bindParam(":start", $start);
                $stmt->bindParam(":end", $end);
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);

                return $stmt->execute();

            } catch(PDOException $e) {
                echo $e->getMessage();
            }

        }
    
        public function readAll() {

            try {

                $sql = "SELECT id, title, color, start, end FROM events";
                $stmt = DB::prepare($sql);
                $stmt->execute();

                return $stmt->fetchAll();

            } catch(PDOException $e) {
                echo $e->getMessage();
            }

        }
    
        public function readById($id) {

            try {

                $sql = "SELECT id, title, color, start, end,  FROM events WHERE id = :id";
                $stmt = DB::prepare($sql);
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->execute();

                return $stmt->fetch();

            } catch(PDOException $e) {
                echo $e->getMessage();
            }

        }
    
        public function delete($id) {

            try {

                $sql = "DELETE FROM events WHERE id = :id";
                $stmt = DB::prepare($sql);
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                
                return $stmt->execute();

            } catch(PDOException $e) {
                echo $e->getMessage();
            }

        }

    }

?>