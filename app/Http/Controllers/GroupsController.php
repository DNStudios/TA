<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
<<<<<<< HEAD
use App\Group;
use Input;
use Response;

class GroupsController extends Controller
{
    public function __construct(){
    	$this->middleware('jwt.auth');
    }

    public function index(Request $request){
    	$search_term	=	$request->input('search');
    	$limit			=	$request->input('limit', 5);

    	if ($search_term) {
    		$groups 	=	Group::orderBy('id','DESC')->where('name','LIKE',"$search_term")->with(array('user' => function ($query){
    			$query->select('id','name');
    		})
    		)->select('id','name','privileges','user_id','isDeleted')->paginate($limit);

    		$groups->appends(array(
    			'search'	=>	$search_term,
    			'limit'		=>	$limit
    			));
    	}
    	else{
    		$groups = Group::orderBy('id','DESC')->with(array('user' => function ($query){
    			$query->select('id','name');
    		})
    		)->select('id','name','privileges','user_id','isDeleted')->paginate($limit);

    		$groups->appends(array(
    			'search'	=>	$search_term,
    			'limit'		=>	$limit
    			));
    		return Response::json($this->transformCollection($groups), 200);
    	}
    }

    public function getGroupsByUser($userId){
    	$group =  Group::select('id','name','privileges','user_id','isDeleted')
    				->with(array('user' => function ($query){
    					$query->select('id','name');
    				})
    				)->where('user_id', '=' , $userId)->paginate(5);
    				
    				return Response::json($this->transformCollection($group), 200);

    }

    public function show($id){
    	$group = Group::with(
    		array('user' => function ($query){
    			$query->select('id','name');
    		})
    		)->find($id);

    	if (!$group) {
    		return Response::json([
    			'error'		=>	[
    			'message'	=>	'Groups does not exist'
    			]
    			], 404);
    	}
    	// get previous group id
    	$previous 	= Group::where('id','<', $group->id)->max('id');
    	// get next group id
    	$next 		=	Group::where('id','>', $group->id)->min('id');
    	
    	return Response::json([
    		'previous_group_id'	=>	$previous,
    		'next_group_id'		=>	$next,
    		'data'				=>	$this->transform($group)
    		], 200);
    }

    public function store(Request $request){
    	if (! $request->name or ! $request->privileges or ! $request->user_id) {
    		return Response::json([
    			'error'	=>	[
    				'message'	=>	'Iam Sorry, must be input name, privileges and user_id'
    			]
    			], 422);
    	}
    	$group 	=	Group::create($request->all());

    	return Response::json([
    		'message'	=>	'Thanks :), Groups Created Successfully',
    		'data'		=>	$this->transform($group)
    		]);
    }

    public function update(Request $request, $id){
    	if (! $request->name or ! $request->privileges or ! $request->user_id) {
    		return Response::json([
    			'error'	=>	[
    				'message'	=>	'Iam Sorry, must be input name, privileges and user_id'
    			]
    			], 422);
    	}

    	$group = Group::find($id);
    	$group->name 		=	$request->name;
    	$group->privileges 	=	$request->privileges;
    	$group->user_id 	=	$request->user_id;
    	$group->isDeleted 	=	$request->isDeleted;
    	$group->save();

    	return Response::json([
    		'message'	=>	'Thanks :), Group Update Successfully',
    		'data'		=>	$this->transform($group)
    		]);
    }

    public function destroy($id){
    	Group::destroy($id);

    	return Response::json([
    		'message'	=>	'Thanks :), Group Delete Successfully'
    		]);
    }

    private function transformCollection($groups){
    	$groupsArray = $groups->toArray();
    	return [
    		'total'			=> $groupsArray['total'],
    		'per_page'		=> intval($groupsArray['per_page']),
    		'current_page'	=> $groupsArray['current_page'],
    		'last_page'		=> $groupsArray['last_page'],
    		'next_page_url'	=> $groupsArray['next_page_url'],
    		'prev_page_url'	=> $groupsArray['prev_page_url'],
    		'from'			=> $groupsArray['from'],
    		'to'			=> $groupsArray['to'],
    		'data'			=>array_map([$this,'transform'], $groupsArray['data'])
    	];
    }

    private function transform($groups){
    	return [
    		'group_id'		=> $groups['id'],
    		'name'			=> $groups['name'],
    		'privileges'	=> $groups['privileges'],
    		'submitted_by'	=> $groups['user']['name']
    	];
    }
=======

class GroupsController extends Controller
{
    //
>>>>>>> c4327df9b8736d3c8a842d758d030bde4ced110f
}
