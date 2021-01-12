<?php
	//'Location: http://sistemas.vilaverde.saude.ws/integracao/index.php'
	class Config 
	{
		static $dbHost = '187.16.185.242';
		static $dbPort = '5430';
		static $webServer = 'Location: http://localhost/integracao/index.php';		
		static $webLogin = 'Location: http://localhost/integracao/login.php';
		static $webLogout = 'Location: http://localhost/integracao/logout.php';
		static $destroy="N";
		
		public static function destroy()
		{
			$destroy="S";
		}
		
	}
?>