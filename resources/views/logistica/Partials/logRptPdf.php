<?php
header("Content-disposition: attachment; filename=".$Doc);
header("Content-type: application/pdf");
readfile($Doc);
?>