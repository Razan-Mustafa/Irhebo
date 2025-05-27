<?php

namespace App\Repositories\Eloquents;

use App\Models\Category;
use App\Utilities\FileManager;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    protected $model;

    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    public function index()
    {
        return $this->model->orderBy('id', 'desc')->get();
    }
    public function getAllActive($isPopular = null)
    {
        $query = Category::query();

        if ($isPopular) {
            $query->where('is_popular', true);
        }

        return $query->where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function store($data)
    {
        $category = $this->model->create([
            'icon' => FileManager::upload('categories', $data['icon']),
        ]);

        foreach (['en', 'ar'] as $locale) {
            $category->translations()->create([
                'language' => $locale,
                'title' => $data["title_$locale"],
                'description' => $data["description_$locale"],
            ]);
        }

        return $category;
    }

    public function update($id, $data)
    {
        $category = $this->find($id);

        $category->update([
            'icon' => FileManager::update('categories', $data['icon'], $category->icon),
        ]);

        foreach (['en', 'ar'] as $locale) {
            $category->translations()
                ->where('language', $locale)
                ->update([
                    'title' => $data["title_$locale"],
                    'description' => $data["description_$locale"],
                ]);
        }

        return $category;
    }

    public function delete($id)
    {
        $category = $this->find($id);
        FileManager::delete($category->icon);
        return $category->delete();
    }
    public function updateActivation(int $id)
    {
        $category = $this->find($id);
        $category->update(['is_active' => !$category->is_active]);
        return $category->fresh();
    }
}
