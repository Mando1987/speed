<?php

namespace App\Services;

use App\Events\AddNewAdmin;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;

class AdminStoreService extends BaseService
{
    const IMAGE_PATH = 'admins/';

    private $admin , $route = 'admin.index';

    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }

    public function handle($request)
    {
        
        try {

            DB::beginTransaction();

            $newAdmin = $this->admin->create(

               array_merge($request['admin'],[

                    'image' => $this->handeImageUploadUsingIntervention($request['admin']['image'], self::IMAGE_PATH)
                ])
            
            );
            $newAdmin->profile()->create($request['profile']);

            event(new AddNewAdmin(auth('admin')->user() , $details = $request['admin']['fullname'] ));

            DB::commit();
            $this->notify(['icon' => self::ICON_SUCCESS ,'title' => self::TITLE_ADDED]);
            return $this->path($this->route);

        } catch (\Exception $ex) {

            DB::rollback();
            $this->notify(['icon' => self::ICON_ERROR ,'title' => self::TITLE_FAILED]);
            return back();
        }

    }

    // public function handleFileUpload($file)
    // {
    //    return (new LocalUploadFileService($file))->save(self::IMAGE_PATH);
    // }

    
}
