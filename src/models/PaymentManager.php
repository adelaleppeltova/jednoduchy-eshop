<?php
class PaymentManager
{

    public function getPayment(string $id): array
    {
        return Db::requestSingle('
			SELECT `id`, `title`, `price`
			FROM `payment` 
			WHERE `id` = ?
		', array($id));
    }


    public function savePayment(int|bool $id, array $payment): void
    {
        if (!$id)
            Db::insert('payment', $payment);
        else
            Db::update('payment', $payment, 'WHERE id = ?', array($id));
    }


    public function getPayments(): array
    {
        return Db::requestAll('
			SELECT `id`, `title`, `price`
			FROM `payment` 
			ORDER BY `id` DESC
		');
    }

    public function deletePayment(string $id): void
    {
        Db::request('
			DELETE FROM payment
			WHERE url = ?
		', array($id));
    }
}
