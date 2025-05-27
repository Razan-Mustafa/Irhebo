<?php

namespace App\Services;

use App\Repositories\Interfaces\ServiceRepositoryInterface;

class ServiceService
{
    protected $serviceRepository;
    public function __construct(ServiceRepositoryInterface $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }
    public function index()
    {
        return $this->serviceRepository->index();
    }
    public function getAllActive()
    {
        return $this->serviceRepository->getAllActive();
    }
    public function getServiceById($id)
    {
        return $this->serviceRepository->find($id);
    }

  
    public function deleteService($id)
    {
        return $this->serviceRepository->delete($id);
    }
    public function getBySubCategory($subCategoryId, $perPage = null)
    {
        return $this->serviceRepository->getBySubCategory($subCategoryId, $perPage);
    }
    public function getServicesByTag($tag, $perPage = null)
    {
        return $this->serviceRepository->getServicesByTag($tag, $perPage);
    }
    public function getServicesByUserId($userId,$perPage)
    {
        return $this->serviceRepository->getServicesByUserId($userId,$perPage);
    }
    public function getRecommendedServices($perPage = null)
    {
        return $this->serviceRepository->getRecommendedServices($perPage);
    }
    public function getFeaturedServices($perPage = null)
    {
        return $this->serviceRepository->getFeaturedServices($perPage);
    }
    public function getRelatedServices($serviceId)
    {
        return $this->serviceRepository->getRelatedServices($serviceId);
    }
    public function getServiceDetails($serviceId)
    {
        return $this->serviceRepository->getServiceDetails($serviceId);
    }
    public function getPlansByServiceId($serviceId)
    {
        return $this->serviceRepository->getPlansByServiceId($serviceId);
    }
    public function search($query, $subCategoryId, $perPage = null)
    {
        return $this->serviceRepository->search($query,$subCategoryId, $perPage);
    }
    public function getResultFilter($filters){
        return $this->serviceRepository->getResultFilter($filters);
    }
    public function find($id){
        return $this->serviceRepository->find($id);
    }
    public function create($data){
        return $this->serviceRepository->create($data);
    }
    public function update($data,$id){
        $service = $this->find($id);
        return $this->serviceRepository->update($data,$service);
    }
    public function delete($id){
        return $this->serviceRepository->delete($id);
    }
    public function deleteMedia($id){
        return $this->serviceRepository->deleteMedia($id);
    }
}
