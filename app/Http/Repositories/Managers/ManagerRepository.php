<?php
namespace App\Http\Repositories\Managers;

use App\Http\Interfaces\ManagerRepositoryInterface;
use App\Http\Requests\ManagerStoreRequest;
use App\Http\Requests\ManagerUpdateRequest;
use App\Http\Services\AlertFormatedDataJson;
use App\Http\Traits\ViewSettingTrait;
use App\Models\Admin;
use App\Models\Manager;
use Illuminate\Support\Facades\DB;

class ManagerRepository implements ManagerRepositoryInterface
{
    use ViewSettingTrait;
    private $admin;
    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }
    public function create()
    {
        return view('manager.create');
    }
    public function store(ManagerStoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $admin = $this->admin->create($request->validated()['admin']);
            $admin->manager()->create($request->validated()['manager']);
            DB::commit();
            return (new AlertFormatedDataJson('validateManager'))->alertBody(
                'includes.alerts.manager',
                trans('site.added')
            )->formatedData();

        } catch (\Exception $ex) {

            DB::rollback();
            \Log::error($ex->getMessage());
            return AlertFormatedDataJson::alertServerError('manager.create');
        }
    }
    public function getAll()
    {
        $delegates = $this->delegate::with('delegateDrive', 'governorate')->paginate($this->paginate);
        return view('delegate.index',
            [
                'delegates' => $delegates,
                'view' => $this->view,
                'search' => '',
            ]
        );
    }
    public function showById($id)
    {
        $delegateDetails = $this->delegate::with('delegateDrive')->where('id', $id)->first();
        if ($delegateDetails) {
            return view('delegate.show', ['delegate' => $delegateDetails]);
        }
    }

    public function update(ManagerUpdateRequest $request, Manager $manager)
    {
        try {
            DB::beginTransaction();
            $manager->update($request->validated()['manager']);
            $manager->admin()->update($request->validated()['admin']);
            DB::commit();
            return (new AlertFormatedDataJson('validateManager'))->alertBody(
                'includes.alerts.manager',
                trans('site.edited')
            )->formatedData();

        } catch (\Exception $ex) {
            DB::rollback();
            \Log::error($ex->getMessage());
            return AlertFormatedDataJson::alertServerError('manager.create');
        }
    }
    public function deleteById(Manager $manager)
    {
        try {
            DB::beginTransaction();
            $manager->admin()->delete();
            $manager->delete();
            DB::commit();
            return (new AlertFormatedDataJson('validateManager'))->alertBody(
                'includes.alerts.manager',
                trans('site.edited')
            )->formatedData();

        } catch (\Exception $ex) {
            DB::rollback();
            \Log::error($ex->getMessage());
            return AlertFormatedDataJson::alertServerError('managers.create');
        }
    }

    public function edit($id)
    {
        $delegate = $this->delegate::with(['admin:id,is_active', 'delegateDrive'])->findOrFail($id);
        return view('delegate.edit',
            [
                'data' => [
                    'delegate' => $delegate,
                    'admin' => $delegate->admin,
                    'delegateDrive' => $delegate->delegateDrive,
                ],
            ]
        );
    }

}
