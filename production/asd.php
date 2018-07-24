<?php

$a = date("H:i:s");

$s=array('a','b','c','d','e','f');
$s_to_json=json_encode((array)$s);

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>BT Printer</title>
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i,900,900i&amp;subset=cyrillic" rel="stylesheet">
    <link href="../vendors/bootstrap/dist/css/bootstrap.css" rel="stylesheet">

    <style>
        html {text-align: center;background-color: #444444;margin: 0;padding: 0}
        body {
            font-family: 'Roboto', sans-serif;
            max-width:1024px;margin:0 auto;
            text-align: left;
            background-color: white;
            padding:8px;
            font-size:17px;
        }
        h1,h2{text-align: center}
        blockquote {background:#eee;padding:8px;margin:4px 0;font-size:12px;}
        img {max-width:100%}
        .btn, button {background-color: darkgreen;color:white;padding: 16px;border:1px solid green}
  .btn{display:inline-block;text-decoration:none}

@media print {
    html,body{margin:0;padding:10px;  
        font-size:32px;
    }
    body{
        width : 640px; 
    }
    blockquote {background:#fff;border-left:4px solid #222; font-size:22px;}
    a {color:#000}  
    
}
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>

    function chr(x){
        return String.fromCharCode(x);
    }
    // symbolic
    var ESC = chr(27);
    var LF = chr(10);

    var PrnAlignLeft = ESC+'a'+chr(0);
    var PrnAlignCenter = ESC+'a'+chr(1);
    var PrnAlignRight = ESC+'a'+chr(2);
    var PrnItalic = ESC+chr(4);
    var PrnBoldOn = ESC+'G'+chr(1);
    var PrnBoldOff = ESC+'G'+chr(0);
    var fromPHP=<?php echo $s_to_json ?>;
    
    // send to print
    function BtPrint(prn){
        var S = "#Intent;scheme=rawbt;";
        var P =  "package=ru.a402d.rawbtprinter;end;";
        var textEncoded = encodeURI(prn);
        window.location.href="intent:"+textEncoded+S+P;
    }

function slip(){
        // собираем чек
        var prn = '';

        for (var i = 0; i < fromPHP.length; i++) {
            prn += PrnAlignRight+<?php echo json_encode($a) ?>+LF;
        }

        prn += <?php echo json_encode($a) ?>+LF;
        prn += PrnAlignLeft+ 'Samsung™ S5570 > Galaxy Mini '+LF;
        prn += PrnAlignRight+ '1 x 7 300'+LF;

        BtPrint(prn);
    }

</script>

</head>
<body>

<style>
pre {font-family:monospace}
</style>
<pre id="pre_print">
--------------------------------
            TEST
--------------------------------
Items 1
3 x $20.00
Items 2
1 x $40.00
********************************
                   TOTAL $100.00
--------------------------------


</pre>
<button onclick="BtPrint(document.getElementById('pre_print').innerText)">button</button>
<br/><br/>
<button onclick="slip()">tes</button>

</body>
</html>