<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>保険管理サービス</title>
<script type="text/javascript"></script>
<script type="text/javascript" src="/js/scripts.js"></script>
<script type="text/javascript" src="/js/zcom-vars-compiled.js"></script>
<script type="text/javascript" src="/js/config.js"></script>
<script type="text/javascript" src="/js/bluebird.js"></script>
<script type="text/javascript" src="/js/local-storage.js"></script>
<script type="text/javascript" src="/js/eth-client.js"></script>
<script type="text/javascript" src="/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/assets/a687c352/jquery.js"></script>
<script type="text/javascript" src="/assets/cc4477fd/yii.js"></script>
<script type="text/javascript" src="/assets/cc4477fd/yii.activeForm.js"></script>
<script>jQuery(function($){
jQuery("#post-form").yiiActiveForm([],[]);
});</script>

<script type="tyxt/javascript">addDiagnosis(getAccount(),"password",$_POST["address"],$_POST["stay"],$_POST["cancer"]);</script>    

<style>
      body {
        background: #ffffff;
        font-family: Meiryo;
        text-align: center;
      }
    .square_btn{
    display: inline-block;
    padding: 0.7em 2em;
    text-decoration: none;
    margin: 20px;
    background: #00ff00;/*ボタン色*/
    color: #FFF;
    border-bottom: solid 4px #627295;
    border-radius: 3px;
}
.square_btn:active {/*ボタンを押したとき*/
    -ms-transform: translateY(4px);
    -webkit-transform: translateY(4px);
    transform: translateY(4px);/*下に動く*/
    border-bottom: none;/*線を消す*/
}

.contact-form {
  border: 1px solid #ccc;
  padding: 10px;
  font-size: 13px;
  font-family: sans-serif;
}
.contact-form .item {
  display: block;
  overflow: hidden;
  margin-bottom: 10px;
}
.contact-form .item.no-label {
  padding: 5px 0px 5px 0px;
}
.contact-form .itemno-label {
  padding: 5px 0px 5px 0px;
}
.contact-form .item .label {
  float: left;
  padding: 5px;
  margin:0;
}
.contact-form .item .radio-group{
  padding: 5px 0px 5px 0px;
}
.contact-form .item input[type=text],
.contact-form .item input[type=email],
.contact-form .item textarea {
  display: block;
  margin-left: 60px;
  width: 350px;
  padding: 5px;
  border: 1px solid #ccc;
  box-sizing: border-box;
  font-size: 13px;
  text-align: center;
  margin: 0 auto;
}
.contact-form .item ::placeholder {
  color: #ccc;
}
.contact-form .item textarea {
  outline: none;
  border: 1px solid #ccc;
  resize: vertical;
}
input[type=submit] {
  border: none;
  outline: none;
  display: block;
  line-height: 30px;
  width: 220px;
  text-align: center;
  font-size: 13px;
  color: #fff;
  background-color: #00ff00;
  border-bottom: 3px solid #464;
  cursor:pointer;
  margin: 0 auto;
  box-sizing: content-box;
  transition:0.1s ease all
}
input[type=regist] {
  border: none;
  outline: none;
  display: block;
  line-height: 30px;
  width: 220px;
  text-align: center;
  font-size: 13px;
  color: #fff;
  background-color: #ffffff;
  cursor:pointer;
  margin: 0 auto;
  box-sizing: content-box;
  transition:0.1s ease all
}
#layer {
    display: none;  /* 初期表示は非表示 */
    position: absolute; 
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    background-color: black;
    opacity: 0.20;
}
#popup {
    display: none;  /* 初期表示は非表示 */
    position: absolute; 
    left: 50%;
    top: 50%;
    width: 300px;
    height: 200px;
    margin-left: -150px;
    margin-top: -100px;
    background-color: white;
    border-radius: 5px;
    text-align: center;
}
div {
  text-align : center ;
}
input[type=submit]:hover{
  opacity:0.6;
}
    </style>

  </head>
  <body>
    <h1>診断書作成</h1>
<?php
  if(empty($_POST["address"]) || empty($_POST["stay"]) ? true : empty($_POST["cancer"])){
      echo "正しく登録してください";
  }
  else{
    echo "患者のアドレス:".$_POST["address"]."<br />" ;
    echo "入院日数:".$_POST["stay"]."日<br />" ;
    if($_POST["cancer"] === "true"){
  	echo "ガン:有り";
    }
    else{
          echo "ガン:無し";
    }
  }
?>
  <div class="back">
  <input type="button" value="前のページへ戻る" onclick="history.back()">
  </div>
  </body>
</html>

