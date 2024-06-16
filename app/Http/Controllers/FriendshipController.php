<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendshipController extends Controller
{
    public function indexRequests()
    {
        try {
            return ApiResponse::success(Auth::user()->pendingFriendRequests, 200);

        } catch (\Exception $e) {
            return ApiResponse::error($e->getCode(), $e->getMessage());
        }
    }

    public function sendFriendRequest(Request $request)
    {
        try {
            $user = Auth::user();
            $friendId = $request->input('friend_id');
            // Check if the user is trying to send a friend request to themselves
            if ($user->id == $friendId) {
                return ApiResponse::error(400, 'You cannot send a friend request to yourself.');
            }
            // Check if the friendship already exists

            // Check if the friend request has already been sent
            if ($user->sentFriendRequests()->where('friend_id', $friendId)->exists()) {
                return ApiResponse::error(400, 'You Sent Before');
            }

            // Attach friend to user's sent friend requests
            $user->sentFriendRequests()->attach($friendId);

            return ApiResponse::success(null, 200);

        } catch (\Exception $exception) {
            return ApiResponse::error($exception->getCode(), $exception->getMessage());
        }


    }

    public function cancelFriendship(Request $request)
    {

        try {
            $user = Auth::user();
            $friend = User::find($request->friend_id);

            if ($user->friends()->where('friend_id', $friend->id)->get()->first()) {
                return ApiResponse::success($user->friends()->detach($friend->id),200);
            }
            return ApiResponse::success($friend->friends()->detach($user->id),200);

        } catch (\Exception $exception) {
            return ApiResponse::error($exception->getCode(), $exception->getMessage());
        }
    }

    public function indexFriends()
    {
        try {
            $user = Auth::user();
            $friends = $user->acceptedFriends()->get()->map(function ($friend) use ($user) {
                return $friend->id === $user->id ? $friend->pivot->user_id : $friend->pivot->friend_id;
            });

            $friends = User::query()->whereIn('id', $friends)->get();
            return ApiResponse::success(UserResource::collection($friends), 200);
        } catch (\Exception $exception) {
            return ApiResponse::error(400, $exception->getMessage());
        }
    }

    public function acceptRequest(Request $request)
    {
        try {

            $user = Auth::user();
            $friend = User::find($request->request_id);
            $user->pendingFriendRequests()->updateExistingPivot($friend->id, ['status' => 'approved']);
            return ApiResponse::success(null, 200);
        } catch (\Exception $exception) {
            return ApiResponse::error($exception->getCode(), $exception->getMessage());
        }

    }
}
