<?php
	//vilaverdesuporte.saude.ws
	class Config 
	{
		static $dbHost = '187.16.185.242';
		static $dbPort = '5430';
		static $webServer = 'Location: http://sistemas.vilaverde.saude.ws/integracao/index.php';		
		static $webLogin = 'Location: http://sistemas.vilaverde.saude.ws/integracao/login.php';
		static $webLogout = 'Location: http://sistemas.vilaverde.saude.ws/integracao/logout.php';
		static $destroy="N";
		
		public static function destroy()
		{
			$destroy="S";
		}
		
	}
?>