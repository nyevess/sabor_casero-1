<?php
include("pdo/conex.php");
try{
session_start();
$user=htmlentities(addslashes($_POST['user']));
$clave=htmlentities(addslashes($_POST['clave']));
$contador=0;



$cliente="SELECT * FROM usuarios WHERE email= :user AND id_rol=3";
$consulta=$base->prepare($cliente);
$consulta->execute(array(":user"=>$user));

    while ($existe_cliente=$consulta->fetch(PDO::FETCH_ASSOC)) {
        if (password_verify($clave, $existe_cliente['clave'])) {
            $contador++;
        }
    }

    if ($contador>0) {
        $_SESSION['username'] = $user;
        header('location: cliente_dentro.php');

    }else if($contador==0){
      
            $dependiente="SELECT * FROM usuarios WHERE email= :user AND id_rol=2";
            $consulta_depen=$base->prepare($dependiente);
            $consulta_depen->execute(array(":user"=>$user));
            
            while ($existe_depen=$consulta_depen->fetch(PDO::FETCH_ASSOC)) {
                if (password_verify($clave, $existe_depen['clave'])) {
                    $contador++;
                }
            }
                if ($contador>0) {
                    $_SESSION['username2'] = $user;
                   
                    header('location: dependiente_dentro.php');
                }
                else if ($contador==0) {
                   
                 
                    $gerente="SELECT * FROM usuarios WHERE email= :user AND id_rol=1";
                    $consulta_geren=$base->prepare($gerente);
                    $consulta_geren->execute(array(":user"=>$user));
        
                    while ($existe_geren=$consulta_geren->fetch(PDO::FETCH_ASSOC)) {
                        if (password_verify($clave, $existe_geren['clave'])) {
                            $contador++;
                        }
                    }
        
                    if ($contador>0) {
                        $_SESSION['username3'] = $user;
                        header('location: gerente_dentro.php');
                    }else{
                        header('location:nologin.php');
                       
                    }
                }
            }
        
  

        }catch(Exception $e){
   //en el bloque del catch nos mostrará los errores que se hayan producido en el try, y nos devuelve el código del error
   die("error: " . $e->GetMessage());
    
    }finally{
        //este bloque lo ejecutará siempre, osea siempre que haga o no haga lo que hay en try cojera la conexion y la cerrará
        $base=null;
    }
    
?>






