<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Resources\ChallengeResource;
use App\Jobs\SendNotification;
use App\Models\Challenge;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;

class ChallengeController extends Controller
{
    public function store(Request $request)
    {
        try { // Validate the request


            $challenge = new Challenge();
            $guest=User::find($request->guest_id);
            $challenge->quiz()->associate($request->quiz_id);
            $challenge->guestUser()->associate($request->guest_id);
            $challenge->hostUser()->associate(Auth::user()->id);
                $challenge->save();
            SendNotification::dispatch('A New Challenge','A New Challenge From '.(Auth::user()->full_name),$guest->fcm_token,null,'token');
            // Return a response
            return ApiResponse::success(ChallengeResource::make($challenge->load(['hostUser','quiz','guestUSer'])), 200);
        } catch (Exception $e) {
            return ApiResponse::error(419, $e->getMessage());
        }
    }

    public function index(Request $request)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Validate the request for status filter
        $validatedData = $request->validate([
            'status' => 'nullable|in:0,1,2',
        ]);

        // Retrieve the status from the request, if available
        $status = $validatedData['status'] ?? null;

        // Retrieve challenges where the user is either the host or the guest
        $challengesQuery = Challenge::query()->with(['hostUser', 'guestUser', 'quiz'])->where(function ($query) use ($user) {
            $query->where('host_user_id', $user->id)
                ->orWhere('guest_user_id', $user->id);
        });

        // Apply the status filter if provided
        if (!is_null($status)) {
            $challengesQuery->where('status', $status);
        }

        // Get the challenges
        $challenges = $challengesQuery->get();

        // Return the challenges
        return ApiResponse::success(ChallengeResource::collection($challenges), 200);
    }

    public function updateDegrees($degree, $challengeId)
    {

        // Get the authenticated user
        $user = Auth::user();

        // Find the challenge
        $challenge = Challenge::findOrFail($challengeId);

        // Check if the user is the host or guest of the challenge
        if ($challenge->host_user_id === $user->id) {
            // User is the host
            $challenge->host_degree = $degree;
        } elseif ($challenge->guest_user_id === $user->id) {
            // User is the guest
            $challenge->guest_degree = $degree;
        } else {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // Update the challenge
        $challenge->save();
        // Check if both degrees have been set
        if ($challenge->host_degree !== null && $challenge->guest_degree !== null) {
            $guest=User::find($challenge->guest_user_id);
            $host=User::find($challenge->host_user_id);

            // Determine the winner
            if ($challenge->host_degree > $challenge->guest_degree) {
                $challenge->winner_user_id = $challenge->host_user_id;

                SendNotification::dispatch('You Win','You Win The Challenge ',$host->fcm_token,null,'token');
                SendNotification::dispatch('You Lose😥','You Lose The Challenge ',$guest->fcm_token,null,'token');

            } elseif ($challenge->guest_degree > $challenge->host_degree) {
                $challenge->winner_user_id = $challenge->guest_user_id;

                SendNotification::dispatch('You Win','You Win The Challenge ',$guest->fcm_token,null,'token');
                SendNotification::dispatch('You Lose😥','You Lose The Challenge ',$host->fcm_token,null,'token');

            } else {
                $challenge->winner_user_id = null; // Tie or no winner

                SendNotification::dispatch('Its A Draw','The Challenge Ended With Draw ',$host->fcm_token,null,'token');
                SendNotification::dispatch('Its A Draw','The Challenge Ended With Draw',$guest->fcm_token,null,'token');

            }

            // Set the challenge status to 'accepted and finished'
            $challenge->status = 1;

            // Save the challenge with the winner and updated status
            $challenge->save();
        }
        return ApiResponse::success(null,200);
    }
}
