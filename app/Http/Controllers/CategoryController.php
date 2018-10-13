<?php

namespace App\Http\Controllers;
use Validator;
use App\Category;
use Redirect;
use DB, Input, Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(10);
        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a ordertype type.
     
     * @return Response
     */
    public function create()
    {
        return view('category.create');
    }

     /**
     * Store a newly created ordertype type in storage
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
             'display_name' => 'required|unique:categories',
        ]);

        $input = $request->all();

        if ($validator->fails()) 
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }
              $error_message = '';
             try {
                //generate slug
                $input['name'] = str_slug($input['display_name'], '-');

                 $service_creat = Category::create($input);
                 
                    return Redirect::back()->withFlashSuccess("Category Added Successfully");
             }
            catch (Exception $e)
             {
                $error_message = $e->getMessage();
                return Redirect::back()->withErrors($error_message)->withInput();
             }
             return Redirect::back()->withFlashSuccess("Cannot add Category Please check again");

        }

    /**
     * Show the form for editing the specified order type.
     *
     * @param ordertype type $id
     * @return Response
     */
    public function edit($id)
    {
        $edit_category = Category::find($id);
        return view('category.edit', compact('edit_category'));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function update($id, Request $request) {
        $service = Category::findorfail($id);

        $input = $request->all();
        
        try {
            //generate slug
                $input['name'] = str_slug($input['display_name'], '-');
            $updateNow = $service->update($input);
            return Redirect::back()->withFlashSuccess("Successfully Updated Category");
        } catch (Exception $e) {
            $error_message = $e->getMessage();
                return Redirect::back()->withErrors($error_message)->withInput();
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $destroy_product_type = Category::findorfail($id);
        $updateNow = $destroy_product_type->delete($id);
        return redirect()->back()->withFlashSuccess("Category has been successfully Deleted");
    }
}
