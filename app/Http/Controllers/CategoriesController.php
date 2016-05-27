<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use App\Category;
use Response;
use Input;

class CategoriesController extends Controller
{
    public function __construct() {
    	$this->middleware('jwt.auth');
    }

    public function index(Request $request){
    	$search_term = $request->input('search');
    	$limit = $request->input('limit', 5);

    	if ($search_term) {
    		$categories = Category::orderBy('id','DESC')->where('name','LIKE',"%$search_term")->with(array('posts' => function ($query){
    			$query->select('id','title');
    		})
    		)->select('id','name','isDeleted','post_id')->paginate($limit);

    		$categories->appends(array(
    			'search'	=>	$search_term,
    			'limit'		=> $limit
    			));
    	}
    	else
    	{
    		$categories = Category::orderBy('id','DESC')->with(array('posts' => function ($query){
    			$query->select('id','title');
    		})
    		)->select('id','name', 'isDeleted','post_id')->paginate($limit);

    		$categories->appends(array(
    			'limit'	=> $limit
    			));
    	}
    	return Response::json($this->transformCollection($categories), 200);
    }

    public function getCategoriesByPost($postId){
        return Category::select('id','name','isDeleted','post_id')
            ->where('post_id','=', $postId)->paginate(5);
            // ->get();
            return Response::json($this->transformCollection($categories), 200);

    }

    public function show($id){
    	$category = Category::with(
            array('posts' => function ($query){
                $query->select('id','title');
            })
            )->find($id);

        if (!$category) {
            return Response::json([
                'error'     => [
                'message'   => 'Category does not exits'
                ]
                ], 404);
        }

        // get previous  id
        $previous = Category::where('id','<', $category->id)->max('id');

        // get next category id
        $next = Category::where('id','>', $category->id)->min('id');

        return Response::json([
            'previous_category_id'  	=>  $previous,
            'next_category_id'      	=>  $next,
            'data'              =>  $this->transform($category)
            ], 200);
    }

    public function store(Request $request){
    	if (! $request->name or ! $request->post_id) {
            return Response::json([
                'error' =>  [
                    'message'   =>  'Created Not Successfully'
                ]
                ], 422);
            }
            $category   = Category::create($request->all());

            return Response::json([
                'message'   =>  ' Created Successfully',
                'data'      =>  $this->transform($category)
                ]);
    }

    public function update(Request $request, $id){
        if (! $request->name or ! $request->post_id) {
            return Response::json([
                'error' => [
                    'message'   =>  'Update Not Successfully'
                ]
                ], 422);
        }

        $category = Category::find($id);
        $category->name    	= $request->name;
        $category->isDeleted = $request->isDeleted;
        $category->post_id   = $request->post_id;
        $category->save();

        return Response::json([
                'message'   =>  ' Update Successfully',
                'data'      =>  $this->transform($category)
            ]);
    }

    public function destroy($id){
        Category::destroy($id);

        return Response::json([
                'message'   =>  ' Delete Successfully',
            ]);
    }

    private function transformCollection($categories){
    	$categoriesArray = $categories->toArray();
    	return [
    		'total'			=> $categoriesArray['total'],
    		'per_page'		=> intval($categoriesArray['per_page']),
    		'current_page'	=> $categoriesArray['current_page'],
    		'last_page'		=> $categoriesArray['last_page'],
    		'next_page_url'	=> $categoriesArray['next_page_url'],
    		'prev_page_url'	=> $categoriesArray['prev_page_url'],
    		'from'			=> $categoriesArray['from'],
    		'to'			=> $categoriesArray['to'],
    		'data'			=>array_map([$this,'transform'], $categoriesArray['data'])
    	];
    }

    private function transform($category){
    	return [
    		'category_id'	=>	$category['id'],
    		'name'			=>	$category['name'],
            'isDeleted'     =>  $category['isDeleted'],
            'post_id'       =>  $category['post_id']
            // 'title'       	=>  $category['title']
    	];
    }
}
