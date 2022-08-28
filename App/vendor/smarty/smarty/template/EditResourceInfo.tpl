<main class="container">
    <form action="" method="post" class="mt-5">

        <div class="form-outline mb-4 row">
            <div class="col">
                <label class="form-label" for="resourceName">Resource Name</label>
                <input type="text" id="resourceName" class="form-control" name="resourceName" value="{$resourceName}"/>
            </div>
            <div class="col">
                <label class="form-label" for="version">Version</label>
                <input type="text" id="version" class="form-control" name="version" value="{$version}"/>
            </div>
        </div>
        <div class="form-outline mb-4 row">
            <div class="col">
                <label class="form-label" for="changeLog">Change log</label>
                <textarea id="changeLog" class="form-control" name="changeLog" rows="5">{$change_log}</textarea>
            </div>
            <div class="col mt-5">
                <div class="row">
                    <div class="col">
                        <div class="form-check">
                            <input type="checkbox" value="1" id="DBupdate" class="form-check-input" name="DBupdate" {$dbChecked}/>
                            <label class="form-check-label" for="DBupdate">DB Update</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" value="1" id="configUpdate" class="form-check-input"
                                name="configUpdate" {$congifChecked}/>
                            <label class="form-check-label" for="configUpdate">Config Update</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" value="1" id="necessaryUpdate" class="form-check-input"
                                name="necessaryUpdate" {$necessaryChecked}/>
                            <label class="form-check-label" for="necessaryUpdate">Necessary Update</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input type="checkbox" value="1" id="serverResponse" class="form-check-input"
                                name="serverResponse" {$serverChecked}/>
                            <label class="form-check-label" for="serverResponse">Server Response</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" value="1" id="clientResponse" class="form-check-input"
                                name="clientResponse" {$clientChecked}/>
                            <label class="form-check-label" for="clientResponse">Client Response</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-outline mb-4 row">
            <div class="col">
                <label class="form-label" for="realseURL">Realse URL</label>
                <input type="text" id="realseURL" class="form-control" name="realseURL" value="{$release_url}"/>
            </div>
        </div>
        <div class="form-outline mb-4 row">
            <div class="col">
                <label class="form-label" for="serverResponseTireOne">Server response tire one</label>
                <textarea id="serverResponseTireOne" class="form-control" name="serverResponseTireOne"
                    rows="5">{$server_response_tire1}</textarea>
            </div>
            <div class="col">
                <label class="form-label" for="serverResponseTireTwo">Server response tire two</label>
                <textarea id="serverResponseTireTwo" class="form-control" name="serverResponseTireTwo"
                    rows="5">{$server_response_tire2}</textarea>
            </div>
        </div>
        <div class="form-outline mb-4 row">
            <div class="col">
                <label class="form-label" for="clientResponseTireOne">Client response tire one</label>
                <textarea id="clientResponseTireOne" class="form-control" name="clientResponseTireOne"
                    rows="5">{$server_client_tire1}</textarea>
            </div>
            <div class="col">
                <label class="form-label" for="clientResponseTireTwo">Client response tire two</label>
                <textarea id="clientResponseTireTwo" class="form-control" name="clientResponseTireTwo"
                    rows="5">{$server_client_tire2}</textarea>
            </div>
        </div>

        <button type="submit" class="btn btn-success mb-4 mt-2">Confirm Changes</button>
    </form>
</main>