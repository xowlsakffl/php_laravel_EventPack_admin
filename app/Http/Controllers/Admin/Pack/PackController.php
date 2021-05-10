<?php

namespace App\Http\Controllers\Admin\Pack;

use App\Http\Controllers\Controller;
use App\Pack;
use Illuminate\Http\Request;

class PackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $state = $request->state;
        $searchOption = $request->search_option;
        $searchText = $request->search_text;

        if($searchText !== NULL){
            if($searchOption == 'name'){
                $packData = Pack::where([
                    [function($query) use ($searchText){
                        $query->orWhere('name_ko', 'LIKE', '%'.$searchText.'%')->orWhere('name_en', 'LIKE', '%'.$searchText.'%')->get();
                    }]
                ])->paginate(10);
            }else{
                $packData = Pack::where([
                    [function($query) use ($searchOption, $searchText){
                        $query->orWhere($searchOption, 'LIKE', '%'.$searchText.'%')->get();
                    }]
                ])->paginate(10);
            } 
        }else{
            switch ($state) {
                case 'normal':
                    $packData = Pack::where('state', 10)->latest()->paginate(10);
                    break;
                case 'stop':
                    $packData = Pack::where('state', 9)->latest()->paginate(10);
                    break;
                case 'delete':
                    $packData = Pack::where('state', 0)->latest()->paginate(10);
                    break;
                default:
                    $packData = Pack::latest()->paginate(10);
                    break;
            }
        }

        return view('template.pack.pack_list', compact('packData'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('template.pack.pack_add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'code' => $request->code,
            'name_ko' => $request->name_ko,
            'name_en' => $request->name_en,
            'explain_ko' => $request->explain_ko,
            'explain_en' => $request->explain_en,
            'default_path' => $request->default_path,
            'state' => $request->state
        ];

        $request->validate([
            'code' => 'required|unique:packs,code',
            'name_ko' => 'required|string',
            'name_en' => 'required|string',
            'explain_ko' => 'required',
            'explain_en' => 'required',
            'default_path' => 'required'
        ],
        [
            'code.required' => '코드명을 입력해주세요.',
            'code.unique' => '이미 존재하는 코드명입니다.',
            'name_ko.required' => '레이아웃명(국문)을 입력해주세요.',
            'name_ko.string' => '문자만 입력가능합니다.',
            'name_en.required' => '레이아웃명(영문)을 입력해주세요.',
            'name_en.string' => '문자만 입력가능합니다.',
            'explain_ko' => '설명을 입력해주세요.',
            'explain_en' => '설명을 입력해주세요.',
            'default_path.required' => '기본 경로를 입력해주세요.',
        ]);

        Pack::create($data);

        flash('기능이 생성되었습니다.')->success();
        return redirect()->route('admin.packs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($pdx)
    {
        $packData = Pack::where('pdx', $pdx)->first();

        return view('template.pack.pack_show', compact('packData'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($pdx)
    {
        $packData = Pack::where('pdx', $pdx)->first();

        return view('template.pack.pack_edit', compact('packData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $pdx)
    {
        $data = [
            'code' => $request->code,
            'name_ko' => $request->name_ko,
            'name_en' => $request->name_en,
            'explain_ko' => $request->explain_ko,
            'explain_en' => $request->explain_en,
            'default_path' => $request->default_path,
            'state' => $request->state
        ];

        $request->validate([
            'code' => 'required|unique:packs,code,'.$pdx.',pdx',
            'name_ko' => 'required|string',
            'name_en' => 'required|string',
            'explain_ko' => 'required',
            'explain_en' => 'required',
            'default_path' => 'required'
        ],
        [
            'code.required' => '코드명을 입력해주세요.',
            'code.unique' => '이미 존재하는 코드명입니다.',
            'name_ko.required' => '레이아웃명(국문)을 입력해주세요.',
            'name_ko.string' => '문자만 입력가능합니다.',
            'name_en.required' => '레이아웃명(영문)을 입력해주세요.',
            'name_en.string' => '문자만 입력가능합니다.',
            'explain_ko' => '설명을 입력해주세요.',
            'explain_en' => '설명을 입력해주세요.',
            'default_path.required' => '기본 경로를 입력해주세요.',
        ]);

        Pack::where('pdx', $pdx)->update($data);

        flash('기능이 수정되었습니다.')->success();
        return redirect()->route('admin.packs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($pdx)
    {
        Pack::where('pdx' ,$pdx)->delete();
        
        flash('기능이 삭제되었습니다.')->success();
        return redirect()->route('admin.packs.index');
    }
}
