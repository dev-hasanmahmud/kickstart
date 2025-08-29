<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\{
    Auth,
    Log,
    Storage,
};

class PanelHomeController extends Controller
{
    public function home()
    {
        return view('panel.home');
    }

    public function profile()
    {
        $user = Auth::user();

        return view('panel.users.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
                'bio' => 'nullable|string|max:1000',
            ]);

            $storagePath = config('panel.storage_path');
            $user = Auth::user();

            if ($request->hasFile('avatar')) {
                if ($user->avatar) {
                    Storage::disk('public')->delete($user->avatar);
                }

                $path = $request->file('avatar')->store('avatars', 'public');
                $user->avatar = $storagePath . $path;
            } else {
                $user->avatar = $request->avatar_hidden ?? null;
            }

            $user->name = $request->name;
            $user->bio = $request->bio;
            $user->save();

            Log::channel('panel')->warning('Profile updated successfully: ', [
                'user_id' => $user->id,
                'ip' => $request->ip(),
            ]);

            return back()->with('success', 'Profile updated successfully.');
        } catch (Throwable $e) {
            Log::channel('panel')->error('Profile update failed. Please try again: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'ip' => $request->ip(),
            ]);

            return redirect('/')->withErrors('Profile update failed. Please try again.');
        }
    }
}
