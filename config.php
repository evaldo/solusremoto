<?php
	
	class Config 
	{
			
		static $dbHost = '201.48.37.65';
		static $dbPort = '5433';
		static $webServer = 'Location: http://201.48.37.65:8012/solusremoto/index.php';		
		static $webLogin = 'Location: http://201.48.37.65:8012/solusremoto/login.php';	
		static $webLogout = 'Location: http://201.48.37.65:8012/solusremoto/logout.php';	
		
		static $destroy="N";
		
		public static function destroy()
		{
			$destroy="S";
		}
		
	}
?>