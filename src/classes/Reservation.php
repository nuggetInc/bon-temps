<?php

declare(strict_types=1);

class Reservation
{
    private function __construct(
        private int $id,
        private int $datetime,
        private int $count,
        private int $customerID
    ) {
    }

    public function getID(): int
    {
        return $this->id;
    }

    public function getDatetime(): int
    {
        return $this->datetime;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function getCustomerID(): int
    {
        return $this->customerID;
    }

    public static function get(int $id): ?Reservation
    {
        $params = array(":id" => $id);
        $sth = getPDO()->prepare("SELECT `date`, `time`, `count`, `customer_id` FROM `reservations` WHERE `id` = :id LIMIT 1;");
        $sth->execute($params);

        if ($row = $sth->fetch())
            return new Reservation($id, strtotime($row["date"] . " " . $row["time"]), $row["count"], $row["customer_id"]);

        return null;
    }

    public static function getByCustomerID(int $customerID): array
    {
        $params = array(":customer_id" => $customerID);
        $sth = getPDO()->prepare("SELECT `id`, `date`, `time`, `count` FROM `reservations` WHERE `customer_id` = :customer_id;");
        $sth->execute($params);

        $reservations = array();

        while ($row = $sth->fetch())
            $reservations[] = new Reservation($row["id"], strtotime($row["date"] . " " . $row["time"]), $row["count"], $customerID);

        return $reservations;
    }

    public static function update(int $id, int $datetime, int $count, int $customerID): ?Reservation
    {
        $params = array(
            ":id" => $id,
            ":date" => date("Y-m-d", $datetime),
            ":time" => date("H:i:s", $datetime),
            ":count" => $count,
            ":customer_id" => $customerID,
        );

        $sth = getPDO()->prepare("UPDATE `reservations` SET `date` = :date, `time` = :time, `count` = :count, `customer_id` = :customer_id WHERE `id` = :id;");
        $sth->execute($params);

        return new Reservation($id, $datetime, $count, $customerID);
    }
}
