<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="#" type="image/x-icon">

    <title>{{ getenv('WEBSITE_NAME') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200;300;400;600;700;800;900&display=swap"
        rel="stylesheet">

    <style type="text/css">
        body {
            text-align: center;
            margin: 0 auto;
            width: 650px;
            font-family: 'Public Sans', sans-serif;
            background-color: #e2e2e2;
            display: block;
        }

        ul {
            margin: 0;
            padding: 0;
        }

        li {
            display: inline-block;
            text-decoration: unset;
        }

        a {
            text-decoration: none;
        }

        .theme-color {
            color: #0DA487;
        }

        .text-center {
            text-align: center
        }

        .header-table {
            padding: 10px 0;
            background-color: #F7F7F7;
        }

        .header .header-logo a {
            display: block;
            margin: 0;
            text-align: center;
        }

        .product-table thead tr th {
            padding: 0;
            padding-bottom: 13px;
            border-bottom: 1px solid rgba(217, 217, 217, 0.5);
            font-size: 17px;
            font-weight: 600;
        }

        .product-table thead tr th:first-child {
            text-align: left;
        }

        .product-table thead tr th:nth-child(n+2) {
            text-align: right;
        }

        .product-table tbody tr td {
            padding: 11px 0;
            border-bottom: 1px solid rgba(217, 217, 217, 0.5);
        }

        .product-table tbody tr td:first-child {
            padding-left: 23px;
        }

        .product-table tbody tr:last-child td {
            border-bottom: none;
        }

        .product-table tbody tr td:nth-child(n+2) {
            text-align: right;
        }

        .product-table tbody tr td .product-detail h5 {
            margin: 0;
            font-size: 15px;
            font-weight: 600;
            margin-left: 19px;
            color: #222222;
        }

        .product-table tbody tr td h5 {
            margin: 0;
            font-size: 15px;
            font-weight: 600;
        }

        .product-table tbody tr td h5 span {
            color: #939393;
        }

        .product-table tbody tr td .product-detail {
            display: flex;
            align-items: center;
        }

        .checkout-button {
            margin: 35px 0;
            font-size: 20px;
            font-weight: 700;
            padding: 14px 30px;
            border: none;
            border-radius: 6px;
            background-color: #0DA487;
            color: #fff;
            display: inline-block;
        }

        .footer-table {
            position: relative;
        }

        .footer-table::before {
            position: absolute;
            content: "";
            background-image: url(images/footer-left.svg);
            background-position: top right;
            top: 0;
            left: -71%;
            width: 100%;
            height: 100%;
            background-repeat: no-repeat;
            z-index: -1;
            background-size: contain;
            opacity: 0.3;
        }

        .footer-table::after {
            position: absolute;
            content: "";
            background-image: url(images/footer-right.svg);
            background-position: top right;
            top: 0;
            right: 0;
            width: 100%;
            height: 100%;
            background-repeat: no-repeat;
            z-index: -1;
            background-size: contain;
            opacity: 0.3;
        }
    </style>
</head>

<body style="margin: 20px auto;">
    <table align="center" border="1" cellpadding="0" cellspacing="0"
        style="background-color: white; box-shadow: 0px 0px 14px -4px rgba(0, 0, 0, 0.2705882353);">
        <table align="center" border="0" cellpadding="0" cellspacing="0"
            style="background-color: white; width: 100%; box-shadow: 0px 0px 14px -4px rgba(0, 0, 0, 0.2705882353);">
            <tbody>
                <tr>
                    <td>
                        <table class="content-table" style="margin-top: 28px;" align="center" cellpadding="0"
                            cellspacing="0" width="100%">
                            <tbody>
                                <tr class="content-tr text-center">
                                    <td style="display: block;">
                                        <h3
                                            style="font-size: 21px; font-weight: 700; text-transform: capitalize; margin: 0;color: black;">
                                            Order-Invoice</h3>
                                        <p style="font-size: 16px; font-weight: 500; color: #417394; margin: 15px 0 0;">
                                            We have send you the invoice of you Order-No: {{$order_no}}</p>
                                        <p>We are pleased to attach the invoice for your recent order. Please find the
                                            attached invoice PDF for your reference.</p>

                                        <p>If you have any questions or concerns regarding this invoice, please feel
                                            free to contact our support team.</p>

                                        <p>Thank you for choosing our services!</p>
                                        <p>Best regards,<br>
                                    </td>
                                </tr>
                            </tbody>
                        </table>


                    </td>
                </tr>
            </tbody>
        </table>
        <table class="text-center footer-table" align="center" border="0" cellpadding="0" cellspacing="0"
            width="100%"
            style="background-color: #282834; color: white; padding: 24px; overflow: hidden; z-index: 0;">
            <tr>
                <td>
                    <table border="0" cellpadding="0" cellspacing="0" class="footer-social-icon text-center"
                        align="center" style="margin: 8px auto 20px;">
                        <tr>
                            <td style="font-size: 19px; font-weight: 700;">Shop For <span class="theme-color"
                                    style="color: #417394;">{{ getenv('WEBSITE_NAME') }}</span></td>
                        </tr>
                    </table>
                 
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td>
                                <h5
                                    style="font-size: 13px; text-transform: uppercase; margin: 10px 0 0; color:#ddd;
                                letter-spacing:1px; font-weight: 500;">
                                    2023-24 copy right by {{ getenv('WEBSITE_NAME') }}
                                </h5>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </table>
</body>

</html>
