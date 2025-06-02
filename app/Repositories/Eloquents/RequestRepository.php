<?php

namespace App\Repositories\Eloquents;

use App\Models\Request;
use App\Models\RequestLog;
use App\Traits\PaginateTrait;
use App\Utilities\FileManager;
use App\Models\RequestLogAttachment;
use App\Repositories\Interfaces\RequestRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RequestRepository implements RequestRepositoryInterface
{
    use PaginateTrait;
    protected $model;
    public function __construct(Request $request)
    {
        $this->model = $request;
    }
    public function getAll()
    {
        return $this->model->orderBy('id', 'DESC')->get();
    }
    public function getByUser($perPage)
    {
        $query = $this->model->where('user_id', Auth::id())->orderBy('id', 'desc');
        return $this->paginate($query, $perPage);
    }

    public function getByFreelancer($perPage)
    {
        $query = $this->model->whereHas('service', function ($q) {
            $q->where('user_id', Auth::id());
        });



        return $this->paginate($query, $perPage);
    }

    public function createRequest(array $data)
    {
        return $this->model->create($data);
    }
    public function find($id)
    {
        return $this->model->find($id);
    }
    public function getRequestDetails($id)
    {
        $request = $this->model->with([
            'user.languages.language',
            'service',
            'plan.features' => function ($query) use ($id) {
                $serviceId = $this->model->find($id)?->service_id;
                if ($serviceId) {
                    $query->where('service_id', $serviceId);
                }
            },
            'logs.user',
            'logs.attachments'
        ])->findOrFail($id);

        $user = Auth::guard('api')->user();
        if ($user && !$user->freelancer()->exists()) {
            $request->need_action = false;
            $request->save();
        }
        return $request;
    }
    public function addComment($data)
    {
        $request = $this->find($data['request_id']);
        $current_status = $request->status;
        $new_status = $data['status'];
        $request->update([
            'status' => $new_status,
            'need_action' => true
        ]);
        if ($current_status != $new_status) {
            $requestLog = RequestLog::create([
                'user_id' => $data['user_id'],
                'request_id' => $request->id,
                'action' => Auth::user()->username . ' has updated the request status to ' . $new_status
            ]);
        }
        $requestLog = RequestLog::create([
            'user_id' => $data['user_id'],
            'request_id' => $request->id,
            'action' => $data['action']
        ]);

        // dd( Auth::user()->username.' has updated the request status to '. $new_status);

        if (isset($data['attachments']) && is_array($data['attachments'])) {
            foreach ($data['attachments'] as $media) {
                $mediaPath = FileManager::upload('request_logs', $media);
                $fileType = FileManager::getFileTypeFromPath($mediaPath);

                $requestLog->attachments()->create([
                    'media_path' => $mediaPath,
                    'media_type' => $fileType,
                ]);
            }
        }
        return $requestLog->load('attachments');
    }
    public function confirmRequest($id)
    {
        $request = $this->find($id);
        $request->update([
            'status' => 'confirmed'
        ]);
    }
}
