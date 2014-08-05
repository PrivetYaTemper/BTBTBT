<?php get_header(); ?>

	<div id="content">

	<?php if (have_posts()) : ?>

		<h2>Результаты поиска</h2>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Предыдущие записи') ?></div>
			<div class="alignright"><?php previous_posts_link('Новые записи &raquo;') ?></div>
		</div>


		<?php while (have_posts()) : the_post(); ?>

			<div <?php post_class() ?>>
				<h3 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
				<span class="posted">Опубликовано <?php the_time('j M, Y') ?> в <?php the_time() ?></span>

				<p class="postmetadata alt">
					Рубрика: <?php the_category(', ') ?>.
						<?php edit_post_link('Редактировать запись','','.'); ?>
				</p>
			</div>

		<?php endwhile; ?>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Предыдущие записи') ?></div>
			<div class="alignright"><?php previous_posts_link('Новые записи &raquo;') ?></div>
		</div>

	<?php else : ?>

		<h2 class="center">Ничего не найдено <br><br>Попробуйте изменить условия поиска</h2>
		<?php get_search_form(); ?>

	<?php endif; ?>

	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>