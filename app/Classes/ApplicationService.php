<?php
/**
 * Created by PhpStorm.
 * User: tran.minh.hoang
 * Date: 26/10/2018
 * Time: 10:11
 */
namespace App\Classes;

class ApplicationService
{
    public function handleUploadedCv($cv)
    {
        $fileName = '';
        if (isset($cv)) {
            $fileName = time() . '.' . $cv->getClientOriginalExtension();
            $cv->move(public_path(config('app.cv_base_url')), $fileName);

            return $fileName;
        }

        return $fileName;
    }
}
