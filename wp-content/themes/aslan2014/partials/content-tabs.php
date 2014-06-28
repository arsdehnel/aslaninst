<?php
	$tabs = get_posts( array( 'meta_key' => 'aslaninst_tab_parent_id', 'meta_value' => get_the_ID(), 'post_type' => 'aslaninst_tabs', 'orderby' => 'menu_order', 'order' => 'ASC' ) );

	if( is_array( $tabs ) && count( $tabs ) ):
		if( array_key_exists( 'tab_id', $_GET ) ){
			$tab_id = $_REQUEST['tab_id'];
		}else{
			$tab_id = 0;
		}
		?>
		<div class="tabs-wrapper">
			<nav class="nav-tabs">
				<?php
					foreach( $tabs as $tab ):
						if( $tab_id == $tab->ID || ( $tab_id == 0 && $tabs[0]->ID == $tab->ID ) ):
							$current_tab_id = $tab->ID;
							?>
							<a class="active"><?php echo $tab->post_title; ?></a>
							<?php
						else:
							?>
							<a href="?tab_id=<?php echo $tab->ID; ?>"><?php echo $tab->post_title; ?></a>
							<?php
						endif;
					endforeach;
				?>
			</nav><!-- /.nav-tabs -->
			<div class="tabs-content">
				<?php
					foreach( $tabs as $tab ):
						?>
						<div class="tab-content <?php echo ( $tab->ID == $current_tab_id ? 'current' : '' ); ?>"><?php echo $tab->post_content; ?></div>
						<?php
					endforeach;
				?>
			</div><!-- /.tabs-content -->
		</div><!-- /.tabs-wrapper -->
		<?php
	endif;