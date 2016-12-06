<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>UploadiFive Test</title>
<script src="jquery-1.7.2.min.js" type="text/javascript"></script>
<script src="jquery.uploadify.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="uploadify.css">
<style type="text/css">
body {
	font: 13px Arial, Helvetica, Sans-serif;
}
</style>
</head>

<body>
	<h1>Uploadify Demo</h1>
	<form>
		<div id="queue"></div>
		<input id="file_upload" name="file_upload" type="file" multiple="true">
	</form>

	<script type="text/javascript">
		<?php $timestamp = time();?>
		$(function() {
			$('#file_upload').uploadify({
				'formData'     : {
					'timestamp' : '<?php echo $timestamp;?>',
					'token'     : '<?php echo md5('unique_salt' . $timestamp);?>'
				},
				'buttonText': '文件上传',
				'swf'      : 'uploadify.swf',
				'uploader' : 'uploadify.php',
				'onUploadSuccess': function(file, data, response){
					alert(data);
					var v = JSON.parse(data);
					if (v.result == 'success') {
						var obj = $('#' + file.id).parent().parent().find('input');
						$('[name=' + obj.attr('name') + '_show]').attr('src', '__ROOT__/Uploads/' + v.msg);
						$('[name=' + obj.attr('name') + ']').val(v.msg);
					}else {
						//alert(v.msg);
					}
				},
			});
		});
	</script>
</body>
</html>