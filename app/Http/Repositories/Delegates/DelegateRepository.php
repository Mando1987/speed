<?php
namespace App\Http\Repositories\Delegates;

use App\Http\Interfaces\DelegateRepositoryInterface;
use App\Http\Services\AlertFormatedDataJson;
use App\Http\Traits\UploadImageTrait;
use App\Http\Traits\ViewSettingTrait;
use App\Models\Admin;
use App\Models\Delegate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DelegateRepository implements DelegateRepositoryInterface
{
    use UploadImageTrait, ViewSettingTrait;
    private $admin;
    private $delegate;
    public function __construct(Admin $admin, Delegate $delegate)
    {
        $this->admin = $admin;
        $this->delegate = $delegate;

    }
    public function create()
    {
        return view('delegate.create');
    }
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $admin = $this->admin->create($request->validated()['admin']);
            $createDelegate = $admin->delegate()->create(
                array_merge($request->validated()['delegate'], [
                    'image' => $this->handeImageUploadUsingIntervention($request->validated()['image'], 'delegates/profile/'),
                    'national_image' => $this->handeImageUploadUsingIntervention($request->validated()['national_image'], 'delegates/national/'),
                ])
            );

            $createDelegate->delegateDrive()->create($request->validated()['delegateDrive']);
            DB::commit();
            return (new AlertFormatedDataJson('validateDelegate'))->alertBody(
                'includes.alerts.delegate',
                trans('site.added')
            )->formatedData();

        } catch (\Exception $ex) {

            DB::rollback();
            \Log::error($ex->getMessage());
            return AlertFormatedDataJson::alertServerError('delegate.create');
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

    public function update($request, $id)
    {
        try {
            $data = $request->validated();
            DB::beginTransaction();
            $updateDelegate = $this->delegate::find($id);
            $updateDelegate->update(
                array_merge($data['delegate'], [
                    'image' => $this->handeImageUploadUsingIntervention($data['image'], 'delegates/profile/'),
                    'national_image' => $this->handeImageUploadUsingIntervention($data['national_image'], 'delegates/national/'),
                ])
            );
            $updateDelegate->delegateDrive()->update($data['delegateDrive']);
            $updateDelegate->admin()->update($data['admin']);
            DB::commit();
            return (new AlertFormatedDataJson('validateDelegate'))->alertBody(
                'includes.alerts.delegate',
                trans('site.edited')
            )->formatedData();

        } catch (\Exception $ex) {
            DB::rollback();
            \Log::error($ex->getMessage());
            return AlertFormatedDataJson::alertServerError('delegate.edit', $id);
        }
    }

    public function edit($id)
    {
        $delegate = $this->delegate::with(['admin:id,is_active','delegateDrive'])->findOrFail($id);
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

    public function changeActive($id)
    {
        try {
            $delegateEnabled = $this->delegate::findOrFail($id);
            $active = $delegateEnabled->active == 1 ? 0 : 1;
            $message = trans('site.delegate_set_active_' . $active);
            $text = trans('site.delegate_get_active_' . $active);

            $delegateEnabled->update(['active' => $active]);

            return ['code' => 1, 'title' => trans('site.success_title'), 'message' => $message, 'text' => $text];
        } catch (\Exception $ex) {

            return ['code' => 2, 'title' => trans('site.failed_title'), 'message' => trans('site.failed')];
        }
    }

}
