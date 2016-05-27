<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Tag;
use App\Post;
use Response;
use Input;


class TagsController extends Controller
{
    public function __construct() {
    	$this->middleware('jwt.auth');
    }

    public function index(Request $request){
    	$search_term = $request->input('search');
    	$limit = $request->input('limit', 5);

    	if ($search_term) {
    		$tags = Tag::orderBy('id','DESC')->where('name','LIKE',"%$search_term")
                            ->select('id','name','isDeleted','post_id')->paginate($limit);

    		$tags->appends(array(
    			'search'	=>	$search_term,
    			'limit'		=> $limit
    			));
    	}
    	else
    	{
    		$tags = Tag::orderBy('id','DESC')
                            ->select('id','name', 'isDeleted','post_id')->paginate($limit);

    		$tags->appends(array(
    			'limit'	=> $limit
    			));
    	}
    	return Response::json($this->transformCollection($tags), 200);
    }

    public function getTagsByPost($postId){
        $tag = Tag::select('id','name','isDeleted','post_id')
                ->where('post_id','=', $postId)->paginate(5);

        return Response::json($this->transformCollection($tag), 200);

    }

    public function show($id){
    	$tag = Tag::with(
            array('posts' => function ($query){
                $query->select('id','title');
            })
            )->find($id);

        if (!$tag) {
            return Response::json([
                'error'     => [
                'message'   => 'Tag does not exits'
                ]
                ], 404);
        }

        // get previous  id
        $previous = Tag::where('id','<', $tag->id)->max('id');

        // get next tag id
        $next = Tag::where('id','>', $tag->id)->min('id');

        return Response::json([
            'previous_tag_id'  	=>  $previous,
            'next_tag_id'      	=>  $next,
            'data'              =>  $this->transform($tag)
            ], 200);
    }

    public function store(Request $request){
    	if (! $request) {
            return Response::json([
                'error' =>  [
                    'message'   =>  'Not Successfully'
                ]
                ], 422);
            }
            $tag   = Tag::create($request->all());

            return Response::json([
                'message'   =>  ' Created Successfully',
                'data'      =>  $this->transform($tag)
                ]);
    }

    public function update(Request $request, $id){
        if (! $request) {
            return Response::json([
                'error' => [
                    'message'   =>  'Not Successfully'
                ]
                ], 422);
        }

        $tag = Tag::find($id);
        $tag->name    	= $request->name;
        $tag->isDeleted = $request->isDeleted;
        $tag->post_id   = $request->post_id;
        $tag->save();

        return Response::json([
                'message'   =>  ' Update Successfully',
                'data'      =>  $this->transform($tag)
            ]);
    }

    public function destroy($id){
        Tag::destroy($id);

        return Response::json([
                'message'   =>  'Tags Delete Successfully',
            ]);
    }

    private function transformCollection($tags){
    	$tagsArray = $tags->toArray();
    	return [
    		'total'			=> $tagsArray['total'],
    		'per_page'		=> intval($tagsArray['per_page']),
    		'current_page'	=> $tagsArray['current_page'],
    		'last_page'		=> $tagsArray['last_page'],
    		'next_page_url'	=> $tagsArray['next_page_url'],
    		'prev_page_url'	=> $tagsArray['prev_page_url'],
    		'from'			=> $tagsArray['from'],
    		'to'			=> $tagsArray['to'],
    		'data'			=>array_map([$this,'transform'], $tagsArray['data'])
    	];
    }

    private function transform($tag){
    	return [
    		'tag_id'		=>	$tag['id'],
    		'name'			=>	$tag['name'],
            'isDeleted'     =>  $tag['isDeleted'],
            'post_id'       =>  $tag['post_id']
    	];
    }
}
