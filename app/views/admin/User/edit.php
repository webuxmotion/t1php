<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Редактирование пользователя
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN?>"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="<?=ADMIN?>/user"><i class="fa fa-dashboard"></i> Список пользователей</a></li>
        <li class="active"><i class="fa fa-shopping-cart"></i> Редактирование пользователя</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <form action="<?=ADMIN?>/user/edit" method="POST" data-toggle="validator">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="login">Login</label>
                            <input
                                type="text"
                                class="form-control"
                                name="login"
                                id="login"
                                value="<?=h($user['login']);?>"
                                required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input
                                type="password"
                                class="form-control"
                                name="password"
                                id="password"
                                placeholder="Введите пароль, если хотите его изменить">
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input
                                type="text"
                                class="form-control"
                                name="name"
                                id="name"
                                value="<?=h($user['name']);?>"
                                required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group">
                            <label for="name">Email</label>
                            <input
                                type="email"
                                class="form-control"
                                name="email"
                                id="email"
                                value="<?=h($user['email']);?>"
                                required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group">
                            <label for="name">Address</label>
                            <input
                                type="text"
                                class="form-control"
                                name="address"
                                id="address"
                                value="<?=h($user['address']);?>"
                                required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <select name="role" id="role" class="form-control">
                                <option value="user" <?php if ($user['role'] == 'user') echo 'selected';?>>User</option>
                                <option value="admin" <?php if ($user['role'] == 'admin') echo 'selected';?>>Admin</option>
                            </select>
                        </div>
                    </div>
                    <div class="box-footer">
                        <input type="hidden" name="id" value="<?=$user['id']?>">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>

            </div>

            
        </div>
    </div>
</section>
<!-- /.content -->
