<!doctype html>
<html>
    <head>
        <title>Webdoos Controlpanel | Ftp-tool</title>
        <link rel="stylesheet" type="text/css" href="/assets/vendor/foundation/6.0/css/foundation.min.css">
        <link rel="stylesheet" type="text/css" href="/assets/vendor/nucleo/2.3/outline/css/nucleo-outline.css">
        <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="/assets/css/login.css">
        <link rel="stylesheet" href="../vendor/Ladda-master/dist/ladda.min.css">
    </head>
    <body>
        <?php if (empty($totalArray)) { ?>
<!--            <div class="large-3 large-centered columns">
                <div class="row">
                    <div class="large-12 columns">
                        <form action="" method="post" >
                            <div class="row">
                                <div class="large-12 columns">
                                    <div class="input-group">
                                        <p>DEV SERVER </br></p>
                                        <p>IP </br> 
                                            <input type="text" name="ipDEV"/>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="large-12 columns">
                                    <div class="input-group">
                                        <p>USER </br>
                                            <input type="text" name="idDEV"/>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="large-12 columns">
                                    <div class="input-group">
                                        <p>PW </br>
                                            <input type="text" name="pwDEV"/>
                                        </p> 
                                        </br>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="large-12 columns">
                                    <div class="input-group">
                                        <p>LIVE SERVER </br></p>
                                        <p>IP </br> 
                                            <input type="text" name="ipLIVE"/>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="large-12 columns">
                                    <div class="input-group">
                                        <p>USER </br>
                                            <input type="text" name="idLIVE"/>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="large-12 columns">
                                    <div class="input-group">
                                        <p>PW </br>
                                            <input type="text" name="pwLIVE"/>
                                        </p> 
                                    </div>
                                </div>
                            </div>
-->                            <div class="row">
                                <div class="large-12 large-centered columns">                           
                                    <button type="submit" class="ladda-button"  data-style="expand-right">Submit</button>
                                </div>
                            </div><!--
                        </form>
                    </div>
                </div>
            </div>-->

            <?php

//            if (!empty($message)) {
//                echo '<div class="large-3 large-centered columns">';
//                echo '<div class="row">';
//                echo '<div class="large-12 columns">';
//                echo '<div class="input-group">';
//                echo '<p>' . $message . '</p>';
//                echo '</div>';
//                echo '</div>';
//                echo '</div>';
//                echo '</div>';
            }
            ?>

            <?php
            ini_set('display_errors', 1);
            error_reporting(E_ALL);
            ini_set('max_execution_time', 0);
        } else {

            $url = $_SERVER['REQUEST_URI'];
            if ($url == '/controle-webdoos-io/ftp/' || $url == '/controle-webdoos-io/ftp/index') {
                echo'<form name="myform" method="post" action="test">';
            } else {
                echo'<form name="myform" method="post" action="ftp/test">';
            }

            echo '<div class="row">';
            echo '<div class="small-6 large-centered columns">';
            echo '<table style="width: 100%">';
            echo '<tr>';
            echo '<th class="text-left">' . 'DEV' . '</th>';
            echo '<th class="text-right">' . 'LIVE' . '</th>';
            echo '<th class="text-right">' . 'Status' . '</th>';
            echo '<th class="text-right"></th>';
            echo '</tr>';

            foreach ($totalArray as $row) {
                echo '<tr>';
                echo '<td class="text-left"><span>' . $row[0] . '</span></td>';
                echo '<td class="text-right"><span>' . $row[1] . '</span></td>';
                echo '<td class="text-right">' . $row[2] . '</td>';
                echo '<td class="text-right"><input type="checkbox"  id="required-checkbox"  name="check_list[]" value="' . htmlspecialchars(json_encode($row[0])) . '"/></td>';
                echo '</tr>';
            }
            echo '</table>';
            echo '</div>';
            echo '</div>';

            echo '</br>';
            echo '<div class="row">';
            echo '<div class="small-6 large-centered columns">';
            echo '<div class="row">';

// send back the array with all the files          
            echo'<input type="hidden" name="dataFiles" value="' . htmlspecialchars(json_encode($totalArray)) . '">';

// send back the array with the ftp login information
            unset($ftpCredentials[6]);
            unset($ftpCredentials[7]);
            foreach ($ftpCredentials as $row) {
                echo'<input type="hidden" name="ftpCredentials[]" value="' . $row . '">';
            }
// send back the array with all the directories
            foreach ($dirArray as $row) {
                echo'<input type="hidden" name="dirArray[]" value="' . $row . '">';
            }
            echo'<div class="small-8 columns">';
            
            
                    
            echo'<button input type="submit" id="submit" class="ladda-button" name="submit" value ="Upload" data-style="expand-right">Upload</button>';

            
            
            ?>
            <input type="button" class="button" name="Check_All" value="Check All" onClick="CheckAll(document.myform.check_list[])">
        </div>
        <div class="small-4 columns text-right">
            <input type="button" class="button" name="Un_CheckAll" value="Uncheck All" onClick="UnCheckAll(document.myform.check_list[])">
        </div>
    <?php
    echo'</form>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}
?>
</body>
</html>

<script type='text/javascript'>
    $(document).ready(function () {
        var $submit = $('#submit');
        $submit.prop('disabled', true);
        
        $('input[name="Check_All"]').click(function () {

            $('input[name^="check_list"]').prop('checked', true);
            $submit.removeAttr('disabled');

        });
        $('input[name="Un_CheckAll"]').click(function () {

            $('input[name^="check_list"]').prop('checked', false);
            $submit.prop('disabled', true);

        });
    });
</script>

<script src="../vendor/Ladda-master/dist/spin.min.js"></script>
<script src="../vendor/Ladda-master/dist/ladda.min.js"></script>
<script> Ladda.bind('button[type=submit]');</script>

<script type='text/javascript'>
var $submit = $('#submit');
$checkbox = $('input[type=checkbox]');

$submit.prop('disabled', true);

$checkbox.on('click', function(){
    if ($("input:checkbox:checked").length > 0) {
        $submit.removeAttr('disabled');
    }else{
        $submit.prop('disabled', true);
    }
});
</script>



