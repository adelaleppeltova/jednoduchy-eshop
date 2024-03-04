<?php
class CategoryManager
{

    public static function getCategory(string $id): array
    {
        return Db::requestSingle('
			SELECT `id`, `url`, `title`, `descript`, `homepage`
			FROM `categories` 
			WHERE `id` = ?
		', array($id));
    }


    public static function saveCategory(int|bool $id, array $category): void
    {
        if (!$id)
            Db::insert('categories', $category);
        else
            Db::update('categories', $category, 'WHERE id = ?', array($id));
    }


    public static function getCategories(): array
    {
        return Db::requestAll('
			SELECT `id`, `url`, `title`, `descript`, `homepage`
			FROM `categories` 
			ORDER BY `id` DESC
		');
    }

    public static function deleteCategories(string $id): void
    {
        Db::request('
			DELETE FROM categories
			WHERE url = ?
		', array($id));
    }
}
