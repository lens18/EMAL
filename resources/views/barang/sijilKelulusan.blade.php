
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">
    <!--title>Sales Invoice</title-->
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<style>

    @font-face {
        font-family: 'notosansSC';
        font-style: normal;
        font-weight: normal;
        src: url('/fonts/NotoSansSC-Regular.otf') format('truetype');
    }

    .notosansSC{
        font-family: 'notosansSC';
    }

    h4.title{
        margin-bottom:0;
        font-size: 19px
    }

    h5.titleName{
        margin-bottom:0;
        font-size: 50px;
        font-weight: bold
    }

    p.text1{
        font-size: 18.5px
    }

    p.text2{
        font-size: 19.5px
    }

    p.text3{
        font-size: 17.5px
    }

    p{
        margin-bottom: 0;
        word-break: break-all;
    }

    .footer {
        font-size: 12px;
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        text-align: center;
    }

    .td-13{
    width: 13%;
    }

    .td-37{
    width: 37%;
    }
    .td-20{
        width: 20%;
    }
    .td-30{
        width: 30%;
    }
    .td-40{
        width: 40%;
    }
    .td-50{
        width: 50%;
    }
    .td-60{
        width: 60%;
    }
    .td-70{
        width: 70%;
    }
    .td-80{
        width: 80%;
    }
    .td-100{
        width: 100%;
    }

    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{
        border-top: none;
        padding: 3px;
    }

    .bg-grey{
        background: #DCDCDC;
        border-radius: 5px;
        padding: 10px
    }

    @page
    {
        size: auto;   /* auto is the initial value */
        margin: 0mm;  /* this affects the margin in the printer settings */
    }
</style>
<body>
    <div class="container">
        <table class="table table-borderless" style="margin-bottom:0">
            <tr class="tbody">
                <td class="td-20"></td>
                <td class="td-40" style="margin: auto; text-align: center;">
                    <img src="/img/Jata Negara.jpg" alt="">
                </td>
                <td class="td-20"></td>
            </tr>
        </table>

        <table class="table table-borderless" style="margin-bottom:0">
            <tr class="tbody">
                <td class="td-20">
                </td>
                <td class="td-40" style="margin: auto; text-align: center;">
                    <h4 class="title">CAWANGAN KEJURUTERAAN ELEKTRIK <br>
                        JABATAN KERJA RAYA MALAYSIA
                    </h4>
                </td>
                <td class="td-20"></td>
            </tr>
        </table>

        <table class="table table-borderless" >
            <tr class="tbody">
                <td class="td-20">
                </td>
                <td class="td-40" style="margin: auto; text-align: center;">
                    <h5 class="titleName">SIJIL EMAL</h5>
                </td>
                <td class="td-20"></td>
            </tr>
        </table>

        <table class="table table-borderless" style="margin-bottom:10">
            <tr class="tbody">
                <td>
                    <p class=text1>Sijil Pendaftaran Bahan/Barangan Elektrik (Electrical Material Approved List) ini dikeluarkan kepada pengilang/pembekal :</p>
                </td>
            </tr>
        </table>

        <table class="table table-borderless" style="margin-bottom:10">
            <tr class="tbody">
                <td>
                    <p class=text2>Syarikat : <strong>{{$user->namaSyarikat}}</strong></p>
                    <p class=text1>Alamat : {{$material->alamatPengilang}}</p>
                </td>
            </tr>
        </table>

        <table class="table table-borderless" style="margin-bottom:10">
            <tr class="tbody">
                <td>
                    <p class=text1>Bahan: <strong>{{$material->materialCategori->name ?? '' }}</strong></p>
                </td>
            </tr>
        </table>

        <table class="table table-borderless" style="margin-bottom:10">
            <tr class="tbody">
                <td>
                    <p class=text1>Pendaftaran ini adalah seperti butiran di bawah dan tertakluk kepada Spesifikasi JKR dan <b>syarat-syarat di muka surat 2.</b> <br>
                        Sijil ini hendaklah dibaca bersama <b>Lampiran</b> (3 muka surat).</p>
                </td>
            </tr>
        </table>

        <div style="padding-left:5px">
             <table class="table table-borderless bg-grey">
                <tr class="tbody">
                    <td class="td-13">
                        <p class=text3>Pengilang : </p>
                    </td>
                    <td class="td-37">
                        <p class=text3>{{$material->namaPengilang}} </p>
                    </td>
                </tr>
                <tr class="tbody">
                    <td class="td-13">
                        <p class=text3>Negara Pengilang : </p>
                    </td>
                    <td class="td-37">
                        <p class=text3>{{$material->negaraPengilang}} </p>
                    </td>
                </tr>
                <tr class="tbody">
                    <td class="td-13">
                        <p class=text3>Jenama : </p>
                    </td>
                    <td class="td-37">
                        <p class=text3>{{$material->jenama}} </p>
                    </td>
                </tr>
                <tr class="tbody">
                    <td class="td-13">
                        <p class=text3>Model : </p>
                    </td>
                    <td class="td-37">
                        <p class=text3>{{$material->model}} </p>
                    </td>
                </tr>
                <tr class="tbody">
                    <td class="td-13">
                        <p class=text3>Kadaran : </p>
                    </td>
                    <td class="td-37">
                        <p class=text3>{{$material->ratedVoltage}} & {{$material->coreNo}} </p>
                    </td>
                </tr>
            </table>
        </div>

        <div class="footer">
        <table class="table table-borderless" style="margin-bottom:0">
            <tr class="tbody">
                <td style="margin: auto; text-align: center;">
                    <p class=text4>Cawangan Kejuruteraan Elektrik Ibu Pejabat JKR Malaysia, Aras 11, Menara Kerja Raya (Blok G), Jalan Sultan Salahuddin, 50480 Kuala Lumpur.  <br>
                        Tel : 03-2618 9958   Faks : 03-2618 9844   Laman Web : http://www.jkr.gov.my    Email: adminEMAL@jkr.gov.my
                    </p>
                </td>
            </tr>
        </table>
        </div>
    </div>
</body>
</html>
