<?php
// DB接続情報
$dsn = 'mysql:host=localhost;dbname=testphp;charset=utf8mb4';
$username = 'root';
$password = 'S043160';

// POSTデータを受け取る
$id = $_POST['Mouban'];

// try-catch
try{
	// データベースへの接続を表すPDOインスタンスを生成
	$pdo = new PDO($dsn,$username,$password);

	//  SQL文 :idは、名前付きプレースホルダ
	$sql = "select * from syain where Mouban = :Mouban";

	// プリペアドステートメントを作成
	$stmt = $pdo->prepare($sql);

	// プレースホルダと変数をバインド
	$stmt -> bindParam(":Mouban",$id);
	$stmt -> execute(); //実行

	// データを取得
	$rec = $stmt->fetch(PDO::FETCH_ASSOC);

	// 接続を閉じる
	//$pdo = null; スクリプト終了時に自動で切断されるので不要
}catch (PDOException $e) {
	// UTF8に文字エンコーディングを変換します
	exit(mb_convert_encoding($e->getMessage(),'UTF-8','SJIS-win'));   
}
function escape1($str)
{
    return htmlspecialchars($str,ENT_QUOTES,'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>select</title>
</head>
<body >

<?php foreach ($rec as $a):?>
	<?=escape1($a)?>
<?php endforeach; ?>が開通予定日です

</body>
</html>