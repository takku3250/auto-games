<!DOCTYPE html>
<html>
<head>
    <title>マッチング一覧</title>
</head>
<body>
    <h1>マッチング一覧</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>ポストID</th>
                <th>ユーザーID</th>
                <th>プレイ日時</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($matches as $match)
                <tr>
                    <td>{{ $match->id }}</td>
                    <td>{{ $match->owner->name }}</td>
                    <td>{{ $match->guest->name }}</td>
                    <td>{{ $match->played_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>