<?php

namespace App\Http\Controllers\Admin\Layout;

use App\Http\Controllers\Controller;
use App\LayoutTop;
use Illuminate\Http\Request;

class LayoutTopController extends Controller
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
                $layoutData = LayoutTop::where([
                    [function($query) use ($searchText){
                        $query->orWhere('name_ko', 'LIKE', '%'.$searchText.'%')->orWhere('name_en', 'LIKE', '%'.$searchText.'%')->get();
                    }]
                ])->paginate(10);
            }else{
                $layoutData = LayoutTop::where([
                    [function($query) use ($searchOption, $searchText){
                        $query->orWhere($searchOption, 'LIKE', '%'.$searchText.'%')->get();
                    }]
                ])->paginate(10);
            } 
        }else{
            switch ($state) {
                case 'normal':
                    $layoutData = LayoutTop::where('state', 10)->latest()->paginate(10);
                    break;
                case 'unprint':
                    $layoutData = LayoutTop::where('state', 9)->latest()->paginate(10);
                    break;
                case 'stop':
                    $layoutData = LayoutTop::where('state', 8)->latest()->paginate(10);
                    break;
                case 'delete':
                    $layoutData = LayoutTop::where('state', 0)->latest()->paginate(10);
                    break;
                default:
                    $layoutData = LayoutTop::latest()->paginate(10);
                    break;
            }
        }

        return view('template.layout.tops.layout_top_list', compact('layoutData'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('template.layout.tops.layout_top_add');
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
            'category' => $request->category,
            'name_ko' => $request->name_ko,
            'name_en' => $request->name_en,
            'code' => $request->code,
            'html' => $request->html,
            'css' => $request->css,
            'state' => $request->state
        ];

        $request->validate([
            'category' => 'required',
            'name_ko' => 'required|string',
            'name_en' => 'required|string',
            'code' => 'required|unique:layout_tops,code',
            'html' => 'required',
            'css' => 'required'
        ],
        [
            'category.required' => '테마 분류를 입력해주세요.',
            'name_ko.required' => '레이아웃명(국문)을 입력해주세요.',
            'name_ko.string' => '문자만 입력가능합니다.',
            'name_en.required' => '레이아웃명(영문)을 입력해주세요.',
            'name_en.string' => '문자만 입력가능합니다.',
            'code.required' => '코드명을 입력해주세요.',
            'code.unique' => '이미 존재하는 코드명입니다.',
            'html.required' => 'html을 입력해주세요.',
            'css.required' => 'css를 입력해주세요.',
        ]);

        LayoutTop::create($data);

        flash('상단 레이아웃이 생성되었습니다.')->success();
        return redirect()->route('admin.layout-tops.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($lotdx)
    {
        $layoutData = LayoutTop::where('lotdx', $lotdx)->first();

        return view('template.layout.tops.layout_top_show', compact('layoutData'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($lotdx)
    {
        $layoutData = LayoutTop::where('lotdx', $lotdx)->first();

        return view('template.layout.tops.layout_top_edit', compact('layoutData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $lotdx)
    {
        $data = [
            'category' => $request->category,
            'name_ko' => $request->name_ko,
            'name_en' => $request->name_en,
            'code' => $request->code,
            'html' => $request->html,
            'css' => $request->css,
            'state' => $request->state
        ];

        $request->validate([
            'category' => 'required',
            'name_ko' => 'required|string',
            'name_en' => 'required|string',
            'code' => 'required|unique:layout_tops,code',
            'html' => 'required',
            'css' => 'required'
        ],
        [
            'category.required' => '테마 분류를 입력해주세요.',
            'name_ko.required' => '레이아웃명(국문)을 입력해주세요.',
            'name_ko.string' => '문자만 입력가능합니다.',
            'name_en.required' => '레이아웃명(영문)을 입력해주세요.',
            'name_en.string' => '문자만 입력가능합니다.',
            'code.required' => '코드명을 입력해주세요.',
            'code.unique' => '이미 존재하는 코드명입니다.',
            'html.required' => 'html을 입력해주세요.',
            'css.required' => 'css를 입력해주세요.',
        ]);

        LayoutTop::where('lotdx', $lotdx)->update($data);

        flash('상단 레이아웃이 수정되었습니다.')->success();
        return redirect()->route('admin.layout-tops.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($lotdx)
    {
        LayoutTop::where('lotdx' ,$lotdx)->delete();
        
        flash('상단 레이아웃이 삭제되었습니다.')->success();
        return redirect()->route('admin.layout-tops.index');
    }
}
