<?php 
	
	$request_body = file_get_contents('php://input');
	$data = base64_decode($request_body);

	$img = str_replace('data:image/jpeg;base64,', '', $data);
	$img = str_replace(' ', '+', $img);
	$file = 'image.jpeg';
	$success = file_put_contents($file, $data);





?>
<link href="https://lallabi.com/family_assets/css/home.css" rel="stylesheet" type="text/css">
</style>
<div id="lt-photo__list" style="white-space: nowrap; height: 162px; overflow: hidden; outline: none;" tabindex="0"> 
	
	<div class="lt-add__images"> 
		<div class="lt-images__box"> 
			<a href="javascript:void(0)" class="lt-images__link"> 
				<div class="lt-images__core"> <input name="ltPostFiles[]" id="ltPostFile" class="lt_image_upload_btn" type="file" multiple="multiple"> </div> 
			</a> 
		</div> 
	</div> 
	<input type="submit" name="upload" id="upload" value="Upload" />
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
if(window.File && window.FileList && window.FileReader) {

        $(".lt_image_upload_btn").on("change",function(e) {
            if($('.lt-photo__preview').length === 0){
                count_photo = 0;
            }
            var files = e.target.files ,
                filesLength = files.length ;
            var imgPath = $(this)[0].value;
            var leng = $('.lt-photo__preview').length;
            if(leng != NaN)
                var sum =eval(filesLength)+eval(leng);
            else var sum =filesLength;


            var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
            if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {

                if (filesLength <= 10 && leng < 10 && sum <= 10) {
                    for (var i = 0; i < filesLength; i++) {
                        var f = files[i];
                        var fileReader = new FileReader();
                        fileReader.onload = (function (e) {
                            var file = e.target;
                            var html = "<div class='lt-photo__preview'> " +
                                "<div class='lt-preview__details'> " +
                                "<div class='lt-preview__filename'> " +
                                    /*   "<span>"+ files[count].name +"</span> " +*/
                                "</div> " +
                                "<img src='" + e.target.result + "' alt='' id='img_path_"+count_photo +"'/> " +
                                "</div> " +
                                "<a class='lt-preview__remove' onclick='rmv(this.id);' id='img_remove_"+count_photo+"'  href='javascript:undefined;' >Remove file</a> " +
                                "</div>";
                            count_photo++;
                            $('#lt-added__photo').removeClass("hide");
                            $('#lt-photo__list').prepend(html);
                        });
                        fileReader.readAsDataURL(f);
                    }
                }else{
                    commonMessage('Image Post',"Posting Image Maximum Limit 10");
                }

            }
            else
            {
                alert("Pls select only images");
            }
        });
    } else { alert("Your browser doesn't support to File API") }


	
	$(document).ready(function(){

		$("#upload").click(function(){

		var base64image = $('#img_path_0').attr('src');
		
				$.ajax({
					url: 'imageShow.php',
					type: 'post',
					data: base64image,
					contentType: false,
					processData: false,
					success: function(response){
						
					}
				});
			});
		});
	
</script>

