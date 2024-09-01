<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Str;
use App\Utils\GoogleDriveHelpers;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Iman\Streamer\VideoStreamer;
use League\Flysystem\FileNotFoundException;
use \Intervention\Image\Facades\Image;

abstract class ApiController extends Controller
{
    protected function apiSuccessResponse(array $data = [], int $status = 200, array $headers = [], int $options = 0)
    {
        $msg = ['success' => true];
        foreach ($data as $key => $val)
            $msg[$key] = $val;

        return response()->json($msg, $status, $headers, $options);
    }

    private function storePublicFile(string $path, UploadedFile $file)
    {
        if ($storedFile = $file->store($path, [ 'disk' => 'public' ]))
            return Storage::disk('public')->url($storedFile);

        return false;
    }

    protected function storeImage(string $path, UploadedFile $file)
    {
        return $this->storePublicFile("images/$path", $file);
    }

    protected function storeOptimizedPicture(string $path, UploadedFile $file, int $quality = 50)
    {
        $img = Image::make($file);
        $path = "images/$path/" . Str::random() . "." . $file->extension();
        $imgStream = $img->stream($file->extension(), $quality)->getContents();
        $imgResource = tmpfile();
        fwrite($imgResource, $imgStream);
        $saved = Storage::disk('public')->writeStream($path, $imgResource);
        fclose($imgResource);
        return $saved ? Storage::disk('public')->url($path) : false;
    }

    protected function deletePublicFile(string $path)
    {
        $path = trim($path, '/');
        return Storage::disk('public')->delete($path);
    }

    protected function deletePublicFileFromUrl(string $url)
    {
        $path = str_replace('storage/', '', parse_url($url)['path']);
        return $this->deletePublicFile($path);
    }

    protected function deleteImageFromUrl(string $url)
    {
        return $this->deletePublicFileFromUrl($url);
    }

    protected function storePublicVideo(string $path, UploadedFile $file)
    {
        return $this->storePublicFile("videos/$path", $file);
    }

    /**
     * store stream to google drive
     *
     * @param string $dirName
     * @param UploadedFile $stream
     * @return string full path to uploaded file
     * @throws FileNotFoundException
     */
    protected function storeStreamToGoogle(string $dirName, UploadedFile $stream): string
    {
        $dir = GoogleDriveHelpers::createDirIfNotExists($dirName);
        $fileName = now()->format('y_m_d_h_i_s') . '_' . Str::random(10) . '.' . $stream->getClientOriginalExtension();
        $fullPath = $dir['path'] . '/' . $fileName;
        Storage::disk('google')->putStream($fullPath, fopen($stream->getRealPath(), 'rb'));
        return Storage::disk('google')->getMetaData($fullPath)['path'];
    }

    protected function videoStreamResponse($stream)
    {
        $tmpFileName = tempnam(sys_get_temp_dir(), 'vid');
        $tmpFile = fopen($tmpFileName, 'wb');
        fwrite($tmpFile, stream_get_contents($stream));
        fclose($tmpFile);

        return response()->stream(function () use ($tmpFileName) {
            VideoStreamer::streamFile($tmpFileName);
        });
    }
}
