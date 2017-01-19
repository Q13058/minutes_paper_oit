 <?php
	set_include_path(get_include_path().PATH_SEPARATOR.$_SERVER["DOCUMENT_ROOT"].'/PHPExcel/Classes/');
	
      //ライブラリ読み込み
      require_once 'PHPExcel.php';
      require_once 'PHPExcel/IOFactory.php';

      //Excel読み込み
      $filepath = "QA0930.xlsx";
      $objReader = PHPExcel_IOFactory::createReader('Excel2007');
      $book = $objReader->load($filepath);

      //シート設定
      $book->setActiveSheetIndex(0);
      $sheet = $book->getActiveSheet();

	//行の総数をカウント
    $flag = 0;
    $count_x = 0;
    $temp = 0;
      while($flag == 0){
			$objCell = $sheet->getCellByColumnAndRow($temp, 1); //col,rowの並び
              $str = _getText($objCell);
                $count_x++;
                $temp++;
                if($str == ""){
                    $flag = 1;
                }
          }
        $count_x--;
        echo "x:".$count_x;

    //列の総数をカウント
    $flag = 0;
    $count_y = 0;
    $temp = 1;
      while($flag < 2){
			$objCell = $sheet->getCellByColumnAndRow(1, $temp); //col,rowの並び
              $str = _getText($objCell);
                $count_y++;
                $temp++;
                if($str == ""){
                    $flag++;
                }
          }
        $count_y--;
        echo "  y:".$count_y."<br>";

echo 'A1: ' . $book->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->getRGB();
echo '<font color='.$book->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->getRGB().'>'.'A1やよ'.'</font>'.'<br>';
echo 'A2: ' . $book->getActiveSheet()->getStyle('A2')->getFill()->getStartColor()->getRGB();
echo '<font color='.$book->getActiveSheet()->getStyle('A2')->getFill()->getStartColor()->getRGB().'>'.'A2やよ'.'</font>'.'<br>';
echo 'B1: ' . $book->getActiveSheet()->getStyle('B1')->getFill()->getStartColor()->getRGB();
echo '<font color='.$book->getActiveSheet()->getStyle('B1')->getFill()->getStartColor()->getRGB().'>'.'B1やよ'.'</font>'.'<br>';
echo 'B2: ' . $book->getActiveSheet()->getStyle('B2')->getFill()->getStartColor()->getRGB();
echo '<font color='.$book->getActiveSheet()->getStyle('B2')->getFill()->getStartColor()->getRGB().'>'.'B2やよ'.'</font>'.'<br>';
echo 'C1: ' . $book->getActiveSheet()->getStyle('C1')->getFill()->getStartColor()->getRGB();
echo '<font color='.$book->getActiveSheet()->getStyle('C1')->getFill()->getStartColor()->getRGB().'>'.'C1やよ'.'</font>'.'<br>';
echo 'C2: ' . $book->getActiveSheet()->getStyle('C2')->getFill()->getStartColor()->getRGB();
echo '<font color='.$book->getActiveSheet()->getStyle('C2')->getFill()->getStartColor()->getRGB().'>'.'C2やよ'.'</font>'.'<br>';
echo 'D1: ' . $book->getActiveSheet()->getStyle('D1')->getFill()->getStartColor()->getRGB();
echo '<font color='.$book->getActiveSheet()->getStyle('D1')->getFill()->getStartColor()->getRGB().'>'.'D1やよ'.'</font>'.'<br>';
echo 'D2: ' . $book->getActiveSheet()->getStyle('D2')->getFill()->getStartColor()->getRGB();
echo '<font color='.$book->getActiveSheet()->getStyle('D2')->getFill()->getStartColor()->getRGB().'>'.'D2やよ'.'</font>'.'<br>';
      /**
       * 指定したセルの文字列を取得する
       *
       * 色づけされたセルなどは cell->getValue()で文字列のみが取得できない
       *
       *
       * @param $objCell Cellオブジェクト
       */
      function _getText($objCell = null){
          if (is_null($objCell)) {
              return false;
          }
          $txtCell = "";
          //まずはgetValue()を実行
          $valueCell = $objCell->getValue();
          if (is_object($valueCell)) {
              //オブジェクトが返ってきたら、リッチテキスト要素を取得
              $rtfCell = $valueCell->getRichTextElements();
              //配列で返ってくるので、そこからさらに文字列を抽出
              $txtParts = array();
              foreach ($rtfCell as $v) {
                  $txtParts[] = $v->getText();
              }
              //連結する
              $txtCell = implode("", $txtParts);
          } else {
              if (!empty($valueCell)) {
                  $txtCell = $valueCell;
              }else{
				$txtCell = 0;
			}
          }
          return $txtCell;
      }
?>

