<?php
    session_start();
    include_once("../_dao/ApiDAO.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>API FULLCALENDAR</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../_css/fullcalendar.min.css" />
    <link href='../_css/fullcalendar.print.min.css' rel='stylesheet' media='print' />
    <link rel="stylesheet" type="text/css" href="../_css/style.css" />
    <link rel="stylesheet" type="text/css" href="../_css/bootstrap.min.css" />
    <script src='../_js/moment.min.js'></script>
    <script src='../_js/jquery.min.js'></script>
    <script src="../_js/fullcalendar.min.js"></script>
    <script src="../_language/pt-br.js"></script>
    <script src="../_js/bootstrap.min.js"></script>

    <script>

        $(document).ready(function() {

            $('#calendar').fullCalendar({
                header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
                },
                defaultDate: Date(),
                navLinks: true, // can click day/week names to navigate views
                editable: true,
                eventLimit: true, // allow "more" link when too many events
                selectable: true,
                selectHelper: true,

                // CADASTRAR
                select: function(start, end) {
                    $('#myModalCad #start').val(moment(start).format('DD/MM/YYYY HH:mm:ss'));
                    $('#myModalCad #end').val(moment(end).format('DD/MM/YYYY HH:mm:ss'));
                    $('#myModalCad').modal('show');
                },

                // VISUALIZAR
                eventClick: function(event) {

                    $('#myModalVis #id').val(event.id);
                    $('#myModalVis #title').val(event.title);
                    $('#myModalVis #color').val(event.color);
                    $('#myModalVis #start').val(event.start.format('DD/MM/YYYY HH:mm:ss'));
                    $('#myModalVis #end').val(event.end.format('DD/MM/YYYY HH:mm:ss'));

                    $('#myModalVis #id').text(event.id);
                    $('#myModalVis #title').text(event.title);
                    $('#myModalVis #start').text(event.start.format('DD/MM/YYYY HH:mm:ss'));
                    $('#myModalVis #end').text(event.end.format('DD/MM/YYYY HH:mm:ss'));
                    $('#myModalVis').modal('show');
                    
                    return false;
                },

                // LISTAR
                events: [
                    <?php
                    
                        $apiDAO = new ApiDAO();
                        $result = $apiDAO->readAll();
                        foreach($result as $key => $value) :
                    
                    ?>

                    {
                    id: '<?php echo $value['id']; ?>',
                    title: '<?php echo $value['title']; ?>',
                    color: '<?php echo $value['color']; ?>',
                    start: '<?php echo $value['start']; ?>',
                    end: '<?php echo $value['end']; ?>',
                    },

                    <?php endforeach; ?>
                ]
            });

        });

        // MASCARA DATA/HORA
        function DataHora(evento, objeto) {
            var keypress = (window.event)?event.keyCode:evento.which;
            campo = eval(objeto);

            if(campo.value == '00/00/0000 00:00:00') {
                campo.value="";
            }

            caracteres = '0123456789';
            separacao1 = '/';
            separacao2 = ' ';
            separacao3 = ':';
            conjunto1 = 2;
            conjunto2 = 5;
            conjunto3 = 10;
            conjunto4 = 13;
            conjunto5 = 16;

            if((caracteres.search(String.fromCharCode (keypress)) != -1) && campo.value.length < (19)) {
                if(campo.value.length == conjunto1) {
                    campo.value = campo.value + separacao1;
                } else if(campo.value.length == conjunto2) {
                    campo.value = campo.value + separacao1;
                } else if(campo.value.length == conjunto3) {
                    campo.value = campo.value + separacao2;
                } else if(campo.value.length == conjunto4) {
                    campo.value = campo.value + separacao3;
                } else if(campo.value.length == conjunto5) {
                    campo.value = campo.value + separacao3;
                }
            } else {
                event.returnValue = false;
            }

        }

    </script>

