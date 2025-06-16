<?php

namespace App\Http\Controllers\Freelancer;

use App\Http\Controllers\Controller;
use App\Models\Request as ModelsRequest;
use App\Models\RequestLog;
use App\Models\RequestLogAttachment;
use App\Services\RequestService;
use App\Utilities\FileManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    protected $requestService;

    public function __construct(RequestService $requestService)
    {
        $this->requestService = $requestService;
    }

    public function index()
    {
        $requests = ModelsRequest::with(['service.user', 'user'])
            ->whereHas('service', function ($q) {
                $q->where('user_id', Auth::id());
            })
            ->get();
        return view('pages-freelancer.requests.index', compact('requests'));
    }

    public function show($id)
    {
        $request = $this->requestService->getRequestDetails($id);
        return view('pages-freelancer.requests.edit', compact('request'));
    }


    // public function changeStatus(Request $request, $id)
    // {
    //     $request->validate([
    //         'status' => 'required|in:pending,in_progress,completed',
    //     ]);

    //     $requestItem = ModelsRequest::findOrFail($id);
    //     $requestItem->status = $request->status;
    //     $requestItem->save();

    //     // Save comment to request_logs
    //     $log = new RequestLog();
    //     $log->request_id = $requestItem->id;
    //     $log->action = auth()->user()->username . ' has updated the request status to ' . $request->status;
    //     $log->user_id = auth()->id();
    //     $log->save();

    //     return back()->with('success', 'Status updated successfully!');
    // }


    public function changeStatus(Request $request, FileManager $fileManager)
    {
        $request->validate([
            'status' => 'required|in:pending,in_progress,completed',
            'comment' => 'required|string|max:1000',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120', // max 5MB
        ]);

        $requestItem = ModelsRequest::findOrFail($request->id ?? $request->route('id'));
        $requestItem->status = $request->status;
        $requestItem->save();

        // Save comment to request_logs
        $log = new RequestLog();
        $log->request_id = $requestItem->id;
        $log->action = auth()->user()->username . ' has updated the request status to ' . $request->status . '. Comment: ' . $request->comment;
        $log->user_id = auth()->id();
        $log->save();


        // 1. Basic status update log (without comment)
        $logStatus = new RequestLog();
        $logStatus->request_id = $requestItem->id;
        $logStatus->action = auth()->user()->username . ' has updated the request status to ' . $request->status . '.';
        $logStatus->user_id = auth()->id();
        $logStatus->save();

        // 2. Comment log
        $log = new RequestLog();
        $log->request_id = $requestItem->id;
        $log->action = $request->comment;
        $log->user_id = auth()->id();
        $log->save();


        // Handle file attachment if uploaded (استخدام FileManager لتحميل الملف بنفس الطريقة)
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = $fileManager->upload('attachment', $file);

            $extension = strtolower($file->getClientOriginalExtension());

            $mediaType = match (true) {
                in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp']) => 'image',
                in_array($extension, ['mp4', 'avi', 'mov', 'mkv'])          => 'video',
                default                                                     => 'file',
            };

            $attachment = new RequestLogAttachment();
            $attachment->log_id = $log->id;
            $attachment->media_path = $filename;
            $attachment->media_type = $mediaType;
            $attachment->save();
        }

        return back()->with('success', 'Status updated successfully with comment!');
    }




    public function addUpdate(Request $request, $id, FileManager $fileManager)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120', // max 5MB
        ]);

        $requestItem = ModelsRequest::findOrFail($id);

        // Save comment to request_logs
        $log = new RequestLog();
        $log->request_id = $requestItem->id;
        $log->action = $request->comment;
        $log->user_id = auth()->id(); // If you want to track who added the comment
        $log->save();

        // Handle file attachment if uploaded
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = $fileManager->upload('attachemnt', $request->file('attachment'));
            $fileType = $file->getClientOriginalExtension(); // or getClientMimeType()

            $extension = strtolower($file->getClientOriginalExtension());

            $mediaType = match (true) {
                in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp']) => 'image',
                in_array($extension, ['mp4', 'avi', 'mov', 'mkv'])          => 'video',
                default                                                     => 'file', // fallback for pdf, doc, etc
            };
            $attachment = new RequestLogAttachment();
            $attachment->log_id = $log->id;
            $attachment->media_path = $filename;
            $attachment->media_type = $mediaType;
            $attachment->save();
        }

        return back()->with('success', 'Update added successfully!');
    }


    public function logs($id)
    {
        $request = ModelsRequest::with(['logs.attachments'])->findOrFail($id);
        $request->logs = $request->logs->sortByDesc('id')->values();
        return view('pages-freelancer.requests.logs', compact('request'));
    }
}
