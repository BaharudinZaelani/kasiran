<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasiran</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="<?= BASE; ?>/assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="icon" type="<?= BASE; ?>/image/png" href="<?= LOGO_WEB; ?>"/>
    <style>
        a {
            text-decoration: none;
        }
        .primary {
            color: white !important;
        }
        .card button {
            background-color: <?= BG_COLOR_SECOND; ?>;
            font-weight: bold;
        }
        .container {
            display: grid;
            grid-template-columns: 1fr 85vw;
            height: 100%;
        }

        /* sidebar */
        .col-sidebar {
            background-color: <?= BG_COLOR_SECOND; ?>;
            color: <?= SIDE_COLOR; ?> !important;
            position: relative;
        }
        .side-body {
            margin: 12px 0;
            height: 80vh;
            overflow: auto;
        }
        .side-header {
            width: 100%;
            height: 50px;
            display: grid;
            justify-content: center;
            align-items: center;
        }
        .side-footer {
            position: absolute;
            bottom: 0;
            right: 0;
            left: 0;
            height: 50px;
            background-color: <?= BG_COLOR; ?>;
            display: grid;
            align-items: center;
            justify-content: center;
        }
        .side-body .list-nav {
            padding: 0 8px;
            height: 100%;
        }
        .side-body .list-nav ul {
            list-style: none;
        }
        .side-body .list-nav ul .list-item {
            margin-bottom: 12px;
        }
        .sub-nav a {
            color: <?= SIDE_COLOR; ?> !important;
        }
        .side-body .list-nav ul .list-item .title{
            color: <?= SIDE_COLOR; ?> !important;
            border: none;
            display: grid;
            align-items: center;
            grid-template-columns: 15% auto;
            cursor: pointer;
            padding: 0;
            margin: 0;
            padding: 12px;
            background-color: <?= BG_COLOR_THIRD; ?>;
        }
        .hide {
            height: 0px !important;
            overflow: hidden !important;
        }
        .side-body .list-nav ul .list-item .sub-nav {
            height: 150px;
            overflow: hidden;
            background-color: <?= BG_COLOR; ?>;
            padding: 4px;
        }
        .side-body .list-nav ul .list-item .sub-nav li:hover {
            cursor: pointer;
            background-color: <?= BG_COLOR_SECOND; ?> !important;
        }
        .side-body .list-nav ul .list-item .sub-nav li {
            padding: 12px;
        }
        .side-body .list-nav ul .list-item .sub-nav li a{
            display: block;
            height: 100%;
            width: 100%;
        }

        /* content */
        .col-content .navbar {
            border-left: 1px solid <?= BG_COLOR_SECOND; ?>;
            height: 50px;
            background-color: <?= BG_COLOR; ?>;
        }
        .col-content .content {
            padding: 12px;
        }

        /* dropdown */
        .nav-dropdown {
            display: none;
        }
        .navbar {
            padding: 0 7px;
            display: grid;
            grid-template-columns: 1fr auto;
            justify-items: end;
            align-items: center;
        }
        .navbar .head {
            color: #fff;
        }
        .navbar .user {
            padding: 0 12px;
            height: 100%;
            display: grid;
            justify-content: center;
            align-items: center;
        }
        .navbar .user:hover {
            background-color: <?= BG_COLOR_FOURTH; ?>;
        }
        .head {
            display: grid;
            grid-template-columns: 1fr auto;
            align-items: center;
            grid-gap: 12px;
        }
        .username {
            margin-top: -4px;
        }
        #nav-dropdown {
            position: relative;
        }
        .sub-navbar {
            z-index: 999;
            box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
            position: absolute;
            top: 50px;
            background-color: <?= BG_COLOR_SECOND; ?>;
            width: 380px;
            right: 0;
        }
        .sub-navbar button {
            text-align: left;
            background-color: <?= BG_COLOR; ?>;
            margin: 4px 0;
            color: #fff;
            border: none;
            padding: 12px;
            cursor: pointer;
        }
        .navbar-footer {
            display: grid;
            grid-template-columns: 1fr auto;
            justify-content: end;
            align-items: center;
            padding: 0 12px;
            height: 50px;
            background-color: <?= BG_COLOR; ?>;
        }
        .navbar-footer button, .navbar-footer a {
            border-radius: 5px;
            padding: 5px 12px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .sub-navbar-header {
            padding: 12px 0;
        }
        .sub-navbar-title {
            display: grid;
            justify-content: center;
            align-items: center;
            grid-gap: 12px;
        }
        .sub-nav-title {
            text-align: center;
            width: 100%;
            color: #fff;
        }
        .avatar {
            justify-content: center;
            display: grid;
        }
    </style>
</head>
<body>
    <!-- wrp -->
    <div class="wrp">