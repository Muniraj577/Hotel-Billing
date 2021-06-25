<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    use HasFactory;

    public static function image($request, $filename, $path, $oldImage = null)
    {
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $image = $request->$filename;
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        if ($oldImage != null && file_exists($path . $oldImage) && $oldImage != "default.png") {
            unlink($path . $oldImage);
        }
        $image->move($path, $imageName);
        return $imageName;
    }
}
