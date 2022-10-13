<?php

declare(strict_types=1);

class Customer
{
    private function __construct(
        private int $id,
        private string $email,
        private string $phonenumber,
        private string $postalCode,
        private string $houseNumber,
        private int $userID
    ) {
    }

    public function getID(): int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhonenumber(): string
    {
        return $this->phonenumber;
    }

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    public function getHouseNumber(): string
    {
        return $this->houseNumber;
    }

    public function getUserID(): int
    {
        return $this->userID;
    }

    public static function get(int $id): ?Customer
    {
        $params = array(":id" => $id);
        $sth = getPDO()->prepare("SELECT `email`, `phonenumber`, `postal_code`, `house_number`, `user_id` FROM `customers` WHERE `id` = :id LIMIT 1;");
        $sth->execute($params);

        if ($row = $sth->fetch())
            return new Customer($id, $row["email"], $row["phonenumber"], $row["postal_code"], $row["house_number"], $row["user_id"]);

        return null;
    }

    public static function getByUserID(int $userID): ?Customer
    {
        $params = array(":user_id" => $userID);
        $sth = getPDO()->prepare("SELECT `id`, `email`, `phonenumber`, `postal_code`, `house_number` FROM `customers` WHERE `user_id` = :user_id LIMIT 1;");
        $sth->execute($params);

        if ($row = $sth->fetch())
            return new Customer($row["id"], $row["email"], $row["phonenumber"], $row["postal_code"], $row["house_number"], $userID);

        return null;
    }

    public static function create(string $email, string $phonenumber, string $postalCode, string $houseNumber, int $userID): Customer
    {
        $params = array(
            ":email" => $email,
            ":phonenumber" => $phonenumber,
            ":postal_code" => $postalCode,
            ":house_number" => $houseNumber,
            ":user_id" => $userID
        );
        $sth = getPDO()->prepare("INSERT INTO `customers` (`email`, `phonenumber`, `postal_code`, `house_number`, `user_id`) VALUES (:email, :phonenumber, :postal_code, :house_number, :user_id);");
        $sth->execute($params);

        return new Customer((int)getPDO()->lastInsertId(), $email, $phonenumber, $postalCode, $houseNumber, $userID);
    }
}
