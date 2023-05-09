<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // it check if the app environment is local or not
    protected function isEnvLocal()
    {
        if (app()->environment('local'))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    // it return any path inside the main app directory
    protected function getPath($path = [])
    {
        if(empty($path))
        {
            $this->errorMsg("Path can't be empty");
        }

        $implode_path = implode(DIRECTORY_SEPARATOR, $path);

        return base_path($implode_path);
    }

    // It returns the path outside the main app directory
    protected function getUniversalPath($path)
    {
        if(empty($path))
        {
            $this->errorMsg("Path can't be empty");
        }

        $main_app_path = config('app.main_path');
        
        $path = str_replace('/', DIRECTORY_SEPARATOR, $path);

        return $main_app_path.DIRECTORY_SEPARATOR.$path;
    }

    // It checks if the file extension is allowed or not
    protected function isFileExtAllowed($allowed_ext = [], $file = null, $msg = null)
    {
        if(!in_array($file, $allowed_ext)){
            dd($msg == null ? "File extension is not allowed" : $msg);
        }else{
            return true;
        }
    }

    // it upload file to certain path
    protected function uploadFile(Request $request, $file, $path, $file_name = null)
    {
        $filename = $file_name == null ? $request->file($file)->getClientOriginalName() : $file_name.'.'.$request->file($file)->getClientOriginalExtension();

        return $request->file($file)->move($path, $filename);
    }

    // it check file extension then upload to certain path
    protected function checkFileExtThenUploadFile(Request $request, $file, $path, $allowed_ext = [])
    {
        if(in_array($request->file($file)->getClientOriginalExtension(), $allowed_ext))
        {
            $filename = $request->file($file)->getClientOriginalName();
    
            $request->file($file)->move($path, $filename);
        }
        else
        {
            dd("file extension is not allowed");
        }
    }

    // it removes the file from certain path
    protected function removeFile($filename)
    {
        file_exists($filename) && !is_dir($filename) ?  unlink($filename) : true;
    }

    // check if url is youtube
    protected function checkIfUrlIsYoutube($url, $msg=null)
    {
        $parsed = parse_url($url);

        return $parsed['host'] !== 'www.youtube.com' ?  dd($msg == null ? 'Youtube link is not valid' : $msg) : $url;
    }

    // It parse a youtube url
    protected function parseYouTubeURL($url)
    {
        parse_str( parse_url( $url, PHP_URL_QUERY ), $youtube_link_url );

        return $youtube_link_url['v'];
    }

    // It parse a viemo url
    protected function parseVimeoURL($url)
    {
        return (int) substr(parse_url($url, PHP_URL_PATH), 1);
    }

    protected function redierctTo($path, $msg = null)
    {
        echo $msg == null ? '<script> window.location.href= "'.URL::to($path).'"; </script>' : '<h5>'.$msg.'</h5><script> window.location.href= "'.URL::to($path).'"; </script>';
    }

    protected function reloadPage()
    {
        echo '<script> window.location.reload(); </script>';
    }

    // Slugify a string
    protected function slugify($string, $separator = '-') 
    {
        $string = trim($string);
        $string = mb_strtolower($string, 'UTF-8');
    
        // Make alphanumeric (removes all other characters)
        // this makes the string safe especially when used as a part of a URL
        // this keeps latin characters and Persian characters as well
        $string = preg_replace("/[^a-z0-9_\s\-ءاآؤئبپتثجچحخدذرزژسشصضطظعغفقكکگلمنوهی]/u", '', $string);
    
        // Remove multiple dashes or whitespaces or underscores
        $string = preg_replace("/[\s\-_]+/", ' ', $string);
    
        // Convert whitespaces and underscore to the given separator
        $string = preg_replace("/[\s\_]/", $separator, $string);
    
        return $string;
    }

    // It delete the a certain path
    protected function deleteDir($dirPath) 
    {
        if(!is_dir($dirPath))
        {
            throw new \InvalidArgumentException("$dirPath must be a directory");
        }

        if(substr($dirPath, strlen($dirPath) - 1, 1) != '/') 
        {
            $dirPath .= '/';
        }

        $files = glob($dirPath . '*', GLOB_MARK);

        foreach($files as $file) 
        {
            if (is_dir($file)) 
            {
                self::deleteDir($file);
            } 
            else 
            {
                unlink($file);
            }
        }
        
        rmdir($dirPath);
    }

    protected function errorMsg($msg)
    {
        echo '
        <div class="text-center">
            <span class="fa fa-times text-danger" style="font-size:100px;"></span>
            <h5>'.$msg.'</h5>
        </div>';
        die();
    }

    protected function successMsg($msg)
    {
        echo '
        <div class="text-center">
            <span class="fa fa-check text-success" style="font-size:100px;"></span>
            <h5>'.$msg.'</h5>
        </div>';
    }

    private function ddErrorMsg($msg)
    {
        dd($msg);
    }
}
