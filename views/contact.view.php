<?php include('views/partials/head.view.php')?>

<div id="contact_me" class="row">
	<div class="col-md-6 mx-auto text-center">
		<p  class="display-4 font-weight-bold mb-10">
	  		Tom Havatyi
	  	</p>
		<p class="">
		   	I'm currently looking for any new opportunities in software development, my inbox is always open. Whether you have a question or just want to say hi, I'll try my best to get back to you!
		</p>
		<div class="mt-5">
			
			<button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="havvtom@gmail.com">
			  <a href="#" class="fa fa-envelope"></a>
			</button>
			<button type="button" id="linkedin" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="check out my linkedin profile">
			  <a href="#" class="fa fa-linkedin"></a>
			</button>
			<button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="062 283 6577">
			  <a href="#" class="fa fa-whatsapp"></a>
			</button>
			<?php include('views/partials/footer.view.php')?>
		</div>

	</div>
	
</div>

<?php include('views/partials/js.php')?>

<script type="text/javascript">
	$( document ).ready(function () {
		$("#linkedin").click( function () {
			window.open('https://www.linkedin.com/in/tom-havatyi-377a6b102/', '_blank')
		} )
	})
</script>

