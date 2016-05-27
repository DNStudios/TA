<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Comment;
use App\Post;
use App\User;
use Response;
use Input;

class CommentsController extends Controller
{
    public function __construct() {
    	$this->middleware('jwt.auth');
    }

    public function index(Request $request){
    	$search_term = $request->input('search');
    	$limit = $request->input('limit', 5);

    	if ($search_term) {
    		$comments = Comment::orderBy('id','DESC')->where('text','LIKE',"%$search_term")->with(array('User' => function ($query){
    			$query->select('id','name');
    		})
    		)->select('id','text','email','isDeleted','post_id','user_id')->paginate($limit);

    		$comments->appends(array(
    			'search'	=>	$search_term,
    			'limit'		=> $limit
    			));
    	}
    	else
    	{
    		$comments = Comment::orderBy('id','DESC')->with(array('User' => function ($query){
    			$query->select('id','name');
    		})
    		)->select('id','text','email','isDeleted','post_id','user_id')->paginate($limit);

    		$comments->appends(array(
    			'limit'	=> $limit
    			));
    	}
    	return Response::json($this->transformCollection($comments), 200);
    }

    public function getCommentsByPost($postId){
        return Comment::select('id','text','email','isDeleted','post_id','user_id')
            ->where('post_id','=', $postId)->paginate(5);
            // ->get();
            return Response::json($this->transformCollection($comments), 200);

    }

     public function getCommentsByUser($userId){
        return Comment::select('id','text','email','isDeleted','post_id','user_id')
            ->where('user_id','=', $userId)->paginate(5);
            // ->get();
            return Response::json($this->transformCollection($comments), 200);

    }

    public function show($id){
    	$comment = Comment::with(
            array('User' => function ($query){
                $query->select('id','name');
            })
            )->find($id);

        if (!$comment) {
            return Response::json([
                'error'     => [
                'message'   => 'Comment does not exits'
                ]
                ], 404);
        }

        // get previous Comment id
        $previous = Comment::where('id','<', $comment->id)->max('id');

        // get next Comment id
        $next = Comment::where('id','>', $comment->id)->min('id');

        return Response::json([
            'previous_comment_id'  =>  $previous,
            'next_comment_id'      =>  $next,
            'data'              =>  $this->transform($comment)
            ], 200);
    }

    public function store(Request $request){
    	if (! $request->text or ! $request->email) {
            return Response::json([
                'error' =>  [
                    'message'   =>  'Please Provide Bot text and email'
                ]
                ], 422);
            }
            $comment   = Comment::create($request->all());

            return Response::json([
                'message'   =>  'Comment Created Successfully',
                'data'      =>  $this->transform($comment)
                ]);
    }

    public function update(Request $request, $id){
        if (! $request->text or ! $request->email) {
            return Response::json([
                'error' => [
                    'message'   =>  'Please Provide Both text and email'
                ]
                ], 422);
        }

        $comment = Comment::find($id);
        $comment->text    	= $request->text;
        $comment->email     = $request->email;
        $comment->isDeleted = $request->isDeleted;
        $comment->post_id   = $request->post_id;
        $comment->user_id  	= $request->user_id;
        $comment->save();

        return Response::json([
                'message'   =>  'Comment Update Successfully',
                'data'      =>  $this->transform($comment)
            ]);
    }

    public function destroy($id){
        Comment::destroy($id);

        return Response::json([
                'message'   =>  'Comment Delete Successfully',
            ]);
    }

    private function transformCollection($comments){
    	$commentsArray = $comments->toArray();
    	return [
    		'total'			=> $commentsArray['total'],
    		'per_page'		=> intval($commentsArray['per_page']),
    		'current_page'	=> $commentsArray['current_page'],
    		'last_page'		=> $commentsArray['last_page'],
    		'next_page_url'	=> $commentsArray['next_page_url'],
    		'prev_page_url'	=> $commentsArray['prev_page_url'],
    		'from'			=> $commentsArray['from'],
    		'to'			=> $commentsArray['to'],
    		'data'			=>array_map([$this,'transform'], $commentsArray['data'])
    	];
    }

    private function transform($comment){
    	return [
    		'comment_id'	=>	$comment['id'],
    		'text'			=>	$comment['text'],
            'email'         =>  $comment['email'],
            'isDeleted'     =>  $comment['isDeleted'],
            'post_id'       =>  $comment['post_id'],
    		'commented_by'	=>	$comment['user']['name']
    	];
    }
}
