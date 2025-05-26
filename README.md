# 🚀 Laravel API Development Tutorial

A step-by-step guide to building a RESTful API with Laravel

## 📋 Table of Contents
1. [Project Setup](#-step-1-create-a-fresh-laravel-project)
2. [Environment Configuration](#%EF%B8%8F-step-2-configure-the-environment)
3. [Database Seeding](#-step-3-create-a-seeder)
4. [Running Migrations](#-step-5-run-migrations-and-seeder)
5. [API Controller](#-step-6-create-api-controller)
6. [API Routes](#-step-7-define-api-routes)

## 🛠️ Installation & Setup
```bash
### 🌱 Step 1: Create a Fresh Laravel Project

composer create-project laravel/laravel laravel-api
cd laravel-api

### ⚙️ Step 2: Configure the Environment

Update your .env file with database configuration:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_api
DB_USERNAME=root
DB_PASSWORD=

## 🗃️ Database Setup

### 📝 Step 3: Create and Configure Seeder

Create a seeder:
php artisan make:seeder UserSeeder

Update database/seeders/UserSeeder.php:
public function run(): void
{
    $users = [
        [
            'name' => 'Mahfujur Rahman',
            'email' => 'mahfujurrahman6793@gmail.com',
            'password' => bcrypt('12345678'),
        ],
        [
            'name' => 'Afrin Akter',
            'email' => 'afrinakter6793@gmail.com',
            'password' => bcrypt('12345678'),
        ]
    ];
    User::insert($users);
}

### 🔄 Step 4: Run Migrations and Seeder

php artisan migrate
php artisan db:seed --class=UserSeeder

## 🧑‍💻 API Development

###🏗️ Step 5: Create API Controller

app/Http/Controllers/UserApiController.php:
<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UserApiController extends Controller
{
    // Get single or all users
    public function index($id = null) {
        if($id == '') {
            return response()->json([
                'status' => 'success',
                'data' => User::all()
            ], 200);
        }
        return response()->json([
            'status' => 'success',
            'data' => User::findOrFail($id)
        ], 200);
    }

    // Create single user
    public function store(Request $request) {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
            ], [
                'name.required' => 'Name is required',
                'email.required' => 'Email is required',
                'email.email' => 'Must be a valid email',
                'email.unique' => 'Email must be unique',
                'password.required' => 'Password is required'
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);

            return response()->json([
                'status' => 'success',
                'data' => $user
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'errors' => $e->errors()
            ], 422);
        }
    }

    // Create multiple users
    public function mul_store(Request $request) {
        $users = $request->all();
        
        foreach($users['users'] as $user) {
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => bcrypt($user['password'])
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Users created successfully'
        ], 201);
    }

    // Update user
    public function update(Request $request, $id) {
        $user = User::findOrFail($id);
        $data = $request->all();

        if(isset($data['name'])) $user->name = $data['name'];
        if(isset($data['email'])) $user->email = $data['email'];
        if(isset($data['password'])) $user->password = bcrypt($data['password']);
        
        $user->save();

        return response()->json([
            'status' => 'success',
            'data' => $user
        ], 200);
    }

    // Delete user
    public function destroy($id) {
        User::findOrFail($id)->delete();
        
        return response()->json([
            'status' => 'success',
            'message' => 'User deleted successfully'
        ], 200);
    }
}

### 🛣️ Step 6: Define API Routes

Update routes/api.php:
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserApiController;

Route::prefix('users')->group(function() {
    Route::get('/{id?}', [UserApiController::class, 'index']);
    Route::post('/', [UserApiController::class, 'store']);
    Route::post('/multiple', [UserApiController::class, 'mul_store']);
    Route::put('/update/{id}', [UserApiController::class, 'update']);
    Route::delete('/delete/{id}', [UserApiController::class, 'destroy']);
});
