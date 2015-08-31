<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12" id="contact-form">
	<h3 class="title">Отправьте нам сообщение</h3>
	<p>Напишите ваше сообщение в свободной форме, обязательно укажите ваше имя и email для того чтобы мы могли ответить вам</p>
	<p>Пожалуйста, будьте терпеливы в ожидании ответа.</p>
	<?if (!empty($arResult["ERRORS"])):?>
		<?ShowError(implode("<br />", $arResult["ERRORS"]))?>
	<?endif;

	if (strlen($arResult["MESSAGE"]) > 0):?>
		<?ShowNote($arResult["MESSAGE"])?>
	<?endif?>
	<form name="iblock_add" id="feedback-form" action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data">
		<input type="text" name="PROPERTY[NAME][0]" value="<?=ConvertTimeStamp(time(),"FULL")?>" style="display: none;">
		<?=bitrix_sessid_post()?>
		<fieldset>
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<label>Ваше имя<span class="mf-req">*</span></label>
					<input class="form-control" type="text" id="name" name="PROPERTY[26][0]" value="<?=$_REQUEST["PROPERTY"][26][0]?>" required="">
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<label>Ваш E-mail<span class="mf-req"></span></label>
					<input class="form-control" type="text" id="email" name="PROPERTY[27][0]" value="<?=$_REQUEST["PROPERTY"][27][0]?>">
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<label>Ваш телефон<span class="mf-req"></span></label>
					<input class="form-control" type="text" id="phone" name="PROPERTY[28][0]" value="<?=$_REQUEST["PROPERTY"][28][0]?>">
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<label>Сообщение<span class="mf-req">*</span></label>
					<textarea class="form-control" cols="40" rows="5" name="PROPERTY[PREVIEW_TEXT][0]" required=""><?=$_REQUEST["PROPERTY"]["PREVIEW_TEXT"][0]?></textarea>
				</div>
			</div>
			<?if($arParams["USE_CAPTCHA"] == "Y" && $arParams["ID"] <= 0):?>
				<noinedx>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<br/>
						<label><?=GetMessage("IBLOCK_FORM_CAPTCHA_PROMPT")?><span class="mf-req">*</span></label><br/>
						<input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
						<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" /><br/><br/>
						<input class="form-control" type="text" name="captcha_word" maxlength="50" value="">
					</div>
				</div>
				</noinedx>
			<?endif?>
		</fieldset>
		<br>
		<input type="submit" name="iblock_submit" class="btn-normal btn-color" value="Отправить">
		<div class="clearfix"></div>
	</form>
	<br/>
</div>