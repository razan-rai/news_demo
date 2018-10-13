<?php namespace App\Library;

use App\Category;
use App\News;
use App\Models\User;
use Carbon\Carbon;
use DB;
use FCM;
use Illuminate\Support\Str;
use Image;
use Lang;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use Mail;

class BikashNewsFunction
{
   

    public static function fitImage($image = 'null', $width = 1200, $height = 1200)
    {
        dd("here");
        try {
            $filename = $width . '_' . $height . '_' . basename($image);

            if (Storage::disk('uploads')->exists($filename)) {
                return url("/uploads/temps/$filename");
            }

            $img = Image::make($image);
            // crop the best fitting 5:3 (600x360) ratio and resize to 600x360 pixel
            $img->fit($width, $height);
            $img->save(public_path() . "/uploads/temps/$filename");
            return url("/uploads/temps/$filename");
        } catch (\Exception $e) {
            return 'https://dummyimage.com/200x200/000/fff&text=NO+Image+FOUND';
        }
    }



    public static function convertStringToAnchor($content)
    {
        $str = str_replace('www.', 'http://www.', $content);
        $str = preg_replace('|http://([a-zA-Z0-9-./]+)|', '<a href="http://$1">$1</a>', $str);
        $str = preg_replace('/(([a-z0-9+_-]+)(.[a-z0-9+_-]+)*@([a-z0-9-]+.)+[a-z]{2,6})/', '<a href="mailto:$1">$1</a>', $str);
        return $str;
    }

    public static function imageUpload($files, $path)
    {
        $extension        = $files->getClientOriginalExtension();
        $filename         = self::filename($extension);
        $filenameWithPath = $path . $filename;

        $error_message = '';
        try {
            $files->move($path, $filename);
            return $filenameWithPath;
        } catch (Exception $e) {
            return \Response::json(array('error' => true, 'message' => Lang::get('messages.invalidfile')));
        }
    }

    public static function category_name($category)
    {
        $category_name = [];
        foreach ($category as $category_id) {
            $cat = Category::find($category_id);
            $category_name[] = $cat['name'];
        }
        return $category_name;
    }
    /**
     * get file name from extension.
     *
     * @param store $extension
     * @return Response
     */
    public static function filename($extension)
    {
        return uniqid(time()) . '.' . $extension;
    }

    /**
     * get specific product list
     *
     * @param sortBy $status, no. of item $number
     * @return Response
     */
    public static function getSpecificProduct($status, $number)
    {
        $query = DB::table('products');

        if ($status != null) {
            $query->where('status', $status);
        }
        if ($number != null) {
            $query->paginate($number);
        }

        $results = $query->paginate(15);
        return $results;
    }


    /**
     * get specific product list as per the parameter provided
     *
     * @param sortBy $status, no. of item $number
     * @return Response
     */
    public static function search($input)
    {
        $query = DB::table('products');
        if (isset($input['page_no'])) {
            $query->paginate($input['page_no']);
        }
        if (isset($input['search'])) {
            $query->where('name', 'like', '%'.$input['search'].'%');
            $query->orWhere('detail', 'like', '%'.$input['search'].'%');
        }

        if (!empty($input['category'])) {
            $query->whereIn('category', $input['category']);
        }

        if (!empty($input['color'])) {
            $query->whereIn('color', $input['color']);
        }
        $results = $query->paginate(15);
        return $results;
    }

}
