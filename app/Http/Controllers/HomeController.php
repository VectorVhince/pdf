<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts;
use App\Comments;
use App\Announcements;
use App\User;
use App\Notification;
use Auth;
use App\Page;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
        'except' => [
        'index',
        'search',
        'error',
        'about',
        'terms',
        'privacy',
        ]]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $featured = Posts::where('featured', '=', '1')->where('approved', '=', '1')->orderBy('featured_date', 'desc')->take(7)->get();

        $views_counter = config('variables.views');
        $views = Posts::where('views', '>=', $views_counter)->where('featured', '!=', '1')->where('approved', '=', '1')->orderBy('trend_date', 'desc')->take(7)->get();        

        $news = Posts::where('category','news')->where('approved', '=', '1')->latest()->skip(1)->take(3)->get();
        $editorials = Posts::where('category','editorial')->where('featured','!=','1')->where('approved', '=', '1')->latest()->skip(1)->take(3)->get();
        $opinions = Posts::where('category','opinion')->where('featured','!=','1')->where('approved', '=', '1')->latest()->skip(1)->take(3)->get();
        $features = Posts::where('category','feature')->where('featured','!=','1')->where('approved', '=', '1')->latest()->skip(1)->take(3)->get();
        $humors = Posts::where('category','humor')->where('featured','!=','1')->where('approved', '=', '1')->latest()->skip(1)->take(3)->get();
        $sports = Posts::where('category','sports')->where('featured','!=','1')->where('approved', '=', '1')->latest()->skip(1)->take(3)->get();
        

        $news_first = Posts::where('category','news')->where('approved', '=', '1')->latest()->first();
        $editorials_first = Posts::where('category','editorial')->where('approved', '=', '1')->latest()->first();
        $opinions_first = Posts::where('category','opinion')->where('approved', '=', '1')->latest()->first();
        $features_first = Posts::where('category','feature')->where('approved', '=', '1')->latest()->first();
        $humors_first = Posts::where('category','humor')->where('approved', '=', '1')->latest()->first();
        $sports_first = Posts::where('category','sports')->where('approved', '=', '1')->latest()->first();

        $announcements = Announcements::latest()->take(7)->get();

        $recent_comments = Comments::latest()->take(7)->get();        

        return view('welcome')
        ->with('featured', $featured)
        ->with('views', $views)
        ->with('news', $news)
        ->with('opinions', $opinions)
        ->with('features', $features)
        ->with('humors', $humors)
        ->with('sports', $sports)
        ->with('news_first', $news_first)
        ->with('editorials', $editorials)
        ->with('opinions_first', $opinions_first)
        ->with('features_first', $features_first)
        ->with('humors_first', $humors_first)
        ->with('sports_first', $sports_first)
        ->with('editorials_first', $editorials_first)
        ->with('announcements', $announcements)
        ->with('recent_comments', $recent_comments);
    }

    public function createAnnouncement()
    {
        return view('admin.create_announcement');
    }

    public function storeAnnouncement(Request $request)
    {
        $this->validate($request, [
            'body' => 'required'
            ]);

        $announcements = new Announcements;
        $announcements->create($request->all());

        $request->session()->flash('alert-success', 'Announcement was successfully created!');
        return redirect()->route('home');
    }

    public function editAnnouncement($id)
    {
        $announcement = Announcements::find($id);

        return view('admin.edit_announcement')->with('announcement',$announcement);
    }

    public function updateAnnouncement(Request $request, $id)
    {
        $announcement = Announcements::find($id);
        $this->validate($request, [
            'body' => 'required'
            ]);

        $announcement->update($request->all());
        
        $request->session()->flash('alert-success', 'Announcement was successfully updated!');
        return redirect()->route('home');
    }

    public function deleteAnnouncement(Request $request, $id) {
        Announcements::find($id)->delete();

        $request->session()->flash('alert-danger', 'Announcement was successfully deleted!');
        return redirect()->route('home');
    }

    public function search(Request $request)
    {
        if (Auth::guest()) {
            if ($request->search == "iamadmin") {
                return view('auth.login');
            }
        }

        $items = Posts::where(function($query) use ($request) {
            if ($search=$request->get('search')) {
                $query->orWhere('title', 'like', '%' . $search . '%');
                $query->orWhere('body', 'like', '%' . $search . '%');
                $query->orWhere('user', 'like', '%' . $search . '%');
            }
        })->paginate(10);

        $search = $request->search;

        $count = $items->total();

        return view('search')
        ->with('items',$items)
        ->with('search',$search)
        ->with('count',$count);
    }

    public function settings()
    {
        return view('admin.settings');
    }

    public function changePassword(Request $request, $id) {
        $user = User::find($id);

        $this->validate($request, [
            'old_password' => 'required|min:6',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|min:6',
            ]);

        $old_password = $request->old_password;
        $new_password = $request->new_password;
        $confirm_password = $request->confirm_password;
        $current_password = $user->password;

        if ($new_password == $confirm_password) {
            if (\Hash::check($old_password,$current_password)) {
                $user->password = bcrypt($new_password);
                $user->update();

                $request->session()->flash('alert-success', "Password successfully updated!");
                return redirect()->route('settings');
            }
        }
        else {
            $request->session()->flash('alert-danger', "New password and confirm password don't match!");
            return redirect()->route('settings');
        }
    }

    public function changeName(Request $request, $id) {
        $user = User::find($id);

        $this->validate($request, [
            'name' => 'required',
            ]);

        $user->name = $request->name;
        $user->update();

        $request->session()->flash('alert-success', "Name successfully updated!");
        return redirect()->route('settings');
    }

    public function changeUsername(Request $request, $id) {
        $user = User::find($id);

        $this->validate($request, [
            'username' => 'required',
            ]);

        $user->username = $request->username;
        $user->update();

        $request->session()->flash('alert-success', "Username successfully updated!");
        return redirect()->route('settings');
    }

    public function changeEmail(Request $request, $id) {
        $user = User::find($id);

        $this->validate($request, [
            'email' => 'required',
            ]);

        $user->email = $request->email;
        $user->update();

        $request->session()->flash('alert-success', "Username successfully updated!");
        return redirect()->route('settings');
    }

    public function myPosts($id)
    {
        $users = User::find($id)->postsUser()->latest()->get();

        return view('admin.my_posts')->with('users', $users);
    }

    public function myPostsSortBy(Request $request, $id)
    {
        switch ($request->key) {
            case 'date':
                $users = User::find($id)->postsUser()->latest()->get();

                return view('admin.my_posts')->with('users', $users);
                break;

            case 'name':
                $users = User::find($id)->postsUser()->orderBy('title','asc')->get();

                return view('admin.my_posts')->with('users', $users);
                break;

            case 'views':
                $users = User::find($id)->postsUser()->orderBy('views','desc')->get();

                return view('admin.my_posts')->with('users', $users);
                break;
        }
        
    }

    public function pendingPosts() {
        $posts = Posts::where('approved','0')->latest()->get();
        Notification::where('active', '=', '1')->where('category','pending')->update(array('active' => '0'));

        return view('admin.pending_posts')->with('posts',$posts);
    }

    public function pendingSortBy(Request $request)
    {
        switch ($request->key) {
            case 'date':
                $posts = Posts::where('approved','0')->latest()->get();

                return view('admin.pending_posts')->with('posts', $posts);
                break;

            case 'name':
                $posts = Posts::where('approved','0')->orderBy('title','asc')->get();

                return view('admin.pending_posts')->with('posts', $posts);
                break;
        }
        
    }

    public function error() {
        return view('errors.503');
    }

    public function accounts() {
        $users = User::all();

        return view('admin.accounts')->with('users',$users);
    }

    public function updateRole(Request $request, $id) {
        $user = User::find($id);

        $user->role = $request->role;
        $user->update();

        $request->session()->flash('alert-success', "Role successfully updated!");
        return redirect()->route('accounts');
    }

    public function updatePosition(Request $request, $id) {
        $user = User::find($id);

        $user->position = $request->position;
        $user->update();

        $request->session()->flash('alert-success', "Role successfully updated!");
        return redirect()->route('accounts');
    }

    public function about() {
        $users = User::all();
        $category = Page::where('category','about')->first();
        return view('about')->with('category',$category)->with('users',$users);
    }

    public function aboutUpdate(Request $request, $id) {
        $category = Page::find($id);

        $category->content = $request->content;
        $category->update();

        return redirect()->route('about');
    }

    public function terms() {
        $category = Page::where('category','terms')->first();
        return view('terms')->with('category',$category);
    }

    public function termsUpdate(Request $request, $id) {
        $category = Page::find($id);

        $category->content = $request->content;
        $category->update();

        return redirect()->route('terms');
    }

    public function privacy() {
        $category = Page::where('category','privacy')->first();
        return view('privacy')->with('category',$category);
    }

    public function privacyUpdate(Request $request, $id) {
        $category = Page::find($id);

        $category->content = $request->content;
        $category->update();

        return redirect()->route('privacy');
    }

    public function weatherUpdate(Request $request, $id) {
        $category = Page::find($id);

        $category->content = $request->content;
        $category->update();

        return redirect()->route('index.news');
    }

    public function calendarUpdate(Request $request, $id) {
        $category = Page::find($id);

        $category->content = $request->content;
        $category->update();

        return redirect()->route('index.editorial');
    }

    public function selfopinionUpdate(Request $request, $id) {
        $category = Page::find($id);

        $category->content = $request->content;
        $category->update();

        return redirect()->route('index.opinion');
    }

    public function readalsoUpdate(Request $request, $id) {
        $category = Page::find($id);

        $category->content = $request->content;
        $category->update();

        return redirect()->route('index.feature');
    }

    public function fromwebUpdate(Request $request, $id) {
        $category = Page::find($id);

        $category->content = $request->content;
        $category->update();

        return redirect()->route('index.humor');
    }

    public function outsidesportsUpdate(Request $request, $id) {
        $category = Page::find($id);

        $category->content = $request->content;
        $category->update();

        return redirect()->route('index.sports');
    }
}
