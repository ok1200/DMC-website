<?php
    require 'libs/PHPMailerAutoload.php';
    $action=$_REQUEST['action'];
   
    if ($action==""){
            ?>
            <!-- Campos del formulario editables -->
            <form  action="" method="POST" enctype="multipart/form-data">

            <input type="hidden" name="action" value="submit">

            <label class="Form_label" for="nombre">Nombre</label>
            <input required type="text" name="nombre" value="" class="form-control Form_input" id="nombre" placeholder="Carolina Montenegro">

            <label class="Form_label" for="email">Email</label>
            <input required type="email" name="email" value="" class="form-control Form_input" id="email" placeholder="carolinamontenegro@gmail.com">

            <label class="Form_label" for="telefono">Teléfono</label>
            <input required type="number" name="telefono" value="" class="form-control Form_input" id="telefono" placeholder="312 728 38 14">

            <label class="Form_label" for="mensaje">Mensaje</label>
            <textarea required type="text" name="mensaje" rows="4" cols="50" class="form-control Form_input" id="mensaje" placeholder="Escribe tu mensaje..."></textarea>
            <small class="Campos-necesarios">*Todos los campos son necesarios</small>

            <input type="checkbox" class="Check_input" name="check"  aria-label="Checkbox" required><label for="check" class="Check_label"> Acepto<a href="" target="_blank" class="Check_input Check_input-link">política de tratamiento de datos</a></label>

            <button id="submit" class="Button Busqueda-certificado_btn contacto_btn" type="submit">Enviar</button>
            
            </form>
            <?php
    }
    
  
    else{
        
        // Variables donde se guardan los datos del formulario 
        $nombre=$_REQUEST['nombre'];
        $email=$_REQUEST['email'];
        $telefono=$_REQUEST['telefono'];
        $mensaje=$_REQUEST['mensaje'];

           
            $mail = new PHPMailer;
        // Condicional de campos vacíos 
        if (($nombre=="")||($telefono=="")||($email=="")||($mensaje=="")){
        echo "Hay campos vacíos, por favor llenar los campos requeridos con * <a href=\"\">Volver</a>.";
      }
      else{ 
     
        
           
        
            //$mail->SMTPDebug = 4;                               // Habilitar el debug
            
            //$mail->isSMTP();                                      // Usar SMTP
            $mail->Host = 'mail.dcmservicios.com';  //***EDITAR*** Especificar el servidor SMTP reemplazando por el nombre del servidor donde esta alojada su cuenta
            $mail->SMTPAuth = true;                               // Habilitar autenticacion SMTP
            $mail->Username = 'info@dcmservicios.com';             //***EDITAR*** Nombre de usuario SMTP donde debe ir la cuenta de correo a utilizar para el envio
            $mail->Password = 'wy3HLJFnss0E';              //***EDITAR*** Clave SMTP donde debe ir la clave de la cuenta de correo a utilizar para el envio
            $mail->SMTPSecure = 'ssl';                            // Habilitar encriptacion
            $mail->Port = 465;                                    // Puerto SMTP
            
            $mail->setFrom($email);     //***EDITAR*** Direccion de correo remitente
            $mail->addAddress('contacto@dcmservicios.com'); //***EDITAR*** Agregar eldestinatario
            
            $mail->addBCC($email);                          // Direccion con copia del envío 
            
            $mail->addReplyTo('contacto@dcmservicios.com');     //***EDITAR*** Direccion de correo para respuestas
            
            $mail->isHTML(true);                                  // Habilitar contenido HTML
            
            $mail->Subject = 'Contacto en dcmservicios.com'; //***EDITAR*** Asunto del mensaje . No debe tener tildes o estar escrito todo en Mayusculas
            $mail->Body    ='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
                                "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                                <html xmlns="http://www.w3.org/1999/xhtml">
                                <head></head>
                                <body>
                                <table>
                                    <th style="font-size:24px">Nueva Consulta de Contacto - DCM</th>
                                </table>
                                <table>
                                    <tr><td>Nombre</td><td></td><td>' . $nombre . '</td></tr>
                                    <tr><td>Email</td><td></td><td>' . $email . '</td></tr>
                                    <tr><td>Telefono</td><td></td><td>' . $telefono . '</td></tr>  
                                    <tr><td>Mensaje</td><td></td><td>' . $mensaje . '</td></tr>
                                </table>
                                </body>
                                </html>'; // Contenido del mensaje.
            
            if(!$mail->send()) {
                echo 'El mensaje no pudo ser enviado';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo "<p class='done-message'>Tu mensaje ha sido enviado exitosamente!</p>";
            }
        
        }
          
    
  }
?>

