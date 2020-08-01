<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Список языков - <a href="<?=ADMIN;?>/lang/add" class="btn btn-primary">Добавить язык</a>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN;?>"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li class="active">Список языков</li>
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
                                <th>ID</th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($langs as $lang): ?>
                                <tr>
                                    <td><?=$lang->id;?></td>
                                    <td><?=$lang->code;?></td>
                                    <td><?=$lang->name;?></td>
                                    <td>
                                        <a href="<?=ADMIN;?>/lang/edit?id=<?=$lang->id;?>"><i class="fa fa-fw fa-pencil"></i></a>
                                        <a class="delete js-delete" href="<?=ADMIN;?>/lang/delete?id=<?=$lang->id;?>"><i class="fa fa-fw fa-close text-danger"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- /.content -->
