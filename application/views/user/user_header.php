<style media="all" type="text/css">@import "<?= base_url();?>menu/menu_style.css";</style>
	<!--[if lt IE 7]>
		<link rel="stylesheet" type="text/css" href="<?= base_url();?>menu/includes/ie6.css" media="screen"/>
	<![endif]-->
<div class="wrapper1">
	<div class="wrapper">
		<div class="nav-wrapper">			
			<div class="nav">
				<ul id="navigation" >
 					<li class="<?php if(isset($page) && $page=='home')echo 'active';?>">
						<a href="<?= base_url();?>" target="_self">
							<span class="menu-left"></span>
							<span class="menu-mid">Home</span>
							<span class="menu-right"></span>
						</a>
					</li>					 
										
			   	</ul>
			   	<ul style="float:right">
			   		<li class="#">
							<a href="<?= base_url();?>user/profile" target="_self">
								<span class="menu-left"></span>
								<span class="menu-mid">Profile</span>
								<span class="menu-right"></span>
							</a>
					</li>
				   	<li class="#" >
							<a href="<?= base_url();?>user/dashboard/logout/" target="_self">
								<span class="menu-left"></span>
								<span class="menu-mid" >Logout</span>
								<span class="menu-right"></span>
							</a>
					</li>					
			   	</ul>
			</div>			
			<div id="breadcrumb">
				<?php
				if(isset($breadcrumb)){
					echo '<ul class="breadcrumb">';
					foreach($breadcrumb as $bread){
						echo '<li><img src="'.$bread['icon'].'" /><a href="'.$bread['url'].'">'.$bread['txt'].'</a></li>';
					}
					echo '</ul>';
				}
				?>
			</div>
		
	 </div>
	</div>
</div>