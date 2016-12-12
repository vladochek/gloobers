<section class="steps">
<div class="container">
<article>
<!-- h1>Create your passeport </h1>
<p>Enter the destinations in which you can help other travelers. </p> -->
</article>

<div class="about_profile">
<div class="row">
<div class="search_place">


<form style="display: inline;" class="tagsfilter">
 
  <div class="row">
   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
   <div class="title">Destination </div>
   <input name="tags5" id="_trip_loction1" onblur="if (this.placeholder == ''){this.placeholder = 'Destination'; }" onfocus="if (this.placeholder == 'Destination') {this.placeholder = '';}" value="<?php if($_REQUEST['tags5']){ echo $_REQUEST['tags5']; } ?>" onkeyup="search_destination();"autocomplete="off" type="text" placeholder="Destination"/></div>
		 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"> 
		 	<div class="title">Type of trip </div>
			  <select class="select_box" id="loc_desc" tabindex="1">
			  			 <?php foreach($passeport_types as $passeport_type){ ?>
			  			<option value="<?php echo $passeport_type['description']; ?>"> <?php echo $passeport_type['description']; ?> </option>
			  <?php } ?>
			  </select> 
		  </div>
		   <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
		   <div class="title"> </div>
		   <a href="javascript:void(0);" class="button pull-right" onclick="add_passeport();"> Add </a>
		   </div>   
   </div>  
   <div class="row">                       
   <div id="createElementHandlerBox">
    <?php 
//get_passeport();

	if(!empty($passeports)){ 

			foreach($passeports as $passeport)
			{
				echo '<span  class="tagmanagerTag" tag="'.$passeport['location'].'">'.$passeport['location'].'<a class="tagmanagerRemoveTag" title="Remove" onclick="Delete_passeport(this)" id="'.$passeport['location'].'"  href="javascript:void(0);">x</a></span>';
			

			}
			
	}?>
   </div>
   </div>
 </form>
 </div>
</div>
<div class="map"><div class="row">
<!-- <div class="map"> <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d55373193.96960599!2d79.985516139203!3d32.104080806377034!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1434543140626" width="100%" height="300" frameborder="0" style="border:0"></iframe></div>
 --> <div id="map_canvas"   style="width: 100%; height: 350px; "></div>

 </div>
 </div>
<!-- <div class="row submitrow">
<div class="pull-right"><a href="#" class="latter">Do this later </a> <a href="" class="button"> NEXT </a> </div>
</div>
</div> -->
</div>
</section>

