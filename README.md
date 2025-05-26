# 📘 Laravel API Tutorial

## 🚀 Step 1: Create a Fresh Laravel Project

First, create a fresh Laravel project via Composer or Laravel installer:

```bash
composer create-project laravel/laravel laravel-api
cd laravel-api

⚙️ Step 2: Configure the Environment
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_api
DB_USERNAME=root
DB_PASSWORD=

🌱 Step 3: Create a Seeder
php artisan make:seeder UserSedder
✏️ Step 4: Update the Seeder
public function run(): void
    {
        $users =[
            [
                'name' => 'mahfujur Rahman',
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
🧱 Step 5: Run Migrations and Seeder
php artisan migrate
php artisan db:seed

🧪 Step 6: Create API Controller
class UserApiController extends Controller
{
    public function index($id = null){
        if($id == ''){
            $data = User::get();
            $response = [
                'status' => 'success',
                'data' => $data
            ];
            return response()->json($response, 200);

        }
        else{
            $data = User::findorFail($id);
            $response = [
                'status' => 'success',
                'data' => $data
            ];
            return response()->json($response, 200);
        }
    }
    public function store(Request $request){
         try {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ];

        $customMessages = [
            'name.required' => 'Name Is Required',
            'email.required' => 'Email Is Required',
            'email.email' => 'Email Must Be Valid',
            'email.unique' => 'Email Must Be Unique',
            'password.required' => 'Password Is Required'
        ];

        $request->validate($rules, $customMessages);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

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
    public function mul_store(Request $request){
        $datas = $request->all();
        foreach($datas['users'] as $data){
            // $user = new User();
            // $user->name = $data['name'];
            // $user->email = $data['email'];
            // $user->password = bcrypt($data['password']);
            // $user->save();
            User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password'])
            ]);
        }
        $response = [
            'status' => 'success',
            'message' => 'Users created successfully'
        ];
        return response()->json($response, 201);
    }
    public function update(Request $request, $id){
        $data = $request->all();
        $user = User::findorFail($id);
        if(isset($data['name'])){
            $user->name = $data['name'];
        }
        if(isset($data['email'])){
            $user->email = $data['email'];
        }
        if(isset($data['password'])){
            $user->password = bcrypt($data['password']);
        }
        $user->save();
        $response = [
            'status' => 'success',
            'data' => $user
        ];
        return response()->json($response, 200);
    }
    public function destroy($id){
        $user = User::findorFail($id);
        $user->delete();
        $response = [
            'status' => 'success',
            'message' => 'User deleted successfully'
        ];
        return response()->json($response, 200);
    }

}

🔀 Step 7: Define API Routes
Route::get('/users/{id?}',[UserApiController::class,'index']);
Route::post('/users',[UserApiController::class,'store']);
Route::post('/users/multiple',[UserApiController::class,'mul_store']);
Route::put('/users/update/{id}',[UserApiController::class,'update']);
Route::delete('/users/delete/{id}',[UserApiController::class,'destroy']);
