
<div class="componentheading">
    <?php echo JText::_('TIMELINES'); ?>
</div>
<br />

<?php if (count($this->timelines)) : ?>
    <div class="_tl_timelines">
        <?php foreach ($this->timelines as $timeline) : ?>
            <span class="_tl_timeline">
                <a href="<?php echo $timeline->link; ?>"><?php echo $timeline->name; ?></a>
            </span>
        <?php endforeach; ?>
    </div>
<?php else : ?>
    <span><?php echo JText::_('NO_PUBLISHED_TIMELINES'); ?></span>
<?php endif; ?>
