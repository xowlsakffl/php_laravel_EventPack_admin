<?php

namespace App\Http\Controllers\Admin\Layout;

use App\Http\Controllers\Controller;
use App\LayoutNavigation;
use Illuminate\Http\Request;

class LayoutNaviController extends Controller
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
                $layoutData = LayoutNavigation::where([
                    [function($query) use ($searchText){
                        $query->orWhere('name_ko', 'LIKE', '%'.$searchText.'%')->orWhere('name_en', 'LIKE', '%'.$searchText.'%')->get();
                    }]
                ])->paginate(10);
            }else{
                $layoutData = LayoutNavigation::where([
                    [function($query) use ($searchOption, $searchText){
                        $query->orWhere($searchOption, 'LIKE', '%'.$searchText.'%')->get();
                    }]
                ])->paginate(10);
            } 
        }else{
            switch ($state) {
                case 'normal':
                    $layoutData = LayoutNavigation::where('state', 10)->latest()->paginate(10);
                    break;
                case 'unprint':
                    $layoutData = LayoutNavigation::where('state', 9)->latest()->paginate(10);
                    break;
                case 'stop':
                    $layoutData = LayoutNavigation::where('state', 8)->latest()->paginate(10);
                    break;
                case 'delete':
                    $layoutData = LayoutNavigation::where('state', 0)->latest()->paginate(10);
                    break;
                default:
                    $layoutData = LayoutNavigation::latest()->paginate(10);
                    break;
            }
        }

        return view('template.layout.navigations.layout_navi_list', compact('layoutData'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('template.layout.navigations.layout_navi_add');
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

        LayoutNavigation::create($data);

        flash('레이아웃 메뉴가 생성되었습니다.')->success();
        return redirect()->route('admin.layout-navigations.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($londx)
    {
        $layoutData = LayoutNavigation::where('londx', $londx)->first();

        return view('template.layout.navigations.layout_navi_show', compact('layoutData'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($londx)
    {
        $layoutData = LayoutNavigation::where('londx', $londx)->first();

        return view('template.layout.navigations.layout_navi_edit', compact('layoutData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $londx)
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

        LayoutNavigation::where('londx', $londx)->update($data);

        flash('레이아웃 메뉴가 수정되었습니다.')->success();
        return redirect()->route('admin.layout-navigations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($londx)
    {
        LayoutNavigation::where('londx' ,$londx)->delete();
        
        flash('레이아웃 메뉴가 삭제되었습니다.')->success();
        return redirect()->route('admin.layout-navigations.index');
    }
}
