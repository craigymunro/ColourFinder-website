<?=filter_var($_GET["t"], FILTER_VALIDATE_URL) ?  file_get_contents($_GET["t"]) : false ?>
