<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
if (!$arResult["ITEMS"]) return;
?>
<div class="main-content">
<div class="container">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="row team">
				<?foreach($arResult["ITEMS"] as $key => $item):?>
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 item animate_afc d<?=($key+1)?> animate_start">
						<div class="team-member">
							<div class="team-member-holder">
								<div class="team-member-image">
									<img alt="<?=$item["NAME"].' '.$item["LAST_NAME"]?>" title="<?=$item["NAME"].' '.$item["LAST_NAME"]?>" src="<?=$item["PERSONAL_PHOTO"]["SRC"]?>">
									<div class="team-member-links">
										<?/*<div class="team-member-links-list">
											<a onclick="return !window.open(this.href)" class="facebook team-member-links-item" href="https://www.facebook.com/">
												<i class="icon-facebook"></i>
											</a>
											<a onclick="return !window.open(this.href)" class="google_plus team-member-links-item" href="https://plus.google.com">
												<i class="icon-google_plus"></i>
											</a>
											<a onclick="return !window.open(this.href)" class="linkedin team-member-links-item" href="https://www.linkedin.com">
												<i class="icon-linkedin"></i>
											</a>
											<a onclick="return !window.open(this.href)" class="twitter team-member-links-item" href="https://twitter.com">
												<i class="icon-twitter"></i>
											</a>
										</div>*/?>
									</div>
								</div>
								<div class="team-member-meta">
									<h4 class="team-member-name"><?=$item["NAME"].' '.$item["LAST_NAME"]?></h4>
									<div class="team-member-role"><?=$item["WORK_POSITION"]?></div>
									<div class="team-member-description">
										<p><?=$item["WORK_PROFILE"]?></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?endforeach;?>
			</div>
		</div>
	</div>
</div>
</div>

