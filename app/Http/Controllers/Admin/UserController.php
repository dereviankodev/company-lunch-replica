<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\StoreRequest;
use App\Http\Requests\Admin\Users\UpdateRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Throwable;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::orderByDesc('id')->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    public function create(): View
    {
        return view('admin.users.create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $user = User::create(
            array_merge(
                $request->only(['name', 'email']),
                ['password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'] // password
            )
        );

        return redirect()->route('admin.users.show', $user);
    }

    public function show(User $user): View
    {
        $carts = Cart::whereUserId($user->id)->with('menu.dish.category')->get();
        $orders = Order::whereCustomerId($user->id)->with(['orderItems.dish.category', 'recipient'])->paginate(20);

        return view('admin.users.show', compact('user', 'carts', 'orders'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(UpdateRequest $request, User $user): RedirectResponse
    {
        $user->update($request->only(['name', 'email', 'is_admin']));

        return redirect()->route('admin.users.show', $user);
    }

    /**
     * @throws Throwable
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->deleteOrFail();

        return redirect()->route('admin.users.index');
    }
}
