<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait LoggerTrait
{
    public function logger($data = [], $success = true)
    {
        $date = new \DateTime("now", new \DateTimeZone('Asia/Ho_Chi_Minh'));

        $data['date'] = $date->format('Y-m-d H:i:s');
        $data['api_user_email'] = !empty(request()->user()) ? request()->user()->api_user_email : '';
        $data['api_user_roles'] = !empty(request()->user()) ? request()->user()->api_user_roles : '';

        if ($success) Log::channel('log_api_integration_success')->info(json_encode($data));
        else Log::channel('log_api_integration_error')->error(json_encode($data));

        return true;
    }

    public function loggerDataRequest($data = [])
    {
        $date = new \DateTime("now", new \DateTimeZone('Asia/Ho_Chi_Minh'));

        $data['date'] = $date->format('Y-m-d H:i:s');

        Log::channel('log_data_request')->info(json_encode($data));

        return true;
    }
    
    public function loggerDataImport($data = [])
    {
        $date = new \DateTime("now", new \DateTimeZone('Asia/Ho_Chi_Minh'));

        $data['date'] = $date->format('Y-m-d H:i:s');

        Log::channel('log_data_import')->info(json_encode($data));

        return true;
    }
}
