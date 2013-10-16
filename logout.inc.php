<?php

	session_start();
	session_destroy();
echo("loged off");
echo"<a href=\"index.php?content=main\">home</a>";
echo"<a href=\"index.php? content=login\">login</a>";

?>