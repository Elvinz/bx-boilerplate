<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?if (!$_REQUEST["AJAX_CALL"] || $arResult["ERRORS"]):?>
	<h3 class="title" style="margin-bottom: 5px;">Отправьте нам сообщение</h3>
	<p>Напишите ваше сообщение в свободной форме, обязательно укажите ваше имя и email для того чтобы мы могли ответить вам</p>
	<p>Пожалуйста, будьте терпеливы в ожидании ответа.</p>
	<?if ($arResult["SELLING_PROP_ELEMENT"]):?>
		<p>Тариф: <b style="color: #0488cd"><?=$arResult["SELLING_PROP_ELEMENT"]["NAME"]?></b> - <b style="color: red"><?=SaleFormatCurrency($arResult["SELLING_PROP_ELEMENT"]["PROPERTIES"]["PRICE"]["VALUE"], "RUB");?></b></p>
	<?endif;?>
<?endif;?>
<?if (!empty($arResult["ERRORS"])):?>
<?ShowError(implode("<br />", $arResult["ERRORS"]))?>
<?endif;
if (strlen($arResult["MESSAGE"]) > 0):?>
	<table style="width: 100%; height: 100px;">
		<tr>
			<td style="width: 100%; height: 100%;vertical-align: middle;color: green;font-size: 16px;">
				<?ShowNote($arResult["MESSAGE"])?><br/>
			</td>
		</tr>
	</table>
	<?if ($_REQUEST["AJAX_CALL"] && !$arResult["ERRORS"]):?>
		<script>
			$(document).ready(function(){
				$.fancybox.update()
				setTimeout(function(){
					$.fancybox.close();
				}, 3000)
			});

		</script>
		<?
		return;
		?>
	<?endif;?>
<?endif?>

<form name="iblock_add" id="feedback-form" action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data">
	<input type="text" name="PROPERTY[NAME][0]" value="<?=ConvertTimeStamp(time(),"FULL")?>" style="display: none;">
	<?=bitrix_sessid_post()?>
<fieldset>
	<div class="row">
		<div style="width: 25%">
			<label>Ваше имя<span class="mf-req"></span></label>
			<input class="form-control" type="text" id="name" name="PROPERTY[26][0]" value="<?=$_REQUEST["PROPERTY"][26][0]?>" required="">
		</div>
		<div style="width: 25%">
			<label>Ваш E-mail<span class="mf-req"></span></label>
			<input class="form-control" type="text" id="email" name="PROPERTY[27][0]" value="<?=$_REQUEST["PROPERTY"][27][0]?>">
		</div>
		<div style="width: 25%">
			<label>Ваш телефон<span class="mf-req"></span></label>
			<input class="form-control" type="text" id="phone" name="PROPERTY[28][0]" value="<?=$_REQUEST["PROPERTY"][28][0]?>">
		</div>
	</div>
	<div class="row">
		<div>
			<label>Сообщение<span class="mf-req">*</span></label>
			<textarea class="form-control" cols="30" rows="5" name="PROPERTY[PREVIEW_TEXT][0]" required=""><?=$_REQUEST["PROPERTY"]["PREVIEW_TEXT"][0]?></textarea>
		</div>
	</div>
	<?if($arParams["USE_CAPTCHA"] == "Y" && $arParams["ID"] <= 0):?>
	<noindex>
		<div class="row">
		<div>
			<label><?=GetMessage("IBLOCK_FORM_CAPTCHA_PROMPT")?><span class="mf-req">*</span></label><br/>
			<input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
			<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" /><br/><br/>
			<input class="form-control" type="text" name="captcha_word" maxlength="50" value="">
		</div>
	</div>
	</noindex>
	<?endif?>
</fieldset>
<br>
<input type="submit" name="iblock_submit" class="btn-normal btn-color" value="Отправить">
<div class="clearfix"></div>
</form>