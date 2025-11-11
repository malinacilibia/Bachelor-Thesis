    <?php

    use App\Events\UserRegistration;
    use App\Http\Controllers\Admin\ReminderController;
    use App\Http\Controllers\CatBreedController;
    use App\Http\Controllers\FavoriteController;
    use App\Http\Controllers\PagesController;
    use App\Models\Post;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\PostsController;
    use App\Http\Controllers\AdoptionRequestController;
    use App\Http\Controllers\Admin\AdminController;
    use App\Http\Middleware\IsAdmin;
    use App\Http\Controllers\Admin\PostController;
    use App\Http\Controllers\Admin\AdoptionsRequestController;
    use App\Http\Controllers\Admin\UserController;
    use App\Http\Controllers\AppointmentController;
    use App\Http\Controllers\DonationController;
    use Illuminate\Support\Facades\Broadcast;
    use App\Http\Controllers\Admin\DonationController as AdminDonationController;
    use App\Http\Controllers\AdoptionStoryController;
    use App\Http\Controllers\Admin\PostImageController;

    ;



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

    //Route::get('/', function () {
    //    return view('welcome');
    //});

    Auth::routes(['verify' => true]);

    Route::get('/', [PagesController::class, 'index']);
    Route::get('/about', [PagesController::class, 'about']);
    Route::get('/services', [PagesController::class, 'services']);


    //Route::get('/hello', function () {
    //    return '<h1>Hello World</h1>';
    //});
    //
    //Route::get('/about', function () {
    //    return view('pages.about');
    //});

    Route::get('/users/{id}', function ($id) {
        return 'This is user with id ' . $id;
    });

    Auth::routes();

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Auth::routes();

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Auth::routes();

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('posts', PostsController::class);


    Auth::routes();


    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('posts', PostsController::class);

    Route::middleware(['auth'])->group(function () {
        Route::get('/adoption/{post_id?}', [AdoptionRequestController::class, 'showForm'])->name('adoption.form');

        Route::post('/adoption', [AdoptionRequestController::class, 'submitForm'])->name('adoption.submit');

        Route::get('/adoption-request/{id}', [AdoptionRequestController::class, 'show'])->name('adoption.show');
    });

    Route::middleware(['auth', 'is_admin'])->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

    });


    Route::middleware(['auth', 'is_admin'])->group(function () {
        Route::get('/admin/pisici', [PostController::class, 'index'])->name('admin.pisici');
        Route::get('/admin/pisici/create', [PostController::class, 'create'])->name('admin.pisici.create');
        Route::post('/admin/pisici/store', [PostController::class, 'store'])->name('admin.pisici.store');
        Route::get('/admin/pisici/{id}/edit', [PostController::class, 'edit'])->name('admin.pisici.edit');
        Route::put('/admin/pisici/{id}', [PostController::class, 'update'])->name('admin.pisici.update');
        Route::delete('/admin/pisici/{id}', [PostController::class, 'destroy'])->name('admin.pisici.destroy');
        Route::get('/admin/pisici/{id}', [PostController::class, 'show'])->name('admin.pisici.show');

    });


    Route::middleware(['auth', 'is_admin'])->group(function () {
        Route::get('/admin/adoptie', [AdoptionsRequestController::class, 'index'])->name('admin.adoptie');
        Route::get('/admin/adoptie/{id}', [AdoptionsRequestController::class, 'show'])->name('admin.adoptie.show');
        Route::post('/admin/adoptie/{id}/approve', [AdoptionsRequestController::class, 'approve'])->name('admin.adoptie.approve');
        Route::post('/admin/adoptie/{id}/reject', [AdoptionsRequestController::class, 'reject'])->name('admin.adoptie.reject');
    });




    Route::middleware(['auth'])->group(function () {
        Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');

        Route::get('/appointments/fetch', [AppointmentController::class, 'fetchAppointments'])->name('appointments.fetch');

        Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    });

    Route::middleware(['auth'])->group(function () {
        Route::get('/appointments/create/{post_id}', [AppointmentController::class, 'create'])->name('appointments.create');
    });

    Route::middleware(['auth'])->group(function () {
        Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    });


    Route::middleware(['auth', 'is_admin'])->group(function () {
        Route::get('/admin/appointments', [AppointmentController::class, 'adminIndex'])->name('admin.appointments.index');
        Route::post('/admin/appointments/{appointment}/approve', [AppointmentController::class, 'approve'])->name('admin.appointments.approve');
        Route::post('/admin/appointments/{appointment}/reject', [AppointmentController::class, 'reject'])->name('admin.appointments.reject');
    });

    Route::middleware(['auth'])->group(function () {
        Route::get('/appointments/unavailable', [AppointmentController::class, 'getUnavailableDates'])->name('appointments.unavailable');
        Route::get('/appointments/unavailable-hours/{date}', [AppointmentController::class, 'getUnavailableHours'])->name('appointments.unavailableHours');

    });

    Route::middleware(['auth', 'is_admin'])->group(function () {
        Route::post('/admin/appointments/{appointment}/feedback', [AppointmentController::class, 'addFeedback'])->name('admin.appointments.feedback');
    });

    Route::post('/admin/appointments/{post_id}/adopted', [AppointmentController::class, 'markAsAdopted'])
        ->name('admin.appointments.adopted')
        ->middleware('auth', 'is_admin');

    Route::get('/userRegistration', function () {
        return view('userRegistration');
    });
    Route::post('/userRegistration', function () {
        $name = request()->name;

        event (new UserRegistration($name));
    });


    Broadcast::channel('user.{id}', function ($user, $id) {
        return (int) $user->id === (int) $id;
    });

    Route::post('/adoption/update-status/{id}', [AdoptionRequestController::class, 'updateStatus'])->name('adoption.updateStatus');


    Broadcast::routes(['middleware' => ['auth']]);


    Route::post('/notifications/{id}/read', function ($id) {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->markAsRead();
        return response()->json(['success' => true]);
    })->middleware('auth');




    Route::middleware(['auth'])->group(function () {
        Route::get('/donate', function () {
            return view('donations.donate');
        })->name('donation.form');

        Route::post('/donate', [DonationController::class, 'createCheckoutSession'])->name('donation.process');

        Route::get('/donate/success', function () {
            return view('donations.donation_success');
        })->name('donation.success');

        Route::get('/donate/cancel', function () {
            return view('donations.donation_cancel');
        })->name('donation.cancel');
        Route::get('/donate/verify/{sessionId}', [DonationController::class, 'verifyPayment'])->name('donation.verify');


    });

    Route::middleware(['auth', 'is_admin'])->group(function () {
        Route::get('/admin/donations', [AdminDonationController::class, 'index'])->name('admin.donations');
    });


    Route::middleware(['auth'])->group(function () {
        Route::get('/donate', function () {
            return view('donations.donate');
        })->name('donation.form');

        Route::get('/help', [DonationController::class, 'showDonationForm'])->name('help.options');
    });


    Route::get('/adoption-stories', [AdoptionStoryController::class, 'index'])->name('adoption.stories');
    Route::get('/adoption_stories/{id}', [AdoptionStoryController::class, 'show'])->name('adoption_stories.show');

    Route::middleware('auth')->group(function () {
        Route::get('/my-stories', [AdoptionStoryController::class, 'myStories'])->name('my.stories');
        Route::get('/story/create', [AdoptionStoryController::class, 'create'])->name('story.create');
        Route::post('/story/store', [AdoptionStoryController::class, 'store'])->name('story.store');
        Route::get('/story/{id}/edit', [AdoptionStoryController::class, 'edit'])->name('story.edit');
        Route::put('/story/{id}', [AdoptionStoryController::class, 'update'])->name('story.update');
        Route::delete('/story/{id}', [AdoptionStoryController::class, 'destroy'])->name('story.destroy');

    });

    Route::middleware(['auth', 'is_admin'])->group(function () {
        Route::get('/admin/stories', [AdoptionStoryController::class, 'adminIndex'])->name('admin.stories');
        Route::post('/admin/stories/{id}/approve', [AdoptionStoryController::class, 'approve'])->name('admin.stories.approve');
        Route::post('/admin/stories/{id}/reject', [AdoptionStoryController::class, 'reject'])->name('admin.stories.reject');
        Route::get('/admin/stories/{id}', [AdoptionStoryController::class, 'adminShow'])->name('admin.stories.show');

    });

    Route::delete('/admin/pisici/imagini/{id}', [App\Http\Controllers\Admin\PostImageController::class, 'destroy'])->name('admin.pisici.imagini.destroy');
    Route::middleware(['auth'])->group(function () {
        Route::post('/favorite/{postId}', [FavoriteController::class, 'toggle'])->name('favorite.toggle');
        Route::get('/wishlist', function() {
            $favorites = auth()->user()->favorites()->get();
            return view('wishlist', compact('favorites'));
        })->name('wishlist');
        Route::post('/favorite-toggle/{post}', [FavoriteController::class, 'toggled'])->name('favorite.ajax.toggle');
        Route::delete('/wishlist/{post}', [FavoriteController::class, 'destroy'])->name('wishlist.remove');

    });
    Route::get('/test-login', function () {
        $user = \App\Models\User::first();
        Auth::login($user);
        return 'logged in';
    });

    Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/utilizatori', [UserController::class, 'index'])->name('utilizatori.index');
        Route::get('/utilizatori/{id}', [UserController::class, 'show'])->name('utilizatori.show');
    });

    Route::middleware(['auth'])->group(function () {
        Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
        Route::get('/profile/edit', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
        Route::post('/email/resend', [App\Http\Controllers\ProfileController::class, 'resendVerification'])->name('email.resend');
    });


    Route::prefix('admin')->middleware(['auth', 'is_admin'])->group(function () {
        Route::get('/reminders', [ReminderController::class, 'index'])->name('admin.reminders');
        Route::post('/reminders/send/{appointment}', [ReminderController::class, 'send'])->name('admin.reminders.send');
    });

    Route::prefix('admin')->middleware(['auth', 'is_admin'])->group(function () {
        Route::get('/cat-breed', [CatBreedController::class, 'showForm'])->name('admin.cat.breed.form');
    Route::post('/cat-breed-prediction', [CatBreedController::class, 'savePrediction'])->name('admin.cat.breed.savePrediction');
    });

    Route::get('/cats-age', function(Request $request) {
        $query = Post::query()->where('type', 'pisica')->where('adopted', false);

        if ($request->filled('age_category')) {
            $query->where('age_category', $request->age_category);
        }

        return $query->get(['id', 'title', 'cover_image', 'age', 'gender']);
    });
