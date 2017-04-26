 <?php
 
	define('MYSQL_SERVER', 'localhost');
	define('MYSQL_USER', 'root');
	define('MYSQL_PASSWORD', '666');
	define('MYSQL_DB', 'nuevolut_emaxan');
 
	function db_connect()
	{
		$link = mysqli_connect(MYSQL_SERVER, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB) or die("could not connect to mysql");
		if(!mysqli_set_charset($link, 'utf8')) printf(("ERROR: ".mysqli_error($link)));
		return $link;
	}
	
	function do_query_get_array($link, $query)
	{
		$result = mysqli_query($link, $query);

		if(!$result) die(mysqli_error($link));
		$array = array();
		$count = @mysqli_num_rows($result);

		for($i = 0; $i < $count; $i++)
		{
			$row = mysqli_fetch_array($result);
			$array[] = $row;
		}
		return $array;
	}
	
	function do_query_insert($link, $query)
	{
		$result = mysqli_query($link, $query);
		return TRUE;
	}
	
	function get_array_with_N_rows($source, $n)
	{
		$result = array();
		for($index = 0; (isset($source[$index]))&&($index < $n); $index++) $result[$index] = $source[$index];
		return $result;
	}