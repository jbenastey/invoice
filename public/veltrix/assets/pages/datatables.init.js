/*
 Template Name: Veltrix - Responsive Bootstrap 4 Admin Dashboard
 Author: Themesbrand
 File: Datatable js
 */

$(document).ready(function() {
    let baseUrl = window.location.origin+'/elapor-pupr/public';
    $('#datatable').DataTable();

    //Buttons examples
    // table.on('click', '.change-status', function (event) {
    //     var urlToRedirect = event.currentTarget.getAttribute('href');
    //     event.preventDefault();
    //     var html = '<div class="modal fade" id="status-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">' +
    //         '        <div class="modal-dialog modal-dialog-centered">' +
    //         '            <div class="modal-content">' +
    //         '                <div class="modal-body">' +
    //         '                    <div class="row">' +
    //         '                        <div class="col-12 text-center">' +
    //         '                            <i class="fa fa-exclamation-triangle warning" style="font-size: 120px;color: #38a4f8"></i>' +
    //         '                        </div>' +
    //         '                        <div class="col-12 mb-2 mt-2">' +
    //         '                            <h5 class="text-center"> Apakah anda yakin ingin mengubah status?</h5>' +
    //         '                        </div>' +
    //         '                        <div class="col-6 pr-0">' +
    //         '                            <button type="button" class="btn btn-secondary float-right mr-1 waves-effect" data-dismiss="modal">Kembali</button>' +
    //         '                        </div>' +
    //         '                        <div class="col-6 pl-0">' +
    //         '                            <a href="'+urlToRedirect+'" class="float-left ml-1 btn btn-info waves-effect">Ubah</a>' +
    //         '                        </div>' +
    //         '                    </div>' +
    //         '                </div>' +
    //         '            </div><!-- /.modal-content -->' +
    //         '        </div><!-- /.modal-dialog -->' +
    //         '    </div>';
    //
    //     $('#modal-container').html(html);
    //     $('#status-modal').modal();
    // });
    //
    // table.on('click', '.delete-confirm', function (event) {
    //     var urlToRedirect = event.currentTarget.getAttribute('href');
    //     event.preventDefault();
    //     var html = '<div class="modal fade" id="status-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">' +
    //         '        <div class="modal-dialog modal-dialog-centered">' +
    //         '            <div class="modal-content">' +
    //         '                <div class="modal-body">' +
    //         '                    <div class="row">' +
    //         '                        <div class="col-12 text-center">' +
    //         '                            <i class="fa fa-exclamation-triangle text-danger" style="font-size: 120px;"></i>' +
    //         '                        </div>' +
    //         '                        <div class="col-12 mb-2 mt-2">' +
    //         '                            <h5 class="text-center"> Apakah anda yakin ingin menghapus data?</h5>' +
    //         '                        </div>' +
    //         '                        <div class="col-6 pr-0">' +
    //         '                            <button type="button" class="btn btn-secondary float-right mr-1 waves-effect" data-dismiss="modal">Kembali</button>' +
    //         '                        </div>' +
    //         '                        <div class="col-6 pl-0">' +
    //         '                            <a href="'+urlToRedirect+'" class="float-left ml-1 btn btn-danger waves-effect">Hapus</a>' +
    //         '                        </div>' +
    //         '                    </div>' +
    //         '                </div>' +
    //         '            </div><!-- /.modal-content -->' +
    //         '        </div><!-- /.modal-dialog -->' +
    //         '    </div>';
    //
    //     $('#modal-container').html(html);
    //     $('#status-modal').modal();
    // });
} );
