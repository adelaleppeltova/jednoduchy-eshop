<?php

class Db
{

    private static $connection;

    private static array $settings = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_EMULATE_PREPARES => false,
    );

    public static function connect(string $host, string $user, string $password, string $database): void
    {
        if (!isset(self::$connection)) {
            self::$connection = @new PDO(
                "mysql:host=$host;dbname=$database",
                $user,
                $password,
                self::$settings
            );
        }
    }

    public static function requestSingle(string $request, array $parameters = array()): array|bool
    {
        $result = self::$connection->prepare($request);
        $result->execute($parameters);
        return $result->fetch();
    }


    public static function requestAll(string $request, array $parameters = array()): array|bool
    {
        $result = self::$connection->prepare($request);
        $result->execute($parameters);
        return $result->fetchAll();
    }


    public static function requestAlone(string $request, array $parameters = array()): string
    {
        $result = self::requestSingle($request, $parameters);
        return $result[0];
    }


    public static function request(string $request, array $parameters = array()): int
    {
        $result = self::$connection->prepare($request);
        $result->execute($parameters);
        return $result->rowCount();
    }


    public static function insert(string $table, array $parameters = array()): bool
    {
        return self::request(
            "INSERT INTO `$table` (`" .
                implode('`, `', array_keys($parameters)) .
                "`) VALUES (" . str_repeat('?,', sizeOf($parameters) - 1) . "?)",
            array_values($parameters)
        );
    }


    public static function update(string $table, array $values, string $condition, array $parameters = array()): bool
    {
        return self::request(
            "UPDATE `$table` SET `" .
                implode('` = ?, `', array_keys($values)) .
                "` = ? " . $condition,
            array_merge(array_values($values), $parameters)
        );
    }

    public static function lastId(): int
    {
        return self::$connection->lastInsertId();
    }
}
