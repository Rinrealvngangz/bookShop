<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Sleek Dashboard - Free Bootstrap 4 Admin Dashboard Template and UI Kit. It is very powerful bootstrap admin dashboard, which allows you to build products like admin panels, content management systems and CRMs etc.">

    <title>Sleek - Admin Dashboard</title>

    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500" rel="stylesheet" />
    <link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!--
    PLUGINS CSS STYLE -->
      @yield('style')
    <link href={{asset("assets/plugins/nprogress/nprogress.css")}} rel="stylesheet" />
    <link href={{asset("assets/plugins/treeview/gijgo.min.css")}} rel="stylesheet" />
    <link href={{asset("https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/css/bootstrap.min.css")}} rel="stylesheet" />
    <link rel="stylesheet" href="{{asset("https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css")}}">

    <link href={{asset("assets/plugins/slider/unslider.css")}} rel="stylesheet" />
    <link href={{asset("assets/plugins/slider/unslider-dots.css")}} rel="stylesheet" />

    <link href={{asset("assets/plugins/slider/unslider-dots.css")}} rel="stylesheet" />

    <!-- No Extra plugin used -->

    <link href={{asset("assets/plugins/jvectormap/jquery-jvectormap-2.0.3.css")}} rel="stylesheet" />

    <link href={{asset("assets/plugins/daterangepicker/daterangepicker.css")}} rel="stylesheet" />

    <link href={{asset("assets/plugins/toastr/toastr.min.css")}} rel="stylesheet" />

    <!-- SLEEK CSS -->
    <link id="sleek-css" rel="stylesheet" href={{asset("assets/css/sleek.css")}} />

    <!-- FAVICON -->
    <link href={{asset("assets/img/favicon.png")}} rel="shortcut icon" />

    <!-- DATA TABLE -->

    <link href={{asset("assets/plugins/data-tables/datatables.bootstrap4.min.css")}} rel="stylesheet">

    <link href={{asset("https://unpkg.com/sleek-dashboard/dist/assets/css/sleek.min.css")}}>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <!-- SELECT-->
    <link href={{asset("assets/plugins/select2/css/select2.min.css")}} rel="stylesheet" />
    <link href={{asset("assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}} rel="stylesheet" />
    <link href={{asset("assets/plugins/sweet-alert/sweetalert2.min.css")}} rel="stylesheet" />
    <link href="{{asset("https://use.fontawesome.com/releases/v5.5.0/css/all.css")}}" rel="stylesheet" crossorigin="anonymous">
    <link href={{asset("assets/plugins/fileInput/fileinput.css")}} rel="stylesheet" />
    <link href={{asset("assets/plugins/fileInput/explorer-fas/theme.css")}} rel="stylesheet" />


    <!--
      HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries
    -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->

    <script src={{asset("assets/plugins/nprogress/nprogress.js")}}></script>
    <link href={{asset("assets/plugins/tree-multiselect/jquery.tree-multiselect.min.css")}} rel="stylesheet">
    <link href={{asset("assets/plugins/dynamic-tree/bstreeview.css" )}}rel="stylesheet">

    <link rel="stylesheet" href={{asset("assets/plugins/publisher/publisher.css")}}>
    <link rel="stylesheet" href={{asset("assets/plugins/author/author.css")}}>
    <style>
        .card {
            flex-direction: column;
            min-width: 0;
            color: #000;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid #fff;
            border-radius: 6px;
            -webkit-box-shadow: 0px 0px 5px 0px rgb(249, 249, 250);
            -moz-box-shadow: 0px 0px 5px 0px rgba(212, 182, 212, 1);
            box-shadow: 0px 0px 5px 0px rgb(161, 163, 164)
        }

        .learn-more {
            text-decoration: none;
            color: #000;
            margin-top: 8px
        }

        .learn-more:hover {
            text-decoration: none;
            color: blue;
            margin-top: 8px
        }
    </style>
</head>
