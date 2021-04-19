<?php

$key = $_GET['key'];

switch($key) {
    case 'login':
        if (isset($_POST['submit'])) {
    
            $testMobile = isset($_POST['sMobile']) ? true : false;

            $regarray =  $_POST['val'];

            $regarray['pass'] = md5($regarray['pass']);

            if($user = login($regarray)) {
                $_SESSION['email'] = $regarray['email'];
                $_SESSION['pass'] = $regarray['pass'];
                if (isset($_POST['keep'])) {
                    setcookie('biddest_email', $regarray['email'], time() + 30*24*60*60, '/');
                    setcookie('biddest_pass', $regarray['pass'], time() + 30*24*60*60, '/');
                }
                echo '<script> location.replace("./"); </script>';   
            } else {
                $_SESSION['wrong-submit'] = true;
                echo '<script> location.replace("./login"); </script>';
            } 
        }
        break;
    case 'login-admin':
        if (isset($_POST['submit'])) {
    
            $testMobile = isset($_POST['sMobile']) ? true : false;

            $regarray =  $_POST['val'];

            $regarray['pass'] = md5($regarray['pass']);

            $regarray['admin'] = 1;

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
    case 'signup':
        if (isset($_POST['submit'])) {
    
            $testMobile = isset($_POST['sMobile']) ? true : false;

            $regarray =  $_POST['val'];

            $regarray['pass'] = md5($regarray['pass']);

            $regarray['birth_date'] = strtotime($regarray['birth_date']);

            if($user_id = signup($regarray)) {
                $_SESSION['email'] = $regarray['email'];
                $_SESSION['pass'] = $regarray['pass'];
                setcookie('biddest_email', $regarray['email'], time() + 30*24*60*60, '/');
                setcookie('biddest_pass', $regarray['pass'], time() + 30*24*60*60, '/');
                echo '<script> location.replace("./"); </script>';   
            } else {
                $_SESSION['wrong-submit'] = true;
                echo '<script> location.replace("./register"); </script>';
            } 
        }
        break;
    case 'update':
        if (isset($_POST['submit'])) {
    
            $testMobile = isset($_POST['sMobile']) ? true : false;

            $regarray =  $_POST['val'];

            $regarray['pass'] = md5($regarray['pass']);

            if (isset($regarray['birth_date'])) {
                $regarray['birth_date'] = strtotime($regarray['birth_date']);
            }            

            $userID = (isset($_POST['user_id'])) ? $_POST['user_id'] : $sUser['id'];
            $where = "WHERE `id` = '".$userID."'";

            if($user_id = updateTable('users', $regarray, $where)) {
                $_SESSION['email'] = $regarray['email'];
                $_SESSION['pass'] = $regarray['pass'];
                setcookie('biddest_email', $regarray['email'], time() + 30*24*60*60);
                setcookie('biddest_pass', $regarray['pass'], time() + 30*24*60*60);
                echo '<script> location.replace("./"); </script>';  
            } else {
                $_SESSION['wrong-submit'] = true;
                echo '<script> location.replace("./account"); </script>';
            } 
        }
        break;
    case 'logout':
        unset($_SESSION['email']);
        unset($_SESSION['pass']);
        setcookie('biddest_email', '', time() + 30*24*60*60);
        setcookie('biddest_pass', '', time() + 30*24*60*60);
        echo '<script> location.replace("./"); </script>';
        break;
    case 'logout-admin':
        unset($_SESSION['admin']);
        echo '<script> location.replace("./"); </script>';
        break;
    case 'buy':
        if (isset($_POST['submit'])) {
    
            $testMobile = isset($_POST['sMobile']) ? true : false;

            $regarray =  array();

            $regarray['bids'] = $_POST['val']['bids'] + $sUser['bids'];
            $regarray['active'] = 1;

            $where = "WHERE `id` = '".$sUser['id']."'";

            if($user_id = updateTable('users', $regarray, $where)) {
                echo '<script> location.replace("./"); </script>';          
            } else {
                echo '<script> location.replace("./buy"); </script>';
            } 
        }
        break;
    case 'addSlide':
        $testMobile = isset($_POST['sMobile']) ? true : false;

        $regarray =  $_POST['val'];

        if($slide_id = insertTable('slide', $regarray)) {
            if (isMobile() || $testMobile) {
                $slide = getSlide($slide_id);
                header('Content-type: application/json');
                echo json_encode($slide , JSON_UNESCAPED_UNICODE);
            } else {
                echo '<script> location.replace("adminCP/slider"); </script>';
            }                       
        } else {
            if (isMobile() || $testMobile) {
                $error = array('message' => 'something Wrong');
                echo json_encode($error , JSON_UNESCAPED_UNICODE);
            } else {
                $_SESSION['wrong-submit'] = true;
                echo '<script> location.replace("adminCP/add-slide"); </script>';
            }
        } 
        break;
    case 'updateSlide':    
        $testMobile = isset($_POST['sMobile']) ? true : false;

        $regarray =  $_POST['val'];

        $slide_id = $_POST['slide_id'];
        $where = "WHERE `id` = '".$slide_id."'";

        if(updateTable('slide', $regarray, $where)) {
            if (isMobile() || $testMobile) {
                $slide = getSlide($slide_id);
                header('Content-type: application/json');
                echo json_encode($slide , JSON_UNESCAPED_UNICODE);
            } else {
                echo '<script> location.replace("adminCP/slider"); </script>';
            }                       
        } else {
            if (isMobile() || $testMobile) {
                $error = array('message' => 'something Wrong');
                echo json_encode($error , JSON_UNESCAPED_UNICODE);
            } else {
                $_SESSION['wrong-submit'] = true;
                echo '<script> location.replace("adminCP/add-slide?id='.$slide_id.'"); </script>';
            }
        } 
        break;
    case 'addRow':
        $testMobile = isset($_POST['sMobile']) ? true : false;

        $regarray =  $_POST['val'];

        if($slide_id = insertTable($_POST['table'], $regarray)) {
            echo '<script> location.replace("admin/'.$_POST['link'].'"); </script>';                 
        } else {
            $_SESSION['wrong-submit'] = true;
            echo '<script> window.history.back(); </script>';
        } 
        break;
    case 'updateRow':    
        $testMobile = isset($_POST['sMobile']) ? true : false;

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
        $testMobile = isset($_POST['sMobile']) ? true : false;

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
    
            $testMobile = isset($_POST['sMobile']) ? true : false;

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
    case 'addOption':
        if (isset($_POST['submit'])) {
          $table = $_POST['table'];
          $regarray =  $_POST['val'];
          $regarray['all'] = 3;
          if($slide_id = insertTable($table, $regarray)) {
            error_reporting(-1);
            ini_set('display_errors', 'On');
            require_once __DIR__ . '/firebase.php';
            require_once __DIR__ . '/push.php';
            $firebase = new Firebase();
            $push = new Push();
            // optional payload
            $payload = array();
            $payload['team'] = 'India';
            $payload['score'] = '5.6';
            // notification title
            $title = $regarray['title'];
            // notification message
            $message = $regarray['message'];
            $push->setTitle($title);
            $push->setMessage($message);
            $push->setImage('');
            $push->setIsBackground(FALSE);
            $push->setPayload($payload);
            foreach ($_POST['token'] as $token) {
              $json = $push->getPush();
              $regId = $token;
              //echo $token.'<br>';
              $response = $firebase->send($regId, $json);
              echo json_encode($json).'<br>'.json_encode($response).'<br>';
            }
            echo '<script> location.replace("adminCP/notifications"); </script>';
          }
          else {
            $_SESSION['wrong-submit'] = true;
            echo '<script> window.history.back(); </script>';
          }
        }
        break;
    case 'lang':
        $lang = $_GET['lang'];
        setcookie('biddest_lang', $lang, time() + 365*24*60*60);
        echo '<script> window.history.back(); </script>';
        break;
    case 'contact':
        echo '<script> location.replace("./"); </script>';
        break;
    case 'subscribe':
        echo '<script> location.replace("./"); </script>';
        break;
    case 'country':
    case 'avatar':
    case 'gender':
        $table = $key;
        $result = selectTable($table, '');
        echo json_encode($result , JSON_UNESCAPED_UNICODE);
        break;
    default:
        
}

?>
