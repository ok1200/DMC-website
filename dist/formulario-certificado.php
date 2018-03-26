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

            <label class="Form_label" for="cedula">Cédula</label>
            <input required type="text" name="cedula" value="" class="form-control Form_input" id="nombre" placeholder="Ejemplo: 1039234567">            

            <label class="Form_label" for="email">Email</label>
            <input required type="email" name="email" value="" class="form-control Form_input" id="email" placeholder="carolinamontenegro@gmail.com">

            <label class="Form_label" for="telefono">Teléfono</label>
            <input required type="number" name="telefono" value="" class="form-control Form_input" id="telefono" placeholder="312 728 38 14">

            <h5 class="mt-4 py-0 mb-0 Contacto_form-title Color_subtitle">Certificados:</h5>
            <small class="Campos-necesarios mb-2">(Elige los certificados que deseas solicitar)</small>
            <div class="Contorno-checkbox">
                <div class="Form-group">
                    <input type="checkbox" class="Check_input" name="check"  aria-label="Checkbox"><label for="check" class="Check_label">Básico Administrativo en Trabajo Seguro en Alturas</label> 
                </div>
                <div class="Form-group">
                    <input type="checkbox" class="Check_input" name="check"  aria-label="Checkbox"><label for="check" class="Check_label">Básico Operativo en Trabajo Seguro en Alturas</label> 
                </div>
                <div class="Form-group">
                    <input type="checkbox" class="Check_input" name="check"  aria-label="Checkbox"><label for="check" class="Check_label">Avanzado en Trabajo Seguro en Alturas</label> 
                </div>
                <div class="Form-group">
                    <input type="checkbox" class="Check_input" name="check"  aria-label="Checkbox"><label for="check" class="Check_label">Reentrenamiento en Trabajo Seguro en Alturas</label> 
                </div>                                                
                <div class="Form-group">
                    <input type="checkbox" class="Check_input" name="check"  aria-label="Checkbox"><label for="check" class="Check_label">Coordinador de Trabajo Seguro en Alturas</label> 
                </div>
                <div class="Form-group">
                    <input type="checkbox" class="Check_input" name="check"  aria-label="Checkbox"><label for="check" class="Check_label">Armado y Desarmado de Andamios</label> 
                </div>
            </div>
            
            <small class="Campos-necesarios">*Todos los campos son necesarios</small>

            <input type="checkbox" class="Check_input" name="check"  aria-label="Checkbox" required><label for="check" class="Check_label"> Acepto<a href="" target="_blank" class="Check_input Check_input-link">política de tratamiento de datos</a></label>

            <div class="text-center">
                <button id="submit" class="Button Button_form Busqueda-certificado_btn" type="submit">Solicitar</button>
            </div>
            
            </form>
            <?php
    }
    
  
    else{
        
        // Variables donde se guardan los datos del formulario
        $servicio=$_REQUEST['servicio'];
        $empresa=$_REQUEST['empresa'];
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
            $mail->Username = 'contacto@dcmservicios.com';             //***EDITAR*** Nombre de usuario SMTP donde debe ir la cuenta de correo a utilizar para el envio
            $mail->Password = 'wy3HLJFnss0E';              //***EDITAR*** Clave SMTP donde debe ir la clave de la cuenta de correo a utilizar para el envio
            $mail->SMTPSecure = 'ssl';                            // Habilitar encriptacion
            $mail->Port = 465;                                    // Puerto SMTP
            
            $mail->setFrom($email);     //***EDITAR*** Direccion de correo remitente
            $mail->addAddress('contacto@dcmservicios.com'); //***EDITAR*** Agregar eldestinatario
            
            $mail->addBCC($email);                          // Direccion con copia del envío 
            
            $mail->addReplyTo('contacto@dcmservicios.com');     //***EDITAR*** Direccion de correo para respuestas
            
            $mail->isHTML(true);                                  // Habilitar contenido HTML
            
            $mail->Subject = 'Nueva solicitud de certificado en dcmservicios.com'; //***EDITAR*** Asunto del mensaje . No debe tener tildes o estar escrito todo en Mayusculas
            $mail->Body    ='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
                                "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                                <html xmlns="http://www.w3.org/1999/xhtml">
                                <head></head>
                                <body>
                                <table>
                                    <th style="font-size:24px">Nueva solicitud de certificado - DCM</th>
                                </table>
                                <table>
                                    <tr><td>Servicio</td><td></td><td>' . $servicio . '</td></tr>
                                    <tr><td>Nombre</td><td></td><td>' . $nombre . '</td></tr>
                                    <tr><td>Email</td><td></td><td>' . $email . '</td></tr>
                                    <tr><td>Telefono</td><td></td><td>' . $telefono . '</td></tr>
                                    <tr><td>Empresa</td><td></td><td>' . $empresa . '</td></tr> 
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
