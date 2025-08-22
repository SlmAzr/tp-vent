Si un user admin n'est pas présent faire : 

 >php artisan tinker 

> use App\Models\User;

if (!User::role('admin')->exists()) {
    $admin = User::create([
        'name' => 'Admin',
        'email' => 'admin@example.com',
        'password' => bcrypt('password123'),
    ]);
    $admin->assignRole('admin');
}
