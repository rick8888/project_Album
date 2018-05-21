<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ImageRepository;
use App\Models\Image;
use App\Models\Category;
use App\Models\User;

class ImageController extends Controller
{
    protected $repository;
    
    public function __construct(ImageRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images=Image::LatestwithUser()->paginate(config('app.pagination'));
        return view('home', compact('images'));  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('images.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
        'image' => 'required|image|max:2000',
        'category_id' => 'required|exists:categories,id',
        'description' => 'nullable|string|max:255',
        ]);
        
        $this->repository->store($request);
        return back()->with('ok', __("L'image a bien été enregistrée"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        $image->delete();
        
        return back();
    }
    
    public function category($slug){
        
        $category = Category::whereSlug($slug)->firstorFail();
        $images = $this->repository->getImagesForCategory($slug);
        return view('home', compact('category', 'images'));
    }
    
    public function user(User $user){
        
        $images=$this->repository->getImagesForUser($user);
        //die($images);
        return view('home', compact('user', 'images'));
    }
    
   public function ChangCategory(Image $image)
   {
       //var_dump($image->category->id);
       //die();
       return view('images.changecategory', compact('image'));
   }
   // save nouvelle categories de image
   public function savechange(Image $image)
   {
       //var_dump($request->category_id);
       var_dump($image->id);
       die("la famille d'abord");
   }
}
