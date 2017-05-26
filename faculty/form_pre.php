<?php
    $flag = 0;
?>

<html>
    <head>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
        <script type="text/javascript">
          $(document).ready(function(){
            var yo = <?php echo $flag; ?>;
            if(yo === 0)
                alert('jokola');
            document.getElementById("first_name").required = true;
            document.getElementById("first").required = false;
            //alert('jokola');
          });
        </script>
        <script type="text/javascript">
        function handleChange() {
            alert("jola");
            document.getElementById("first_name").required = true;
            document.getElementById("first").required = false;
        }
        </script>
    </head>
    <body>
        <form action="demo_form.asp">
            <select name="select_course" id="select_course" onchange="handleChange()">
            <option>kola</option>
            <option>mola</option>
            </select>
          <input type="text" name="first_name" value="" id="first_name"
            maxlength="150" >
            <input type="text1" name="first_name1" value="" id="first"
            maxlength="150" >
          <input type="submit" name="kola">
        </form>
    </body>
</html>