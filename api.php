<?php

$key = $_GET['key'];

switch($key) {
    case 'login-admin':
        if (isset($_POST['submit'])) {
    
            $regarray =  $_POST['val'];

            if($user = login($regarray)) {
                $_SESSION['admin'] = 1;
                $_SESSION['expired_admin'] = time() + 500;
                echo '<script> window.history.back(); </script>';  
            } else {
                $_SESSION['wrong-submit'] = true;
                echo '<script> window.history.back(); </script>';
            } 
        }
        break;
    case 'logout':
        unset($_SESSION['admin']);
        echo '<script> location.replace("./"); </script>';
        break;
    case 'addRow':
        $regarray =  $_POST['val'];

        if($slide_id = insertTable($_POST['table'], $regarray)) {
            echo '<script> location.replace("admin/'.$_POST['link'].'"); </script>';                 
        } else {
            $_SESSION['wrong-submit'] = true;
            echo '<script> window.history.back(); </script>';
        } 
        break;
    case 'updateRow':    
        $regarray =  $_POST['val'];

        $slide_id = $_POST['row_id'];
        $where = "WHERE `id` = '".$slide_id."'";

        if(updateTable($_POST['table'], $regarray, $where)) {
            echo '<script> location.replace("admin/'.$_POST['link'].'"); </script>';                 
        } else {
            $_SESSION['wrong-submit'] = true;
            echo '<script> window.history.back(); </script>';
        } 
        break;
    case 'deleteRow':    
        $where = "WHERE `id` = '".$_GET['id']."'";

        if(deleteTable($_GET['table'], $where)) {
            echo '<script> window.history.back(); </script>';                
        } else {
            $_SESSION['wrong-submit'] = true;
            echo '<script> window.history.back(); </script>';
        } 
        break;
    case 'updateCPanel':
        if (isset($_POST['submit'])) {
    
            $regarray =  $_POST['val'];

            $where = "WHERE `id` = '1'";

            if(updateTable('cpanel', $regarray, $where)) {
                echo '<script> window.history.back(); </script>';                         
            } else {
                $_SESSION['wrong-submit'] = true;
                echo '<script> window.history.back(); </script>';
            } 
        }
        break;
    case 'addPartner':
        $target_dir = "img/logos/";
        $target_file = $target_dir . basename($_FILES["img"]["name"]);
        $regarray = array();

        if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
            $regarray['img'] = htmlspecialchars( basename( $_FILES["img"]["name"]));
            if($slide_id = insertTable('partner', $regarray)) {
                echo '<script> location.replace("admin/partner"); </script>';                 
            } else {
                $_SESSION['wrong-submit'] = true;
                echo '<script> window.history.back(); </script>';
            } 
        } else {
            $_SESSION['wrong-submit'] = true;
            echo '<script> window.history.back(); </script>';
        }
        break;
    case 'updatePartner':    
        $target_dir = "img/logos/";
        $target_file = $target_dir . basename($_FILES["img"]["name"]);
        $regarray = array();

        $slide_id = $_POST['row_id'];
        $where = "WHERE `id` = '".$slide_id."'";

        if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
            $regarray['img'] = htmlspecialchars( basename( $_FILES["img"]["name"]));
            if(updateTable('partner', $regarray, $where)) {
                echo '<script> location.replace("admin/partner"); </script>';                 
            } else {
                $_SESSION['wrong-submit'] = true;
                echo '<script> window.history.back(); </script>';
            }
        } else {
            $_SESSION['wrong-submit'] = true;
            echo '<script> window.history.back(); </script>';
        }
        break;
    case 'contact':
        if (isset($_POST['submit'])) {
    
            $regarray =  $_POST['val'];

            $to  = $sAdmin['email']; // note the comma
            $subject = $regarray['name'];

            $headers = "From: ". strip_tags($regarray['email']) . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

            $message = '<html><body>';
            $message .= '<div style="text-align:center;">';
            $message .= $regarray['name'].'<br><br>'.$regarray['phone'].'<br><br>'.$regarray['message'];
            $message .= '</div>';
            $message .= '</body></html>';

            if(mail($to, $subject, $message, $headers)){
                echo '<script> location.replace("./contact"); </script>';
            } else {
                $_SESSION['wrong-submit'] = true;
                echo '<script> location.replace("./contact"); </script>';
            }
        }
        break;
    default:
        
}

?>
