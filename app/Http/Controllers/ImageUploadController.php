<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ImageUploadController extends Controller
{
    public function uploadAvatar(Request $request)
    {
        // Ellenőrizd, hogy van-e fájl
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            
            // Ellenőrizd, hogy a fájl valóban képfájl-e
            $validated = $request->validate([
                'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            
            // Fájl tárolása a public disk-en (a storage/app/public mappába)
            $path = $file->store('avatars', 'public');
            
            // A felhasználó avatarjának frissítése
            $user = auth()->user();
            $user->avatar = $path;
            $user->save();
            
            return response()->json([
                'message' => 'Avatar uploaded successfully.',
                'avatar' => $path,
            ], 200);
        } else {
            return response()->json([
                'message' => 'No file uploaded or invalid file',
                'errors' => ['avatar' => ['The avatar field is required.']],
            ], 422);
        }
    }
}
