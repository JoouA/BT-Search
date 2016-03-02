<?php
/**
 * @Author: Kslr
 * @Date:   2016-03-01 21:16:55
 * @Last Modified by:     Kslr
 * @Last Modified time: 2 2016-03-01 22:10:39
 */
namespace App\Http\Controllers;

use View;
use DB;
use Cache;
use GuzzleHttp;
use DiDom\Document;
use DiDom\Query;
use GuzzleHttp\Client;


class HomeController extends Controller
{

	public function index()
	{
		if(Cache::has('searchKeyword')) {
			$tags = Cache::get('searchKeyword');
		} else {
			$tags = $this->tags();
			Cache::put('searchKeyword', $tags, 1440);
		}
		return View::make('index', ['tags'=>$tags]);
	}

	/**
	 * 获得源站推荐搜索词
	 * @return [type]
	 */
	private function tags()
	{
		$client = new GuzzleHttp\Client();
		$response = $client->request('GET', 'http://www.torrentkitty.net/search/', [
				'headers' => [
					'User-Agent'=> 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.97 Safari/537.36',
					'Referer'	=> 'http://www.torrentkitty.net/search/',
				]
			]);
		
		$document = new Document();
		$document->loadHtml((string) $response->getBody());

		$tags = [];
		foreach ($document->find("div[class=wrapper] p")[4]->find('a') as $key => $value) {
			$tags[$key] = $value->text();
		}
		return $tags;
	}
}