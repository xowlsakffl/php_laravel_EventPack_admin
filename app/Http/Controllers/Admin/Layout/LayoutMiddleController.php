<?php

namespace App\Http\Controllers\Admin\Layout;

use App\Http\Controllers\Controller;
use App\LayoutMiddle;
use Illuminate\Http\Request;

class LayoutMiddleController extends Controller
{
    public function index(Request $request)
    {
        $state = $request->state;
        $searchOption = $request->search_option;
        $searchText = $request->search_text;

        if($searchText !== null) {
            if($searchOption === 'name') {
                $layoutData = LayoutMiddle::where(function($query) use ($searchText) {
                    $query->where('name_ko', 'LIKE', '%'.$searchText.'%')
                        ->orWhere('name_en', 'LIKE', '%'.$searchText.'%');
                })->paginate(10);
            } else {
                $layoutData = LayoutMiddle::where($searchOption, 'LIKE', '%'.$searchText.'%')->paginate(10);
            }
        } else {
            switch($state) {
                case 'normal':
                    $layoutData = LayoutMiddle::where('state', 10)->latest()->paginate(10);
                    break;
                case 'unprint':
                    $layoutData = LayoutMiddle::where('state', 9)->latest()->paginate(10);
                    break;
                case 'stop':
                    $layoutData = LayoutMiddle::where('state', 8)->latest()->paginate(10);
                    break;
                case 'delete':
                    $layoutData = LayoutMiddle::where('state', 0)->latest()->paginate(10);
                    break;
                default:
                    $layoutData = LayoutMiddle::latest()->paginate(10);
                    break;
            }
        }

        return view('template.layout.middles.layout_middle_list', compact('layoutData'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('template.layout.middles.layout_middle_add');
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);

        LayoutMiddle::create($data);

        flash('중단 레이아웃이 생성되었습니다.')->success();
        return redirect()->route('admin.layout-middles.index');
    }

    public function show($lomdx)
    {
        $layoutData = LayoutMiddle::findOrFail($lomdx);

        return view('template.layout.middles.layout_middle_show', compact('layoutData'));
    }

    public function edit($lomdx)
    {
        $layoutData = LayoutMiddle::findOrFail($lomdx);

        return view('template.layout.middles.layout_middle_edit', compact('layoutData'));
    }

    public function update(Request $request, $lomdx)
    {
        $layoutData = LayoutMiddle::findOrFail($lomdx);
        $data = $this->validatedData($request, $lomdx);

        $layoutData->update($data);

        flash('중단 레이아웃이 수정되었습니다.')->success();
        return redirect()->route('admin.layout-middles.index');
    }

    public function destroy($lomdx)
    {
        LayoutMiddle::findOrFail($lomdx)->delete();

        flash('중단 레이아웃이 삭제되었습니다.')->success();
        return redirect()->route('admin.layout-middles.index');
    }

    private function validatedData(Request $request, $lomdx = null)
    {
        $uniqueCodeRule = 'required|unique:layout_middles,code';
        if($lomdx) {
            $uniqueCodeRule .= ','.$lomdx.',lomdx';
        }

        return $request->validate([
            'category' => 'required',
            'name_ko' => 'required|string',
            'name_en' => 'required|string',
            'code' => $uniqueCodeRule,
            'html' => 'required',
            'css' => 'required',
            'state' => 'nullable',
        ]);
    }
}
