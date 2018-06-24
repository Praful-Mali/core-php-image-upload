<style>
/* Container */
.container{
    margin: 0 auto;
    border: 0px solid black;
    width: 50%;
    height: 250px;
    border-radius: 3px;
    background-color: ghostwhite;
    text-align: center;
}
.container h1{
    background-color: cornflowerblue;
    color: white;
    font-weight: normal;
    margin-top: 0px;
    padding: 15px 5px;
    text-align: center;
}

/* file */
#file{
    border: 2px solid gray;
    border-radius: 3px;
    color: black;
    padding: 10px 5px;
}

/* Button */
.button{
    border: 0px;
    background-color: deepskyblue;
    color: white;
    padding: 5px 15px;
    margin-left: 10px;
}
</style>
<div class="container">
    <h1>AJAX File upload</h1>

    <form method="post" action="" enctype="multipart/form-data" id="myform">
      
        <div >
            <input type="file" id="file" name="file" />
            <input type="button" class="button" value="Upload" id="but_upload">
        </div>
    </form>
	
	<form name="photo" id="imageUploadForm" enctype="multipart/form-data" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
		<input type="file" style="widows:0; height:0" id="ImageBrowse" name="image" size="30"/>
		
		<input type="submit" name="upload" value="Upload" />
	</form>
</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<?php

/* Getting file name */
if(isset($_FILES['file'])){
	$filename = $_FILES['file']['name'];

	/* Location */
	$location = "img/".$filename;
	$uploadOk = 1;
	$imageFileType = pathinfo($location,PATHINFO_EXTENSION);

	// Check image format
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	 && $imageFileType != "gif" ) {
	 $uploadOk = 0;
	}

	if($uploadOk == 0){
		echo 0;
	}else{
	 /* Upload file */
	 if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
		echo $location;
	 }else{
		echo 0;
	 }
	}

}

if(isset($_FILES['image'])){
	$filename = $_FILES['image']['name'];

	/* Location */
	$location = "img/".$filename;
	$uploadOk = 1;
	$imageFileType = pathinfo($location,PATHINFO_EXTENSION);

	// Check image format
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	 && $imageFileType != "gif" ) {
	 $uploadOk = 0;
	}

	if($uploadOk == 0){
		echo 0;
	}else{
	 /* Upload file */
	 if(move_uploaded_file($_FILES['image']['tmp_name'],$location)){
		echo $location;
	 }else{
		echo 0;
	 }
	}

}

?>

<script>
$(document).ready(function(){

    $("#but_upload").click(function(){

        var fd = new FormData();
        var files = $('#file')[0].files[0];
        fd.append('file',files);
	
        $.ajax({
            url: 'index.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
                if(response != 0){
                    $("#img").attr("src",response);
                }else{
                    alert('file not uploaded');
                }
            },
        });
    });
});


$(document).ready(function (e) {
    $('#imageUploadForm').on('submit',(function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type:'POST',
            url: $(this).attr('action'),
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
                console.log("success");
                console.log(data);
            },
            error: function(data){
                console.log("error");
                console.log(data);
            }
        });
    }));

    $("#ImageBrowse").on("change", function() {
        $("#imageUploadForm").submit();
    });
});
</script>