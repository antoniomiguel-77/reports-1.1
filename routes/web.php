<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::controller(TaskController::class)->prefix('/')->group(function(){
    Route::get('/', 'login');
    Route::get('/tarefas','task')->name('task')->middleware(['auth', 'verified']);
    Route::get('/adicionar/tarefas','addTask')->name('add.task')->middleware(['auth', 'verified']);
    Route::post('/tarefas','save')->name('save.task')->middleware(['auth', 'verified']);
    
    
    Route::get('/pendente/{id}','task_pending')->name('pause.task')->middleware(['auth', 'verified']);
    Route::get('/terminada/{id}','task_done')->name('pause.task')->middleware(['auth', 'verified']);
    Route::get('/editar/{id}','task_edit')->name('edit.task')->middleware(['auth', 'verified']);
    Route::post('/actualizar','task_update')->name('update.task')->middleware(['auth', 'verified']);
    
    Route::get('/relatorios','reports')->name('reports')->middleware(['auth', 'verified','admin']);
    Route::post('/relatorios','make_report')->name('make.reports')->middleware(['auth', 'verified','admin']);
    Route::get('/relatorio','report')->name('report.task')->middleware(['auth', 'verified']);
    
    

    Route::get('/other','other_weekend')->name('new_weekend')->middleware(['auth', 'verified','admin']);
    // Criar usuario root
    Route::get("/root",'user_root');
    //Fim 
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/tarefas', function () {
        return view('pages.tasks',[
            'tasks'=>\App\Models\Task::paginate(5)
        ]);
    })->name('task');
});
