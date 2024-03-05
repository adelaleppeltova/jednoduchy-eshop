<?php
class TransportManager
{

    public static function getTransport(string $id): array
    {
        return Db::requestSingle('
			SELECT `id`, `title`, `price`
			FROM `transport` 
			WHERE `id` = ?
		', array($id));
    }


    public static function saveTransport(int|bool $id, array $transport): void
    {
        if (!$id)
            Db::insert('transport', $transport);
        else
            Db::update('transport', $transport, 'WHERE id = ?', array($id));
    }


    public static function getTransports(): array
    {
        return Db::requestAll('
			SELECT `id`, `title`, `price`
			FROM `transport` 
			ORDER BY `id` DESC
		');
    }

    public static function deleteTransport(string $id): void
    {
        Db::request('
			DELETE FROM transport
			WHERE url = ?
		', array($id));
    }
}
