<?php
defined('_JEXEC') or die('Restricted access');
?>

<div class="componentheading">
    <?php echo $this->settings->title; ?>
</div>

<?php if ($this->settings->display_description) : ?>
    <span class="_tl_description"><?php echo $this->timeline->description; ?></span>
<?php endif; ?>

<div id="<?php echo $this->settings->container_id; ?>" style="<?php echo $this->settings->container_style; ?>">
</div>
