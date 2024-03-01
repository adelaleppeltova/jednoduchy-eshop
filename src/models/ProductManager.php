<?php
class ProductManager
{

    public static function getProduct(string $id): array
    {
        return Db::requestSingle('
			SELECT `id`, `title`, `price`, `shortdesc`, `longdesc`, `image`,  `categories_id`
			FROM `products` 
			WHERE `id` = ?
		', array($id));
    }


    public function saveProduct(int|bool $id, array $product): void
    {
        if (!$id)
            Db::insert('products', $product);
        else
            Db::update('products', $product, 'WHERE id = ?', array($id));
    }


    public static function getProducts(): array
    {
        return Db::requestAll('
			SELECT `id`, `title`, `price`, `shortdesc`, `longdesc`, `image`, `categories_id`
			FROM `products` 
			ORDER BY `id` DESC
		');
    }

    public function deleteProduct(string $id): void
    {
        Db::request('
			DELETE FROM products
			WHERE url = ?
		', array($id));
    }
}
