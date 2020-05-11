echo off
REM This adds the folder containing php.exe to the path
PATH=%PATH%;C:\xampp\php;C:\xampp\php\ext

REM Change Directory to the folder containing your script
CD C:\xampp\htdocs\integracao\gestaoleitos

REM Execute
php cargadeleitos.php