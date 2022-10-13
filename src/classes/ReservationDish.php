<?php

declare(strict_types=1);

class ReservationDish
{
    private function __construct(
        public int $reservationID,
        public int $dishID,
        public int $amount
    ) {
    }

    public function getReservationID(): int
    {
        return $this->reservationID;
    }
    public function getDishID(): int
    {
        return $this->dishID;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getDish(): Dish
    {
        return Dish::get($this->dishID);
    }

    public static function getByReservationID(int $reservationID): array
    {
        $params = array(":reservation_id" => $reservationID);
        $sth = getPDO()->prepare("SELECT `dish_id`, `amount` FROM `reservationdishes` WHERE `reservation_id` = :reservation_id;");
        $sth->execute($params);

        $resevationDishes = array();

        while ($row = $sth->fetch())
            $resevationDishes[] = new ReservationDish($reservationID, $row["dish_id"], $row["amount"]);

        return $resevationDishes;
    }

    public static function create(int $reservationID, int $dishID, int $amount): ReservationDish
    {
        $params = array(
            ":reservation_id" => $reservationID,
            ":dish_id" => $dishID,
            ":amount" => $amount,
        );
        $sth = getPDO()->prepare("INSERT INTO `reservationdishes` (reservation_id, dish_id, amount) VALUES (:reservation_id, :dish_id, :amount);");
        $sth->execute($params);


        return new ReservationDish($reservationID, $dishID, $amount);
    }

    public static function deleteByReservationID(int $reservationID): void
    {
        $params = array(":reservation_id" => $reservationID);
        $sth = getPDO()->prepare("DELETE FROM `reservationdishes` WHERE `reservation_id` = :reservation_id;");
        $sth->execute($params);
    }
}