</head>
<body>

    <div class="container">
        <div class="page-header">
            <h1>Agenda</h1>
        </div>

            <?php
                
                if(isset($_SESSION['msg'])) {
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                }

            ?>

        <div id='calendar'></div>
    </div>

    <!-- MODAL - VISUALIZAR -->
    <div class="modal fade" id="myModalVis" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Dados do Evento</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <dl class="visualizar">
                        <dt>Titulo</dt>
                        <dd id="title"></dd>
                        <dt>Inicio</dt>
                        <dd id="start"></dd>
                        <dt>Fim</dt>
                        <dd id="end"></dd>
                        <button class="btn btn-canc-vis btn-warning">Editar</button>
                    </dl>
                </div>

                <div class="form">

                    <!-- EDITAR -->
                    <form class="form-horizontal" method="post" action="../_controller/update.php">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Titulo</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" name="title" id="title" placeholder="Digite o titulo..." />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Inicio</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" name="start" id="start" onKeyPress="DataHora(event, this)" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Fim</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" name="end" id="end" onKeyPress="DataHora(event, this)" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Cor</label>
                            <div class="col-sm-10">
                            <select class="form-control" name="color" id="color" />
                                <option value="">.::Selecione::.</option>
                                <option style="color:#FFD700;" value="#FFD700">Amarelo</option>
                                <option style="color:#0071C5;" value="#0071C5">Azul Turquesa</option>
                                <option style="color:#FF4500;" value="#FF4500">Laranja</option>
                                <option style="color:#8B4513;" value="#8B4513">Marrom</option>
                                <option style="color:#1C1C1C;" value="#1C1C1C">Preto</option>
                                <option style="color:#436EEE;" value="#436EEE">Azul Royal</option>
                                <option style="color:#A020F0;" value="#A020F0">Roxo</option>
                                <option style="color:#40E0D0;" value="#40E0D0">Turquesa</option>
                                <option style="color:#228B22;" value="#228B22">Verde</option>
                                <option style="color:#8B0000;" value="#8B0000">Vermelho</option>
                            </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                            <input type="hidden" class="form-control" name="id" id="id" />
                            <button type="submit" class="btn btn-success">Salvar Alteracoes</button>
                            <button type="button" class="btn btn-canc-edit btn-primary">Cancelar</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- MODAL - CADASTRAR -->
    <div class="modal fade" id="myModalCad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Cadastrar Evento</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                <form class="form-horizontal" method="post" action="../_controller/add.php">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Titulo</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" name="title" placeholder="Digite o titulo..." />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Inicio</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" name="start" id="start" onKeyPress="DataHora(event, this)" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Fim</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" name="end" id="end" onKeyPress="DataHora(event, this)" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Cor</label>
                        <div class="col-sm-10">
                        <select class="form-control" name="color" id="color" />
                            <option value="">.::Selecione::.</option>
                            <option style="color:#FFD700;" value="#FFD700">Amarelo</option>
                            <option style="color:#0071C5;" value="#0071C5">Azul Turquesa</option>
                            <option style="color:#FF4500;" value="#FF4500">Laranja</option>
                            <option style="color:#8B4513;" value="#8B4513">Marrom</option>
                            <option style="color:#1C1C1C;" value="#1C1C1C">Preto</option>
                            <option style="color:#436EEE;" value="#436EEE">Azul Royal</option>
                            <option style="color:#A020F0;" value="#A020F0">Roxo</option>
                            <option style="color:#40E0D0;" value="#40E0D0">Turquesa</option>
                            <option style="color:#228B22;" value="#228B22">Verde</option>
                            <option style="color:#8B0000;" value="#8B0000">Vermelho</option>
                        </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                        <button type="submit" class="btn btn-success">Cadastrar</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('.btn-canc-vis').on("click", function(){
            $('.form').slideToggle();
            $('.visualizar').slideToggle();
        });

        $('.btn-canc-edit').on("click", function(){
            $('.visualizar').slideToggle();
            $('.form').slideToggle();
        });
    </script>
</body>
</html>