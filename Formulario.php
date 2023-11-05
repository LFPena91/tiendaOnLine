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
        <a href="Ppal.html"><img src="img/Fondo.png" alt="Logotipo LP" title="Logotipo LP" width="70"></a>  ROPA DEPORTIVA ON-LINE
      </div>
    </header>
    <p>
      <?php

        //Creo la conexión a la BD
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "tiendaonline";
        
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Verifica la conexión
        if ($conn->connect_errno) {
          echo "Falló la conexión a MySQL: " . $conn->connect_error;
          exit();
        }

        //escapamos los datos ingresados al formulario
        $nombre = $conn->real_escape_string($_POST['nombre']);
        $apellidos = $conn->real_escape_string($_POST['apellidos']);
        $correo = $conn->real_escape_string($_POST['correo']);
        $celular = $conn->real_escape_string($_POST['celular']);
        $servicio = $conn->real_escape_string($_POST['servicio']);

        //Genero una consulta, para evitar valores repetidos.
        $consulta = "SELECT estado FROM tiendaonline.clientes
                    WHERE celular = $celular
                      AND servicio = '$servicio'";
        $resultado = mysqli_query($conn,$consulta);
        //Primero se valida si en la fila estado hay algún dato
        if ($resultado && mysqli_num_rows($resultado) > 0){
          //Recorremos cada uno de los datos encontrados
          while ($fila = mysqli_fetch_assoc($resultado)) {
            if ($fila['estado'] == "Pendiente"){ 
              echo 
              "<div class = 'formulario'>
                <p><b>Su solicitud ya ha sido creada, pronto nos comunicaremos con usted</b></p>
                <a href='Ppal.html'>Finalizar</a>
              </div>";
            }else{
              $actualizacion = "UPDATE clientes
                                SET nombres = '$nombre' , apellidos = '$apellidos' , 
                                    correo_electronico = '$correo' , servicio = '$servicio' , estado = 'Pendiente'
                                WHERE celular = $celular AND estado <> 'Pendiente'"; //agregar condicional servicio
              if (mysqli_query($conn,$actualizacion)){
                echo 
                "<div class = 'formulario'>
                  <p><b>Datos actualizados, pronto nos comunicaremos con usted</b></p>
                    <ul class = 'pregunta'>
                      <li>Nombre(s): </li>
                      <li>Apellido(s): </li>
                      <li>Correo electrónico: </li>
                      <li>Celular: </li>
                      <li>Servicio que solicita: </li>
                    </ul>
                    <ul class = 'respuesta'>
                      <li>". $nombre. "</li>
                      <li>". $apellidos. "</li>
                      <li>". $correo. "</li>
                      <li>". $celular. "</li>
                      <li>". $servicio. "</li>
                    </ul>
                  <a href='Ppal.html'>Finalizar</a>
                </div>";
              }else{
                echo "Error";
              }
            }
          }
        }else{
          $query = "INSERT INTO clientes 
                    (nombres, apellidos, correo_electronico, celular, servicio, estado)
                    VALUES ('{$nombre}','{$apellidos}','{$correo}','{$celular}','{$servicio}','Pendiente')";
          $conn->query($query);
          echo  
          "<div class = 'formulario'>
            <p><b>Esta es la información enviada:</b></p>
              <ul class = 'pregunta'>
                <li>Nombre(s): </li>
                <li>Apellido(s): </li>
                <li>Correo electrónico: </li>
                <li>Celular: </li>
                <li>Servicio que solicita: </li>
              </ul>
              <ul class = 'respuesta'>
                <li>". $nombre. "</li>
                <li>". $apellidos. "</li>
                <li>". $correo. "</li>
                <li>". $celular. "</li>
                <li>". $servicio. "</li>
              </ul>
              <a href='Ppal.html'>Finalizar</a>
          </div>";
        }
      //se cierra la conexión
      $conn->close();
      ?>
    </p>
  </body>
</html>
