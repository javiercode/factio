<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Example 2</title>
    <style>
        body {
            background: #FFF;
            /* font-size:0.9em !important; */
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 12px;
            line-height: 1.22;
            color: #333;
        }
        ::after, ::before {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }
        .col-xs-7 {
            width: 375px;
        }
        .col-xs-5 {
            width: 244px;
        }
        .col-xs-8 {
            width: 66.66666667%;
        }
        .col-xs-4 {
            width: 33.33333333%;
        }
        .col-xs-1 {
            width: 8.33333333%;
        }
        .col-xs-1, .col-xs-10, .col-xs-11, .col-xs-12, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9 {
            float: left;
        }
        .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-xs-1, .col-xs-10, .col-xs-11, .col-xs-12, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9 {
            position: relative;
            min-height: 1px;
            padding-right: 15px;
            padding-left: 15px;
        }
        .btn-group-vertical > .btn-group::after, .btn-toolbar::after, .clearfix::after, .container-fluid::after, .container::after, .dl-horizontal dd::after, .form-horizontal .form-group::after, .modal-footer::after, .nav::after, .navbar-collapse::after, .navbar-header::after, .navbar::after, .pager::after, .panel-body::after, .row::after {
            clear: both;
        }

        .btn-group-vertical > .btn-group::after, .btn-group-vertical > .btn-group::before, .btn-toolbar::after, .btn-toolbar::before, .clearfix::after, .clearfix::before, .container-fluid::after, .container-fluid::before, .container::after, .container::before, .dl-horizontal dd::after, .dl-horizontal dd::before, .form-horizontal .form-group::after, .form-horizontal .form-group::before, .modal-footer::after, .modal-footer::before, .nav::after, .nav::before, .navbar-collapse::after, .navbar-collapse::before, .navbar-header::after, .navbar-header::before, .navbar::after, .navbar::before, .pager::after, .pager::before, .panel-body::after, .panel-body::before, .row::after, .row::before {
            display: table;
            content: " ";
        }
        .row {
            margin-right: -15px;
            margin-left: -15px;
        }
        .panel {
            margin-bottom: 20px;
            background-color: #fff;
            border: 1px solid transparent;
            border-top-color: transparent;
            border-right-color: transparent;
            border-bottom-color: transparent;
            border-left-color: transparent;
            border-radius: 4px;
            -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
            box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
        }
        .panel-default {
            border-color: #ddd;
        }
        .panel-title {
            margin-top: 0;
            margin-bottom: 0;
            font-size: 16px;
            color: inherit;
        }
        .panel-default > .panel-heading {
            color: #333;
            background-color: #f5f5f5;
            border-color: #ddd;
        }
        .panel-heading {
            padding: 5px 15px;
            border-bottom: 1px solid transparent;
            /*border-bottom-color: transparent;*/
            border-top-left-radius: 3px;
            border-top-right-radius: 3px;
        }
        .panel-heading {
            background-color: #f5f5f5 !important;
            border-color: #ddd !important;
        }
        .panel-body {
            border-color: #ddd !important;
        }
        dt {
            font-weight: 700;
        }

        dd, dt {
            line-height: 1.42857143;
        }

        .invoice {
            width: 700px !important;
            margin: 50px auto;
        }

        .invoice .invoice-header {
            /*background-color: #EEE;*/
            border-color: #EEE !important;
            border-radius: 10px;
            padding: 25px 25px 15px;
            text-align: center;
        }

        .invoice .invoice-header h1 {
            margin: 0;
        }

        .invoice .invoice-header .media .media-body {
            font-size: .9em;
            margin: 0;
        }

        .invoice .invoice-body {
            border-radius: 10px;
            padding: 25px;
            background: #EEE;
        }

        .invoice .invoice-footer {
            padding: 15px;
            font-size: 0.9em;
            text-align: center;
            color: #999;
        }

        .logo {
            max-height: 70px;
            border-radius: 10px;
        }

        .dl-horizontal {
            margin: 0;
        }

        .dl-horizontal dt {
            float: left;
            width: 80px;
            overflow: hidden;
            clear: left;
            text-align: right;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .dl-horizontal dd {
            margin-left: 90px;
        }

        .rowamount {
            padding-top: 15px !important;
        }

        .rowtotal {
            font-size: 1.3em;
        }

        .colfix {
            width: 12%;
        }

        .mono {
            font-family: monospace;
        }
        .tachado{
            text-decoration:line-through;
        }
        .panel-body .nota{
            font-size: 9px !important;
        }
        .panel-header{
            height: 165px;
        }
    </style>
</head>
<body>
<div class="container invoice">
    <div class="invoice-footer">
        Gracias por escojer nuestros servicios.
        <br/> importadores oficiales
        <br/>
    </div>
</div>
</body>
</html>

