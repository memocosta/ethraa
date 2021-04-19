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
    case 'forget':
        if (isset($_POST['submit'])) {
    
            $testMobile = isset($_POST['sMobile']) ? true : false;

            $regarray =  $_POST['val'];

            $user = array();
            $user = getUser($regarray['email']);

            if(!empty($user)) {
                $to  = $user['email']; // note the comma
                $subject = 'Biddest - Reset Password';
                $hashcode = ($user['id']*1234).'6a14fb38cafa0a0f771e58e95c69f7c3';

                $headers = "From: ". strip_tags($sAdmin['email']) . "\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

                $message = '<html><body>';
                $message .= '<div style="text-align:center;">';
                $message .= '<div style="text-align:center; margin:20px;">';
                $message .= '<a href="http://thebiddest.com/changePassword?id='.$hashcode.'">Click to Change Your Password</a>';
                $message .= '</div>';
                $message .= '</div>';
                $message .= '</body></html>';

                $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=320, target-densitydpi=device-dpi"/>
        <title>forgot password</title>

        <style type="text/css">
            /* Client-specific Styles */
            #outlook a { padding: 0; }  /* Force Outlook to provide a "view in browser" button. */
            body { width: 100% !important; }
            .ReadMsgBody { width: 100%; } 
            .ExternalClass { width: 100%; display:block !important; } /* Force Hotmail to display emails at full width */
            .ExternalClass p{margin: 0px!important;}
            /* Reset Styles */
            /* Add 100px so mobile switch bar doesn\'t cover street address. */
            body { background-color: #ececec; margin: 0; padding: 0; }
            p{margin:0px!important;}

            img { outline: none; text-decoration: none; display: block;}
            br, strong br, b br, em br, i br { line-height:100%; }
            h1, h2, h3, h4, h5, h6 { line-height: 100% !important; -webkit-font-smoothing: antialiased; }
            h1 a, h2 a, h3 a, h4 a, h5 a, h6 a { color: blue !important; }
            h1 a:active, h2 a:active,  h3 a:active, h4 a:active, h5 a:active, h6 a:active { color: red !important; }
            /* Preferably not the same color as the normal header link color.  There is limited support for psuedo classes in email clients, this was added just for good measure. */
            h1 a:visited, h2 a:visited,  h3 a:visited, h4 a:visited, h5 a:visited, h6 a:visited { color: purple !important; }
            /* Preferably not the same color as the normal header link color. There is limited support for psuedo classes in email clients, this was added just for good measure. */  
            table td, table tr { border-collapse: collapse; }
            .yshortcuts, .yshortcuts a, .yshortcuts a:link,.yshortcuts a:visited, .yshortcuts a:hover, .yshortcuts a span {
                color: black; text-decoration: none !important; border-bottom: none !important; background: none !important;
            }   /* Body text color for the New Yahoo.  This example sets the font of Yahoo\'s Shortcuts to black. */
            /* This most probably won\'t work in all email clients. Don\'t include code blocks in email. */
            code {
                white-space: normal;
                word-break: break-all;
            }




            /* mystyle*/


            @media only screen and (max-width: 600px) {
                .content {width: 95% !important;}
                .title{ font-size: 20px !important; font-weight: bold !important;}
                .headerImg{margin:0 auto !important; padding-left:0px !important;}
                .message{ padding-right: 15px !important; padding-left: 15px !important; font-weight: bold !important; color:#8A8989 !important; }
                .Button{width: 90% !important;}
                .ButtonContent a{font-weight: bold;}
                .contact-mail{width:100% !important;}
                .email{padding-left: 0!important;}

                body[yahoo].content {width: 95% !important;
                                     padding-top:20px !important; padding-right: 10px !important; padding-bottom: 20px !important; padding-left: 10px !important;}
                body[yahoo].headerImg{margin:0 auto !important; padding-left:0px !important;}
                body[yahoo].message{ padding-right: 15px !important; padding-left: 15px !important; font-weight: bold !important; color:#8A8989 !important;}
                body[yahoo].title{font-size: 20px !important; font-weight: bold !important;}
                body[yahoo].Button{width: 100% !important;}
                body[yahoo].ButtonContent a{font-weight: bold;}
                body[yahoo].contact-mail{width:100% !important;}
                body[yahoo].email{padding-left: 0!important;}


            }

            body {margin:0; padding:0; min-width: 100%!important; background-color: #f3f3f3;}
            .container{background-color:#f3f3f3; border-collapse: collapse; width:100%; table-layout: fixed; margin:0 auto;}
            .content{width: 600px;  background-color:#f3f3f3;border-collapse: collapse;margin:0 auto;}  
            .header{padding-top: 20px; padding-right: 10px; padding-bottom: 0px; padding-left: 10px; margin:0 auto; font-family:Arial, Helvetica, sans-serif; background-color:#f3f3f3;}
            .headerImg{ width:90%; max-width: 160px; padding-bottom: 10px; padding-left: 20px;}
            .bannerImg{  margin:0 auto; background-color: #fff;  padding-top: 0px; padding-right: 0px; padding-bottom: 20px; padding-left: 0px;}
            .bannerImg img{width:100%;}
            .title{font-family:Arial, Helvetica, sans-serif;  font-size: 20px; color:#036985; margin: 0 auto; padding-top: 0px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px; background-color: #fff; text-align:center;}
            .message{ font-family: Arial, Helvetica, sans-serif; font-size: 15px; color: #273554; background-color: #fff; padding-top: 5px; padding-right: 30px; padding-bottom: 5px; padding-left: 30px; line-height: 30px;}
            .foter{font-family: Arial, Helvetica, sans-serif; font-size: 14px; color:#fff;background-color: #f3f3f3;  padding-top: 30px; padding-right: 0px; padding-bottom: 35px; padding-left: 0px; border-bottom-left-radius: 3px; border-bottom-right-radius: 3px;}
            .foter a{color:#fff;  text-decoration: none;}
            .foter span {color:#fff; text-decoration: none;text-decoration: underline;border-bottom-left-radius: 3px; border-bottom-right-radius: 3px;-webkit-border-bottom-left-radius:3px; -webkit-border-bottom-right-radius:3px; -moz-border-bottom-left-radius:3px; -moz-border-bottom-right-radius:3px;}         
            .mail{text-align: center; padding: 0 2px 0 0;}
            .mail-address{text-align: center; padding: 0 0 0 2px;}
            .copyrights{color:#535353; font-size: 11px; padding-top: 10px;padding-right: 15px;padding-left: 15px;}
            .copyRights a {color:#8f8f95;  text-decoration: none;}
            .copyrights span{color:#8f8f95; text-decoration: none;text-decoration: underline;}
            .space{width: 5%;}
            .Hspace{height:30px;}
            .info{line-height: 150%;}

        </style>
        <!--[if (gte mso 9)|(IE)]>
   <style type="text/css">
       table {border-collapse: collapse;}
   </style>
   <![endif]-->
    </head>
    <body  yahoo="fix" bgcolor="#f3f3f3" style="margin: 0; padding: 0; min-width: 100%!important; background-color: #f3f3f3">
        <table  class="container" width="100%" bgcolor="#f3f3f3" border="0" cellpadding="0" cellspacing="0" style="background-color:#f3f3f3; border-collapse: collapse; table-layout: fixed; margin:0 auto;">
            <tr>
                <td>
                    <!--[if (gte mso 9)|(IE)]>
<table width="600" align="center" cellpadding="0" cellspacing="0" border="0">
<tr>
<td>
<![endif]-->

                    <table class="content" align="center" cellpadding="0" cellspacing="0" border="0" style="width: 600px; background-color:#f3f3f3; border-collapse: collapse; margin:0 auto; ">
                        <tr>
                            <td class="Hspace" style="background-color:#f3f3f3; height: 30px;">
                                &nbsp;
                            </td>
                        </tr>

                        <tr>
                            <td  colspan="3" class="header" style="padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin:0 auto; font-family:Arial, Helvetica, sans-serif; background-color:#ffffff;">
                                <img class="headerImg" src="https://thebiddest.com/pics/lo2.png"  width="90%"  height="auto" border="0" alt="EventXray" style="width:90%; max-width: 140px; padding-bottom: 0px;" />

                            </td>                          
                        </tr>
                        <tr>
                            <td  class="bannerImg" align="center"  style=" margin:0 auto; background-color: #fff;  padding-top: 0px; padding-right: 0px; padding-bottom: 20px; padding-left: 0px;">
                                <img  src="https://thebiddest.com/pics/password.png"  align="bottom"   border="0" alt="header" width="100%" />

                            </td>
                        </tr>
                        <tr>
                            <td class="title" align="center" style="font-family:Arial, Helvetica, sans-serif;  font-size: 35px; font-weight: bold; color:#606060; margin: 0 auto; padding-top: 0px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px; background-color: #fff;">
                                Forgot your password?
                            </td>
                        </tr>

                        <tr>
                            <td  class="message" align="center" style=" font-family: Arial, Helvetica, sans-serif; font-size: 16px; color: #273554; background-color: #fff; padding-top: 0px; padding-right: 30px; padding-bottom: 20px; padding-left: 30px; line-height: 30px;">
                                No need to worry,Click the button below to reset your password.
                            </td>

                        </tr>


                        <tr>
                            <td class="ButtonContainer"  bgcolor="#fff" style="background-color:#fff; padding-top: 10px; padding-right: 15px; padding-bottom: 40px; padding-left: 15px;
                                border-bottom-left-radius: 3px; border-bottom-right-radius: 3px;-webkit-border-bottom-left-radius:3px; -webkit-border-bottom-right-radius:3px; -moz-border-bottom-left-radius:3px; -moz-border-bottom-right-radius:3px;">
                                <table class="Button" border="0" cellpadding="0" cellspacing="0" width="220px"  align="center"  style="border-collapse: collapse; margin: 0 auto; background-color:#eb3427; width:220px; border-top-left-radius: 3px; border-top-right-radius: 3px; border-bottom-right-radius: 3px; border-bottom-left-radius: 3px;  -moz-border-radius:3px; -webkit-border-radius:3px;">
                                    <tr>
                                        <td align="center" valign="middle" class="ButtonContent" style="padding-top:15px; padding-right:30px; padding-bottom:15px; padding-left:30px; ">
                                            <a href="http://thebiddest.com/changePassword?id='.$hashcode.'" target="_blank" style="color:#FFFFFF; font-family:Arial,Helvetica, sans-serif; font-size:16px; font-weight:normal; text-decoration:none;"><span style="color:#fff;  text-decoration: none;">Reset password</span></a>

                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr>
                            <td   class="foter" align="center" bgcolor="#f3f3f3"  style=" font-family: Arial, Helvetica, sans-serif; font-size: 14px; color:#8f8f95;;background-color: #f3f3f3; padding-top: 0px; padding-right: 0px; padding-bottom: 35px; padding-left: 0px; border-bottom-left-radius: 3px; border-bottom-right-radius: 3px;-webkit-border-bottom-left-radius:3px; -webkit-border-bottom-right-radius:3px; -moz-border-bottom-left-radius:3px; -moz-border-bottom-right-radius:3px;">
                                <table>                                          
                                    <tr>
                                        <td align="center" style="padding: 20px 0 0 0;">
                                            <table border="0" cellspacing="0" cellpadding="0">
                                                <tr>

                                                    <td class="mail" style="text-align: center; padding: 0 2px 0 0;">
                                                        <span style="padding-right: 2px; padding-top: 3px;"><img   align="left"  width="15" src="https://thebiddest.com/pics/email.png" alt="mail" style=" padding-top: 2px;"/></span>
                                                    </td>
                                                    <td class="mail-address" style="text-align: center; padding: 0 0 0 2px;">
                                                        <span style="color:#606060;text-decoration: none;">thebiddest</span><span style="color:#606060;text-decoration: none;">.com</span>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center" class="copyrights" style="color:#535353; font-size: 13px; padding-top: 10px;padding-right: 15px;padding-left: 15px;">
                                            Copyright (c) 2016 <a href="{{--//main-website--link//--}}" style="color:#8f8f95;  text-decoration: none;"><span style="color:#8f8f95; text-decoration: none;text-decoration: underline;"> {{--//main-website-title//--}}</span></a>. All Rights Reserved.
                                        </td>
                                    </tr>
                                </table>

                            </td>
                        </tr>

                        <tr>
                            <td class="Hspace" bgcolor="#f3f3f3;" style="background-color:#f3f3f3; height: 30px;">
                                &nbsp;
                            </td>
                        </tr>
                    </table>


                    <!--[if (gte mso 9)|(IE)]>
</td>
</tr>
</table>
<![endif]-->
                </td>
            </tr>
        </table>
    </body>
</html>';

                mail($to, $subject, $message, $headers);

                $_SESSION['PasswordReset'] = true;
                echo '<script> location.replace("./forget"); </script>';
            } else {
                $_SESSION['wrong-submit'] = true;
                echo '<script> location.replace("./forget"); </script>';
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
    case 'addProduct':
        $testMobile = isset($_POST['sMobile']) ? true : false;

        $regarray =  $_POST['val'];

        if($product_id = addProduct($regarray)) {
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
            $title = 'The Biddest';
            // notification message
            $message = $regarray['name'];
            $push->setTitle($title);
            $push->setMessage($message);
            $push->setImage('');
            $push->setIsBackground(FALSE);
            $push->setPayload($payload);
            $tokens = selectTable('users_tokens', '');
            foreach ($tokens as $token) {
              $json = $push->getPush();
              $regId = $tokens['tokens'];
              $response = $firebase->send($regId, $json);
              echo json_encode($json).'<br>'.json_encode($response).'<br>';
            }
            echo '<script> location.replace("adminCP/products"); </script>';                    
        } else {
            $_SESSION['wrong-submit'] = true;
            echo '<script> location.replace("adminCP/add-product"); </script>';
        } 
        break;
    case 'updateProduct':    
        $testMobile = isset($_POST['sMobile']) ? true : false;

        $regarray =  $_POST['val'];
        $regarray['bids'] = (int)($regarray['price'] / $sAdmin['biddest_price']);

        $product_id = $_POST['product_id'];
        $where = "WHERE `id` = '".$product_id."'";

        if(updateTable('products', $regarray, $where)) {
            if (isMobile() || $testMobile) {
                header('Content-type: application/json');
                echo json_encode($c_product , JSON_UNESCAPED_UNICODE);
            } else {
                echo '<script> location.replace("adminCP/products"); </script>';
            }                       
        } else {
            if (isMobile() || $testMobile) {
                $error = array('message' => 'something Wrong');
                echo json_encode($error , JSON_UNESCAPED_UNICODE);
            } else {
                $_SESSION['wrong-submit'] = true;
                echo '<script> location.replace("adminCP/add-product?id='.$product_id.'"); </script>';
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
            if (isMobile() || $testMobile) {
                $slide = getSlide($slide_id);
                header('Content-type: application/json');
                echo json_encode($slide , JSON_UNESCAPED_UNICODE);
            } else {
                echo '<script> location.replace("adminCP/'.$_POST['link'].'"); </script>';
            }                       
        } else {
            if (isMobile() || $testMobile) {
                $error = array('message' => 'something Wrong');
                echo json_encode($error , JSON_UNESCAPED_UNICODE);
            } else {
                $_SESSION['wrong-submit'] = true;
                echo '<script> window.history.back(); </script>';
            }
        } 
        break;
    case 'updateRow':    
        $testMobile = isset($_POST['sMobile']) ? true : false;

        $regarray =  $_POST['val'];

        $slide_id = $_POST['slide_id'];
        $where = "WHERE `id` = '".$slide_id."'";

        if(updateTable($_POST['table'], $regarray, $where)) {
            if (isMobile() || $testMobile) {
                $slide = getSlide($slide_id);
                header('Content-type: application/json');
                echo json_encode($slide , JSON_UNESCAPED_UNICODE);
            } else {
                echo '<script> location.replace("adminCP/'.$_POST['link'].'"); </script>';
            }                       
        } else {
            if (isMobile() || $testMobile) {
                $error = array('message' => 'something Wrong');
                echo json_encode($error , JSON_UNESCAPED_UNICODE);
            } else {
                $_SESSION['wrong-submit'] = true;
                echo '<script> window.history.back(); </script>';
            }
        } 
        break;
    case 'updateBiddest':    
        $testMobile = isset($_POST['sMobile']) ? true : false;

        $regarray =  $_POST['val'];

        $slide_id = $_POST['slide_id'];
        $where = "WHERE `id` = '".$slide_id."'";

        if(updateTable('biddest', $regarray, $where)) {
            if (isMobile() || $testMobile) {
                $slide = getBiddest($slide_id);
                header('Content-type: application/json');
                echo json_encode($slide , JSON_UNESCAPED_UNICODE);
            } else {
                echo '<script> location.replace("adminCP/latest-biddest"); </script>';
            }                       
        } else {
            if (isMobile() || $testMobile) {
                $error = array('message' => 'something Wrong');
                echo json_encode($error , JSON_UNESCAPED_UNICODE);
            } else {
                $_SESSION['wrong-submit'] = true;
                echo '<script> location.replace("adminCP/add-biddest?id='.$slide_id.'"); </script>';
            }
        } 
        break;
    case 'updateCPanel':
        if (isset($_POST['submit'])) {
    
            $testMobile = isset($_POST['sMobile']) ? true : false;

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
