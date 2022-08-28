<?php
/* Smarty version 4.2.0, created on 2022-08-15 10:24:31
  from 'C:\xampp\htdocs\product-logger\App\vendor\smarty\smarty\template\login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.0',
  'unifunc' => 'content_62fa02bf4cd670_40978858',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5490268fc74944ff26694ad5199b0dd43e59c963' => 
    array (
      0 => 'C:\\xampp\\htdocs\\product-logger\\App\\vendor\\smarty\\smarty\\template\\login.tpl',
      1 => 1660551863,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_62fa02bf4cd670_40978858 (Smarty_Internal_Template $_smarty_tpl) {
?><main class="container">
    <form action="" method="post" class="mt-5">

        <div class="form-outline mb-4">
            <label class="form-label" for="username">Username</label>
            <input type="username" id="username" class="form-control" name="username" />
        </div>
        <div class="form-outline mb-4">
            <label class="form-label" for="password">Password</label>
            <input type="password" id="password" class="form-control" name="password" />
        </div>

        <button type="submit" class="btn btn-primary btn-block mb-4 mt-2">Sign in</button>
    </form>
</main><?php }
}
