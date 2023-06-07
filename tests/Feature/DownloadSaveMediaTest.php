<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DownloadSaveMediaTest extends TestCase
{
    public function testDownloadSaveMediaSuccess()
    {
        Storage::fake('uploads');
        $url = 'https://www.google.com/images/branding/googlelogo/1x/googlelogo_light_color_272x92dp.png';
        $expected = DB::table('media_files')->select(DB::raw('MAX(id) as latest_id'))->value('latest_id') + 1;
        $result = download_save_media($url);
        $this->assertEquals($expected, $result);
        Storage::disk('uploads')->assertExists('tmp/googlelogo_light_color_272x92dp.png');
    }

    public function testDownloadSaveMediaEmptyUrl()
    {
        Storage::fake('uploads');
        $url = '';
        $expected = null;
        $result = download_save_media($url);
        $this->assertEquals($expected, $result);
        Storage::disk('uploads')->assertMissing('tmp/');
    }

    public function testDownloadSaveMediaGoogleDriveUrl()
    {
        Storage::fake('uploads');
        $url = 'https://drive.google.com/file.jpg';
        $expected = null;
        $result = download_save_media($url);
        $this->assertEquals($expected, $result);
        Storage::disk('uploads')->assertMissing('tmp/');
    }

    public function testDownloadSaveMediaFailure()
    {
        Storage::fake('uploads');
        $url = 'https://bad.example.com/image.jpg';
        $expected = null;
        $result = download_save_media($url);
        $this->assertEquals($expected, $result);
        Storage::disk('uploads')->assertMissing('tmp/');
    }
}
