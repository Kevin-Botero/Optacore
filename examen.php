<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examenes Visuales</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="CSS/examen.css">
</head>
<body>
<?php include ("nav.php");?>

<!-- Sección de Agudeza Visual -->
    <div class="img1"></div>
    <div class="botones">
        <a href="https://wa.me/3128246409" class="boton-whatsapp">Via WhatsApp</a>
    </div>

    <h1 class="title">Agudeza Visual</h1>
    <h3 class="subt">Una buena visión mejora nuestra calidad de vida y nos conecta con el mundo.</h3>

    <div class="pregunta">
        <label class="pregunta-label">¿Qué es la agudeza visual?</label>
        <span class="icono-pregunta" onclick="toggleRespuesta('respuesta1')">▼</span>
    </div>
    <div class="respuesta" id="respuesta1" style="display:none;">La agudeza visual es la capacidad de ver detalles con claridad.</div>

    <hr class="linea">
    <div class="pregunta">
        <label class="pregunta-label">¿Cuándo debo hacerme un examen visual?</label>
        <span class="icono-pregunta" onclick="toggleRespuesta('respuesta2')">▼</span>
    </div>
    <div class="respuesta" id="respuesta2" style="display:none;">Es recomendable hacerlo cada año para mantener una buena salud visual.</div>

    <hr class="linea">
    <div class="pregunta">
        <label class="pregunta-label">¿Qué incluye un examen visual completo?</label>
        <span class="icono-pregunta" onclick="toggleRespuesta('respuesta3')">▼</span>
    </div>
    <div class="respuesta" id="respuesta3" style="display:none;">Incluye pruebas de agudeza visual, campo visual y revisión de salud ocular.</div>

    <hr class="linea">
    <div class="pregunta">
        <label class="pregunta-label">¿Por qué es importante cuidar la vista?</label>
        <span class="icono-pregunta" onclick="toggleRespuesta('respuesta4')">▼</span>
    </div>
    <div class="respuesta" id="respuesta4" style="display:none;">Una buena visión es esencial para el bienestar y calidad de vida diaria.</div>

    <button class="boton-agendas">Agenda tu examen</button>

<!-- Sección de Refracción Visual -->
    <div class="img2"></div>
    <h1 class="title2">Refracción Visual</h1>
    <h3 class="subt2">La forma en que la luz se curva en el ojo afecta nuestra claridad de visión.</h3>

    <div class="pregunta">
        <label class="pregunta-label">¿Qué es la refracción visual?</label>
        <span class="icono-pregunta" onclick="toggleRespuesta('respuesta5')">▼</span>
    </div>
    <div class="respuesta" id="respuesta5" style="display:none;">La refracción visual es el fenómeno óptico que ocurre cuando la luz pasa a través de diferentes medios y se desvía, permitiendo ver objetos.</div>

    <hr class="linea">
    <div class="pregunta">
        <label class="pregunta-label">¿Cómo afecta la refracción a la visión?</label>
        <span class="icono-pregunta" onclick="toggleRespuesta('respuesta6')">▼</span>
    </div>
    <div class="respuesta" id="respuesta6" style="display:none;">La refracción afecta la claridad con la que vemos; una refracción incorrecta puede causar problemas como miopía o hipermetropía.</div>

    <hr class="linea">
    <div class="pregunta">
        <label class="pregunta-label">¿Qué es un examen de refracción?</label>
        <span class="icono-pregunta" onclick="toggleRespuesta('respuesta7')">▼</span>
    </div>
    <div class="respuesta" id="respuesta7" style="display:none;">Un examen de refracción evalúa cómo la luz se enfoca en la retina y ayuda a determinar la corrección óptica necesaria.</div>

    <hr class="linea">
    <div class="pregunta">
        <label class="pregunta-label">¿Cuáles son los métodos de corrección de la refracción?</label>
        <span class="icono-pregunta" onclick="toggleRespuesta('respuesta8')">▼</span>
    </div>
    <div class="respuesta" id="respuesta8" style="display:none;">Los métodos de corrección incluyen el uso de gafas, lentes de contacto o cirugía refractiva.</div>

    <button class="boton-agendas">Agenda tu examen</button>

<!-- Sección de Terapia Visual -->
    <div class="img3"></div>
    <h1 class="title3">Terapia Visual</h1>
    <h3 class="subt3">El entrenamiento visual puede mejorar la función y coordinación ocular.</h3>

    <div class="pregunta">
        <label class="pregunta-label">¿Qué es la terapia visual?</label>
        <span class="icono-pregunta" onclick="toggleRespuesta('respuesta9')">▼</span>
    </div>
    <div class="respuesta" id="respuesta9" style="display:none;">La terapia visual es un tratamiento que mejora la función visual a través de ejercicios y técnicas específicas.</div>

    <hr class="linea">
    <div class="pregunta">
        <label class="pregunta-label">¿Cuándo se recomienda la terapia visual?</label>
        <span class="icono-pregunta" onclick="toggleRespuesta('respuesta10')">▼</span>
    </div>
    <div class="respuesta" id="respuesta10" style="display:none;">Se recomienda en casos de problemas de coordinación visual, dificultades de aprendizaje o tras lesiones oculares.</div>

    <hr class="linea">
    <div class="pregunta">
        <label class="pregunta-label">¿Cómo se realiza la terapia visual?</label>
        <span class="icono-pregunta" onclick="toggleRespuesta('respuesta11')">▼</span>
    </div>
    <div class="respuesta" id="respuesta11" style="display:none;">Se lleva a cabo mediante ejercicios visuales, seguimiento de objetos y actividades que fortalecen el sistema visual.</div>

    <hr class="linea">
    <div class="pregunta">
        <label class="pregunta-label">¿Cuáles son los beneficios de la terapia visual?</label>
        <span class="icono-pregunta" onclick="toggleRespuesta('respuesta12')">▼</span>
    </div>
    <div class="respuesta" id="respuesta12" style="display:none;">Los beneficios incluyen una mejora en la coordinación, la concentración y la percepción visual.</div>

    <button class="boton-agendas">Agenda tu examen</button>

<script>
    function toggleRespuesta(respuestaId) {
        // Ocultar todas las respuestas
        var respuestas = document.querySelectorAll('.respuesta');
        respuestas.forEach(function(respuesta) {
            respuesta.style.display = 'none';
        });
        
        // Mostrar la respuesta seleccionada
        var respuesta = document.getElementById(respuestaId);
        respuesta.style.display = 'block';
    }
</script>

</body>
</html>
