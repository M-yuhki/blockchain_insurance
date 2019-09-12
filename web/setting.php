<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
?>
<div class="wrapper">
    <?= $this->render('/common/sidebar');?>
    <!-- Page Content Holder -->
    <div id="content">
        <div class="wrap-setting">
            <?php if (!Yii::$app->user->identity->address) { ?>
                <button type="button" id="createAccount" class="btn btn-primary" data-toggle="modal" data-target="#create_account_popup">
                    <span>Create new Accountss</span>
                </button><br><br>
            <?php } else { ?>
                <p><strong>Your Address:</strong> <span><?= (Yii::$app->user->identity->address) ? '0x' . Yii::$app->user->identity->address : '' ?></span></p>
            <?php } ?>

            <?php $form = ActiveForm::begin(['action' => ['user/setting'], 'id' => 'user-form', 'method' => 'POST', 'options' => ['class' => '']]); ?>

                <fieldset><legend>Setting</legend></fieldset>
                <?php if (Yii::$app->session->hasFlash('userFormSubmitted')) { ?>
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <strong>Well done!</strong> Save successful
                        </div>
                    <?php } ?>
                <?php if (Yii::$app->session->hasFlash('userFormSubmittedError')) { ?>
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <strong>Oh snap!</strong> Save data failed
                        </div>
                    <?php } ?>
                <?= $form->field($model, 'nickname')->textInput(['class' => 'form-control']) ?>
                <div class="form-group clearfix">
                    <div class="col-sm-offset-2 col-sm-10">
                        <div class="pull-right">
                            <?= Html::button('Cancel', ['class' => 'btn btn-default', 'name' => 'back-button', 'onclick' => '(function ( $event ) { window.location.href = "' . Url::to(['post/index']) . '"; })();']) ?>
                            <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                        </div>
                    </div>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<div class="modal fade create_account_popup" id="create_account_popup">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a href="#" data-dismiss="modal" class="class pull-right"><span class="glyphicon glyphicon-remove"></span></a>
                <h3>Create Account</h3>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger alert-dismissable" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <span>Oh snap! Create account failed.</span>
                </div>
                <div class="field-password">
                    <label class="control-label" for="password">Input password</label>
                    <input type="password" id="accountPassword" class="form-control" name="account-password" value="" placeholder="Password">
                </div>
                <?php $form = ActiveForm::begin(['action' => ['user/setting'], 'id' => 'create-account-form', 'method' => 'POST']); ?>
                    <?= $form->field($model, 'address')->hiddenInput(['id' => 'address', 'value' => ''])->label(false); ?>
                <div class="form-group">
                    <div class="row"><div class="col-sm-2 col-sm-offset-5 text-center">
                    <?= Html::button('CREATE', ['id' => 'createAccountBtn', 'class' => 'btn btn-primary btn-lg', 'name' => 'create-account-button', 'data-loading-text' => '<i class="fa fa-circle-o-notch fa-spin"></i> Creating account...']) ?></div></div>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>保険管理サービス</title>
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
 <form class="contact-form" action="//www-creators.com/rsc/receiver.php" method="post">
    <p class="label">発行したいアカウントを選択してください</p>
  <div class="item">
    <div class="radio-group">
      <label><input type="radio" name="source">通常アカウント</label><br>
      <label><input type="radio" name="source">医師アカウント</label><br>
    </div>
  </div>
  <div class="item no-label">
    <input type="submit">
  </div>
</form>
  <div class="back">
  <input type="button" value="前のページへ戻る" onclick="history.back()">
  <div>
  </body>
</html>
