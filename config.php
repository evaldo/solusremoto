<?php
	//'Location: http://sistemas.vilaverde.saude.ws/integracao/index.php'
	class Config 
	{
		static $dbHost = '186.248.180.100';
		static $dbPort = '5430';
		static $webServer = 'Location: http://infgervilaverde.saude.ws/infger/integracao/index.php';		
		static $webLogin = 'Location: http://localhost/integracao/login.php';
		static $webLogout = 'Location: http://localhost/integracao/logout.php';
		static $destroy="N";
		
		public static function destroy()
		{
			$destroy="S";
		}
		
	}
?>