<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{  // <--- THIS WAS MISSING
    /**
     * Show the edit form.
     * Requirement: Users can edit only their own tweets.
     */
    public function edit(Tweet $tweet)
    {
        // Authorization Check
        if (Auth::id() !== $tweet->user_id) {
            abort(403, 'Unauthorized action.');
        }

        return view('posts.edit', compact('tweet'));
    }

    /**
     * Update the tweet content.
     * Requirement: Update tweet content.
     */
    public function update(Request $request, Tweet $tweet)
    {
        // Authorization Check
        if (Auth::id() !== $tweet->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'content' => 'required|string|max:280',
        ]);

        $tweet->update($validated);

        return redirect()->route('dashboard')->with('success', 'Post updated successfully!');
    }

    /**
     * Display the feed.
     */
    public function index()
    {
        // Get tweets with their author (user) and likes to avoid loading issues
        $posts = Tweet::with(['user', 'likes'])->latest()->get();

        return view('dashboard', compact('posts'));
    }

    /**
     * Store a new post.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:280',
        ]);

        // Create post for the currently logged-in user
        $request->user()->tweets()->create($validated);

        return redirect()->route('dashboard')->with('success', 'Posted successfully!');
    }

    /**
     * Toggle like on a post.
     */
    public function like(Tweet $tweet)
    {
        $user = Auth::user();

        $existingLike = $tweet->likes()->where('user_id', $user->id)->first();

        if ($existingLike) {
            $existingLike->delete();
        } else {
            $tweet->likes()->create([
                'user_id' => $user->id
            ]);
        }

        return redirect()->back();
    }

    /**
     * Delete a post.
     */
    public function destroy(Tweet $tweet)
    {
        if (Auth::id() !== $tweet->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $tweet->delete();

        return redirect()->back()->with('success', 'Post removed.');
    }

    /**
     * Display a specific user's profile.
     */
    public function showUser(\App\Models\User $user)
    {
        $posts = $user->tweets()->with(['user', 'likes'])->latest()->get();
        $tweetCount = $posts->count();
        $likesReceived = $user->tweets()->withCount('likes')->get()->sum('likes_count');

        return view('users.show', compact('user', 'posts', 'tweetCount', 'likesReceived'));
    }
}