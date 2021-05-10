<?php

namespace App\Http\Controllers\Admin\Work;

use App\Http\Controllers\Controller;
use App\User;
use App\Work;
use Illuminate\Http\Request;

class WorkController extends Controller
{
    public function index(Request $request)
    {      
        $state = $request->state;
        $searchOption = $request->search_option;
        $searchText = $request->search_text;

        if($searchText !== NULL){
            if($request->search_option === "uid"){      
                $workData = Work::whereHas('user', function ($query) use($searchText){
                    $query->where('name', 'LIKE', '%'. $searchText .'%');
                })->paginate(10);
            }else{
                $workData = Work::where([
                    [function($query) use ($searchOption, $searchText){
                        $query->orWhere($searchOption, 'LIKE', '%'.$searchText.'%')->get();
                    }]
                ])->paginate(10);
            }
        }else{
            switch ($state) {
                case 'normal':
                    $workData = Work::where('state', 10)->latest()->paginate(10);
                    break;
                case 'waiting':
                    $workData = Work::where('state', 9)->latest()->paginate(10);
                    break;
                case 'stop':
                    $workData = Work::where('state', 8)->latest()->paginate(10);
                    break;
                case 'expiration':
                    $workData = Work::where('state', 7)->latest()->paginate(10);
                    break;
                case 'delete':
                    $workData = Work::where('state', 0)->latest()->paginate(10);
                    break;
                default:
                    $workData = Work::latest()->paginate(10);
                    break;
            }
        }

        return view('project.project_list', compact('workData'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function getUid(Request $request){
        $search = $request->search;

        $uids = User::orderby('uid', 'asc')->where('uid', 'LIKE', $search.'%')->limit(5)->get();

        foreach($uids as $uid){
            $response[] = [
                'value' => $uid->uid,
            ];
        }

        return response()->json($response);
    }

    public function create()
    {
        return view('project.project_add');
    }

    public function store(Request $request)
    {
        $user = User::where('uid', $request->uid)->first();
        
        if($user == NULL){
            flash('존재하지 않는 아이디입니다.')->success();
            return redirect()->back();
        }

        $data = [
            'udx' => User::where('uid', $request->uid)->first()->udx,
            'name' => $request->name,
            'participant' => $request->participant,
            'duration' => $request->duration,
            'state' => $request->state
        ];

        $request->validate([
            'uid' => 'required|exists:users,uid',
            'name' => 'required',
            'participant' => 'required|string',
            'duration' => 'required',
        ],
        [
            'uid.required' => '소유자를 입력해주세요.',
            'uid.exists' => '존재하지 않는 아이디입니다.',
            'name.required' => '프로젝트명은 입력해주세요.',
            'participant.required' => '참가자 수를 입력해주세요.',
            'participant.string' => '문자만 입력해주세요.',
            'duration' => '기간을 입력해주세요.'
        ]);

        Work::create($data);

        flash('프로젝트가 생성되었습니다.')->success();
        return redirect()->route('admin.works.index');
    }

    public function show($wdx)
    {
        $work = Work::where('wdx', $wdx)->first();

        $data = [
            'user_work' => $work,
            'user_uid' => User::where('udx', $work->udx)->first()->uid,
        ];

        $sites = $work->sites()->get();

        return view('project.project_show', compact('data', 'sites'));
    }

    public function edit($wdx)
    {
        $work = Work::where('wdx', $wdx)->first();

        $data = [
            'user_work' => $work,
            'user_uid' => User::where('udx', $work->udx)->first()->uid,
        ];

        return view('project.project_edit')->with('data', $data);
    }

    public function update(Request $request, $wdx)
    {
        $user = User::where('uid', $request->uid)->first();
        
        if($user == NULL){
            flash('존재하지 않는 아이디입니다.')->success();
            return redirect()->back();
        }

        $data = [
            'udx' => User::where('uid', $request->uid)->first()->udx,
            'name' => $request->name,
            'participant' => $request->participant,
            'duration' => $request->duration,
            'state' => $request->state
        ];

        $request->validate([
            'uid' => 'required|exists:users,uid',
            'name' => 'required',
            'participant' => 'required|string',
            'duration' => 'required',
        ],
        [
            'uid.required' => '소유자를 입력해주세요.',
            'uid.exists' => '존재하지 않는 아이디입니다.',
            'name.required' => '프로젝트명은 입력해주세요.',
            'participant.required' => '참가자 수를 입력해주세요.',
            'participant.string' => '문자만 입력해주세요.',
            'duration' => '기간을 입력해주세요.'
        ]);

        Work::where('wdx' ,$wdx)->update($data);

        flash('프로젝트가 수정되었습니다.')->success();
        return redirect()->route('admin.works.index');
    }

    public function destroy($wdx)
    {
        Work::where('wdx' ,$wdx)->delete();
        
        flash('프로젝트가 삭제되었습니다.')->success();
        return redirect()->route('admin.works.index');
    }
}
