<?php

namespace App\Http\Controllers;

use App\Models\Notification;

;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $notifications = Notification::all();
        return response()->json(['data' => $notifications], 200);
    }

    public function show($id){
        $notifications = Notification::findOrFail($id);
        return response()->json(['data' => $notifications], 200);
    }

    public function destroy(Notification $notification){
        $isDeleted = $notification->delete();
        return response()->json(['message' => $isDeleted ? "Deleted successfully" : "Failed to delete"], $isDeleted ? 200 : 400);
    }
}
