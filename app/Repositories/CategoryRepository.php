<?php

namespace App\Repositories;

use App\Models\Category;
use App\Interfaces\CategoryInterface;
use Illuminate\Database\Eloquent\Builder;

class CategoryRepository implements CategoryInterface
{
	protected $category;
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * Return new instance of the Query Builder for this model.
     */
    public function query(): Builder
    {
        return $this->category->newQuery();
    }

    public function all()
    {
        return $this->query()->getAll();
    }

    public function paginated()
    {
        return $this->category->paginated();
    }

    public function create(array $data)
    {
    	return $this->query()->create($data);
    }

    public function getId($id)
    {
    	return $this->category->categoryId($id);
    }

    public function update(array $data,$id)
    {
        $record = $this->getId($id);
    	return $record->update($data);
    }

    public function delete($id)
    {
    	return $this->category->deleteCategory($id);
    }

    public function categorySlug(string $slug)
    {
        return $this->query()->categorySlug($slug);
    }

    public function categoryWithArticles()
    {
        return $this->query()->categoryWithArticles();
    }

    public function politicsCategory()
    {
        return $this->query()->politicsCategory();
    }

    public function sportsCategory()
    {
        return $this->query()->sportsCategory();
    }

    public function tecnologyCategory()
    {
        return $this->query()->tecnologyCategory();
    }

    public function entertainmentCategory()
    {
        return $this->query()->entertainmentCategory();
    }
}