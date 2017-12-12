    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <input type="text" name="domain" class="dm_name" value="<?php echo $domain; ?>">
                    <div class="dm_attr" style="margin: 10px;">
                        <ul class="nav nav-pills" style="padding-left:15px">
                            <li class="active"><a data-toggle="pill" href="#lookup">Lookup</a></li>
                            <li><a data-toggle="pill" href="#IPv4">IPv4</a></li>
                            <li><a data-toggle="pill" href="#IPv6">IPv6</a></li>
                            <li><a data-toggle="pill" href="#CNAME">CNAME</a></li>
                            <li><a data-toggle="pill" href="#MX">MX</a></li>
                            <li><a data-toggle="pill" href="#NS">NS</a></li>
                            <li><a data-toggle="pill" href="#SOA">SOA</a></li>
                            <li><a data-toggle="pill" href="#SRV">SRV</a></li>
                            <li><a data-toggle="pill" href="#TXT">TXT</a></li>
                        </ul>
                        <div class="tab-content" style="padding: 20px;">
                            <div id="lookup" class="tab-pane fade in active">
                                <div class="table-responsive">
                                    <h3>Lookup</h3>
                                    <table class="table">
                                        <tr style="font-weight: 600;"">
                                            <td style="width: 50px;"> STT </td>
                                            <td>  Giá Trị </td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td><?php echo $lookup; ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div id="IPv4" class="tab-pane fade">
                               <h3>IPv4</h3>
                               <table class="table">
                                <tr style="font-weight: 600;"">
                                    <td style="width: 50px;"> STT </td>
                                    <td>  Giá Trị </td>
                                </tr>
                                <?php foreach ($ipv4 as $key => $value) {?>
                                <tr>
                                    <td><?php echo $key + 1; ?></td>
                                    <td><?php echo $value; ?></td>
                                </tr>
                                <?php } ?>
                            </table>

                        </div>
                        <div id="IPv6" class="tab-pane fade">
                            <h3>IPv6</h3>
                            <table class="table">
                                <tr style="font-weight: 600;"">
                                    <td style="width: 50px;"> STT </td>
                                    <td>  Giá Trị </td>
                                </tr>
                                <?php foreach ($ipv6 as $key => $value) {?>
                                <tr>
                                    <td><?php echo $key + 1; ?></td>
                                    <td><?php echo $value; ?></td>
                                </tr>
                                <?php } ?>
                            </table>
                        </div>
                        <div id="CNAME" class="tab-pane fade">
                            <h3>CNAME</h3>
                            <table class="table">
                                <tr style="font-weight: 600;"">
                                    <td style="width: 50px;"> Code </td>
                                    <td>  Giá Trị </td>
                                </tr>
                                <?php foreach ($cname as $key => $value) {?>
                                <tr>
                                    <td><?php echo $key; ?></td>
                                    <td><?php echo $value; ?></td>
                                </tr>
                                <?php } ?>
                            </table>
                        </div>
                        <div id="MX" class="tab-pane fade">
                            <h3>MX</h3>
                            <table class="table">
                                <tr style="font-weight: 600;"">
                                    <td style="width: 50px;"> Code </td>
                                    <td>  Giá Trị </td>
                                </tr>
                                <?php foreach ($mx[0] as $key => $value) {?>
                                <tr>
                                    <td><?php echo $key; ?></td>
                                    <td><?php echo $value; ?></td>
                                </tr>
                                <?php } ?>
                            </table>
                        </div>
                        <div id="NS" class="tab-pane fade">
                            <h3>NS</h3>
                            <table class="table">
                                <tr style="font-weight: 600;"">
                                    <td style="width: 50px;"> STT </td>
                                    <td>  Giá Trị </td>
                                </tr>
                                <?php foreach ($ns as $key => $value) {?>
                                <tr>
                                    <td><?php echo $key + 1; ?></td>
                                    <td><?php echo $value; ?></td>
                                </tr>
                                <?php } ?>
                            </table>
                        </div>
                        <div id="SOA" class="tab-pane fade">
                            <h3>SOA</h3>
                            <table class="table">
                                <tr style="font-weight: 600;"">
                                    <td style="width: 50px;"> Code </td>
                                    <td>  Giá Trị </td>
                                </tr>
                                <?php foreach ($soa as $key => $value) {?>
                                <tr>
                                    <td><?php echo $key; ?></td>
                                    <td><?php echo $value; ?></td>
                                </tr>
                                <?php } ?>
                            </table>
                        </div>
                        <div id="SRV" class="tab-pane fade">
                            <h3>SRV</h3>
                            <table class="table">
                                <tr style="font-weight: 600;"">
                                    <td style="width: 50px;"> Code </td>
                                    <td>  Giá Trị </td>
                                </tr>
                                <?php foreach ($srv as $key => $value) {?>
                                <tr>
                                    <td><?php echo $key; ?></td>
                                    <td><?php echo $value; ?></td>
                                </tr>
                                <?php } ?>
                            </table>
                        </div>
                        <div id="TXT" class="tab-pane fade">
                            <h3>TXT</h3>
                            <table class="table">
                                <tr style="font-weight: 600;"">
                                    <td style="width: 50px;"> Code </td>
                                    <td>  Giá Trị </td>
                                </tr>
                                <?php foreach ($txt as $key => $value) {?>
                                <tr>
                                    <td><?php echo $key; ?></td>
                                    <td><?php echo $value; ?></td>
                                </tr>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $('input[role="reg_from"], input[role="reg_to"], input[role="exp_to"], input[role="exp_from"]').datepicker({ dateFormat: 'dd-mm-yy' });

    $('img[role="reg_from"]').on('click',function(){
        $('input[role="reg_from"]').datepicker('show');
    });

    $('button[role=btn-seach]').on('click', function(event) {
        $('#search').slideToggle();
    });

    $('img[role="reg_to"]').on('click',function(){
        $('input[role="reg_to"]').datepicker('show');
    });

    $('img[role="reg_to"]').on('click',function(){
        $('input[role="reg_to"]').datepicker('show');
    });

    $('img[role="exp_from"]').on('click',function(){
        $('input[role="exp_from"]').datepicker('show');
    });

    $('img[role="exp_to"]').on('click',function(){
        $('input[role="exp_to"]').datepicker('show');
    });

    $('#clear_reg').on('click',function(){
        $('input[role="reg_from"],input[role="reg_to"]').val('');
    });

    $('#clear_exp').on('click',function(){
        $('input[role="exp_to"],input[role="exp_from"]').val('');
    });

</script>

<style type="text/css">
input.dm_name{
    display: block;
    padding:15px 30px;
    border-radius: 10px;
    background-color: #0060af;
    color: #fff;
    margin: 20px auto;
    font-weight: 600;
    font-size: 18px;
    border:none;
    width: 80%;
    outline: none !important;
}
.content a{
    color: #000;
    text-decoration: none;
}
.content{
    font-size: 17px;
    background-color: #f3f3f3;
}
.content .row{
    margin-top: 10px;
    margin-bottom: 30px;
    padding-bottom: 60px;
    background-color: #fff;
}
.dm_attr li{
    border:solid 1px #0060af;
    border-radius: 4px;
    text-align: center;
    margin-top: 5px;
}
.dm_attr li a{
    padding: 8px 39px;
    font-size: 18px;
}
.dm_attr td{
    border:solid 1px #2a363f !important;
}
</style>