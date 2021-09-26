<?php

namespace App;

class Db
{
    protected $dbh;

    public function __construct()
    {
        $config = (include __DIR__ . '/../config.php')['db'];

        $dsn = 'mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'] . ';charset=' . $config['charset'];
        $username = $config['username'];
        $password = $config['password'];
        $this->dbh = new \PDO($dsn, $username, $password);
    }

    public function execute($sql, array $data = []): bool
    {
        $sth = $this->dbh->prepare($sql);
        return $sth->execute($data);
    }

    public function query($sql, array $data = [], $class = null): array
    {
        $sth = $this->dbh->prepare($sql);
        $sth->execute($data);

        if (null === $class) {
            $result = $sth->fetchAll(\PDO::FETCH_ASSOC);
        } else {
            $result = $sth->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $class);
        }

        if (false === $result) {
            return [];
        }

        return $result;
    }

    public function getLastId(): string
    {
        return $this->dbh->lastInsertId();
    }
}