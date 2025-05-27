<?php

namespace App\Repositories\Eloquents;

use App\Models\Quotation;
use App\Models\Quotation_Comments;
use App\Repositories\Interfaces\QuotationRepositoryInterface;
use App\Traits\PaginateTrait;
use Illuminate\Support\Facades\Auth;

class QuotationRepository implements QuotationRepositoryInterface
{
    use PaginateTrait;
    protected $model;
    protected $quotationComment;

    public function __construct(Quotation $quotation,Quotation_Comments $quotationComment)
    {
        $this->model = $quotation;
        $this->quotationComment = $quotationComment;
    }
    public function getAll(){
        return $this->model->with('user.profession')->orderBy('id','desc')->get();
    }
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function findAll($perPage = null)
    {
        $query = $this->model->with('user.profession');
        return $this->paginate($query, $perPage);
    }

    public function getByUserId($perPage = null)
    {
        $query = $this->model->with('user.profession')->where('user_id',Auth::id());
        return $this->paginate($query, $perPage);
    }

    public function findById(int $id)
    {
        return $this->model->find($id);
    }

       public function createQuotationComment(array $data)
       {
           return $this->quotationComment->create($data);
       }

       public function getCommentsByQuotationId(int $quotationId)
       {
           return $this->quotationComment->where('quotation_id', $quotationId)->with(['quotation','user.profession'])->get();
       }
       public function getQuotationDetails($id){
        return $this->model->with(['quotationComments','user.profession'])->find($id);


       }
}
