<?php
	//'Location: http://sistemas.vilaverde.saude.ws/integracao/index.php'
	class Config 
	{
		static $dbHost = '187.16.185.242';
		static $dbPort = '5430';
		static $webServer = 'Location: http://localhost/solus/index.php';		
		static $webLogin = 'Location: http://localhost/solus/login.php';
		static $webLogout = 'Location: http://localhost/solus/logout.php';
		static $destroy="N";
		
		public static function destroy()
		{
			$destroy="S";
		}
		
	}
?>