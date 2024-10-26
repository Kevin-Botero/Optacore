<?php
session_start();

include("BD/conexion.php");

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examenes Visuales</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="CSS/examen.css">
</head>
<body>
<?php include ("nav.php");?>
<div class="container" style="margin-top: 20px; margin-bottom: 40px;">
    <h3 style="text-align: center;">Nuestros servicios Medicos</h3>
    <div class="row text-center">
        <!-- Sección de Agudeza Visual -->
        <div class="col-12 col-md-4 mb-4">
        <div class="img1"></div>
        <h3 class="">Agudeza Visual</h3>
        <h6 class="">Una buena visión mejora nuestra calidad de vida y nos conecta con el mundo.</h6>
        <br>
            <div class="accordion" id="accordionAgudeza">
                <!-- 1 -->
                <div class="accordion-item">
                    <h5 class="accordion-header">
                        <button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOneAgudeza" aria-expanded="true" aria-controls="collapseOneAgudeza">
                        ¿Qué es la agudeza visual?
                        </button>
                    </h5>
                    <div id="collapseOneAgudeza" class="accordion-collapse collapse" data-bs-parent="#accordionAgudeza">
                        <div class="accordion-body">
                            <strong>La agudeza visual es la capacidad de ver detalles con claridad.</strong>
                        </div>
                    </div>
                </div>
                <!-- 2 -->
                <div class="accordion-item">
                    <h5 class="accordion-header">
                        <button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwoAgudeza" aria-expanded="true" aria-controls="collapseTwoAgudeza">
                        ¿Cuándo debo hacerme un examen visual?
                        </button>
                    </h5>
                    <div id="collapseTwoAgudeza" class="accordion-collapse collapse" data-bs-parent="#accordionAgudeza">
                        <div class="accordion-body">
                            <strong>Es recomendable hacerlo cada año para mantener una buena salud visual.</strong>
                        </div>
                    </div>
                </div>
                <!-- 3 -->
                <div class="accordion-item">
                    <h5 class="accordion-header">
                        <button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThreeAgudeza" aria-expanded="true" aria-controls="collapseThreeAgudeza">
                        ¿Qué incluye un examen visual completo?
                        </button>
                    </h5>
                    <div id="collapseThreeAgudeza" class="accordion-collapse collapse" data-bs-parent="#accordionAgudeza">
                        <div class="accordion-body">
                            <strong>Incluye pruebas de agudeza visual, campo visual y revisión de salud ocular.</strong>
                        </div>
                    </div>
                </div>
                <!-- 4 -->
                <div class="accordion-item">
                    <h5 class="accordion-header">
                        <button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFourAgudeza" aria-expanded="true" aria-controls="collapseFourAgudeza">
                        ¿Por qué es importante cuidar la vista?
                        </button>
                    </h5>
                    <div id="collapseFourAgudeza" class="accordion-collapse collapse" data-bs-parent="#accordionAgudeza">
                        <div class="accordion-body">
                            <strong>Una buena visión es esencial para el bienestar y calidad de vida diaria.</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección de Refraccion Visual -->
        <div class="col-12 col-md-4 mb-4">
        <div class="img2"></div>
        <h3 class="">Refracción Visual</h3>
        <h6 class="">La forma en que la luz se curva en el ojo afecta nuestra claridad de visión.</h6>
        <br>
            <div class="accordion" id="accordionRefraccion">
                <!-- 1 -->
                <div class="accordion-item">
                    <h5 class="accordion-header">
                        <button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOneRefraccion" aria-expanded="true" aria-controls="collapseOneRefraccion">
                        ¿Qué es la refracción visual?
                        </button>
                    </h5>
                    <div id="collapseOneRefraccion" class="accordion-collapse collapse" data-bs-parent="#accordionRefraccion">
                        <div class="accordion-body">
                            <strong>La refracción visual es el fenómeno óptico que ocurre cuando la luz pasa a través de diferentes medios y se desvía, permitiendo ver objetos.</strong>
                        </div>
                    </div>
                </div>
                <!-- 2 -->
                <div class="accordion-item">
                    <h5 class="accordion-header">
                        <button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwoRefraccion" aria-expanded="true" aria-controls="collapseTwoRefraccion">
                        ¿Cómo afecta la refracción a la visión?
                        </button>
                    </h5>
                    <div id="collapseTwoRefraccion" class="accordion-collapse collapse" data-bs-parent="#accordionRefraccion">
                        <div class="accordion-body">
                            <strong>La refracción afecta la claridad con la que vemos; una refracción incorrecta puede causar problemas como miopía o hipermetropía.</strong>
                        </div>
                    </div>
                </div>
                <!-- 3 -->
                <div class="accordion-item">
                    <h5 class="accordion-header">
                        <button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThreeRefraccion" aria-expanded="true" aria-controls="collapseThreeRefraccion">
                        ¿Qué es un examen de refracción?
                        </button>
                    </h5>
                    <div id="collapseThreeRefraccion" class="accordion-collapse collapse" data-bs-parent="#accordionRefraccion">
                        <div class="accordion-body">
                            <strong>Un examen de refracción evalúa cómo la luz se enfoca en la retina y ayuda a determinar la corrección óptica necesaria.</strong>
                        </div>
                    </div>
                </div>
                <!-- 4 -->
                <div class="accordion-item">
                    <h5 class="accordion-header">
                        <button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFourRefraccion" aria-expanded="true" aria-controls="collapseFourRefraccion">
                        ¿Cuáles son los métodos de corrección de la refracción?
                        </button>
                    </h5>
                    <div id="collapseFourRefraccion" class="accordion-collapse collapse" data-bs-parent="#accordionRefraccion">
                        <div class="accordion-body">
                            <strong>Los métodos de corrección incluyen el uso de gafas, lentes de contacto o cirugía refractiva.</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección de Terapia Visual -->
        <div class="col-12 col-md-4 mb-4">
        <div class="img3"></div>
        <h3 class="">Terapia Visual</h3>
        <h6 class="">El entrenamiento visual puede mejorar la función y coordinación ocular.</h6>
        <br>
            <div class="accordion" id="accordionTerapia">
               <!-- 1 -->
               <div class="accordion-item">
                    <h5 class="accordion-header">
                        <button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOneTerapia" aria-expanded="true" aria-controls="collapseOneTerapia">
                        ¿Qué es la terapia visual?
                        </button>
                    </h5>
                    <div id="collapseOneTerapia" class="accordion-collapse collapse" data-bs-parent="#accordionTerapia">
                        <div class="accordion-body">
                            <strong>La terapia visual es un tratamiento que mejora la función visual a través de ejercicios y técnicas específicas.</strong>
                        </div>
                    </div>
                </div>
                <!-- 2 -->
                <div class="accordion-item">
                    <h5 class="accordion-header">
                        <button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwoTerapia" aria-expanded="true" aria-controls="collapseTwoTerapia">
                        ¿Cuándo se recomienda la terapia visual?
                        </button>
                    </h5>
                    <div id="collapseTwoTerapia" class="accordion-collapse collapse" data-bs-parent="#accordionTerapia">
                        <div class="accordion-body">
                            <strong>Se recomienda en casos de problemas de coordinación visual, dificultades de aprendizaje o tras lesiones oculares.</strong>
                        </div>
                    </div>
                </div>
                <!-- 3 -->
                <div class="accordion-item">
                    <h5 class="accordion-header">
                        <button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThreeTerapia" aria-expanded="true" aria-controls="collapseThreeTerapia">
                        ¿Cómo se realiza la terapia visual?
                        </button>
                    </h5>
                    <div id="collapseThreeTerapia" class="accordion-collapse collapse" data-bs-parent="#accordionTerapia">
                        <div class="accordion-body">
                            <strong>Se lleva a cabo mediante ejercicios visuales, seguimiento de objetos y actividades que fortalecen el sistema visual.</strong>
                        </div>
                    </div>
                </div>
                <!-- 4 -->
                <div class="accordion-item">
                    <h5 class="accordion-header">
                        <button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFourTerapia" aria-expanded="true" aria-controls="collapseFourTerapia">
                        ¿Cuáles son los beneficios de la terapia visual?
                        </button>
                    </h5>
                    <div id="collapseFourTerapia" class="accordion-collapse collapse" data-bs-parent="#accordionTerapia">
                        <div class="accordion-body">
                            <strong>Los beneficios incluyen una mejora en la coordinación, la concentración y la percepción visual.</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a href="form_cita.php" class="btn btn-info" style="width: 100%;">Agenda tu examen</a>
</div>
</body>
</html>
