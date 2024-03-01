<?php

class CategoryController extends Controller
{

    protected array $categories;

    public function __construct(array $categories)
    {
        $this->categories = $categories;
    }
    function process(array $parameters): void
    {
        $this->header = array(
            'title' => 'Kategorie',
            'key_words' => 'category',
            'desc' => 'Kategorie'
        );






        $this->data['categories'] = $this->categories;
        $this->data['selectedCategory'] = CategoryManager::getCategory(1);



        $this->view = 'category';
    }
}
