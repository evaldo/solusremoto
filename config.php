<?php
	//'Location: http://sistemas.vilaverde.saude.ws/integracao/index.php'
	class Config 
	{
		static $dbHost = '187.16.185.242';
		static $dbPort = '5430';
		static $webServer = 'Location: http://192.168.0.247/integracao/index.php';		
		static $webLogin = 'Location: http://192.168.0.247/integracao/login.php';
		static $webLogout = 'Location: http://192.168.0.247/integracao/logout.php';
		static $destroy="N";
		
		public static function destroy()
		{
			$destroy="S";
		}
		
	}
?>