<?php

namespace App\Http\Controllers\Admin\Layout;

use App\Http\Controllers\Controller;
use App\LayoutEtc;
use Illuminate\Http\Request;

class LayoutEtcController extends Controller
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
                $layoutData = LayoutEtc::where([
                    [function($query) use ($searchText){
                        $query->orWhere('name_ko', 'LIKE', '%'.$searchText.'%')->orWhere('name_en', 'LIKE', '%'.$searchText.'%')->get();
                    }]
                ])->paginate(10);
            }else{
                $layoutData = LayoutEtc::where([
                    [function($query) use ($searchOption, $searchText){
                        $query->orWhere($searchOption, 'LIKE', '%'.$searchText.'%')->get();
                    }]
                ])->paginate(10);
            } 
        }else{
            switch ($state) {
                case 'normal':
                    $layoutData = LayoutEtc::where('state', 10)->latest()->paginate(10);
                    break;
                case 'unprint':
                    $layoutData = LayoutEtc::where('state', 9)->latest()->paginate(10);
                    break;
                case 'stop':
                    $layoutData = LayoutEtc::where('state', 8)->latest()->paginate(10);
                    break;
                case 'delete':
                    $layoutData = LayoutEtc::where('state', 0)->latest()->paginate(10);
                    break;
                default:
                    $layoutData = LayoutEtc::latest()->paginate(10);
                    break;
            }
        }

        return view('template.layout.etcs.layout_etc_list', compact('layoutData'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('template.layout.etcs.layout_etc_add');
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
            'display_type' => $request->display_type,
            'display_duration' => $request->display_duration,
            'font_default' => $request->font_default,
            'font_resource' => $request->font_resource,
            'state' => $request->state
        ];

        $request->validate([
            'category' => 'required',
            'name_ko' => 'required|string',
            'name_en' => 'required|string',
            'code' => 'required|unique:layout_tops,code',
            'display_type' => 'required',
            'display_duration' => 'required',
            'font_default' => 'required',
            'font_resource' => 'required'
        ],
        [
            'category.required' => '테마 분류를 입력해주세요.',
            'name_ko.required' => '레이아웃명(국문)을 입력해주세요.',
            'name_ko.string' => '문자만 입력가능합니다.',
            'name_en.required' => '레이아웃명(영문)을 입력해주세요.',
            'name_en.string' => '문자만 입력가능합니다.',
            'code.required' => '코드명을 입력해주세요.',
            'code.unique' => '이미 존재하는 코드명입니다.',
            'display_type.required' => '화면출력 방식을 입력해주세요.',
            'display_duration.required' => '화면출력 시간을 입력해주세요.',
            'font_default.required' => '기본폰트를 입력해주세요.',
            'font_resource.required' => '기본 폰트 출처를 입력해주세요.',
        ]);

        LayoutEtc::create($data);

        flash('기타 레이아웃이 생성되었습니다.')->success();
        return redirect()->route('admin.layout-etcs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($loedx)
    {
        $layoutData = LayoutEtc::where('loedx', $loedx)->first();

        return view('template.layout.etcs.layout_etc_show', compact('layoutData'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($loedx)
    {
        $layoutData = LayoutEtc::where('loedx', $loedx)->first();

        return view('template.layout.etcs.layout_etc_edit', compact('layoutData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $loedx)
    {
        $data = [
            'category' => $request->category,
            'name_ko' => $request->name_ko,
            'name_en' => $request->name_en,
            'code' => $request->code,
            'display_type' => $request->display_type,
            'display_duration' => $request->display_duration,
            'font_default' => $request->font_default,
            'font_resource' => $request->font_resource,
            'state' => $request->state
        ];

        $request->validate([
            'category' => 'required',
            'name_ko' => 'required|string',
            'name_en' => 'required|string',
            'code' => 'required|unique:layout_tops,code',
            'display_type' => 'required',
            'display_duration' => 'required',
            'font_default' => 'required',
            'font_resource' => 'required'
        ],
        [
            'category.required' => '테마 분류를 입력해주세요.',
            'name_ko.required' => '레이아웃명(국문)을 입력해주세요.',
            'name_ko.string' => '문자만 입력가능합니다.',
            'name_en.required' => '레이아웃명(영문)을 입력해주세요.',
            'name_en.string' => '문자만 입력가능합니다.',
            'code.required' => '코드명을 입력해주세요.',
            'code.unique' => '이미 존재하는 코드명입니다.',
            'display_type.required' => '화면출력 방식을 입력해주세요.',
            'display_duration.required' => '화면출력 시간을 입력해주세요.',
            'font_default.required' => '기본폰트를 입력해주세요.',
            'font_resource.required' => '기본 폰트 출처를 입력해주세요.',
        ]);

        LayoutEtc::where('loedx', $loedx)->update($data);

        flash('기타 레이아웃이 수정되었습니다.')->success();
        return redirect()->route('admin.layout-etcs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($loedx)
    {
        LayoutEtc::where('loedx' ,$loedx)->delete();
        
        flash('기타 레이아웃이 삭제되었습니다.')->success();
        return redirect()->route('admin.layout-etcs.index');
    }
}
