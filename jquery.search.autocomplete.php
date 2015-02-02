<?php
if (isset($_GET['term'])) {
    $result = [];
    $result[] = [
        'id' => 1,
        'name' => "Телевизоры",
        'desc' => "Категория телевизоров",
        'icon' => "images/items/1.jpg"
    ];
    $result[] = [
        'id' => 2,
        'name' => "Кондиционеры",
        'desc' => "Категория кондиционеров",
        'icon' => "images/items/2.jpg"
    ];
    $result[] = [
        'id' => 3,
        'name' => "Стиральные машины",
        'desc' => "Категория стиральных машин",
        'icon' => "images/items/3.jpg"
    ];
    $result[] = [
        'id' => 4,
        'name' => "Компьютеры",
        'desc' => "Категория компьютеров",
        'icon' => "images/items/4.jpg"
    ];
    echo json_encode($result);
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Живой поиск</title>
    <script type="text/javascript" src="jquery/jquery-2.1.3.min.js"></script>
    <script type="text/javascript" src="jquery/jquery-ui-1.11.2/jquery-ui.min.js"></script>
    <link rel="stylesheet"  href="jquery/jquery-ui-1.11.2/jquery-ui.min.css" type="text/css" />

    <style type="text/css">

        /* Loader */
        .loader {
            position: absolute;
            top: 6px;
            right: 0px;
            width: 16px;
            height: 16px;
            background: url('images/loader.gif');
        }

        /* Form */
        .form {
            position: relative;
            width: 200px;
        }

        .form input[type=text]{
            width: 100%;
            padding: 5px;
        }

        /* Autocomplete */
        .ui-autocomplete {
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 1000;
            float: left;
            display: none;
            min-width: 160px;
            padding: 4px 0;
            margin: 0 0 10px 25px;
            list-style: none;
            background-color: #ffffff;
            border-color: #ccc;
            border-color: rgba(0, 0, 0, 0.2);
            border-style: solid;
            border-width: 1px;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            -webkit-background-clip: padding-box;
            -moz-background-clip: padding;
            background-clip: padding-box;
            *border-right-width: 2px;
            *border-bottom-width: 2px;
        }

        /* Все элементы */
        .ui-menu .ui-menu-item {
            position: relative;
            margin: 0;
            padding: 5px 1em 5px .4em;
            cursor: pointer;
            min-height: 0; /* support: IE7 */
            /* support: IE10, see #8844 */
            list-style-image: url("data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7");
            background: #fcfcfc;
            border: solid 1px #fcfcfc;
        }

        /* При наведении на элемент */
        .ui-autocomplete .ui-menu-item.ui-state-focus {
            border: solid 1px #efefef;
            font-weight: normal;
            background: #f5f5f5;
        }

        /* Стили элемента */
        ul.ui-autocomplete li.ui-menu-item table {
            width: 100%;
            margin-left: 10px;
        }

        ul.ui-autocomplete li.ui-menu-item table td {
            vertical-align: top;
            padding: 0;
        }

        ul.ui-autocomplete li.ui-menu-item table .icon {
            display: table-cell;
            width: 50px;
        }

        ul.ui-autocomplete li.ui-menu-item table .label {
            display: table-cell;
            padding: 5px 0 0 10px;
            font-size: 100%;
            font-weight: bold;
            color: #5b5b5b;
            text-align: left;
            vertical-align: middle;
        }

        ul.ui-autocomplete li.ui-menu-item table .desc {
            display: table-cell;
            font-size: 80%;
            padding: 0;
            padding-left: 10px;
            color: #9e9e9e;
        }

    </style>
    <script type="text/javascript">
        jQuery(function() {

            var selector = "#product-name";
            var cache = {};
            $(selector).autocomplete({
                source: function( request, response ) {
                    var term = request.term;
                    if ( term in cache ) {
                        response( cache[ term ] );
                        return;
                    }
                    $.getJSON( this.element.data('url'), request, function( data, status, xhr ) {
                        cache[ term ] = data;
                        response( data );
                    });
                },
                select: function(e, ui) {
                    e.preventDefault()
                    $(this).val(ui.item.name);
                },
                delay: 1000,
                minLength: 2
            });

            if ( $(selector).data() ) {

                var ac = $(selector).data('ui-autocomplete');

                if (ac) {
                    ac._renderItem = function(ul, item) {
                        return $( "<li></li>" )
                            .data( "item.autocomplete", item )
                            .append( '<table><tr><td rowspan="2" class="icon"><img src="' + item.icon + '" alt="" /></td><td class="label">' + item.name + '</td></tr><tr><td class="desc">' + item.desc + '</td></tr></table>' )
                            .appendTo( ul );
                    };
                }
            }

            var loader = '<div class="loader"></div>';
            $(document).on({
                ajaxStart: function() {
                    $(selector).after(loader);
                },
                ajaxStop: function() {
                    $(selector).next($(loader)).remove();
                }
            });

        });
    </script>
</head>
<body>

<div class="form">
    <form action="" method="get">
        <input type="text" value="" id="product-name" placeholder="Живой поиск..." data-url="" />
    </form>
</div>


</body>
</html>
