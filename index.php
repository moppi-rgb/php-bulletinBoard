<?php
date_default_timezone_set("Asia/Tokyo");

function loadEnv($filePath)
{
    if (!is_file($filePath)) {
        return;
    }

    $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '' || str_starts_with($line, '#')) {
            continue;
        }

        $parts = explode('=', $line, 2);
        if (count($parts) !== 2) {
            continue;
        }

        $key = trim($parts[0]);
        $value = trim($parts[1]);

        if (
            $value !== '' && (
                (str_starts_with($value, '"') && str_ends_with($value, '"')) ||
                (str_starts_with($value, "'") && str_ends_with($value, "'"))
            )
        ) {
            $value = substr($value, 1, -1);
        }

        $_ENV[$key] = $value;
        putenv("{$key}={$value}");
    }
}

loadEnv(__DIR__ . '/.env');

// データベースに接続
try {
    $dbHost = $_ENV['DB_HOST'] ?? '127.0.0.1';
    $dbName = $_ENV['DB_NAME'] ?? '';
    $dbUser = $_ENV['DB_USER'] ?? '';
    $dbPass = $_ENV['DB_PASSWORD'] ?? '';
    $dbCharset = $_ENV['DB_CHARSET'] ?? 'utf8mb4';

    if ($dbName === '' || $dbUser === '') {
        throw new RuntimeException('.envのDB_NAMEまたはDB_USERが未設定です。');
    }

    $dsn = "mysql:host={$dbHost};dbname={$dbName};charset={$dbCharset}";
    $db = new PDO($dsn, $dbUser, $dbPass);
} catch (PDOException $e) {
    die("接続エラー：" . $e->getMessage());
} catch (RuntimeException $e) {
    die("設定エラー：" . $e->getMessage());
}

// エスケープする関数
function h($s)
{
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}
// レコードの削除
if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    $sql = 'DELETE FROM bbs WHERE id = :delete_id;';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':delete_id', $delete_id, PDO::PARAM_INT);
    $stmt->execute();
    header('Location: index.php');
    exit;
}
// 受け取ったデータの書き込み
if (isset($_POST['message']) && isset($_POST['user_name'])) {
    $message = trim($_POST['message']);
    $user_name = trim($_POST['user_name']);

    if ($message !== '' && $user_name !== '') {
        $sql = 'INSERT INTO bbs (message, user_name, post_date) VALUES (:message, :user_name, NOW());';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':message', $message, PDO::PARAM_STR);
        $stmt->bindValue(':user_name', $user_name, PDO::PARAM_STR);
        $stmt->execute();
        header('Location: index.php');
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sakura.css/css/sakura.css" type="text/css">
    <link rel="stylesheet" href="https://unpkg.com/sakura.css/css/sakura-vader
.css" media="screen and (prefers-color-scheme: dark)" />
    <title>PHP簡易掲示板</title>
</head>

<body>
    <section>
        <h1>PHP一言掲示板</h1>
        <p>学習用に制作したものです。自由に<small>(公序良俗に反しない内容で)</small>書き込みしてください。
        </p>
        <form action="index.php" method="post">
            <label for="">ユーザー名:</label>
            <input type="text" name="user_name">
            <label for="">メッセージ:</label>
            <input type="text" name="message">
            <input type="submit" name="send_message" value="投稿">
        </form>
        <h2>投稿一覧</h2>
        <?php
        $sql = 'SELECT * FROM bbs ORDER BY post_date';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        ?>
        <table>
            <tr>
                <th>id</th>
                <th>ユーザー名</th>
                <th>メッセージ</th>
                <th>日時</th>
                <th></th>
            </tr>
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                <tr>
                    <td><?= h((string) $row['id']) ?></td>
                    <td><?= h($row['user_name']) ?></td>
                    <td><?= h($row['message']) ?></td>
                    <td><?= h($row['post_date']) ?></td>
                    <td>
                        <form action="index.php" method="post">
                            <input type="hidden" name="delete_id" value=<?= $row["id"] ?>>
                            <button type="submit">削除</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </section>

</body>

</html>