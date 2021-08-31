<h1><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chatbox/new','New chatbox');?></h1>

<?php if (isset($errors)) : ?>
		<?php include(erLhcoreClassDesign::designtpl('lhkernel/vadation_error.tpl.php'));?>
<?php endif; ?>

<form ng-non-bindable action="<?php echo erLhcoreClassDesign::baseurl('chatbox/new')?>" method="post">

<?php include(erLhcoreClassDesign::designtpl('lhchatbox/form.tpl.php'));?>

<br>
<div class="btn-group" role="group" aria-label="...">
     <input type="submit" class="btn btn-secondary" name="Save" value="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/buttons','Save');?>"/>
     <input type="submit" class="btn btn-secondary" name="Cancel" value="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/buttons','Cancel');?>"/>
</div>

</form>