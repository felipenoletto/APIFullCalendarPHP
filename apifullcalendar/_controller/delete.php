<?php

    session_start();

    include_once("../_dto/ApiDTO.php");
    include_once("../_dao/ApiDAO.php");

    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    $istart = filter_input(INPUT_POST, 'start', FILTER_SANITIZE_STRING);
    $iend = filter_input(INPUT_POST, 'end', FILTER_SANITIZE_STRING);
    $color = filter_input(INPUT_POST, 'color', FILTER_SANITIZE_STRING);
        
    $data = explode(" ", $istart);
    list($data, $hora) = $data;
    $data_sem_barra = array_reverse(explode("/", $data));
    $data_sem_barra = implode("-", $data_sem_barra);
    $start_sem_barra = $data_sem_barra." ".$hora;

    $data = explode(" ", $iend);
    list($data, $hora) = $data;
    $data_sem_barra = array_reverse(explode("/", $data));
    $data_sem_barra = implode("-", $data_sem_barra);
    $end_sem_barra = $data_sem_barra." ".$hora;

    $start = $start_sem_barra;
    $end = $end_sem_barra;

    $apiDTO = new ApiDTO();
    $apiDTO->setId($id);
    $apiDTO->setTitle($title);
    $apiDTO->setStart($start);
    $apiDTO->setEnd($end);
    $apiDTO->setColor($color);        

    $apiDAO = new ApiDAO();
    $result = $apiDAO->update($apiDTO);

    if($result) {

        $_SESSION['msg'] = "
            <div class='alert alert-success' role='alert'>
            Evento editado.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
            </div>
        ";

        header("Location: ../_view/main.php");

    } else {
        
        $_SESSION['msg'] = "
            <div class='alert alert-danger' role='alert'>
            Erro ao editar.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
            </div>
        ";

        header("Location: ../_view/main.php");

    }

?>