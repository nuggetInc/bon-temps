<?php

declare(strict_types=1);

class User
{
    private function __construct(
        private int $id,
        private string $username,
        private string $password,
        private UserType $type
    ) {
    }

    public function getID(): int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public static function login(string $username, string $password): ?User
    {
        if ($user = User::getByUsername($username)) {
            if ($user->validatePassword($password)) {
                return $user;
            }
        }

        return null;
    }

    public function validatePassword(string $password): bool
    {
        return password_verify($password, $this->password);
    }

    public static function register(string $username, string $password, UserType $type): ?User
    {
        // Cannot create new user username already exists
        var_dump(self::getByUsername($username));
        if (self::getByUsername($username))
            return null;

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $params = array(":username" => $username, ":password" => $hash, ":type" => $type->value);
        $sth = getPDO()->prepare("INSERT INTO `users` (`username`, `password`, `type`) VALUE (:username, :password, :type);");
        $sth->execute($params);

        return new User((int)getPDO()->lastInsertId(), $username, $hash, $type);
    }

    public static function get(int $id): ?User
    {
        $params = array(":id" => $id);
        $sth = getPDO()->prepare("SELECT `username`, `password`, `type` FROM `users` WHERE `id` = :id LIMIT 1;");
        $sth->execute($params);

        if ($row = $sth->fetch())
            return new User($id, $row["username"], $row["password"], UserType::from($row["type"]));

        return null;
    }

    public static function getByUsername(string $username): ?User
    {
        $params = array(":username" => $username);
        $sth = getPDO()->prepare("SELECT `id`, `password`, `type` FROM `users` WHERE `username` = :username LIMIT 1;");
        $sth->execute($params);

        if ($row = $sth->fetch())
            return new User($row["id"], $username, $row["password"], UserType::from($row["type"]));

        return null;
    }
}

enum UserType: string
{
    case Customer = "customer";
    case Employee = "employee";
}
