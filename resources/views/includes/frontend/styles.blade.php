<!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet" />

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/elegant-icons.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/slicknav.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">
    <style>
        .container-1{
          width: 300px;
          vertical-align: middle;
          white-space: nowrap;
          position: relative;
        }

        .container-1 input#search{
          width: 300px;
          height: 50px;
          /*background: #2b303b;*/
          border: none;
          font-size: 10pt;
          float: left;
          /*color: #63717f;*/
          -webkit-border-radius: 5px;
          -moz-border-radius: 5px;
          border-radius: 5px;
        }

        .container-1 input#search::-moz-placeholder {  /* Firefox 19+ */
           color: #65737e;  
        }

        .container-1 .icon{
          position: absolute;
          top: 50%;
          margin-left: 17px;
          margin-top: 17px;
          z-index: 1;
          color: #4f5b66;
        }

        .container-1 input#search:hover, .container-1 input#search:focus, .container-1 input#search:active{
            outline:none;
            background: #ffffff;
          }

          .container-1 input#search{
          width: 300px;
          height: 50px;
          /*background: #2b303b;*/
          border: none;
          font-size: 10pt;
          float: right;
          /*color: #262626;*/
          padding-left: 45px;
          -webkit-border-radius: 5px;
          -moz-border-radius: 5px;
          border-radius: 5px;
         
           
            -webkit-transition: background .55s ease;
          -moz-transition: background .55s ease;
          -ms-transition: background .55s ease;
          -o-transition: background .55s ease;
          transition: background .55s ease;
        }
    </style>