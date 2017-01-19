<html>
<body>
	<form action='result.php' method='post' name="form1">
	■データベースに登録するする列を指定してください。(A列は固定です)
			<br>
			　 何もチェックされていない場合、最後に入力があった列から後ろ4列の内容を自動で登録します。
			<br>
			B列
			<input type="checkbox" name="cell[]" value="2">
			C
			<input type="checkbox" name="cell[]" value="3">
			D
			<input type="checkbox" name="cell[]" value="4">
			E
			<input type="checkbox" name="cell[]" value="5">
			F
			<input type="checkbox" name="cell[]" value="6">
			G
			<input type="checkbox" name="cell[]" value="7">
			<br>
			H
			<input type="checkbox" name="cell[]" value="8">
			I
			<input type="checkbox" name="cell[]" value="9">
			J
			<input type="checkbox" name="cell[]" value="10">
			K
			<input type="checkbox" name="cell[]" value="11">
			L
			<input type="checkbox" name="cell[]" value="12">
			M
			<br>
		<input type='submit' value='送信' />
</form>
</body>
</html>

