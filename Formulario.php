<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8"> <!--Esta parte del código me permite que se vean las tildes de forma adecuada-->
    <title>Ropa LP - Solicitud de Servicio</title>
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <head><link rel="stylesheet" href="CSS/formulario.css"></head>
    <head><link rel="stylesheet" href="CSS/ppal.css"></head>
  </head>
  <body>
    <header>
      <div>
        <!--Inserto el logotipo de la pagina y el nombre-->
        <a href="Ppal.html"><img src="img/logo.png" alt="Logotipo LP" title="Logotipo LP" width="70"></a>  ROPA DEPORTIVA ON-LINE
      </div>
    </header>
    <p>
      <?php
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $celular = $_POST['celular'];
        $servicio = $_POST['servicio'];

        echo  
          "<div class = 'formulario'>
            <p><b>Esta es la información enviada:</b></p>
              <ul class = 'pregunta'>
                <li>Nombre(s): </li>
                <li>Apellido(s): </li>
                <li>Celular: </li>
                <li>Servicio que solicita: </li>
              </ul>
              <ul class = 'respuesta'>
                <li>". $nombre. "</li>
                <li>". $apellidos. "</li>
                <li>". $celular. "</li>
                <li>". $servicio. "</li>
              </ul>
              <a href='Ppal.html'>Finalizar</a>
          </div>";
      ?>
    </p>

  </body>
</html>
