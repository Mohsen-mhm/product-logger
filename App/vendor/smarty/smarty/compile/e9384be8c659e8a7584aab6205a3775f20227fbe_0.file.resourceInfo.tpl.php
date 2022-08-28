<?php
/* Smarty version 4.2.0, created on 2022-08-17 11:46:33
  from 'C:\xampp\htdocs\product-logger\App\vendor\smarty\smarty\template\resourceInfo.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.0',
  'unifunc' => 'content_62fcb8f9813c71_24791767',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e9384be8c659e8a7584aab6205a3775f20227fbe' => 
    array (
      0 => 'C:\\xampp\\htdocs\\product-logger\\App\\vendor\\smarty\\smarty\\template\\resourceInfo.tpl',
      1 => 1660729591,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_62fcb8f9813c71_24791767 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="container mt-5">
    <div class="row d-flex justify-content-between">
        <div class="col">
            <h4>Resource Name: <?php echo $_smarty_tpl->tpl_vars['resource_name']->value;?>
</h4>
        </div>
        <div class="col d-flex justify-content-end">
            <a href="./../../index.php" class="btn btn-secondary w-25 ms-2 me-2">Home page</a>
            <a href="./createResourceInfo.php?id=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" class="btn btn-success w-25 ms-2 me-2">Create</a>
        </div>
    </div>
    <div class="row w-100 mt-5">
        <table id="example2" class="display mt-5">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Version</th>
                    <th>DB</th>
                    <th>Congif</th>
                    <th>Necessary</th>
                    <th>Release URL</th>
                    <th>SR</th>
                    <th>CR</th>
                    <th>Edit</th>
                </tr>
            </thead>

            <tfoot>
                <tr>
                    <th>id</th>
                    <th>Version</th>
                    <th>DB Update</th>
                    <th>Congif Update</th>
                    <th>Necessary Update</th>
                    <th>Release URL</th>
                    <th>Server Response</th>
                    <th>Client Response</th>
                    <th>Edit</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<?php echo '<script'; ?>
>
$(document).ready(function () {
    $('#example2').DataTable({
        processing: false,
        serverSide: true,
        ajax: './../dataTableResourceInfo.php',
    }).column(1).search(<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
).draw();
});
<?php echo '</script'; ?>
>
<?php }
}
