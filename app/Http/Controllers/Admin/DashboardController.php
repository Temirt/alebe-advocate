<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\Faq;
use App\Models\ChatMessage;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;

class DashboardController extends Controller
{
    public function index()
    {
        $formsCount = Form::count();
        $faqsCount = Faq::count();
        $messagesCount = Contact::count(); // Formal Contact submissions
        $liveChatsCount = ChatMessage::count(); // Live floating chat 
        $usersCount = User::count();
        $ordersCount = Order::count();

        return view('admin.dashboard', compact('formsCount','faqsCount','messagesCount', 'liveChatsCount', 'usersCount', 'ordersCount'));
    }
}
