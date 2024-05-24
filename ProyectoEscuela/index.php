
<?php
    session_start();
    
// Verificar si la sesión está activa
if (isset($_SESSION['admin']) || isset($_SESSION['secretaria'])) {
    // Destruir la sesión
    session_destroy();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css"  href="./styles/principal.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Forum&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>


<body class="indice">
    <header>
    <nav class="login-navbar">
        <ul class="navbar">
            <li class="login-item"><i class="fa-brands fa-gg-circle fa-2xl"></i><a href="./formularios/login.php">Log In</a></li>
        </ul>
    </nav>
        <h1 class="titulo">C.E EXECUTE</h1>
        <div class="login">
            
        </div>
        <div class="frase"></div>
        <nav class="contenedor">
            <ul class="navbar">
                <li><a href="QuienesSomos.php">Quiénes Somos</a></li>
                <li><a href="QueOfrecemos.php">Qué Ofrecemos</a></li>
                <li><a href="PorqueElegirnos.php">Por qué Elegirnos</a></li>
            </ul>
        </nav>

    </header>

<br>
<br>
<br>

<div class="columnas">
    <div class="columna-1">
        <div class="calendario">
            <div class="dia dia-evento" id="dia1">1</div>
            <div class="dia" id="dia2">2</div>
            <div class="dia" id="dia3">3</div>
            <div class="dia dia-evento" id="dia4">4</div>
            <div class="dia" id="dia5">5</div>
            <div class="dia" id="dia6">6</div>
            <div class="dia" id="dia7">7</div>
            <div class="dia" id="dia8">8</div>
            <div class="dia" id="dia9">9</div>
            <div class="dia dia-evento" id="dia10">10</div>
            <div class="dia" id="dia11">11</div>
            <div class="dia" id="dia12">12</div>
            <div class="dia" id="dia13">13</div>
            <div class="dia" id="dia14">14</div>
            <div class="dia" id="dia15">15</div>
            <div class="dia" id="dia16">16</div>
            <div class="dia" id="dia17">17</div>
            <div class="dia dia-evento" id="dia18">18</div>
            <div class="dia" id="dia19">19</div>
            <div class="dia dia-evento" id="dia20">20</div>
            <div class="dia dia-evento" id="dia21">21</div>
            <div class="dia" id="dia22">22</div>
            <div class="dia" id="dia23">23</div>
            <div class="dia" id="dia24">24</div>
            <div class="dia" id="dia25">25</div>
            <div class="dia" id="dia26">26</div>
            <div class="dia" id="dia27">27</div>
            <div class="dia dia-evento" id="dia28">28</div>
            <div class="dia" id="dia29">29</div>
            <div class="dia" id="dia30">30</div>
            <div class="dia" id="dia31">31</div>
        </div>
        <div id="eventos">
            <!-- Aquí se mostrarán los eventos al hacer clic en un día -->
        </div>
    </div>

    <div class="columna-2">
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="./img/fp1.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="./img/fp2.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="./img/fp3.jpeg" class="d-block w-100" >
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
    </div>

    <div class="columna-3"> 
        <div id="accordion">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Horario
                        </button>
                    </h5>
                </div>
                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                        <strong>Escuela: </strong>8:00 a 9:00<br>
                        <strong>Secretaria: </strong>10:00 a 14:30 / 15:30 a 17:30<br>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingTwo">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Info y Localización
                        </button>
                    </h5>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body">
                    <strong>Información:</strong> 687-654-365
                        <br>
                    <strong>Contacto: </strong> WhatsApp, Facebook, Instagram
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingThree">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Contacto:
                        </button>
                    </h5>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body">
                    <strong>Telefono Secretaria: </strong>654 223 874

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    </div>
</div>

<div class="contenido-creativo">
    <h2>Descubre nuestro programa de actividades extracurriculares</h2>
    <p>En C.E EXECUTE, no solo nos enfocamos en la excelencia académica, sino también en el desarrollo integral de nuestros estudiantes. Por eso, te ofrecemos una amplia variedad de actividades extracurriculares para que puedas explorar tus intereses, desarrollar tus habilidades y crear experiencias inolvidables.</p>
    
    <div class="actividades">
        <div class="actividad">
            <img src="./img/debate.jpg" alt="Actividad 1">
            <h3>Club de Debate</h3>
            <p>¡Únete a nuestro club de debate y mejora tus habilidades de argumentación y oratoria mientras te diviertes con tus compañeros!</p>
        </div>
        <div class="actividad">
            <img src="./img/robotica.jpg" alt="Actividad 2">
            <h3>Taller de Robótica</h3>
            <p>Expresa tu creatividad y desarrolla tus habilidades tecnológicas en nuestro taller de robótica, donde podrás aprender a construir y programar robots mientras te diviertes y descubres el fascinante mundo de la ingeniería.</p>
        </div>
        <div class="actividad">
            <img src="./img/deporte.jpg" alt="Actividad 3">
            <h3>Equipo Deportivo</h3>
            <p>Forma parte de nuestro equipo deportivo y participa en emocionantes competiciones mientras fomentas el compañerismo y el espíritu de equipo.</p>
        </div>
    </div>
</div>




<script src="./js/calendario.js"></script>
</body>


















































<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


