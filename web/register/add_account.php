<!DOCTYPE html>
<html lang="ja">
  <head>
    <title></title>
    <script src="https://api.blockchain.z.com/static/client/lib/eth-client.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script type="text/javascript">
    const cnsAddress = '0xcc565e58ccbd369f814ba62429652662a71484a4';
    const baseUrl = 'https://api.blockchain.z.com/';
    const ABI = [{"constant": true,"inputs": [{"name": "_addr","type": "address"}],"name": "getValue","outputs": [{"name": "","type": "uint256"}],"payable": false,"stateMutability": "view","type": "function"},{"constant": false,"inputs": [{"name": "_sign","type": "bytes"},{"name": "_v","type": "uint256"}],"name": "setValue","outputs": [{"name": "","type": "uint256"}],"payable": false,"stateMutability": "nonpayable","type": "function"}];

    let gmoAccount;
    let contract;

    function register() {
        ethClient.Account.create(baseUrl, $('password').val(), function(err, account) {
            if (err) {
                console.log(err);
            } else {
                gmoAccount = account;
                contract = new ethClient.AltExecCnsContract(gmoAccount, cnsAddress);
                localStorage.setItem('account', gmoAccount.serialize());
                $('#address').html(gmoAccount.serialize());
            }
        });
    };

    function login() {
        var serializedAccount = localStorage.getItem('account');
        gmoAccount = ethClient.Account.deserialize(serializedAccount);
        gmoAccount.changeBaseUrl(baseUrl);
        contract = new ethClient.AltExecCnsContract(gmoAccount, cnsAddress);
    }

    function getAddress() {
        $('#address').html(gmoAccount.getAddress());
    };

    </script>

    <meta charset="UTF-8">
    <title>保険管理サービス</title>
<script type="text/javascript" scr = "../js/scripts.js"> </script>
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
    <h1>アカウント発行</h1>
<?php
  if($_POST["type"] === "normal"){
	echo "通常アカウントが発行されました";
  }
  else if($_POST["type"] === "doctor"){
        echo "医師アカウントが発行されました";
  	
  }
  else{
  	echo "正しく選択してください";
  }
?>

</form>
<td><span id="address" /></td>
  <div class="back">
  <input type="button" value="前のページへ戻る" onclick="history.back()">
</div>

  </body>
</html>

