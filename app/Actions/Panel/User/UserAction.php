<?php

namespace App\Actions\Panel\User;

use App\Actions\Panel\User\interfaces\UserInterface;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class UserAction implements UserInterface
{
    public function users($request): JsonResponse
    {
        $order = $request->get('order', 'asc');
        $users = User::with('roles')
                ->where('id', 'LIKE', '%'.$request->get('search').'%')
                ->orderBy('id', $order)
                ->paginate(7);
   
        return response()->json($users, 200);
    }

    public function store($request): JsonResponse
    {
        try {
            $input = $request->validated();
            $input['password'] = Hash::make($input['password']);
            $user = User::create($input);
            $user->assignRole($request->input('roles'));
            return response()->json(['message' => '¡Saved Successfully!.'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function update( $request, int $id)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $input = $request->except(['role', 'password']);

        if ($request->filled('password')) {
            $input['password'] = Hash::make($request->password);
        }

        $user = User::findOrFail($id);
        $user->update($input);

        if ($request->has('role')) {
            $user->syncRoles([$request->input('role')]);
        }

        return response()->json([
            'message' => 'User updated successfully.',
        ], 200);
    }

    public function destroy($request)
    {
        $users = json_decode($request->users);

        foreach($users as $user){
            User::find($user)->delete();
        }

        return response()->json([
            'message' => '¡Deleted successfully!.',
        ], 200);
    }

    public function updatePassword($request): JsonResponse
    {
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        if (!Hash::check($request->current_password, auth()->user()->password)) {
            return response()->json(['message' => 'Current password is incorrect.'], 400);
        }

        auth()->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' => 'Password updated successfully.']);
    }
}