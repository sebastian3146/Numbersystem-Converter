<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Zahlensystem Konverter</title>
</head>
<body>
    <div class="background">
        <img src="img/planet_with_sunrise.jpg" id="bg-img">
    </div>

    <div class="container">
        <h2 class="title">Zahlensystem Konverter</h2>
    <?php
        $type_of_number_system;
        $is_number_set;

        $bin_warning;
        $hex_warning;

        //Prüfung auf Art des Zahlensystems
        if(!$_GET['input_number_decimal'] == '') {
            $type_of_number_system = 'dec';
            $is_number_set = true;
        }
        else if(!$_GET['input_number_binary'] == '') {
            $type_of_number_system = 'bin';
            $is_number_set = true;
        }
        else if(!$_GET['input_number_hex'] == '') {
            $type_of_number_system = 'hex';
            $is_number_set = true;
        }

        //Eingabe Prüfer
        if($type_of_number_system == 'bin') {
            if(trim($_GET['input_number_binary'], '0..1') != '') {
                $type_of_number_system = '';
                $bin_warning = true;
                $is_number_set = false;
            }
            if($_GET['input_number_binary'] > 111011100110101100101000000000) {

            }
        }
        if($type_of_number_system == 'hex') {
            if (trim($_GET['input_number_hex'], '0..9A..Fa..f') != '') {
                $type_of_number_system = '';
                $hex_warning = true;
                $is_number_set = false;
            }     
        }


        
        //Input
        if($is_number_set == false) {
            echo('
                <form method="GET" action="index.php" class="input_number">
                    <div class="input">
                    <p >
                        Dezimal: <input class="dec" name="input_number_decimal" type="number">
                    </p>
                    <p>
                        Binär: <input class="bin" name="input_number_binary" type="number">
                    </p>
                    ');
                    if($bin_warning == true) echo('<p class="bin_warning">Eine Binäre Zahl darf nur 0er oder 1en beinhalten!</p>');
                    echo('
                    <p>
                        Hexadezimal: <input class="hex" name="input_number_hex" type="text">
                    </p>
                    ');
                    if($hex_warning == true) echo('<p class="hex_warning">Ungültige Zeichen sind in dieser Hexadezimalen Zahl drinnen!</p>');
                    echo('
                    </div>
                    <input type="submit" value="konvertieren" class="submit">
                </form>
            ');
        }
        
        //Ausgabe der Ergebnisse
        if($type_of_number_system == 'dec') {
            echo('
                <div class="output">
                <p>
                    Dezimal:<span class="dec" style="color:blue">'.$_GET['input_number_decimal'].'</span>
                </p>
                <p>
                    Binär:<span class="bin">0b'.base_convert($_GET['input_number_decimal'], 10, 2).'</span>
                </p>
                <p>
                    Hexadezimal:<span class="hex">0x'.base_convert($_GET['input_number_decimal'], 10, 16).'</span>
                </p>
                </div>
            ');
        } else if($type_of_number_system == 'bin') {
            echo('
                <div class="output">
                <p>
                    Dezimal:<span class="dec">'.base_convert($_GET['input_number_binary'], 2, 10).'</span>
                </p>
                <p>
                    Binär:<span class="bin" style="color:blue">0b'.$_GET['input_number_binary'].'</span>
                </p>
                <p>
                    Hexadezimal:<span class="hex">0x'.base_convert($_GET['input_number_binary'], 2, 16).'</span>
                </p>
                </div>
            ');
        } else if($type_of_number_system == 'hex') {
            echo('
                <div class="output">
                <p>
                    Dezimal:<span class="dec">'.base_convert($_GET['input_number_hex'], 16, 10).'</span>
                </p>
                <p>
                    Binär:<span class="bin">0b'.base_convert($_GET['input_number_hex'], 16, 2).'</span>
                </p>
                <p>
                    Hexadezimal:<span class="hex" style="color:blue">0x'.$_GET['input_number_hex'].'</span>
                </p>
                </div>
            ');
        }

        //Reset
        if($is_number_set == true) echo('<button class="reset"><a href="/numbersystem_converter/index.php">reset</a></button>');
    ?>

    <div class="hint">
        <p><p class="hint_format">Hinweis:</p>Dieser Konverter kann nicht sehr große Zahlen konvertieren, da die Funktion <a href="https://www.php.net/manual/en/function.base-convert.php" class="php_link">"base_convert"</a> es nicht zulässt.</p>
    </div>
</body>
</html>