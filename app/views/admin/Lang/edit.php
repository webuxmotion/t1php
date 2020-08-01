<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Редактирование языка
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN?>"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="<?=ADMIN?>/lang"><i class="fa fa-language"></i> Список языков</a></li>
        <li class="active"><i class="fa fa-edit"></i> Редактирование языка</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <form action="<?=ADMIN?>/lang/edit" method="POST" data-toggle="validator">
                    <div class="box-body">
                        <div class="form-group">
                          <label for="name">Name</label>
                          <input
                            type="text"
                            class="form-control"
                            name="name"
                            id="name"
                            value="<?=h($page_lang['name']);?>"
                            required
                          >
                          <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group">
                          <label for="name">Code</label>
                          <input
                            type="text"
                            class="form-control"
                            name="code"
                            id="code"
                            value="<?=h($page_lang['code']);?>"
                            required
                          >
                          <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        
                    </div>
                    <div class="box-footer">
                        <input type="hidden" name="id" value="<?=$page_lang['id']?>">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>

            </div>

            
        </div>
    </div>
</section>
<!-- /.content -->
