<?php

namespace App\Http\Controllers;

use App\News;
use App\Category;

use Validator;
use Image;
use Redirect;

use Illuminate\Support\Facades\Input;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Library\BikashNewsFunction;

class NewsController extends Controller
{

    //validation 
     protected $rules = [
             'title' => 'bail|required|unique:news|max:255',
             'content' => 'required',
             'author' => 'required',
         ];
        
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        $news = News::all();
        return view('news.index', compact('news'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create()
    {
        $categories = Category::all();
        return view('news.create', compact('categories'));
    }

    /**
    * Store a newly created resource in storage.
    *
    * @return Response
    */
    public function store(Request $request)
    {
        $input = $request->all();
        //save image
         if ( $request->hasFile('image') ) {
            $image     = Input::file('image');
            $path = 'uploads/news/';

            $input['image'] = BikashNewsFunction::imageUpload($image, $path);
            //resizing the image
            $image = Image::make($input['image']);

            $re = $image->resize(null, 1200, function ($constraint) {

                        $constraint->aspectRatio();

                        $constraint->upsize();

                    })->save($input['image']);
        }

        $input['category_id'] = serialize($request->category);
        $input['category_name'] = serialize(BikashNewsFunction::category_name($request->category));
        $news = new News();
        $news->fill($input)->save();

        return Redirect::back()->withFlashSuccess("Successfully Added News");
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function show($id)
    {
        $newsall = News::all();
        $news = News::find($id);
        return view('news.show', compact('news', 'newsall'));
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function edit($id)
    {
        $categories = Category::all();
        $news = News::find($id);
        return view('news.edit', compact('news', 'categories'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:news,title,'. $id .'',
            'content' => 'required',
            'author' => 'required',
            'publish_date' => 'required',
        ]);
        
        $news = News::find($id);
        $input = $request->all();

        if ($validator->fails()) 
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        //save Primary image
         if ( $request->hasFile('image') ) {
            @unlink($image->image);
            $image     = Input::file('image');
            
            $path = 'uploads/news/';

            $input['image'] = BikashNewsFunction::imageUpload($image, $path);
        }

        $input['category_id'] = serialize($request->category);
        $input['category_name'] = serialize(BikashNewsFunction::category_name($request->category));
        $news->update($input);
        
        return Redirect::back()->withFlashSuccess("Successfully Updated News");
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function destroy($id)
    {
        News::find($id)->delete();
        return redirect('news');
    }

    /**
    * {@inheritdoc}
    */
    protected function formatErrors(Validator $validator)
    {
       return $validator->errors()->all();
    }
}
