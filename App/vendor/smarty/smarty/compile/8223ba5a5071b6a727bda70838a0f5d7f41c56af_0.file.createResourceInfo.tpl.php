<?php
/* Smarty version 4.2.0, created on 2022-08-21 07:07:24
  from 'C:\xampp\htdocs\product-logger\App\vendor\smarty\smarty\template\createResourceInfo.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.0',
  'unifunc' => 'content_6301bd8c368ca3_20644333',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8223ba5a5071b6a727bda70838a0f5d7f41c56af' => 
    array (
      0 => 'C:\\xampp\\htdocs\\product-logger\\App\\vendor\\smarty\\smarty\\template\\createResourceInfo.tpl',
      1 => 1661058442,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6301bd8c368ca3_20644333 (Smarty_Internal_Template $_smarty_tpl) {
?><main class="container">
    <form action="" method="post" class="mt-5">

        <div class="form-outline mb-4 row">
            <div class="col">
                <label class="form-label" for="version">Version</label>
                <input type="text" id="version" class="form-control" name="version" />
            </div>
        </div>
        <div class="form-outline mb-4 row">
            <div class="col">
                <label class="form-label" for="changeLog">Change log</label>
                <textarea id="changeLog" class="form-control" name="changeLog" rows="5"></textarea>
            </div>
            <div class="col mt-5">
                <div class="row">
                    <div class="col">
                        <div class="form-check">
                            <input type="checkbox" value="1" id="DBupdate" class="form-check-input" name="DBupdate" />
                            <label class="form-check-label" for="DBupdate">DB Update</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" value="1" id="configUpdate" class="form-check-input"
                                name="configUpdate" />
                            <label class="form-check-label" for="configUpdate">Config Update</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" value="1" id="necessaryUpdate" class="form-check-input"
                                name="necessaryUpdate" />
                            <label class="form-check-label" for="necessaryUpdate">Necessary Update</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input type="checkbox" value="1" id="serverResponse" class="form-check-input"
                                name="serverResponse" />
                            <label class="form-check-label" for="serverResponse">Server Response</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" value="1" id="clientResponse" class="form-check-input"
                                name="clientResponse" />
                            <label class="form-check-label" for="clientResponse">Client Response</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-outline mb-4 row">
            <div class="col">
                <label class="form-label" for="realseURL">Realse URL</label>
                <input type="text" id="realseURL" class="form-control" name="realseURL" />
            </div>
        </div>
        <div class="form-outline mb-4 row">
            <div class="col">
                <label class="form-label" for="serverResponseTireOne">Server response tire one</label>
                <textarea id="serverResponseTireOne" class="form-control" name="serverResponseTireOne"
                    rows="5"></textarea>
            </div>
            <div class="col">
                <label class="form-label" for="serverResponseTireTwo">Server response tire two</label>
                <textarea id="serverResponseTireTwo" class="form-control" name="serverResponseTireTwo"
                    rows="5"></textarea>
            </div>
        </div>
        <div class="form-outline mb-4 row">
            <div class="col">
                <label class="form-label" for="clientResponseTireOne">Client response tire one</label>
                <textarea id="clientResponseTireOne" class="form-control" name="clientResponseTireOne"
                    rows="5"></textarea>
            </div>
            <div class="col">
                <label class="form-label" for="clientResponseTireTwo">Client response tire two</label>
                <textarea id="clientResponseTireTwo" class="form-control" name="clientResponseTireTwo"
                    rows="5"></textarea>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mb-4 mt-2">Create resource</button>
    </form>
</main><?php }
}
