</div>
<div id="footer">
	
	<div class="copyright">
		&copy; <?php echo date("Y"); ?> <?php bloginfo('name'); ?>
        <br>Русские <a href="http://hostenko.com/themes">WordPress темы</a> — <a href="http://hostenko.com">Hostenko</a>
	</div>
	
	<div class="powered">
		<!--<a href="http://graphpaperpress.com" title="Designed by Graph Paper Press" class="gpplogo">Graph Paper Press</a>
		<a href="http://wordpress.com" title="Powered by WordPress" class="wplogo">WordPress</a>-->
	</div>
	<?php if(is_home() || is_archive()): ?>
	<div class="navigation">		
		<div class="prev"><?php previous_posts_link(__('Предыдущая запись &raquo;')); ?></div>
		<div class="next"><?php next_posts_link(__('&laquo; Следующая запись')); ?></div>
	</div>
	<?php endif; ?>
	
</div>
<?php wp_footer(); ?>
</body>
</html>
