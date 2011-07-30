<?php
//varias formas de garantir a limpeza do cache nos clientes e servidores
header("Expires: Mon, 26 Jul 1997 05:00:00");
header("Last-Modified: " . date("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
