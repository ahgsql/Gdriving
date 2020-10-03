<!DOCTYPE html>
<html>
<?php $this->load->view("ortak/head") ?>
<body style="background-color: #f1f2f6;">



    <div class="col-md-12">
        <nav class="navbar navbar-default" role="navigation">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Bootflat</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Link</a></li>
                        <!-- <li class="disabled"><a href="#">Link</a></li> -->
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                            <ul class="dropdown-menu" role="menu">
                                <li class="dropdown-header">Setting</li>
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li class="divider"></li>
                                <li class="active"><a href="#">Separated link</a></li>
                                <li class="divider"></li>
                                <li class="disabled"><a href="#">One more separated link</a></li>
                            </ul>
                        </li>
                    </ul>
                    <form class="navbar-form navbar-right" role="search">
                        <div class="form-search search-only">
                            <i class="search-icon glyphicon glyphicon-search"></i>
                            <input type="text" class="form-control search-query">
                        </div>
                    </form>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
    </div>

<div class="col-md-3"></div>
<div class="col-md-6">
    <div class="panel panel-primary">
        <div class="panel-heading">Avukatlar</div>
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>İsim</th>
                <th>Cep Telefonu</th>
                <th>Şehir</th>
            </tr>
            </thead>
            <tbody>

            <tr>
                <td>3</td>
                <td>Larry</td>
                <td>the Bird</td>
                <td>@twitter</td>
            </tr>
            </tbody>
        </table>
    </div>

</div>
<!--footer-->


</body>
