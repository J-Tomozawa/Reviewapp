<?php

// 楽天ウェブサービス・クラス ===============================================
class pahooRakuten {
	var $error;			//エラーフラグ
	var $hits;			//検索ヒット件数
	var $webapi;		//直前に呼び出したWebAPI URL


	//楽天ウェブサービス
	//https://www.pahoo.org/e-soul/webtech/php06/php06-01-02.shtm#Rakuten 参照
	var $APPLICATIONID      = '1012719882759005667';	//アプリID
	var $APPLICATION_SECRET = '41d9d9162592d970e5fe2ef389b0143b38149d2e';		//シークレット
	var $AFFILIATEID        = '2473f605.8f749324.2473f606.6a1211b7';	//アフィリエイトID

/**
 * コンストラクタ
 * @param	なし
 * @return	なし
*/
function __construct() {
	$this->error  = FALSE;
	$this->errmsg = '';
	$this->hits   = 10;
}

/**
 * デストラクタ
 * @return	なし
*/
function __destruct() {
	unset($this->items);
}

/**
 * エラー状況
 * @return	bool TRUE:異常／FALSE:正常
*/
function iserror() {
	return $this->error;
}

/**
 * エラーメッセージ取得
 * @param	なし
 * @return	string 現在発生しているエラーメッセージ
*/
function geterror() {
	return $this->errmsg;
}

/**
 * PHP5以上かどうか検査する
 * @return	bool TRUE：PHP5以上／FALSE:PHP5未満
*/
function isphp5over() {
	$version = explode('.', phpversion());

	return $version[0] >= 5 ? TRUE : FALSE;
}

/**
 * WebAPIを呼び出して応答データを取得する（https用）
 * @param	string $url リスクエストURL
 * @return	string 応答データ／FALSE=失敗
*/
function callWebAPI($url) {
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_HEADER, FALSE);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); //サーバ証明書検証をスキップ
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); //　　〃
	$result = curl_exec($ch);
	curl_close($ch);

	return $result;
}

// 楽天ブックス系API =======================================================
//出力要素名
var $RakutenBooksItems = array(
	'title',			//書籍タイトル
	'titleKana',		//書籍タイトル カナ
	'subTitle',			//書籍サブタイトル
	'subTitleKana',		//書籍サブタイトル カナ
	'seriesName',		//叢書名
	'seriesNameKana',	//叢書名カナ
	'contents',			//多巻物収録内容
	'contentsKana',		//多巻物収録内容カナ
	'author',			//著者名
	'authorKana',		//著者名カナ
	'publisherName',	//出版社名
	'size',				//書籍のサイズ
	'isbn',				//ISBNコード(書籍コード)
	'itemCaption',		//商品説明文
	'salesDate',		//発売日
	'itemPrice',		//税込み販売価格
	'listPrice',		//定価
	'discountRate',		//割引率
	'discountPrice',	//割引価格
	'itemUrl',			//商品URL
	'affiliateUrl',		//アフィリエイトURL
	'smallImageUrl',	//商品画像 64x64URL
	'mediumImageUrl',	//商品画像 128x128URL
	'largeImageUrl',	//商品画像 200x200URL
	'chirayomiUrl',		//チラよみURL
	'availability',		//在庫状況
	'postageFlag',		//送料フラグ
	'limitedFlag',		//限定フラグ
	'reviewCount',		//レビュー件数
	'reviewAverage',	//レビュー平均
	'booksGenreId'		//楽天ブックスジャンルID
);

/**
 * 楽天ブックス書籍検索APIのURLを取得する
 * @param	string $query  ISBN番号または書名
 * @param	string $author 著者名
 * @param	string $sort   ソート（省略時：standard）
 * @return	string URL
*/
function searchBooksURL($query, $author, $sort='standard') {
	$sort = urlencode($sort);	//検索キー

	if (preg_match('/^[0-9]+$/', $query) > 0) {		//ISBN番号
		$query = '&isbn=' . $query;
	} else if ($query != '') {						//書名
		$query = preg_replace("/ー/ui", '-', $query);
		$query = '&title=' . urlencode($query);
	} else {
		$query = '';
	}
	if ($author != '')	$author = '&author=' . urlencode($author);

	$appid = $this->APPLICATIONID;
	$affid = $this->AFFILIATEID;
	$res = "https://app.rakuten.co.jp/services/api/BooksBook/Search/20170404?applicationId={$appid}&affiliateId={$affid}&format=xml{$query}{$author}&sort={$sort}&size=9&hits=30";

	return $res;
}

/**
 * 楽天ブックスAPIで書籍検索
 * @param	string $query  ISBN番号または書籍名
 * @param	string $author 著者名
 * @param	array  $items  検索結果を格納する配列
 * @param	string $sort   ソート（省略時：standard）
 * @return	ヒットした件数／FALSE：検索に失敗
*/
function searchBooks($query, $author, &$items, $sort='standard') {
	$url = $this->searchBooksURL($query, $author, $sort);
	if (($res = $this->callWebAPI($url)) == FALSE) {
		$this->error  = TRUE;
		$this->errmsg = 'WebAPI呼び出しに失敗';
		return FALSE;
	}
	$this->webapi = $url;

		if ($this->isphp5over()){
		$xml = simplexml_load_string($res);
		//レスポンス・チェック
		$count = (int)$xml->count;
		if ($count <= 0) {	//ヒットせず
			$this->error  = TRUE;
			$this->errmsg = '検索結果なし';
			return FALSE;
		}
		$obj = $xml->Items->Item;
		$cnt = 1;
		foreach ($obj as $node) {
			foreach ($this->RakutenBooksItems as $name) {
				if (isset($node->$name)) {
					$items[$cnt][$name] = (string)$node->$name;
				}
			}
			$items[$cnt]['title'] = preg_replace("/([あ-ん|ア-ン])-/ui", "$1ー", $items[$cnt]['title']);
			$items[$cnt]['titleKana'] = preg_replace("/([あ-ん|ア-ン])-/ui", "$1ー", $items[$cnt]['titleKana']);
			$cnt++;
		}
	}
	$this->hits = $cnt - 1;



	return $this->hits;
}

}