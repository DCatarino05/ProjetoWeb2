<?php
class Connection
{
    private static $instance = null;

    public static function getInstance()
    {
        if (self::$instance === null) {
            try {
                self::$instance = new PDO(
                    'mysql:host=localhost;dbname=cinemasnosso', 
                    'root', 
                    '', 
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC 
                    ]
                );
            } catch (PDOException $e) {
                die("ERRO DE CONEXÃO : " . $e->getMessage());
            }
        }

        return self::$instance;
    }
}
?>