<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => 'true',
            'results' => Project::with(['type', 'technologies'])->orderByDesc('id')->paginate(8),
        ]);
    }
}
