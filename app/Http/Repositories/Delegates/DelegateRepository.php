<?php
namespace App\Http\Repositories\Delegates;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\UploadImageTrait;
use App\Http\Interfaces\DelegateRepositoryInterface;
use App\Models\Admin;

class DelegateRepository implements DelegateRepositoryInterface
{
    use UploadImageTrait;
    private $admin;
    public function __construct(Admin $admin)
    {
        $this->admin = $admin;

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
            return response()->json(['urlRedirect' => route('delegate.index'), 'status' => 200, 'message' => 'ok']);

        } catch (\Exception $ex) {

            DB::rollback();
            return response()->json(['status' => 500, 'message' => $ex->getMessage()]);
        }
    }

}
