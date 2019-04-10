# Y Proofreading

[![License: GPL v2+](https://img.shields.io/badge/License-GPL%20v2%2B-blue.svg)](http://www.gnu.org/licenses/gpl-2.0.html)
[![PHP: >=5.6](https://img.shields.io/badge/PHP-%3E%3D5.6-orange.svg)](http://php.net/)
[![WordPress: >=3.9.3](https://img.shields.io/badge/WordPress-%3E%3D3.9.3-brightgreen.svg)](https://wordpress.org/)

![バナー](https://raw.githubusercontent.com/technote-space/y-proofreading/images/assets/banner-772x250.png)

Yahoo! API を使用した校正支援プラグインです。

## スクリーンショット
### 校正
![Proofreading](https://raw.githubusercontent.com/technote-space/y-proofreading/images/assets/screenshot-1.gif)
### ダッシュボード
![Dashboard](https://raw.githubusercontent.com/technote-space/y-proofreading/images/assets/screenshot-2.png)

## 要件
- PHP 5.6 以上
- WordPress 3.9.3 以上

## 導入手順
1. [ZIPをダウンロード](https://github.com/technote-space/y-proofreading/archive/master.zip)
2. wp-content/plugins に展開
3. プラグインを有効化 
4. *Yahoo! API* の *Client ID* を設定  
    1. https://developer.yahoo.co.jp/yconnect/v2/registration.html  
        アプリケーションの種類は「サーバーサイド」
    2. 管理画面左メニュー『Y Proofreading』⇒『ダッシュボード』に移動
    3. 『Yahoo!API の Client ID』に取得した *アプリケーションID* を入力して『更新』ボタンを押下  
    (シークレットは使用しません)

## 使用方法
### 校正機能の使用
1. サイドバーの「文書タグ」の「校正」から実行します。  
![start-proofreading](https://raw.githubusercontent.com/technote-space/y-proofreading/images/assets/start-proofreading.png)
2. 結果はサイドバーに表示されます。マウスのホバーで指摘事項がポップアップで表示されます。  
![content-result](https://raw.githubusercontent.com/technote-space/y-proofreading/images/assets/content-result.png)
3. 『文章構成支援情報タブ』から指摘の一覧を見ることが可能です。  
![proofreading-info](https://raw.githubusercontent.com/technote-space/y-proofreading/images/assets/proofreading-info.png)
4. 『精度実行』から再度校正を行うことができます。  
![re-proofreading](https://raw.githubusercontent.com/technote-space/y-proofreading/images/assets/re-proofreading.png)
5. 右上の三点リーダー⇒『サイズ設定』からサイズ設定を行うことができます。  
![open-size-setting](https://raw.githubusercontent.com/technote-space/y-proofreading/images/assets/open-size-setting.png)  
![size-setting](https://raw.githubusercontent.com/technote-space/y-proofreading/images/assets/size-setting.png)
6. プラグインの固定を外してしまった場合、右上の三点リーダー⇒『再度固定』から再度固定することができます。  
![size-setting](https://raw.githubusercontent.com/technote-space/y-proofreading/images/assets/pin-again.png)

## 設定
![Dashboard](https://raw.githubusercontent.com/technote-space/y-proofreading/images/assets/screenshot-2.png)
### Yahoo!API の Client ID
https://developer.yahoo.co.jp/yconnect/v2/registration.html  
取得したアプリケーションIDを設定します。
### 除外する指摘
不要な指摘事項を除外することができます。

## Yahoo!API 構成支援
https://developer.yahoo.co.jp/webapi/jlp/kousei/v1/kousei.html

## Author
[GitHub (Technote)](https://github.com/technote-space)  
[Blog](https://technote.space)

## プラグイン作成用フレームワーク
[WP Content Framework](https://github.com/wp-content-framework/core)
