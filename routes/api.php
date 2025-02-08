<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthenticationUser;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/auth-login', [AuthenticationUser::class, 'login'])->name('auth-login');

Route::post('/api/batch', function (Request $request) {
    $results = [];
    // Validate the incoming batch request
    $data = $request->validate([
        'requests' => 'required|array',
        'requests.*.action' => 'required|string',
        'requests.*.payload' => 'sometimes|array',
    ]);

    // Process each request in the batch
    foreach ($data['requests'] as $req) {
        try {
            switch ($req['action']) {
                case 'get_user':
                    // Example: Fetch a user by ID
                    $user = \App\Models\User::find($req['payload']['id'] ?? null);
                    $results[] = $user ? ['status' => 'success', 'data' => $user] : ['status' => 'error', 'message' => 'User not found'];
                    break;

                case 'create_post':
                    // Example: Create a new post
                    $post = \App\Models\Post::create($req['payload'] ?? []);
                    $results[] = ['status' => 'success', 'data' => $post];
                    break;

                case 'delete_user':
                    // Example: Delete a user by ID
                    $deleted = \App\Models\User::destroy($req['payload']['id'] ?? null);
                    $results[] = $deleted ? ['status' => 'success'] : ['status' => 'error', 'message' => 'User not found'];
                    break;

                default:
                    $results[] = ['status' => 'error', 'message' => 'Unknown action'];
                    break;
            }
        } catch (\Exception $e) {
            $results[] = ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    return response()->json($results);
});
