<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Traits\AdminTrait;
use App\Services\AdminStoreService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AdminStoreFormRequest;
use App\Services\AdminFetchDataService;

class AdminController extends Controller
{
    use AdminTrait;

    public function index(Request $request)
    {
        // $all = Admin::find()->with('role:id,name','parent:id,fullname')->paginate(15);


        $admins = Admin::where('parent_id', currentAdminId())->with('role' , 'parent')->paginate(10);
        // $admins = Admin::where('parent_id', currentAdminId())->with('role')->paginate(10);

        // $d = Admin::where('id', '!=' , 4)->get(['id'])->pluck('id');
        // currentAdmin()->subadmins()->attach($d);
        // return $d;
        // $admins = currentAdmin()->subadmins()->get()->pluck('child_id');
        //   return $admins;
        //  $all = Admin::with('parent:id,fullname','role:id,name')->whereIn('id' , $admins)->paginate(10);
        //return $all;

        return view('admin.index' , ['admins' => $admins]);

        //return $this->viewAdminIndex();

    }

    public function create()
    {
        return view('admin.create', [

            'allRoles' => $this->getAllRoles(),
            // 'allParents' => $this->getAllAdmins(),
        ]);

    }
    public function store(AdminStoreFormRequest $request)
    {
        dd($request->validated());
        return app(AdminStoreService::class)->handle($request->validated());

    }

    public function show($id)
    {
        $adminDetails = $this->admin::with('profile')->where('id', $id)->first();
        if ($adminDetails) {
            return view('admin.show', ['admin' => $adminDetails]);
        }

        // try{

        //     $adminDetails = $this->admin::findOrFail($id)->with('profile')->first();

        //     return response()->json($adminDetails);

        // }catch(\Exception $ex)
        // {

        //     return ['code' => 2 ,'title' =>trans('site.failed_title') , 'message' => trans('site.failed')  ];

        // }

    }

    public function edit($id)
    {
        return app(AdminFetchDataService::class)->getSinglAdminData($id);
    }

    public function update(AdminStoreFormRequest $request, $id)
    {
        //
    }

    public function destroy($id)
    {

        notify('success', 'added');
        return $this->path();
    }

    public function changePassword(AdminStoreFormRequest $request, $id)
    {
        $admin = $this->admin::findOrFail($id);

        if (Hash::check($request->old_password, $admin->password)) {

            $admin->password = bcrypt($request->password);
            $admin->save();
            return back();
        }

    }
    /**
     *  cahnage admin active toggle 1,0
     */
    public function changeActive($id)
    {
        try {

            $adminEnabled = $this->admin::findOrFail($id);

            $active = $adminEnabled->active == 1 ? 0 : 1;
            $message = trans('site.admin_set_active_' . $active);
            $text = trans('site.admin_get_active_' . $active);

            $adminEnabled->update(['active' => $active]);

            return ['code' => 1, 'title' => trans('site.success_title'), 'message' => $message, 'text' => $text];

        } catch (\Exception $ex) {

            return ['code' => 2, 'title' => trans('site.failed_title'), 'message' => trans('site.failed')];

        }

    }
    public function any()
    {
        return 'true';
    }
}
