<?php
namespace App\Services;

use App\Repositories\Interfaces\QuotationRepositoryInterface;

class QuotationService
{
    protected $quotationRepository;

    public function __construct(QuotationRepositoryInterface $quotationRepository)
    {
        $this->quotationRepository = $quotationRepository;
    }
    public function index(){
        return $this->quotationRepository->getAll();
    }
    public function store(array $data)
    {
        return $this->quotationRepository->store($data);
    }

    public function getAllQuotations($perPage = null)
    {
        return $this->quotationRepository->findAll($perPage);
    }
    public function getByUserId($perPage = null){
        return $this->quotationRepository->getByUserId($perPage);
    }

    public function getQuotationById(int $id)
    {
        return $this->quotationRepository->findById($id);
    }

       // Create a new quotation comment
       public function createQuotationComment(array $data)
       {
           return $this->quotationRepository->createQuotationComment($data);
       }

       // Get all comments for a specific quotation
       public function getCommentsByQuotationId(int $quotationId)
       {
           return $this->quotationRepository->getCommentsByQuotationId($quotationId);
       }
       public function getQuotationDetails($id){
        return $this->quotationRepository->getQuotationDetails($id);
       }
}
