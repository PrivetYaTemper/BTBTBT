<?php get_header(); ?>

	<div id="content">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>


		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			
			<div class="navigation">			
				<div class="prev"><?php previous_post_link('%link', 'Предыдущая', TRUE); ?></div>
				<div class="next"><?php next_post_link('%link', 'Следующая', TRUE); ?></div>
			</div>
			
			<h2 class="posttitle"><?php the_title(); ?></h2>
			<span class="posted">Опубликовано <?php the_time('j M, Y') ?> в <?php the_time() ?></span>
			<div class="entry">
				<?php the_content('<p class="serif">Читать запись полностью &raquo;</p>'); ?>

				<?php wp_link_pages(array('before' => '<p><strong>Страницы:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
				<?php the_tags( '<p class="tags">Метки: ', ', ', '</p>'); ?>

				<p class="postmetadata alt">
					Рубрика: <?php the_category(', ') ?>
						<br><?php edit_post_link('Редактировать запись','',''); ?>
				</p>

			</div>
		</div>
		

		<div class="clear"></div>
		

	<?php comments_template(); ?>

	<?php endwhile; else: ?>

		<p>Извините, по вашему запросу ничего не найдено.</p>

<?php endif; ?>

	</div>
	
<?php get_sidebar(); ?>

<?php get_footer(); ?>
