<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use App\User;
use Response;
use Input;

class PostsController extends Controller
{
    public function __construct()
    {
    	$this->middleware('jwt.auth');
    }

    public function index(Request $request){
    	$search_term = $request->input('search');
    	$limit = $request->input('limit', 5);

    	if ($search_term) {
    		$posts = Post::orderBy('id', 'DESC')->where('title','LIKE', "%$search_term")->with(array('User' => function ($query){
    			$query->select('id','name');
    		})
    		)->select('id','title','body','image','user_id')->paginate($limit);

    		$posts->appends(array(
    			'search'	=>	$search_term,
    			'limit'		=>	$limit
    			));
    	}
    	else
    	{
    		$posts = Post::orderBy('id','DESC')->with(array('User' => function ($query){
    			$query->select('id','name');
    		})
    		)->select('id','title','body','image','user_id')->paginate($limit);

    		$posts->appends(array(
    			'limit'	=>	$limit
    			));
    	}
    	return Response::json($this->transformCollection($posts), 200);

    } 

    public function show($id){
        $post = Post::with(
            array('User' => function ($query){
                $query->select('id','name');
            })
            )->find($id);

        if (!$post) {
            return Response::json([
                'error'     => [
                'message'   => 'Post does not exits'
                ]
                ], 404);
        }

        // get previous post id
        $previous = Post::where('id','<', $post->id)->max('id');

        // get next post id
        $next = Post::where('id','>', $post->id)->min('id');

        return Response::json([
            'previous_post_id'  =>  $previous,
            'next_post_id'      =>  $next,
            'data'              =>  $this->transform($post)
            ], 200);
    }

    public function store(Request $request){
        if (! $request->title or ! $request->body or ! $request->user_id) {
            return Response::json([
                'error' =>  [
                    'message'   =>  'Please input title, body and user_id'
                ]
                ], 422);
            }
            $post   = Post::create($request->all());

            return Response::json([
                'message'   =>  'Post Created Successfully',
                'data'      =>  $this->transform($post)
                ]);      
    }

    public function update(Request $request, $id){
        if (! $request->title or ! $request->body or ! $request->user_id) {
            return Response::json([
                'error' => [
                    'message'   =>  'Please input title, body and user_id'
                ]
                ], 422);
        }

        $post = Post::find($id);
        $post->title    = $request->title;
        $post->body     = $request->body;
        $post->image    = $request->image;
        $post->user_id  = $request->user_id;
        $post->save();

        return Response::json([
                'message'   =>  'Post Update Successfully',
                'data'      =>  $this->transform($post)
            ]);
    }

    public function destroy($id){
        Post::destroy($id);

        return Response::json([
                'message'   =>  'Post Delete Successfully',
            ]);
    }


    private function transformCollection($posts){
    	$postsArray = $posts->toArray();
    	return [
    		'total'			=> $postsArray['total'],
    		'per_page'		=> intval($postsArray['per_page']),
    		'current_page'	=> $postsArray['current_page'],
    		'last_page'		=> $postsArray['last_page'],
    		'next_page_url'	=> $postsArray['next_page_url'],
    		'prev_page_url'	=> $postsArray['prev_page_url'],
    		'from'			=> $postsArray['from'],
    		'to'			=> $postsArray['to'],
    		'data'			=>array_map([$this,'transform'], $postsArray['data'])
    	];
    }

    private function transform($post){
    	return [
    		'post_id'		=>	$post['id'],
    		'title'			=>	$post['title'],
            'body'          =>  $post['body'],
            'image'         =>  $post['image'],
    		'submitted_by'	=>	$post['user']['name']
    	];
    }


}
