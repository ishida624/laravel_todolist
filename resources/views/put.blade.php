

<html>
<head>
  <meta http-http-equiv="Connect-type" content="text/html" ; charset="utf-8" />
<title>laravel todolist</title>
</head>
<body>
        <a href=todo_index.blade.php>返回</a><br>
        <form action="{{ url("/create") }}" method="put" >
        {{ csrf_field() }}
         @method('PUT')
		<input type = "text" name="item" placeholder="輸入項目">
        <input type = "hidden" name="no" value="<?php echo ".$_GET['radio'].";?>">
		<br>
		<input type="submit" value="新增" >
		<input type="reset">
		<br>
		</form>
    </body>
    </html>
