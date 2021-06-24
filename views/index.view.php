<?php include('views/partials/head.view.php')?>
	<div class="main-container">
		<h2>
			Movies
		</h2>
		<div class="grid-container">
			<?php foreach(array_slice($data->results, 0, 9) as $movie){ ?>
			  <div class="grid-item">
			  	<a href="#">
			  		<img src=<?php echo "https://image.tmdb.org/t/p/w300/".$movie->poster_path;?>>
			  	</a>			  	
				    <div class="title text-white">
			  			<?php echo $movie->title;?>
			  		</div>
			  		<div class="info">
			  			<span><?php echo getReleaseDate($movie->release_date); ?></span>
			  			<?php if( isset($_SESSION['username']) && $_SESSION['username'] == 'jointheteam' && !in_array($movie->id, $_SESSION['favorites'])) { ?>
						  <button type="submit" class="btn btn-sm favorite ml-2" onclick="$(this).favorite(<?php echo "{$movie->id}, '{$movie->title}'"?>)">Favorite</button>
						<?php } elseif( isset($_SESSION['username']) && $_SESSION['username'] == 'jointheteam' ) { ?>
					        <button type="submit" class="btn btn-sm favorite ml-2" onclick="$(this).unfavorite(<?php echo "{$movie->id}, '{$movie->title}'"?>)">Unfavorite</button>
					    <?php } ?>
			  		</div>			    		  		
			  </div>  
			  <?php } ?>	
		</div>	
		<div class="wrapper">
			<div class="pagination">
				<?php for( $i = 1; $i <= 5; $i++ ) { ?>
					<input class="dot" id=<?php echo $i ?> type="radio" name="dots">
					<label for=<?php echo $i ?>></label>
				<?php } ?>
				<div class="pacman"></div>	
			</div>
		</div>	
		<?php include('views/partials/footer.view.php')?>
 	</div>
		
	</div>
	<?php include('views/partials/js.php')?>
	<script type="text/javascript">
		$( document ).ready(function(){

			//Get page number from php 
		    var page = "<?php echo $data->page; ?>";

			// Pagination
		     $(".dot").on('click', function (){
	            	page = this.id;
	            	var url = window.location.pathname;
					if( url.includes('favorites') ){
						$(location).attr('href', window.location.origin + '/favorites?page=' + page)
					} else{
						$(location).attr('href', window.location.origin + '?page=' + page)
					}           	
	            	            	
		        })

		     $("#" + page ).prop('checked', true);

		     //favoring
		     $.fn.favorite = function(movie_id, movie_title) {
		     	$.post("favorite", 
		     		{ movie_id: movie_id, title: movie_title }, 
		     		function ( data, status ){
		     			window.location.replace('/' );
		     		})
		     }

		    //unfavoring
		     $.fn.unfavorite = function(movie_id, movie_title) {
		     	$.post("unfavorite", 
		     		{ movie_id: movie_id, title: movie_title }, 
		     		function ( data, status ){
		     			window.location.replace('/' );
		     		})
		     }
		})
	</script>
</body>

