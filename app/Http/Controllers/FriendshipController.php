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
            return ApiResponse::success(UserResource::collection(Auth::user()->friends()->where('accepted', '=', '0')->get()), 200);

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
            if ($user->friendships()->where('friend_id', $friendId)->exists()) {
                return ApiResponse::error(400, 'Friend Already Exist');
            }

            // Create a new friend request
            $user->friendships()->attach($friendId, ['accepted' => false]);

            return ApiResponse::success(null, 200);

        } catch (\Exception $exception) {
            return ApiResponse::error($exception->getCode(), $exception->getMessage());
        }


    }

    public function indexFriends()
    {
        try {

            $userFriends = Auth::user()->friendFriendships()->get();
            $friendFriends = (Auth::user()->userFriendships()->get());

            $friendIds = $userFriends->push(...$friendFriends);


            $friends = User::query()->whereIn('id', $friendIds->pluck('user_id')->reject(function ($id)  {
                return $id === Auth::user()->id;
            }))->orWhereIn('id', $friendIds->pluck('friend_id')->reject(function ($id)  {
                return $id === Auth::user()->id;
            }))->get();
            return ApiResponse::success(UserResource::collection($friends), 200);

        } catch (\Exception $exception) {
            return ApiResponse::error(400, $exception->getMessage());
        }
    }

    public function acceptRequest(Request $request)
    {
        try {
            if (count(Auth::user()->friends()->where('id', '=', $request->id)->where('accepted', '=', 0)->get()) != 0) {
                Auth::user()->friends()->updateExistingPivot($request->id, ['accepted' => 1]);
                $friendRequest = Auth::user()->friends()->where('id', '=', $request->id)->get()->first();
                return $friendRequest;
            } else {
                return ApiResponse::error(400, 'You Can\'t Accept unExisted Request');

            }
        } catch (\Exception $exception) {
            return ApiResponse::error($exception->getCode(), $exception->getMessage());
        }

    }
}
