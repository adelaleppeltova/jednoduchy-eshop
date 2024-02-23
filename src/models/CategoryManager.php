<?php
class CategoryManager
{

    public function getCategory(string $id): array
    {
        return Db::requestSingle('
			SELECT `id`, `title`, `descript`
			FROM `categories` 
			WHERE `id` = ?
		', array($id));
    }


    public function saveCategory(int|bool $id, array $category): void
    {
        if (!$id)
            Db::insert('categories', $category);
        else
            Db::update('categories', $category, 'WHERE id = ?', array($id));
    }


    public function getCategories(): array
    {
        return Db::requestAll('
			SELECT `id`, `url`, `title`, `descript`
			FROM `categories` 
			ORDER BY `id` DESC
		');
    }

    public function deleteCategories(string $id): void
    {
        Db::request('
			DELETE FROM categories
			WHERE url = ?
		', array($id));
    }
}
