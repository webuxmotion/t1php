<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Очистка кеша
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN?>"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li class="active"><i class="fa fa-shopping-cart"></i> Очистка кеша</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Название</th>
                                <th>Описание</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Языки</td>
                                    <td>Кешируются на 24 час</td>
                                    <td>
                                        <a href="<?=ADMIN;?>/cache/delete?key=lang"><i class="fa text-danger fa-fw js-delete fa-close"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- /.content -->
