<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Utils\GoogleDriveHelpers;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Iman\Streamer\VideoStreamer;

abstract class ApiController extends Controller
{
    protected function apiSuccessResponse(array $data = [], int $status = 200, array $headers = [], int $options = 0)
    {
        $msg = ['success' => true];
        foreach ($data as $key => $val)
            $msg[$key] = $val;

        return response()->json($msg, $status, $headers, $options);
    }

    protected function storeImage(string $path, UploadedFile $file)
    {
        if ($storedFile = $file->store("images/$path", [ 'disk' => 'public' ]))
            return Storage::disk('public')->url($storedFile);

        return false;
    }

    protected function deleteImage(string $path)
    {
        $path = trim($path, '/');
        return Storage::disk('public')->delete("images/$path");
    }

    protected function deleteImageFromUrl(string $url)
    {
        $path = str_replace('storage/images', '', parse_url($url)['path']);
        return $this->deleteImage($path);
    }

    /**
     * store stream to google drive
     *
     * @param string $dirName
     * @param UploadedFile $stream
     * @return string full path to uploaded file
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
