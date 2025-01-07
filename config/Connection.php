<?php
class Connection
{
    private static $instance = null;

    public static function getInstance()
    {
        if (self::$instance === null) {
            try {
                // Substitua os parâmetros abaixo pelos dados fornecidos pelo servidor remoto
                $host = 'sql207.infinityfree.com'; // Verifique o hostname correto
                $dbname = 'if0_37857865_cinemasnosso';
                $user = 'if0_37857865'; // Substitua pelo seu nome de usuário
                $password = '57e1HKRVlNP8l '; // Substitua pela sua senha

                self::$instance = new PDO(
                    "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
                    $user,
                    $password,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC 
                    ]
                );
            } catch (PDOException $e) {
                die("ERRO DE CONEXÃO: " . $e->getMessage());
            }
        }

        return self::$instance;
    }
}
?>
