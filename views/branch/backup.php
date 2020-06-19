<div class="container-fluid mt-3 mb-2">
            <div class="d-flex align-items-center p-2 px-3 bg-white border rounded">
                <h5 class="p-2 mr-auto m-0 text-uppercase text-info">Data Backup</h5>
                <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#modalBackup'>
                    Import Backup
                </button>
            </div>
        </div>

        <div class="container-fluid mb-4">
            <div class="p-4 bg-white border rounded">

                <h3>Backup now</h3>
                <p>The backup requires estimaed 200mb for the data storage.</p>
                <a href="#" class="btn btn-danger">Backup</a>

            </div> <!-- container -->

        </div>

        <div class="modal fade" id="modalBackup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Import Backup</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body px-4 pb-2">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="stBranch">Backup file:<span class="text-danger">*</span></label>
                            </div>
                            <div class="col">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger w-25" data-dismiss="modal">Import</button>
                    </div>
                </div>
            </div>
        </div>
