<?php

namespace App\Http\Controllers\Admin\Layout;

use App\Http\Controllers\Controller;
use App\Layout;
use App\LayoutBottom;
use App\LayoutEtc;
use App\LayoutMiddle;
use App\LayoutNavigation;
use App\LayoutTop;
use Illuminate\Http\Request;

class LayoutController extends Controller
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
                $layoutData = Layout::where([
                    [function($query) use ($searchText){
                        $query->orWhere('name_ko', 'LIKE', '%'.$searchText.'%')->orWhere('name_en', 'LIKE', '%'.$searchText.'%')->get();
                    }]
                ])->paginate(10);
            }else{
                $layoutData = Layout::where([
                    [function($query) use ($searchOption, $searchText){
                        $query->orWhere($searchOption, 'LIKE', '%'.$searchText.'%')->get();
                    }]
                ])->paginate(10);
            } 
        }else{
            switch ($state) {
                case 'normal':
                    $layoutData = Layout::where('state', 10)->latest()->paginate(10);
                    break;
                case 'unprint':
                    $layoutData = Layout::where('state', 9)->latest()->paginate(10);
                    break;
                case 'stop':
                    $layoutData = Layout::where('state', 8)->latest()->paginate(10);
                    break;
                case 'delete':
                    $layoutData = Layout::where('state', 0)->latest()->paginate(10);
                    break;
                default:
                    $layoutData = Layout::latest()->paginate(10);
                    break;
            }
        }

        return view('template.layout.layout_list', compact('layoutData'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $layoutTops = LayoutTop::all();
        $layoutNavis = LayoutNavigation::all();
        $layoutMiddles = LayoutMiddle::all();
        $layoutBottoms = LayoutBottom::all();
        $layoutEtcs = LayoutEtc::all();
        return view('template.layout.layout_add', compact('layoutTops', 'layoutNavis', 'layoutMiddles', 'layoutBottoms', 'layoutEtcs'));
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
            'descript_ko' => $request->descript_ko,
            'descript_en' => $request->descript_en,
            'lotdx' => $request->layout_top,
            'londx' => $request->layout_navi,
            'lomdx' => $request->layout_middle,
            'lobdx' => $request->layout_bottom,
            'loedx' => $request->layout_etc,
            'default' => $request->default,
            'state' => $request->state
        ];

        $request->validate([
            'category' => 'required',
            'name_ko' => 'required|string',
            'name_en' => 'required|string',
            'descript_ko' => 'required',
            'descript_en' => 'required',
        ],
        [
            'category.required' => '테마 분류를 입력해주세요.',
            'name_ko.required' => '레이아웃명(국문)을 입력해주세요.',
            'name_ko.string' => '문자만 입력가능합니다.',
            'name_en.required' => '레이아웃명(영문)을 입력해주세요.',
            'name_en.string' => '문자만 입력가능합니다.',
            'descript_ko.required' => '설명을 입력해주세요.',
            'descript_en.required' => '설명을 입력해주세요.',
        ]);

        Layout::create($data);

        flash('레이아웃이 생성되었습니다.')->success();
        return redirect()->route('admin.layouts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($lodx)
    {
        $layoutData = Layout::where('lodx', $lodx)->first();

        return view('template.layout.layout_show', compact('layoutData'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($lodx)
    {
        $layoutData = Layout::where('lodx', $lodx)->first();
        $layoutTops = LayoutTop::all();
        $layoutNavis = LayoutNavigation::all();
        $layoutMiddles = LayoutMiddle::all();
        $layoutBottoms = LayoutBottom::all();
        $layoutEtcs = LayoutEtc::all();

        return view('template.layout.layout_edit', compact('layoutData', 'layoutTops', 'layoutNavis', 'layoutMiddles', 'layoutBottoms', 'layoutEtcs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $lodx)
    {
        $data = [
            'category' => $request->category,
            'name_ko' => $request->name_ko,
            'name_en' => $request->name_en,
            'descript_ko' => $request->descript_ko,
            'descript_en' => $request->descript_en,
            'lotdx' => $request->layout_top,
            'londx' => $request->layout_navi,
            'lomdx' => $request->layout_middle,
            'lobdx' => $request->layout_bottom,
            'loedx' => $request->layout_etc,
            'default' => $request->default,
            'state' => $request->state
        ];

        $request->validate([
            'category' => 'required',
            'name_ko' => 'required|string',
            'name_en' => 'required|string',
            'descript_ko' => 'required',
            'descript_en' => 'required',
        ],
        [
            'category.required' => '테마 분류를 입력해주세요.',
            'name_ko.required' => '레이아웃명(국문)을 입력해주세요.',
            'name_ko.string' => '문자만 입력가능합니다.',
            'name_en.required' => '레이아웃명(영문)을 입력해주세요.',
            'name_en.string' => '문자만 입력가능합니다.',
            'descript_ko.required' => '설명을 입력해주세요.',
            'descript_en.required' => '설명을 입력해주세요.',
        ]);

        Layout::where('lodx', $lodx)->update($data);

        flash('레이아웃이 수정되었습니다.')->success();
        return redirect()->route('admin.layouts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($lodx)
    {
        Layout::where('lodx' ,$lodx)->delete();
        
        flash('레이아웃이 삭제되었습니다.')->success();
        return redirect()->route('admin.layouts.index');
    }
}
