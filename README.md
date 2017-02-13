# ミニッツペーパ閲覧システムの設定方法

① サーバに表1に書かれている「PHP Version 5.6.25」、「Apache Version 2.4.6」、  
「php MyAdmin version 5.7.16」をインストールする（これら以外のバージョンは非推奨である）。  
② GitHubに公開しているソースコードから、ファイルをダウンロードする。  
③ webサーバ内の「/var/www/html/」のディレクトリに新しく「mp」という名前のディレクトリを作成し、  
②でダウンロードしたソースコードをその中に入れる。  
④ webサーバ内の「/var/www/html/mp/teacher」のディレクトリにある「admin_data」と「user_data」の  
パーミッションを「707」に変更する。  
また、それぞれのファイル内にあるCSVファイルのパーミッションもすべて「707」に変更する。  
⑤ 「(webサーバのアドレス)/mp/login.php」でアクセスすることが可能かを確かめる。  

データベースの設定  
① webブラウザで「（webサーバのアドレス）/phpMyAdmin/」へアクセスし、ログインする。  
② データベースを新しく作成し、データベース名を「mp」とする。  
③ 構造タブをクリックし、テーブルの構造を設定する。  
　データベースは「color」「qanda」「question」という3つのテーブルによって構成されている。  
これらの設定方法を以下に示す。  

■「color」テーブルの設定   
　「color」テーブルは、エクセルファイル内のセルの色情報を閲覧システムに反映し、その色情報が反映されているセルを上に表示させるようするために必要な設定である。  
  「color」テーブルの構造  

###

  | 名前 | データ型 | 照合状態 | その他 |
  |:-------------|:------------|:----------------|:---------------|
  | id(主キー)    | int(11)     |                 | AUTO_INCREMENT |
  | school_date  | date        |                 |                |
  | number       | varchar(7)  | utf8_general_ci |                |
  | rgb          | int(11)     |                 |                |
  | column_color | int(11)     | utf8_general_ci |                |
  | time         | time        |                 |                |
  | lecture      | varchar(64) | utf8_general_ci |                |

###

| Left align | Right align | Center align |
|:-----------|------------:|:------------:|
| This       |        This |     This     |
| column     |      column |    column    |
| will       |        will |     will     |
| be         |          be |      be      |
| left       |       right |    center    |
| aligned    |     aligned |   aligned    |

■「qanda」テーブルの設定
  「qanda」テーブルは、ミニッツペーパーにおける学生の回答（質問、授業のまとめ）と、それに対する教員の回答を保存する場所である。
  「qanda」テーブルの構造  
  | 名前 | データ型 | 照合状態 | その他 |
  |:-------------|:--------------|:----------------|:---------------|
  | id(主キー)    | int(20)       |                 | AUTO_INCREMENT |
  | num          | int(11)       |                 |                |
  | number       | varchar(6)    | utf8_general_ci |                |
  | question     | varchar(1000) | utf8_general_ci |                |
  | answer       | varchar(1000) | utf8_general_ci |                |
  | comment      | varchar(1000) | utf8_general_ci |                |
  | reply        | varchar(1000) | utf8_general_ci |                |
  | column1      | varchar(1000) | utf8_general_ci |                |
  | column2      | varchar(1000) | utf8_general_ci |                |
  | column3      | varchar(1000) | utf8_general_ci |                |
  | column4      | varchar(1000) | utf8_general_ci |                |
  | school_date  | date          |                 |                |
  | present      | int(11)       |                 |                |
  | lecture      | varchar(64)   | utf8_general_ci |                |
  | delete_flag  | int(11)       |                 |                |
  | time         | time          |                 |                |
  | file_name    | varchar(32)   | utf8_general_ci |                |
  | teacher      | varchar(16)   | utf8_general_ci |                |
  | border_flag  | int(11)       |                 |                |

■「question」テーブルの設定
  「question」テーブルは、ミニッツペーパーにおける教員の質問内容を保管する場所である。  
  「question」テーブルの構造
  | 名前 | データ型 | 照合状態 | その他 |
  |:-------------|:--------------|:----------------|:---------------|
  | id(主キー)    | int(11)       |                 | AUTO_INCREMENT |
  | question1    | varchar(1000) |                 |                |
  | question2    | varchar(1000) | utf8_general_ci |                |
  | question3    | varchar(1000) | utf8_general_ci |                |
  | question4    | varchar(1000) | utf8_general_ci |                |
  | question5    | varchar(1000) | utf8_general_ci |                |
  | question6    | varchar(1000) | utf8_general_ci |                |
  | question7    | varchar(1000) | utf8_general_ci |                |
  | question8    | varchar(1000) | utf8_general_ci |                |
  | school_date  | date          |                 |                |
  | count        | int(11)       |                 |                |
  | lecture      | varchar(64)   | utf8_general_ci |                |

④ 特権タブをクリックし、「Add user account」をクリックする。  
⑤ 「User name」「パスワード」「Host name」をそれぞれ設定する。「Host name」は「ローカル」に設定する。  
⑥ グローバル特権の「Check all」のチェックボックスをクリックする。  
⑦ webサーバ内の「/var/www/html/mp/teacher」のディレクトリにある「function.php」をテキストエディタで開く。  
⑧ ⑤で設定した情報を以下の表のように「function.php」内を書き換える。  

|:-------------|:------------|
| IPADDRESS    | 127.0.0.1   |
| USERNAME     | (User name) |
| USERPASSWORD | (パスワード) |
| DATABASE     | mp          |

MySQLの設定
① webブラウザで「（webサーバのアドレス）/phpMyAdmin/」へアクセスし、ログインする。  
② 「mp」データベースを選択し、SQLタブをクリックする。  
③ 入力フォーマットに「SEL GLOBAL sql_mode=’’」を入力し、実行ボタンを押す。
