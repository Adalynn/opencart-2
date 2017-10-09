
4
5
6
7
8
9
10
11
12
13
14
15
16
17
18
19
20
21
22
23
24
25
26
27
28
29
30
<!doctype html>
<html>
    <head>
        <title>Show a Div reaching bottom of the page tutorial</title>
        <script src="http://code.jquery.com/jquery-latest.min.js"></script>
        <script>
            $(document).ready(function() {
                $(window).scroll(function() {
                    if ($(window).scrollTop() >= ($(document).height() - $(window).height())) {
                        $('#showdiv').animate({width: 'toggle'});
                    }else{
                        $('#showdiv').fadeOut('slow');
                    }
                });
            });    
        </script>
        <style>
            body { margin: 0; font-size: 100px;}
            #showdiv {border: 6px double orange; position: fixed; right: 0; bottom: 10px; width: 300px; height: 100px; background: white;display:none;}
            h3{font-size: 15px;}
        </style>
    </head>
    <body>
        <h3>Scroll down to the bottom of the page to see the box appear</h3>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
        <div id="showdiv">
            <h3>Here is the hidden box.</h3>
        </div>
    </body>
</html>