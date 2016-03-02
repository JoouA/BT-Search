<?php
/**
 * @Author: kslr
 * @Date:   2016-03-01 14:39:24
 * @Last Modified by:     Kslr
 * @Last Modified time: 2 2016-03-02 20:42:23
 */

namespace App\Http\Controllers;

use Log;
use View;
use Cache;
use GuzzleHttp;
use DiDom\Document;
use DiDom\Query;
use GuzzleHttp\Client;


class SearchController extends Controller
{

	public function index($keyword, $page=1)
	{
		$mark = md5(sprintf('%s=@%s', $keyword, $page));
		if(Cache::has($mark)) {
			$list = Cache::get($mark);
		} else {
			$list = $this->search($keyword, $page);
			Cache::put($mark, $list, 1440);
		}

		Log::info($keyword);

		return View::make('list', [
			'list'		=>	$list,
			'keyword'	=>	$keyword,
			'page'		=>	$page
		]);
	}

	/**
	 * 在源站进行搜索
	 * @param  string $keyword 搜索词
	 * @param  int    $page    页码
	 * @return array
	 */
	private function search($keyword, $page)
	{
		$url = sprintf('http://direct.torrentkitty.net/search/%s/%s', $keyword, $page);
		$client = new GuzzleHttp\Client();
		$response = $client->request('GET', $url, [
				'headers' => [
					'User-Agent'=> 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.97 Safari/537.36',
					'Referer'	=> 'http://www.torrentkitty.net/search/',
				]
			]);
		
		$document = new Document();
		$document->loadHtml((string) $response->getBody(), 'UTF-8');

		$pagination = [];
		foreach ($document->find("div[class=pagination] a") as $key => $value) {
			$pagination[$key] = $value->text();
		}

		if($pagination) {
			$pageTotal = array_slice($pagination, -2, 1)[0];
		} else {
			$pageTotal = 1;
		}

		$data = [
			'code'		=> 200,
			'pageTotal'	=> $pageTotal
		];

		foreach ($document->find("table[id=archiveResult] tr") as $key => $value) {
			if($key != 0 && isset($value->find('td')[3]->find('a')[1])) {
				$data['data'][$key]['name'] 		=	$value->find('td')[3]->find('a')[1]->attr('title');
				$data['data'][$key]['size'] 		=	$value->find('td')[1]->text();
				$data['data'][$key]['upload_date'] 	=	$value->find('td')[2]->text();
				$data['data'][$key]['magnet']  		=	$value->find('td')[3]->find('a')[1]->attr('href');
			} else {
				$data['data'] = [];
			}
		}
		return $data;
	}
}