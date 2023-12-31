<?php
use App\Http\Controllers\LangController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\exportPDFController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Models\Order;
use App\Models\Post;
use App\Models\Product;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('lang/change', [LangController::class, 'change'])->name('changeLang');

// HomeController
Route::get('/', [HomeController::class, 'index']);
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

// PostController 
Route::get('/posts', [PostController::class, 'index'])->name('posts.index'); // แสดงข้อมูลทั้งหมด
Route::get('/post/show/{id}', [PostController::class, 'show'])->name('show'); // แสดงรายละเอียดข้อมูล
Route::get('posts/create', [PostController::class, 'create'])->name('create'); // ฟอร์มเพิ่มข้อมูล
Route::post('store', [PostController::class, 'store'])->name('store'); // บันทึกข้อมูล
Route::get('post/edit/{id}', [PostController::class, 'edit'])->name('edit'); // ฟอร์มแก้ไข
Route::post('post/update/{id}', [PostController::class, 'update'])->name('update'); // บักทึกการแกไข
Route::get('post/destroy/{id}', [PostController::class, 'destroy'])->name('destroy'); // ลบข้อมูล

// Solf Delete and Data Restore
Route::get('/posts/trashed', [PostController::class, 'trashed'])->name('posts.trashed');
Route::get('/post/restore/{id}', [PostController::class, 'restore'])->name('posts.restore');
Route::get('/posts/restore-all', [PostController::class, 'restoreAll'])->name('posts.restoreAll');


// CategoryController
Route::get('/category', [CategoryController::class, 'index']); // แสดงข้อมูลทั้งหมด
Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create'); // ฟอร์มเพิ่มข้อมูล
Route::post('/categorystore', [CategoryController::class, 'store'])->name('category.store'); // บันทึกข้อมูล
Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit'); // ฟอร์มแก้ไข
Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update'); // บันทึกแก้ไข
Route::get('/category/detroy/{id}', [CategoryController::class, 'destroy'])->name('category.destroy'); // ลบข้อมูล

Route::get('student/all', [StudentsController::class, 'index'])->name('student');

// Product Controller
Route::get('/products', [ProductsController::class, 'index']);
Route::get('/product/create', [ProductsController::class, 'create'])->name('products.create');
Route::post('/product/store', [ProductsController::class, 'store'])->name('products.store');
Route::get('/product/edit/{id}', [ProductsController::class, 'edit'])->name('products.edit');
Route::post('/product/update/{id}', [ProductsController::class, 'update'])->name('products.update');
Route::get('/product/destroy/{id}', [ProductsController::class, 'destroy'])->name('products.destroy');

// OrderController
Route::get('/order/{id}', function ($id) {
    $order = Order::find($id);
    return $order->rProduct()->orderBy('name', 'desc')->get();
});
Route::get('/order/product/{id}', function ($id) {
    $order = Product::find($id);
    return $order->Order()->orderBy('id', 'desc')->get();
});

// Send Email
Route::get('sendemail', [EmailController::class, 'send_email']);

// User
Route::resource('users', UserController::class);
// Roles User
Route::resource('roles', RoleController::class);

// API
Route::get('getDataApi', [FrontendController::class, 'getDataApi']);

// TCPDF
Route::get('exportPDF', [exportPDFController::class, 'exportPDF']);

