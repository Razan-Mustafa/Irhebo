<?php

namespace App\Repositories\Eloquents;

use Exception;
use App\Models\Portfolio;
use App\Models\PortfolioMedia;
use App\Traits\PaginateTrait;
use App\Utilities\FileManager;
use App\Repositories\Interfaces\PortfolioRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class PortfolioRepository implements PortfolioRepositoryInterface
{
    use PaginateTrait;
    protected $model;
    public function __construct(Portfolio $portfolio)
    {
        $this->model = $portfolio;
    }
    public function index(){
        $query = Portfolio::query();
        return $query->get();
    }
    public function getPortfolioByUserId($userId, $perPage = null)
    {
        $query = $this->model->with(['media', 'user.profession'])->where('user_id', $userId)->orderBy('id', 'desc');
        return $this->paginate($query, $perPage);
    }
    public function getPortfolioByService($serviceId)
    {
        return $this->model->with(['media', 'user'])->whereHas('services', function ($query) use ($serviceId) {
            $query->where('service_id', $serviceId);
        })->get();
    }
    public function getFeaturedPortfolios($perPage = null)
    {
        $query = $this->model->with(['media', 'user.profession'])->where('is_featured', true)->orderBy('id', 'desc');
        return $this->paginate($query, $perPage);
    }
    public function getPortfolioDetails($id)
    {
        return $this->model->with('media','services.media','services.user.profession')->find($id);
    }
    public function find($id)
    {
        return $this->model->find($id);
    }
    public function create($data)
    {
        try {
            $portfolio = $this->model->create([
                'user_id' => $data['user_id'],
                'title' => $data['title'],
                'description' => $data['description'],
                'is_featured' => true,
            ]);
            if (!empty($data['media'])) {
                foreach ($data['media'] as $media) {
                    $mediaPath = FileManager::upload('portfolios', $media);
                    $fileType = FileManager::getFileTypeFromPath($mediaPath);
                    $portfolio->media()->create([
                        'media_path' => $mediaPath,
                        'media_type' => $fileType,
                    ]);
                }
            }
            if (!empty($data['cover'])) {
                $coverPath = FileManager::upload('portfolios', $data['cover']);
                $fileType = FileManager::getFileTypeFromPath($coverPath);
                $portfolio->media()->create([
                    'media_path' => $coverPath,
                    'media_type' => $fileType,
                    'is_cover' => true,
                ]);
            }
            if (!empty($data['service_ids'])) {
                $portfolio->services()->attach($data['service_ids']);
            }
            return $portfolio;
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function update($data, $portfolio)
    {
        try {
            $portfolio->update([
                'title' => $data['title'],
                'description' => $data['description'],
                'is_featured' => isset($data['is_featured']) ? $data['is_featured'] : $portfolio->is_featured,
            ]);
            if (!empty($data['media'])) {
                foreach ($data['media'] as $media) {
                    $mediaPath = FileManager::upload('portfolios', $media);
                    $fileType = FileManager::getFileTypeFromPath($mediaPath);
                    $portfolio->media()->create([
                        'media_path' => $mediaPath,
                        'media_type' => $fileType,
                    ]);
                }
            }
            if (!empty($data['cover'])) {
                $portfolio->media()->where('is_cover', true)->delete();
                $coverPath = FileManager::upload('portfolios', $data['cover']);
                $fileType = FileManager::getFileTypeFromPath($coverPath);
                $portfolio->media()->create([
                    'media_path' => $coverPath,
                    'media_type' => $fileType,
                    'is_cover' => true,
                ]);
            }
            $portfolio->services()->detach();
            if (!empty($data['service_ids'])) {
                $portfolio->services()->attach($data['service_ids']);
            }
            return $portfolio;
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function delete($id)
    {
        $portfolio = $this->find($id);

        return $portfolio->delete();
    }
    public function deleteMedia($id)
    {
        $media = PortfolioMedia::find($id);
        if ($media) {
            $media->delete();
        }
    }
}
