<div class="wrap">
	<h1>Churchtool  Plugin der FeG Aschaffenburg</h1>
	<?php settings_errors(); ?>

	<ul class="nav nav-tabs">
		<li class="active"><a href="#tab-1">Manage Settings</a></li>
		
	</ul>

	<div class="tab-content">
		<div id="tab-1" class="tab-pane active">
		
			<form method="post" action="options.php">
				<?php 
					settings_fields( 'kn_nct_plugin_settings' );
					do_settings_sections( 'kn_nct_plugin' );
					submit_button();
				?>
			</form>
			
		
				
		</div>


	
	</div>
</div>