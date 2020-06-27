
<html>
<head>
  <meta http-http-equiv="Connect-type" content="text/html" ; charset="utf-8" />
<title>laravel todolist</title>
</head>
<body>
        <form action="{{ url("/create") }}" method="post" >
        {{ csrf_field() }}
		<input type = "text" name="item" placeholder="輸入項目">
		<br>
		<input type="submit" value="新增" >
		<input type="reset">
		<br>
		</form>

<form action=" " method="get" >
<table  width= "700" border="1" >
    @foreach ($data as $key => $value)
            <tr>
            <td><input type='radio' name='radio' value="{{$value->no}}"></td>
            <td>{{$value->item}}</td>
            <td>{{$value->status}}</td>
            <td>{{$value->update_time}}</td>
            <td>{{$value->update_user}}</td>
            </tr>
            @endforeach
 <input type="submit" value="修改" name="update">
 <input type="submit" value="刪除"  name="delete">
 <input type="submit" value="已完成/未完成"  name="complete">

</table>
</form>
</body>
</html>
<?php
if (isset($_GET['update']) == true && isset($_GET['radio']) == true) {
    // echo "hello";
    if ($_GET['update'] == '修改') {
        // echo "hello";
        $no = $_GET['radio'];
        header("Location:put");
        // return redirect("put/{$_GET['radio']}");
    }
}
if (isset($_GET['delete']) == true && isset($_GET['radio'])) {
    if ($_GET['delete'] == '刪除') {
        return redirect("delete/{$_GET['radio']}");
    }
}
        //header("Location:delete.php?radio=".$_GET['radio']."");

    // if ($_GET['complete'] == '已完成/未完成') {
    //     header("Location:complete.php?radio=".$_GET['radio']."");
    // }
            ?>
