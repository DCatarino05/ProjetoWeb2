<?php
class Connection
{
    private static $instance = null;

    public static function getInstance()
    {
        if (self::$instance === null) {
            try {
                // Parâmetros da conexão
                $host = 'sql207.infinityfree.com'; // Hostname do servidor MySQL
                $dbname = 'if0_37857865_cinemasnosso'; // Nome do banco de dados
                $user = 'if0_37857865'; // Nome de usuário
                $password = '57e1HKRVlNP8l'; // Senha do banco de dados
                $port = 3306; // Porta do MySQL (opcional)

                // Criar instância PDO
                self::$instance = new PDO(
                    "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4",
                    $user,
                    $password,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
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
