<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PracticeAreaController;
use App\Http\Controllers\AttorneyController;
use App\Http\Controllers\LegalFormController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AppointmentController;

Route::get('/language/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'am'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('language.switch');

Route::middleware([\App\Http\Middleware\SetLocale::class])->group(function() {
    // Home
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Practice Areas
    Route::get('/practice-areas', [PracticeAreaController::class, 'index'])->name('practice-areas.index');
    Route::get('/practice-areas/{practiceArea:slug}', [PracticeAreaController::class, 'show'])->name('practice-areas.show');

    // Attorneys
    Route::get('/attorneys', [AttorneyController::class, 'index'])->name('attorneys.index');
    Route::get('/attorneys/{attorney:slug}', [AttorneyController::class, 'show'])->name('attorneys.show');

    // Legal Forms Store
    Route::get('/legal-forms', [LegalFormController::class, 'index'])->name('legal-forms.index');
    Route::get('/legal-forms/{form}', [LegalFormController::class, 'show'])->name('legal-forms.show');

    // Chapa Payment Integration
    Route::post('/checkout/{form}', [\App\Http\Controllers\CheckoutController::class, 'pay'])->name('checkout.pay')->middleware('throttle:checkout');
    Route::post('/checkout/webhook', [\App\Http\Controllers\CheckoutController::class, 'webhook'])->name('checkout.webhook');
    Route::get('/checkout/pending/{tx_ref}', [\App\Http\Controllers\CheckoutController::class, 'pending'])->name('checkout.pending');
    Route::get('/checkout/callback', [\App\Http\Controllers\CheckoutController::class, 'callback'])->name('checkout.callback')->middleware('throttle:checkout');
    Route::get('/checkout/success/{order}', [\App\Http\Controllers\CheckoutController::class, 'success'])->name('checkout.success');
    Route::get('/checkout/download/{order}', [\App\Http\Controllers\CheckoutController::class, 'download'])->name('checkout.download')->middleware('throttle:download');

    // Contact
    Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store')->middleware('throttle:3,1');
    Route::get('/contact/success', [ContactController::class, 'success'])->name('contact.success');

    // Chat
    Route::post('/chat', [\App\Http\Controllers\ChatSubmitController::class, 'store'])->name('chat.store');
    Route::get('/chat/{chat}', [\App\Http\Controllers\ChatSubmitController::class, 'show'])->name('chat.show');

    // Appointments
    Route::get('/book-consultation', [AppointmentController::class, 'create'])->name('appointment.create');
    Route::post('/book-consultation', [AppointmentController::class, 'store'])->name('appointment.store');
    Route::get('/book-consultation/success', [AppointmentController::class, 'success'])->name('appointment.success');

    // Static Pages
    Route::view('/about', 'pages.about')->name('about');
    Route::view('/privacy-policy', 'pages.privacy')->name('privacy');
    Route::view('/legal-disclaimer', 'pages.disclaimer')->name('disclaimer');
    Route::view('/terms', 'pages.terms')->name('terms');
    Route::get('/faqs', function() { 
        $faqs = \App\Models\Faq::where('is_published', true)->get(); 
        return view('pages.faqs', compact('faqs')); 
    })->name('faqs.public');

    // Keep admin routes and auth routes for backward compability from old web.php
    Route::prefix('admin')->middleware(['auth', \App\Http\Middleware\IsAdmin::class])->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/orders', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('admin.orders.index');
        Route::get('/contacts', [\App\Http\Controllers\Admin\ContactController::class, 'index'])->name('admin.contacts.index');
        Route::delete('/contacts/{contact}', [\App\Http\Controllers\Admin\ContactController::class, 'destroy'])->name('admin.contacts.destroy');
        Route::get('/forms', [\App\Http\Controllers\Admin\FormController::class, 'index'])->name('admin.forms.index');
        Route::get('/forms/create', [\App\Http\Controllers\Admin\FormController::class, 'create'])->name('admin.forms.create');
        Route::post('/forms', [\App\Http\Controllers\Admin\FormController::class, 'store'])->name('admin.forms.store');
        Route::get('/forms/{form}/edit', [\App\Http\Controllers\Admin\FormController::class, 'edit'])->name('admin.forms.edit');
        Route::put('/forms/{form}', [\App\Http\Controllers\Admin\FormController::class, 'update'])->name('admin.forms.update');
        Route::delete('/forms/{form}', [\App\Http\Controllers\Admin\FormController::class, 'destroy'])->name('admin.forms.destroy');
        // FAQ management
        Route::get('/faqs', [\App\Http\Controllers\Admin\FaqController::class, 'index'])->name('admin.faqs.index');
        Route::get('/faqs/create', [\App\Http\Controllers\Admin\FaqController::class, 'create'])->name('admin.faqs.create');
        Route::post('/faqs', [\App\Http\Controllers\Admin\FaqController::class, 'store'])->name('admin.faqs.store');
        Route::get('/faqs/{faq}/edit', [\App\Http\Controllers\Admin\FaqController::class, 'edit'])->name('admin.faqs.edit');
        Route::put('/faqs/{faq}', [\App\Http\Controllers\Admin\FaqController::class, 'update'])->name('admin.faqs.update');
        Route::delete('/faqs/{faq}', [\App\Http\Controllers\Admin\FaqController::class, 'destroy'])->name('admin.faqs.destroy');
        Route::get('/chat', [\App\Http\Controllers\Admin\ChatController::class, 'index'])->name('admin.chat.index');
        Route::post('/chat/{chat}/reply', [\App\Http\Controllers\Admin\ChatController::class, 'reply'])->name('admin.chat.reply');
        // Attorneys management
        Route::get('/attorneys', [\App\Http\Controllers\Admin\AttorneyController::class, 'index'])->name('admin.attorneys.index');
        Route::get('/attorneys/create', [\App\Http\Controllers\Admin\AttorneyController::class, 'create'])->name('admin.attorneys.create');
        Route::post('/attorneys', [\App\Http\Controllers\Admin\AttorneyController::class, 'store'])->name('admin.attorneys.store');
        Route::get('/attorneys/{attorney}/edit', [\App\Http\Controllers\Admin\AttorneyController::class, 'edit'])->name('admin.attorneys.edit');
        Route::put('/attorneys/{attorney}', [\App\Http\Controllers\Admin\AttorneyController::class, 'update'])->name('admin.attorneys.update');
        Route::delete('/attorneys/{attorney}', [\App\Http\Controllers\Admin\AttorneyController::class, 'destroy'])->name('admin.attorneys.destroy');
        // Case Results management
        Route::get('/case-results', [\App\Http\Controllers\Admin\CaseResultController::class, 'index'])->name('admin.case-results.index');
        Route::get('/case-results/create', [\App\Http\Controllers\Admin\CaseResultController::class, 'create'])->name('admin.case-results.create');
        Route::post('/case-results', [\App\Http\Controllers\Admin\CaseResultController::class, 'store'])->name('admin.case-results.store');
        Route::get('/case-results/{caseResult}/edit', [\App\Http\Controllers\Admin\CaseResultController::class, 'edit'])->name('admin.case-results.edit');
        Route::put('/case-results/{caseResult}', [\App\Http\Controllers\Admin\CaseResultController::class, 'update'])->name('admin.case-results.update');
        Route::delete('/case-results/{caseResult}', [\App\Http\Controllers\Admin\CaseResultController::class, 'destroy'])->name('admin.case-results.destroy');
        // Testimonials management
        Route::get('/testimonials', [\App\Http\Controllers\Admin\TestimonialController::class, 'index'])->name('admin.testimonials.index');
        Route::get('/testimonials/create', [\App\Http\Controllers\Admin\TestimonialController::class, 'create'])->name('admin.testimonials.create');
        Route::post('/testimonials', [\App\Http\Controllers\Admin\TestimonialController::class, 'store'])->name('admin.testimonials.store');
        Route::get('/testimonials/{testimonial}/edit', [\App\Http\Controllers\Admin\TestimonialController::class, 'edit'])->name('admin.testimonials.edit');
        Route::put('/testimonials/{testimonial}', [\App\Http\Controllers\Admin\TestimonialController::class, 'update'])->name('admin.testimonials.update');
        Route::delete('/testimonials/{testimonial}', [\App\Http\Controllers\Admin\TestimonialController::class, 'destroy'])->name('admin.testimonials.destroy');
    });

    Route::get('/login', [\App\Http\Controllers\Admin\AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [\App\Http\Controllers\Admin\AuthController::class, 'login'])->middleware('throttle:login')->name('login.submit');
    Route::post('/logout', [\App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout')->middleware('auth');

    Route::get('/register', [\App\Http\Controllers\Admin\AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [\App\Http\Controllers\Admin\AuthController::class, 'register'])->name('register.submit')->middleware('throttle:register');

    // User Profile
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    });
});
