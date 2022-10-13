<?php

declare(strict_types=1);

class Dish
{
    private function __construct(
        private int $id,
        private string $name,
        private bool $archived
    ) {
    }

    public function getID(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getArchived(): bool
    {
        return $this->archived;
    }

    public static function get(int $id): ?Dish
    {
        $params = array(":id" => $id);
        $sth = getPDO()->prepare("SELECT `name`, `archived` FROM `dishes` WHERE `id` = :id LIMIT 1;");
        $sth->execute($params);

        if ($row = $sth->fetch())
            return new Dish($id, $row["name"], $row["archived"] != 0);

        return null;
    }

    public static function all(): array
    {
        $sth = getPDO()->prepare("SELECT `id`, `name`, `archived` FROM `dishes`;");
        $sth->execute();

        $dishes = array();

        while ($row = $sth->fetch())
            $dishes[$row["id"]] = new Dish($row["id"], $row["name"], $row["archived"] != 0);

        return $dishes;
    }
}
