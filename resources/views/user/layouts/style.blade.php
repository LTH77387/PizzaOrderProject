<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Pizza Order System</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{ asset('css/list.css') }}">
{{-- <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script> --}}
  <!-- Cookies -->
  <script src="https://cdn.websitepolicies.io/lib/cookieconsent/1.0.3/cookieconsent.min.js" defer></script>
  <script>
      window.addEventListener("load", function() {
          window.wpcc.init({
              "border": "normal",
              "corners": "normal",
              "colors": {
                  "popup": {
                      "background": "#edfdfa",
                      "text": "#000000",
                      "border": "#5ec2b6"
                  },
                  "button": {
                      "background": "#5ec2b6",
                      "text": "#ffffff"
                  }
              },
              "position": "bottom",
              "content": {
                  "href": "https://www.linklogistics.com/cookie-policy/",
                  "message": "We use cookies for you to get the best experiences on our website.",
                  "button": "Accept"
              },
              "padding": "large",
              "margin": "large",
              "fontsize": "large"
          })
      });
  </script>

</head>

<body>
  

    @yield('style')
    @yield('content')
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
<script type="text/javascript">
    var count = 0;
    var btn = document.getElementById("btn");
    var disp = document.getElementById("display");

    btn.onclick = function () {
        count++;
        disp.innerHTML = count;
    }
</script>
</html>