<?php
class ProductManager
{

    public function getProduct(string $id): array
    {
        return Db::requestSingle('
			SELECT `id`, `title`, `price`, `shortdesc`, `longdesc`, `image`
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


    public function getProducts(): array
    {
        return Db::requestAll('
			SELECT `id`, `title`, `price`
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
