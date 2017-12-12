
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <?php
                        //echo $this->Form->create(null, array('type' => 'POST',
                        echo $this->Form->create('Domain',
                            array('type' => 'POST',
                                'url' => array('controller' => 'DomainNsLookup', 'action' => 'index'),
                                'id' => "id_domain_ns_lookup",
                                'name' => "id_domain_ns_lookup",
                                'class' => 'storage_form form-horizontal',
                                'role' => 'form',
                                'div' => false,

                            )
                        );
                    ?>

                    <input type="text" name="domain" id="submit_domain_ns_lookup" class="dm_name"
                           value="<?php echo $domain; ?>"/>

                    <?php
                        echo $this->Form->end();
                    ?>

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
                                        <tr style="font-weight: 600;"
                                        ">
                                        <td style="width: 50px;"> STT</td>
                                        <td> Giá Trị</td>
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
                                    <tr style="font-weight: 600;"
                                    ">
                                    <td style="width: 50px;"> STT</td>
                                    <td> Giá Trị</td>
                                    </tr>
                                    <?php foreach ($ipv4 as $key => $value) { ?>
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
                                    <tr style="font-weight: 600;"
                                    ">
                                    <td style="width: 50px;"> STT</td>
                                    <td> Giá Trị</td>
                                    </tr>
                                    <?php foreach ($ipv6 as $key => $value) { ?>
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
                                    <tr style="font-weight: 600;"
                                    ">
                                    <td style="width: 50px;"> Code</td>
                                    <td> Giá Trị</td>
                                    </tr>
                                    <?php foreach ($cname as $key => $value) { ?>
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
                                    <tr style="font-weight: 600;"
                                    ">
                                    <td style="width: 50px;"> Code</td>
                                    <td> Giá Trị</td>
                                    </tr>
                                    <?php if (count($mx) && !isset($mx[0])) {
                                    foreach ($mx as $key => $value) { ?>
                                        <tr>
                                            <td><?php echo $key; ?></td>
                                            <td><?php echo $value; ?></td>
                                        </tr>
                                    <?php } } else { ?>
                                    <?php
                                    foreach ($mx[0] as $key => $value) { ?>
                                    <tr>
                                        <td><?php echo $key; ?></td>
                                        <td><?php echo $value; ?></td>
                                    </tr>
                                    <?php } } ?>
                                </table>
                            </div>
                            <div id="NS" class="tab-pane fade">
                                <h3>NS</h3>
                                <table class="table">
                                    <tr style="font-weight: 600;"
                                    ">
                                    <td style="width: 50px;"> STT</td>
                                    <td> Giá Trị</td>
                                    </tr>
                                    <?php foreach ($ns as $key => $value) { ?>
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
                                    <tr style="font-weight: 600;"
                                    ">
                                    <td style="width: 50px;"> Code</td>
                                    <td> Giá Trị</td>
                                    </tr>
                                    <?php foreach ($soa as $key => $value) { ?>
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
                                    <tr style="font-weight: 600;"
                                    ">
                                    <td style="width: 50px;"> Code</td>
                                    <td> Giá Trị</td>
                                    </tr>
                                    <?php foreach ($srv as $key => $value) { ?>
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
                                    <tr style="font-weight: 600;"
                                    ">
                                    <td style="width: 50px;"> Code</td>
                                    <td> Giá Trị</td>
                                    </tr>
                                    <?php foreach ($txt as $key => $value) { ?>
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

        <!-- HERE IS THE SELECT FILTER -->
        <script type="text/javascript">
            $(document).ready(function() {
                $('#submit_domain_ns_lookup').keydown(function() {
                    var key = e.which;
                    if (key == 13) {

                        $('#id_domain_ns_lookup').submit();
                        return false;
                    }
                });
            });

            $("#submit_domain_ns_lookup").on("click", function() {
                $(this).val("");
            });
        </script>

        <style type="text/css">
            input.dm_name {
                display: block;
                padding: 15px 30px;
                border-radius: 10px;
                background-color: #0060af;
                color: #fff;
                margin: 20px auto;
                font-weight: 600;
                font-size: 18px;
                border: none;
                width: 80%;
                outline: none !important;
            }

            .content a {
                color: #000;
                text-decoration: none;
            }

            .content {
                font-size: 17px;
                background-color: #f3f3f3;
            }

            .content .row {
                margin-top: 10px;
                margin-bottom: 30px;
                padding-bottom: 60px;
                background-color: #fff;
            }

            .dm_attr li {
                border: solid 1px #0060af;
                border-radius: 4px;
                text-align: center;
                margin-top: 5px;
            }

            .dm_attr li a {
                padding: 8px 39px;
                font-size: 18px;
            }

            .dm_attr td {
                border: solid 1px #2a363f !important;
            }
        </style>