<?php
//php artisan make:controller PostsController --resource vaka se kreira controller so site funkcii so index,create,update,show,edit
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;// ovoa ga dodavamo za da mozemo da ga koriste post za da gi izvelecemi podatocite bez query
use DB;
class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::orderBy('created_at', 'desc')->get();
//  foreach ($posts as $post){
//      echo $post->title;
//  }
        //return $posts;
//   return Post::where('title','Third post')->get();
////  $posts= DB::select('SELECT * FROM  posts');
/// $posts=Post::all();
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        return view('posts.index')->with('posts', $posts);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()//funkcija za create post page vraka  view create.blade.php
    {
        //
        return view('posts.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)//za validacija i vnes u baza
    {



        $this->validate($request,[
            'title'=>'required',
            'body'=> 'required',
            'cover_image'=>'image|nullable|max:1999'

        ]);

        //Handle FIle Upload

        if ($request->hasFile('cover_image')){
            //get filename with extension
            $fileNameWithExt=$request->file('cover_image')->getClientOriginalName();
            //get just filename
            $filename=pathinfo($fileNameWithExt,PATHINFO_FILENAME);
            //get just ext
            $extension=$request->file('cover_image')->getClientOriginalExtension();
            //filenaem to store
            $fileNameToStore=$filename.'_'.time().'.'.$extension;
            //upload image path
            $path=$request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);//C:\xampp\htdocs\lsapp>php artisan storage:link , za da naprave path na slikite


        }else{
            $fileNameToStore='noimage.jpg';
        }

        //create post i input u baza
        $post=new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id=auth()->user()->id;
        $post->cover_image=$fileNameToStore;
        $post->save();

        return redirect('http://localhost/lsapp/public/posts')->with('success','Post Created');



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post=Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post=Post::find($id);

        //check for correct user

        if(auth()->user()->id !==$post->user_id){
            return redirect('/posts')->with('error','Unauthorized Page');
    }

        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request,[
            'title'=>'required',
            'body'=> 'required'
        ]);

        if ($request->hasFile('cover_image')){
            //get filename with extension
            $fileNameWithExt=$request->file('cover_image')->getClientOriginalName();
            //get just filename
            $filename=pathinfo($fileNameWithExt,PATHINFO_FILENAME);
            //get just ext
            $extension=$request->file('cover_image')->getClientOriginalExtension();
            //filenaem to store
            $fileNameToStore=$filename.'_'.time().'.'.$extension;
            //upload image path
            $path=$request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);//C:\xampp\htdocs\lsapp>php artisan storage:link , za da naprave path na slikite


        }

        $post= Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if ($request->hasFile('cover_image')) {
            $post->cover_image = $fileNameToStore;
        }
        $post->save();

        return redirect('http://localhost/lsapp/public/posts')->with('success','Post updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::find($id);
        //check for correct user
        if(auth()->user()->id !==$post->user_id){
            return redirect('/posts')->with('error','Unauthorized Page');
        }
        if ($post->cover_image!='noimage.jpg'){
            //delete image if is not noimage.jpg
            Storage::delete('public/cover_images/'.$post->cover_image);
        }
        $post->delete();
        return redirect('http://localhost/lsapp/public/posts')->with('success','Post deleted');


    }
}
