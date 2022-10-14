<?php

declare(strict_types=1);

class Ingredient
{
    private function __construct(
        private int $id,
        private string $name,
        private float $amount,
        private string $unit,
        private float $price,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getUnit(): string
    {
        return $this->unit;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public static function get(int $id): ?Ingredient
    {
        $params = array(":id" => $id);
        $sth = getPDO()->prepare("SELECT `name`, `amount`, `unit`, `price` FROM `ingredients` WHERE `id` = :id LIMIT 1;");
        $sth->execute($params);

        if ($row = $sth->fetch())
            return new Ingredient($id, $row["name"], $row["amount"], $row["unit"], $row["price"]);

        return null;
    }

    public static function all(): array
    {
        $sth = getPDO()->prepare("SELECT `id`, `name`, `amount`, `unit`, `price` FROM `ingredients`;");
        $sth->execute();

        $ingredients = array();

        while ($row = $sth->fetch())
            $ingredients[$row["id"]] = new Ingredient($row["id"], $row["name"], $row["amount"], $row["unit"], $row["price"]);

        return $ingredients;
    }

    public static function create(string $name, float $amount, string $unit, float $price): Ingredient
    {
        $params = array(
            ":name" => $name,
            ":amount" => $amount,
            ":unit" => $unit,
            ":price" => $price,
        );
        $sth = getPDO()->prepare("INSERT INTO `ingredients` (`name`, `amount`, `unit`, `price`) VALUES (:name, :amount, :unit, :price);");
        $sth->execute($params);

        return new Ingredient((int)getPDO()->lastInsertId(), $name, $amount, $unit, $price);
    }

    public static function update(int $id, string $name, float $amount, string $unit, float $price): Ingredient
    {
        $params = array(
            ":id" => $id,
            ":name" => $name,
            ":amount" => $amount,
            ":unit" => $unit,
            ":price" => $price,
        );
        $sth = getPDO()->prepare("UPDATE `ingredients` SET `name` = :name, `amount` = :amount, `unit` = :unit, `price` = :price WHERE `id` = :id;");
        $sth->execute($params);

        return new Ingredient($id, $name, $amount, $unit, $price);
    }
}
