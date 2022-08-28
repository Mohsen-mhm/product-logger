<?php
/* Smarty version 4.2.0, created on 2022-08-16 11:52:31
  from 'C:\xampp\htdocs\product-logger\App\vendor\smarty\smarty\template\createResource.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.0',
  'unifunc' => 'content_62fb68df3d3453_76353453',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e65eb9c3a0c8e96db860697e3fc974054070d88e' => 
    array (
      0 => 'C:\\xampp\\htdocs\\product-logger\\App\\vendor\\smarty\\smarty\\template\\createResource.tpl',
      1 => 1660643536,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_62fb68df3d3453_76353453 (Smarty_Internal_Template $_smarty_tpl) {
?><main class="container">
    <form action="" method="post" class="mt-5">

        <div class="form-outline mb-4 row">
            <div class="col">
                <label class="form-label" for="resourceName">Resource Name</label>
                <input type="text" id="resourceName" class="form-control" name="resourceName" required/>
            </div>
            <div class="col">
                <label class="form-label" for="version">Version</label>
                <input type="text" id="version" class="form-control" name="version" required/>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mb-4 mt-2">Create resource</button>
    </form>
</main><?php }
}
