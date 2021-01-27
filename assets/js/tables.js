/*---------------------------------------------------------
jQuery Required for Slippa Script by Onlinetoolhub
Project:    Slippa - Domain & Website Marketplace -  V 1.0
Version:    V 1.0
Last change:    20.04.2020
Assigned to:    Onlinetoolhub
----------------------------------------------------------*/

/***DATA TABLES ***/


/*--------------------------------------------------*/
/*  Pages Datatable Functions
/*--------------------------------------------------*/
var baseLoc = window.location.pathname.split("/").pop();

function loadPageData() {
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    var table = $('#tbl_pageData').DataTable({
        destroy: true,
        "ajax": {
            "type": "GET",
            "url": baseUrl + 'common/get_table_data/tbl_pages',
            "data": {
                [csrfName]: csrfHash
            },
            "success": function (data, json) {
                $('.txt_csrfname').val(data.token);
                getPageData(data.response);
            }
        }
    });
}


/*--------------------------------------------------*/
/*  Pages Control
/*--------------------------------------------------*/

function getPageData(data) {
    var table = $('#tbl_pageData').DataTable({
        destroy: true,
        data: data,
        "columns": [{
            "data": 'page_id'
        },
        {
            "data": 'txt_page_title'
        },
        {
            "data": 'txt_page_meta_description'
        },
        {
            "data": null,
            "className": 'center',
            "defaultContent": ''
        },
        {
            "data": null,
            "className": 'center',
            "defaultContent": '<a href="" class="activeClick"><i class="fa fa-ban" aria-hidden="true"></a>'
        },
        {
            "data": null,
            "className": 'center',
            "defaultContent": '<a href="" class="editLink"><i title="edit" class="fa fa-pencil-square-o" aria-hidden="true"></a>'
        },
        {
            "data": null,
            "className": 'center',
            "defaultContent": '<a href="" class="deleteLink"><i title="delete" class="fa fa-trash" aria-hidden="true"></a>'
        }
        ],
        "order": [
            [1, 'asc']
        ],
        dom: 'Bfrtip',
        buttons: ['csv'],
        bFilter: false,
        bInfo: false,
        "createdRow": function (row, data, dataIndex) {

            if (data.p_status === '1') {
                $('td', row).eq(6).html('<a><i title="delete" class="fa fa-trash" aria-hidden="true"></a>');
            }

            if (data.txt_page_title !== '') {
                $('td', row).eq(1).html((data.txt_page_title).substring(0, 20));
            }

            if (data.txt_page_meta_description !== '') {
                $('td', row).eq(2).html((data.txt_page_meta_description).substring(0, 35));
            }

            if (data.page_visibility_status == '1') {
                $('td', row).eq(4).html("<label class='badge badge-success inactiveClick'>Active </label>");
            } else if (data.page_visibility_status == '0') {
                $('td', row).eq(4).html("<label class='badge badge-danger activateClick'>Inactive</label>");
            }

            if (data.txt_page_url_slug) {
                $('td', row).eq(3).html('<div class="input-group">' +
                    '<input value="' + baseUrl + 'page/' + data.txt_page_url_slug + '" type="text" class="form-control sharelinkSingle" readonly="true">' +
                    '<button id="' + 'copy-pageurl' + '-' + data.page_id + '" class="copy-url-button ripple-effect copy-pageurl" data-clipboard-action="copy" data-clipboard-text="' + baseUrl + 'page/' + data.txt_page_url_slug + '" title="Copy to Clipboard" data-tippy-placement="top"><i class="icon-material-outline-file-copy"></i></button>' +
                    '</div>');
            }

        },
        scrollCollapse: true,
        autoWidth: true,
        paging: true,
        columnDefs: [{
            "width": "180px",
            "targets": [3]
        },
        {
            "width": "10px",
            "targets": [2]
        },
        {
            "width": "2px",
            "targets": [0, 4]
        },
        {
            "width": "5px",
            "targets": [1]
        }
        ],
    });


    $('#tbl_pageData tbody').off('click', '.deleteLink').on('click', '.deleteLink', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();
        if (typeof (data_row) != "undefined") {
            if (confirm('Confirm delete')) {
                window.location.href = '#';
                $.ajax({
                    url: baseUrl + 'common/delete_from_table/tbl_pages/page_id/' + data_row.page_id,
                    type: 'POST',
                    data: {
                        [csrfName]: csrfHash
                    },
                    dataType: 'json',
                    success: function (data) {
                        $('.txt_csrfname').val(data.token);
                        loadPageData();
                    },
                    complete: function () { },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(thrownError);
                    }
                });
            }
        }
    });


    $('#tbl_pageData tbody').off('click', '.inactiveClick').on('click', '.inactiveClick', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();
        if (typeof (data_row) != "undefined") {
            if (confirm('Confirm Deactivation')) {

                window.location.href = '#';

                $.ajax({
                    url: baseUrl + 'common/update_selected_data/tbl_pages/page_visibility_status/0/page_id/' + data_row.page_id,
                    type: 'POST',
                    data: {
                        [csrfName]: csrfHash
                    },
                    dataType: 'json',
                    success: function (data) {
                        $('.txt_csrfname').val(data.token);
                        loadPageData();
                    },
                    complete: function () { },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(thrownError);
                    }
                });
            }
        }
    });

    $('#tbl_pageData tbody').off('click', '.activateClick').on('click', '.activateClick', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();
        if (typeof (data_row) != "undefined") {
            if (confirm('Confirm Activation')) {

                window.location.href = '#';

                $.ajax({
                    url: baseUrl + 'common/update_selected_data/tbl_pages/page_visibility_status/1/page_id/' + data_row.page_id,
                    type: 'POST',
                    data: {
                        [csrfName]: csrfHash
                    },
                    dataType: 'json',
                    success: function (data) {
                        $('.txt_csrfname').val(data.token);
                        loadPageData();
                    },
                    complete: function () { },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(thrownError);
                    }
                });
            }
        }
    });


    $('#tbl_pageData tbody').off('click', '.editLink').on('click', '.editLink', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();
        if (typeof (data_row) != "undefined") {

            $.ajax({
                url: baseUrl + 'common/get_selected_row/tbl_pages/page_id/' + data_row.page_id,
                type: 'POST',
                data: {
                    [csrfName]: csrfHash
                },
                dataType: 'json',
                success: function (data, json) {
                    $('.txt_csrfname').val(data.token);
                    document.getElementById("txt_page_title").value = data.response[0].txt_page_title;
                    document.getElementById("txt_page_id").value = data.response[0].page_id;
                    document.getElementById("txt_page_meta_description").value = data.response[0].txt_page_meta_description;

                    if (data.response[0].txt_page_meta_keywords !== "") {
                        document.getElementById("txt_page_meta_keywords").value = JSON.parse(data.response[0].txt_page_meta_keywords);
                    }

                    document.getElementById("txt_page_url_slug").value = data.response[0].txt_page_url_slug;
                    $('#txt_page_description').summernote('destroy');
                    $('#txt_page_description').val(data.response[0].txt_page_description).summernote();

                    dataArr = data.response[0].page_visibility_group;
                    if (dataArr.length > 0) {
                        $('#page_visibility_group').val(dataArr);
                        $('#page_visibility_group').trigger('change');
                    }

                    $('#page_visibility_status').val(data.response[0].page_visibility_status);
                    $(this).closest('form').find("input[type=text], textarea").val("");
                    loadPageData();
                },

                complete: function () { },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(thrownError);
                }
            });
        }
    });
}

/*--------------------------------------------------*/
/*  Comment Datatable Functions
/*--------------------------------------------------*/

function loadCommentData() {
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    var url = window.location.pathname;
    var id = url.substring(url.lastIndexOf('/') + 1);   
    
    if(id != '')
        url = baseUrl + 'common/get_comments_table_data/'+id;
    else 
        url = baseUrl + 'common/get_comments_table_data';
    var table = $('#tbl_CommentData').DataTable({
        destroy: true,
        "ajax": {
            "type": "GET",
            "url": url,
            "data": {
                [csrfName]: csrfHash
            },
            "success": function (data, json) {
                $('.txt_csrfname').val(data.token);
                getCommentData(data.response);
            }
        }
    });
}

/*--------------------------------------------------*/
/*  Blog Datatable Functions
/*--------------------------------------------------*/

function loadBlogData() {
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    var table = $('#tbl_blogData').DataTable({
        destroy: true,
        "ajax": {
            "type": "GET",
            "url": baseUrl + 'common/get_table_data/tbl_blog',
            "data": {
                [csrfName]: csrfHash
            },
            "success": function (data, json) {
                $('.txt_csrfname').val(data.token);
                getBlogData(data.response);
            }
        }
    });
}

/*--------------------------------------------------*/
/*  Blog Control
/*--------------------------------------------------*/

function getBlogData(data) {
    var table = $('#tbl_blogData').DataTable({
        destroy: true,
        data: data,
        "columns": [{
            "data": 'id'
        },
        {
            "data": 'title'
        },
        {
            "data": 'metadescription'
        },
        {
            "data": null,
            "className": 'center',
            "defaultContent": ''
        },
        {
            "data": null,
            "className": 'center',
            "defaultContent": '<a href="javascript:void(0)" class="activeClick"><i class="fa fa-ban" aria-hidden="true"></a>'
        },
        {
            "data": null,
            "className": 'center',
            "defaultContent": '<a href="javascript:void(0)" class="editLink editLinkcolor" ><i title="edit" class="fa fa-pencil-square-o" aria-hidden="true"></a>'
        },
        {
            "data": null,
            "className": 'center',
            "defaultContent": '<a href="javascript:void(0)" class="deleteLink"><i title="delete" class="fa fa-trash" aria-hidden="true"></a>'
        },
        {
            "data": null,
            "className": 'center',
            "defaultContent": '<a href="" class="commentsClick"><i class="fa fa-comments" aria-hidden="true"></a>'
        }
        ],
        "order": [
            [1, 'asc']
        ],
        dom: 'Bfrtip',
        buttons: ['csv'],
        // bFilter: false,
        // bInfo: false,
        "createdRow": function (row, data, dataIndex) {
            if (data.title !== '') {
                $('td', row).eq(1).html((data.title).substring(0, 20));
            }

            if (data.metadescription !== '') {
                $('td', row).eq(2).html((data.metadescription).substring(0, 35));
            }

            if (data.status == '1') {
                $('td', row).eq(4).html("<label class='badge badge-success inactiveClick'>Active </label>");
            } else if (data.status == '0') {
                $('td', row).eq(4).html("<label class='badge badge-danger activateClick'>Inactive</label>");
            }
            $('td', row).eq(7).find('a').attr('href', baseUrl+'admin/view_comments/'+data.id);
            
            if (data.slug) {
                $('td', row).eq(3).html('<div class="input-group">' +
                    '<input value="' + baseUrl + 'blog/' + data.slug + '" type="text" class="form-control sharelinkSingle" readonly="true">' +
                    '<button id="' + 'copy-pageurl' + '-' + data.id + '" class="copy-url-button ripple-effect copy-pageurl" data-clipboard-action="copy" data-clipboard-text="' + baseUrl + 'blog/' + data.slug + '" title="Copy to Clipboard" data-tippy-placement="top"><i class="icon-material-outline-file-copy"></i></button>' +
                    '</div>');
            }

        },
        scrollCollapse: true,
        autoWidth: true,
        paging: true,
        columnDefs: [{
            "width": "180px",
            "targets": [3]
        },
        {
            "width": "10px",
            "targets": [2]
        },
        {
            "width": "2px",
            "targets": [0, 4, 5]
        },
        {
            "width": "5px",
            "targets": [1]
        }
        ],
    });   

    $('#tbl_blogData tbody').off('click', '.deleteLink').on('click', '.deleteLink', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();
        if (typeof (data_row) != "undefined") {
            if (confirm('Confirm delete')) {

                window.location.href = '#';

                $.ajax({
                    url: baseUrl + 'common/delete_from_table/tbl_blog/id/' + data_row.id,
                    type: 'POST',
                    data: {
                        [csrfName]: csrfHash
                    },
                    dataType: 'json',
                    success: function (data) {
                        $('.txt_csrfname').val(data.token);
                        loadBlogData();
                    },
                    complete: function () { },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(thrownError);
                    }
                });
            }
        }
    });

    $('#tbl_blogData tbody').off('click', '.inactiveClick').on('click', '.inactiveClick', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();
        if (typeof (data_row) != "undefined") {
            if (confirm('Confirm Deactivation')) {

                window.location.href = '#';

                $.ajax({
                    url: baseUrl + 'common/update_selected_data/tbl_blog/page_visibility_status/0/id/' + data_row.id,
                    type: 'POST',
                    data: {
                        [csrfName]: csrfHash
                    },
                    dataType: 'json',
                    success: function (data) {
                        $('.txt_csrfname').val(data.token);
                        loadBlogData();
                    },
                    complete: function () { },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(thrownError);
                    }
                });
            }
        }
    });

    $('#tbl_blogData tbody').off('click', '.activateClick').on('click', '.activateClick', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();
        if (typeof (data_row) != "undefined") {
            if (confirm('Confirm Activation')) {

                window.location.href = '#';

                $.ajax({
                    url: baseUrl + 'common/update_selected_data/tbl_blog/page_visibility_status/1/id/' + data_row.id,
                    type: 'POST',
                    data: {
                        [csrfName]: csrfHash
                    },
                    dataType: 'json',
                    success: function (data) {
                        $('.txt_csrfname').val(data.token);
                        loadBlogData();
                    },
                    complete: function () { },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(thrownError);
                    }
                });
            }
        }
    });

    $('#tbl_blogData tbody').off('click', '.editLink').on('click', '.editLink', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();
        if (typeof (data_row) != "undefined") {

            $.ajax({
                url: baseUrl + 'common/get_selected_row/tbl_blog/id/' + data_row.id,
                type: 'POST',
                data: {
                    [csrfName]: csrfHash
                },
                dataType: 'json',
                success: function (data, json) {
                    $('.txt_csrfname').val(data.token);
                    document.getElementById("txt_blogpost_title").value = data.response[0].title;
                    document.getElementById("txt_blogpost_id").value = data.response[0].id;
                    document.getElementById("txt_blogpost_meta_description").value = data.response[0].metadescription;

                    if (data.response[0].metakeywords !== "") {
                        document.getElementById("txt_blogpost_meta_keywords").value = JSON.parse(data.response[0].metakeywords);
                    }

                    if (data.response[0].blog_tags !== "") {
                        document.getElementById("txt_blogpost_tags").value = JSON.parse(data.response[0].blog_tags);
                    }

                    document.getElementById("txt_blogpost_url_slug").value = data.response[0].slug;
                    $('#txt_blogpost_description').summernote('destroy');
                    $('#txt_blogpost_description').val(data.response[0].blog_post).summernote();
                    $('#blogpostvisibility_status').val(data.response[0].status);
                    $('.uploadButton-input-cover').next('label').text(data.response[0].thumbnail);
                    $(this).closest('form').find("input[type=text], textarea").val("");
                    loadBlogData();

                    $("html, body").animate({
                        scrollTop: 0
                    }, 2000);
                },
                complete: function () { },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(thrownError);
                }
            });
        }
    });
}





function getCommentData(data) {
    var table = $('#tbl_CommentData').DataTable({
        destroy: true,
        data: data,
        "columns": [
        {
            "data": 'user_name'
        },
        {
            "data": 'title'
        },
        {
            "data": 'body'
        },
        {
            "data": null,
            "className": 'center',
            "defaultContent": '<a href="javascript:void(0)" class="activeClick"><i class="fa fa-ban" aria-hidden="true"></a>'
        },
        {
            "data": null,
            "className": 'center',
            "defaultContent": '<a href="javascript:void(0)" class="deleteComment"><i title="delete" class="fa fa-trash" aria-hidden="true"></a>'
        }
        ],
        "order": [
            [1, 'asc']
        ],
        dom: 'Bfrtip',
        buttons: ['csv'],
       
        "createdRow": function (row, data, dataIndex) {
            
            approve_link = baseUrl+"common/approve_comment/"+data.id+"/"+data.listing_id;
            
            if (data.status == '1') {
                $('td', row).eq(3).html("<label class='badge badge-success inactiveClick'>Active </label>");
            } else if (data.status == '0') {
                $('td', row).eq(3).html("<label class='badge badge-info activateClick'>Pending</label><a href='"+approve_link+"'> Approve</a>");
            }

        },
        scrollCollapse: true,
        autoWidth: true,
        paging: true,
        columnDefs: [{
            "width": "180px",
            "targets": [3]
        },
        {
            "width": "10px",
            "targets": [2]
        },
        {
            "width": "2px",
            "targets": [0, 4]
        },
        {
            "width": "5px",
            "targets": [1]
        }
        ],
    });
    
    $('#tbl_CommentData tbody').off('click', '.deleteComment').on('click', '.deleteComment', function (e) {
        var data_row = table.row($(this).closest('tr')).data();

        if (confirm('Confirm Delete')) {

            window.location.href = baseUrl+'common/delete_comment/'+data_row.id+'/'+data_row.listing_id;
        }
    });
}


/*--------------------------------------------------*/
/*  Listings Datatable Functions
/*--------------------------------------------------*/


function loadListingsData(id) {
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    var table = $('#tbl_ListingsData').DataTable({
        destroy: true,
        "ajax": {
            "type": "GET",
            "url": baseUrl + 'common/get_listing_table_data/' + id,
            "data": {
                [csrfName]: csrfHash
            },
            "success": function (data, json) {
                $('.txt_csrfname').val(data.token);
                getListingsData(data.response);
                addSpace();

            }
        }
    });
}


function addSpace() {
    $(function () {
        setTimeout(() => {
            $('.buttons-csv ').addClass('mb-3')
        }, 3000);
    });
}

/*--------------------------------------------------*/
/*  Listings Control
/*--------------------------------------------------*/
function getListingsData(data) {

    var table = $('#tbl_ListingsData').DataTable({
        destroy: true,
        data: data,
        "columns": [{
            "data": 'id',

        },
        {
            "data": 'listing_type'
        },
        {
            "data": 'website_BusinessName',
        },
        {
            "data": 'listing_option'
        },
        {
            "data": null,
            "className": 'center',
            "defaultContent": ''
        },
        {
            "data": null,
            "className": 'center',
            "defaultContent": ''
        },
        {
            "data": null,
            "className": 'center',
            "defaultContent": '<a href="" class="inactiveClick"><i class="fa fa-ban" aria-hidden="true"></a>'
        },
        {
            "data": null,
            "className": 'center',
            "defaultContent": '<a href="" class="editLink"><i title="edit" class="fas fa-edit" aria-hidden="true"></a>'
        },
        {
            "data": null,
            "className": 'center',
            "defaultContent": '<a href="" class="deleteLink"><i title="delete" class="fas fa-trash" aria-hidden="true"></a>'
        }
        ],
        "order": [
            [1, 'asc']
        ],
        dom: 'Bfrtip',
        buttons: ['csv'],
        // bFilter: false,
        // bInfo: false,
        "createdRow": function (row, data, dataIndex) {
            $('td', row).eq(0).html("<a href='#' title='Click to change Listing' class='viewUser'>" + data.id + "</a>");
            if (data.status === '1') {
                $('td', row).eq(4).html("<label class='badge badge-success'>Active</label>");
                $('td', row).eq(6).html("<a href='' class='inactiveClick'><i class='fa fa-ban' aria-hidden='true'></a>");
            } else if (data.status === '2') {
                $('td', row).eq(4).html("<label class='badge badge-danger'>Suspended</label>");
                $('td', row).eq(6).html("<a href='' class='activateClick'><i class='fa fa-check' aria-hidden='true'></a>");
            } else if (data.status === '0') {
                $('td', row).eq(4).html("<label class='badge badge-warning'>Payment Pending</label>");
            } else if (data.status === '4') {
                $('td', row).eq(4).html("<label class='badge badge-dark'>Expired</label>");
            } else if (data.status === '5') {
                $('td', row).eq(4).html("<label class='badge badge-info'>Unverified</label>");
            } else if (data.status === '6') {
                $('td', row).eq(4).html("<label class='badge badge-danger'>Deleted by Seller</label>");
            } else if (data.status === '9') {
                $('td', row).eq(4).html("<label class='badge badge-warning'>Pending Approval</label>");
                $('td', row).eq(6).html("<a href='' class='inactiveClick'><i class='fa fa-ban' aria-hidden='true'></a>");
            }
            if (data.sold_status === '1') {
                $('td', row).eq(5).html("<label class='badge badge-success'>SOLD</label>");
            } else {
                $('td', row).eq(5).html("<label class='badge badge-warning'>AVAILABLE</label>");
            }

        },
    });

    $('#tbl_ListingsData tbody').off('click', '.viewUser').on('click', '.viewUser', function (e) {
        e.preventDefault();
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();
        var data_row = table.row($(this).closest('tr')).data();
        if (typeof (data_row) !== "undefined") {
            $('#listing_extend').val('');
            $('#sponsore_listing').val('');
            $('#plan-id').val(data_row.id);
            $('#change-listing').modal('show');
        }
    });

    $('#tbl_ListingsData tbody').off('click', '.deleteLink').on('click', '.deleteLink', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();
        if (typeof (data_row) != "undefined") {
            if (confirm('Confirm delete')) {

                window.location.href = '#';

                $.ajax({
                    url: baseUrl + 'common/delete_from_table/tbl_listings/id/' + data_row.id,
                    type: 'POST',
                    data: {
                        [csrfName]: csrfHash
                    },
                    dataType: 'json',
                    success: function (data) {
                        $('.txt_csrfname').val(data.token);
                        // loadListingsData('');
                        location.reload();
                    },
                    complete: function () { },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(thrownError);
                    }
                });
            }
        }
    });

    $('#tbl_ListingsData tbody').off('click', '.editLink').on('click', '.editLink', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();

        if (typeof (data_row) != "undefined") {

            var data_type = data_row.listing_type;
            if (data_type == "app") {
                window.location.href = baseUrl + 'admin/edit_listings/app/' + data_row.id;
            } else if (data_type == "business") {
                window.location.href = baseUrl + 'admin/edit_listings/business/' + data_row.id;
            } else if (data_type == "domain") {
                window.location.href = baseUrl + 'admin/edit_listings/domain/' + data_row.id;
            }
            else if (data_type == "website") {
                window.location.href = baseUrl + 'admin/edit_listings/website/' + data_row.id;
            }
        }
    });

    $('#tbl_ListingsData tbody').off('click', '.inactiveClick').on('click', '.inactiveClick', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();
        if (typeof (data_row) != "undefined") {
            if (confirm('Do you want to suspend this?')) {

                window.location.href = '#';

                $.ajax({
                    url: baseUrl + 'common/update_selected_data/tbl_listings/status/2/id/' + data_row.id,
                    type: 'POST',
                    data: {
                        [csrfName]: csrfHash
                    },
                    dataType: 'json',
                    success: function (data) {
                        $('.txt_csrfname').val(data.token);
                        loadListingsData('');
                    },
                    complete: function () { },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(thrownError);
                    }
                });
            }
        }
    });

    $('#tbl_ListingsData tbody').off('click', '.activateClick').on('click', '.activateClick', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();
        if (typeof (data_row) != "undefined") {
            if (confirm('Do you want to activate this?')) {

                window.location.href = '#';

                $.ajax({
                    url: baseUrl + 'common/update_selected_data/tbl_listings/status/1/id/' + data_row.id,
                    type: 'POST',
                    data: {
                        [csrfName]: csrfHash
                    },
                    dataType: 'json',
                    success: function (data) {
                        $('.txt_csrfname').val(data.token);
                        loadListingsData('');
                    },
                    complete: function () { },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(thrownError);
                    }
                });
            }
        }
    });
}


/*--------------------------------------------------*/
/*  Cron Jobs Loading
/*--------------------------------------------------*/

function loadCronData() {
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    var table = $('#tbl_crondata').DataTable({
        destroy: true,
        "ajax": {
            "type": "GET",
            "url": baseUrl + 'cron/get_data',
            "data": {
                [csrfName]: csrfHash
            },
            "success": function (data, json) {
                $('.txt_csrfname').val(data.token);
                getCronData(data.response);
            }
        }
    });
}


/*--------------------------------------------------*/
/*  Cron Jobs Controls
/*--------------------------------------------------*/

function getCronData(data) {
    var table = $('#tbl_crondata').DataTable({
        destroy: true,
        data: data,
        "columns": [{
            "className": 'details-control',
            "orderable": false,
            "data": null,
            "defaultContent": ''
        },
        {
            "data": 'cron_Minute'
        },
        {
            "data": 'cron_Hour'
        },
        {
            "data": 'cron_day'
        },
        {
            "data": 'cron_month'
        },
        {
            "data": 'cron_weekday'
        },
        {
            "data": 'cron_job'
        },
        {
            "data": null,
            "className": 'center',
            "defaultContent": '<a href="" class="deleteLink"><i title="delete" class="fas fa-trash pl-3" aria-hidden="true"></i></a>'
        }
        ],
        "order": [
            [1, 'asc']
        ],
    });


    $('#tbl_crondata tbody').on('click', '.deleteLink', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();
        if (typeof (data_row) != "undefined") {
            $.ajax({
                url: baseUrl + 'cron/deletecronDatafromDb/' + data_row.cron_job,
                type: 'POST',
                data: {
                    [csrfName]: csrfHash
                },
                dataType: 'json',
                success: function (data) {
                    $('.txt_csrfname').val(data.token);
                    loadCronData();
                },
                complete: function () { },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(thrownError);
                }
            });
        }
    });
}


/*--------------------------------------------------*/
/*  Load Monetized Method Data start here.
/*--------------------------------------------------*/
function loadMonetizedMethodData() {
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    var table = $('#tbl_categoriesData').DataTable({
        destroy: true,
        "ajax": {
            "type": "GET",
            "url": baseUrl + 'common/get_table_data_order/tbl_common',
            "data": {
                [csrfName]: csrfHash
            },
            "success": function (data, json) {
                $('.txt_csrfname').val(data.token);
                getMonetizationMethodData(data.response);
            }
        }
    });
}

/*--------------------------------------------------*/
/*  Load Monetization Controls
/*--------------------------------------------------*/
function getMonetizationMethodData(data) {
    console.log(data);
    var table = $('#tbl_categoriesData').DataTable({
        destroy: true,
        data: data,
        "columns": [{
            "data": 'name'
        },

        {
            "data": null,
            "className": 'center',
            "defaultContent": '<a href="javascript:void(0);" class="editLink"><i title="edit" class="fas fa-edit" aria-hidden="true"></a>'
        },
        {
            "data": null,
            "className": 'center',
            "defaultContent": '<a href="javascript:void(0);" class="deleteLink"><i title="delete" class="fa fa-trash" aria-hidden="true"></a>'
        }
        ],
        ordering: false,
        scrollX: true,
        scrollCollapse: true,
        autoWidth: true,
        paging: true,
    });



    $('#tbl_categoriesData tbody').off('click', '.deleteLink').on('click', '.deleteLink', function (e) {

        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();
        console.log(data_row);
        if (typeof (data_row) != "undefined") {
            bootboxConfirm(baseUrl + 'common/check_delete_from_table/tbl_common/id/' + data_row.id + "/tbl_listings", csrfName, csrfHash, data_row.name);

        }
    });


    $('#tbl_categoriesData tbody').off('click', '.editLink').on('click', '.editLink', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();
        if (typeof (data_row) != "undefined") {
            $.ajax({
                url: baseUrl + 'common/get_selected_row/tbl_common/id/' + data_row.id,
                type: 'POST',
                data: {
                    [csrfName]: csrfHash
                },
                dataType: 'json',
                success: function (data, json) {
                    $('.txt_csrfname').val(data.token);
                    document.getElementById("name").value = data.response[0].name;
                    document.getElementById("monetization_id").value = data.response[0].id;
                    $("#btn_save").text("update");
                    $("html, body").animate({
                        scrollTop: 0
                    }, 2000);
                },
                complete: function () {
                    $("btn_categorysave").val("Update");
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(thrownError);
                }
            });
        }
    });

}

/**********end of monetiztion********* */

/************starts solution category********************** */


/*--------------------------------------------------*/
/*  Load Solution Categories Data
/*--------------------------------------------------*/
function loadSolutionCategoryData() {
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    $('.mainCategory').show();
    var table = $('#tbl_categoriesData').DataTable({
        destroy: true,
        "ajax": {
            "type": "GET",
            "url": baseUrl + 'common/get_table_solution_data_order/tbl_solution_categories',
            "data": {
                [csrfName]: csrfHash
            },
            "success": function (data, json) {
                $('.txt_csrfname').val(data.token);
                getSolutionCategoryData(data.response);
                console.log(data.response);

            }
        }
    });
}

/*--------------------------------------------------*/
/*  Load Solution Categories Controls
/*--------------------------------------------------*/
function getSolutionCategoryData(data) {
    console.log(data);
    var table = $('#tbl_categoriesData').DataTable({
        destroy: true,
        data: data,
        "columns": [{
            "data": 'c_name'
        },
        {
            "data": null,
            "className": 'center',
            "defaultContent": ''
        },
        {
            "data": 'c_parent'
        },
        {
            "data": null,
            "className": 'center',
            "defaultContent": '<a href="javascript:void(0);" class="editLink"><i title="edit" class="fas fa-edit" aria-hidden="true"></a>'
        },
        {
            "data": null,
            "className": 'center',
            "defaultContent": '<a href="javascript:void(0);" class="deleteLink"><i title="delete" class="fa fa-trash" aria-hidden="true"></a>'
        }
        ],


        "createdRow": function (row, data, dataIndex) {
            if (data.c_thumb !== '') {
                $('td', row).eq(2).html("<img src='" + baseUrl + 'assets/img/categories/' + data.c_thumb + "' class='img-fluid img-thumbnail'> </a>");
            } else {
                $('td', row).eq(2).html("N/A");
            }
            if (data.c_parent !== '') {
                $('td', row).eq(1).html(data.c_parent);
            } else {
                $('td', row).eq(1).html("N/A");
            }
        },
        ordering: false,
        scrollX: true,
        scrollCollapse: true,
        autoWidth: true,
        paging: true,
    });
    $('#tbl_categoriesData tbody').off('click', '.deleteLink').on('click', '.deleteLink', function (e) {

        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();
        if (typeof (data_row) != "undefined") {
            if (typeof (data_row) != "undefined") {
                bootboxConfirm(baseUrl + 'common/check_delete_from_table/tbl_solution_categories/id/' + data_row.id +
                    "/tbl_solutions", csrfName, csrfHash, data_row.c_name);

            }
        }
    });

    $('#tbl_categoriesData tbody').off('click', '.editLink').on('click', '.editLink', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();

        if (typeof (data_row) != "undefined") {
            $.ajax({
                url: baseUrl + 'common/get_solution_category_data/tbl_solution_categories/' + data_row.id,
                type: 'POST',
                data: {
                    [csrfName]: csrfHash
                },
                dataType: 'json',
                success: function (data, json) {
                    $('.txt_csrfname').val(data.token);
                    document.getElementById("category_name").value = data.response[0].c_name;

                    if (data.response[0].parent_id != undefined && data.response[0].parent_id != null && data.response[0].parent_id != 0) {
                        $('#admin_solution_category').val(data.response[0].parent_id);
                    } else {
                        $('#admin_solution_category').val("");
                        $('.mainCategory').hide();
                    }

                    document.getElementById("category_meta_description").value = data.response[0].c_description;
                    document.getElementById("category_id").value = data.response[0].id;
                    document.getElementById("category_url_slug").value = data.response[0].url_slug;
                    $('.uploadButton-input-cover').next('label').text(data.response[0].c_thumb);
                    $('#category_level').val(data.response[0].c_level);


                    if (data.response[0].metakeywords !== "") {
                        document.getElementById("category_meta_keywords").value = JSON.parse(data.response[0].c_keywords);
                    }

                    $(this).closest('form').find("input[type=text], textarea").val("");
                    $("#btn_save").text("update solution");
                    $("html, body").animate({
                        scrollTop: 0
                    }, 2000);
                },
                complete: function () { },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(thrownError);
                }
            });
        }
    });

}

/****************end of solution categories********************* */

/****Service Type Solution starts */

/*--------------------------------------------------*/
/*  Load Service Type
/*--------------------------------------------------*/
function loadServiceTypeData() {
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    var table = $('#tbl_categoriesData').DataTable({
        destroy: true,
        "ajax": {
            "type": "GET",
            "url": baseUrl + 'common/get_table_data_order/tbl_solution_service_types',
            "data": {
                [csrfName]: csrfHash
            },
            "success": function (data, json) {
                $('.txt_csrfname').val(data.token);
                getServiceTypeData(data.response);
            }
        }
    });
}

/*--------------------------------------------------*/
/*  Load Service Data
/*--------------------------------------------------*/
function getServiceTypeData(data) {
    var table = $('#tbl_categoriesData').DataTable({
        destroy: true,
        data: data,
        "columns": [{
            "data": 'c_name'
        },
        {
            "data": 'c_description'
        },
        {
            "data": null,
            "className": 'center',
            "defaultContent": ''
        },
        {
            "data": null,
            "className": 'center',
            "defaultContent": '<a href="javascript:void(0);" class="editLink"><i title="edit" class="fas fa-edit" aria-hidden="true"></a>'
        },
        {
            "data": null,
            "className": 'center',
            "defaultContent": '<a href="javascript:void(0);" class="deleteLink"><i title="delete" class="fa fa-trash" aria-hidden="true"></a>'
        }

        ],


        "createdRow": function (row, data, dataIndex) {
            if (data.c_thumb !== '') {
                $('td', row).eq(2).html("<img src='" + baseUrl + 'assets/img/categories/' + data.c_thumb + "' class='img-fluid img-thumbnail'> </a>");
            } else {
                $('td', row).eq(2).html("N/A");
            }
        },
        ordering: false,
        scrollX: true,
        scrollCollapse: true,
        autoWidth: true,
        paging: true,
    });

    $('#tbl_categoriesData tbody').off('click', '.deleteLink').on('click', '.deleteLink', function (e) {

        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();
        if (typeof (data_row) != "undefined") {
            if (typeof (data_row) != "undefined") {
                bootboxConfirm(baseUrl + 'common/check_delete_from_table/tbl_solution_service_types/id/' + data_row.id +
                    "/tbl_solutions", csrfName, csrfHash, data_row.c_name);

            }
        }
    });


    $('#tbl_categoriesData tbody').off('click', '.editLink').on('click', '.editLink', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();
        if (typeof (data_row) != "undefined") {
            $.ajax({
                url: baseUrl + 'common/get_selected_row/tbl_solution_service_types/id/' + data_row.id,
                type: 'POST',
                data: {
                    [csrfName]: csrfHash
                },
                dataType: 'json',
                success: function (data, json) {
                    $('.txt_csrfname').val(data.token);
                    document.getElementById("category_name").value = data.response[0].c_name;
                    document.getElementById("category_meta_description").value = data.response[0].c_description;
                    document.getElementById("category_id").value = data.response[0].id;
                    document.getElementById("category_url_slug").value = data.response[0].url_slug;
                    $('.uploadButton-input-cover').next('label').text(data.response[0].c_thumb);
                    $('#category_level').val(data.response[0].c_level);
                    if (data.response[0].metakeywords !== "") {
                        document.getElementById("category_meta_keywords").value = JSON.parse(data.response[0].c_keywords);
                    }
                    $(this).closest('form').find("input[type=text], textarea").val("");
                    $("#btn_save").text("update");
                    $("html, body").animate({
                        scrollTop: 0
                    }, 2000);
                },
                complete: function () { },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(thrownError);
                }
            });
        }
    });

}
/*------------------Service Type Solution end-------------------- */
/*--------------------------------------------------*/
/*  Load Categories Data
/*--------------------------------------------------*/
function loadCategoryData() {
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    var table = $('#tbl_categoriesData').DataTable({
        destroy: true,
        "ajax": {
            "type": "GET",
            "url": baseUrl + 'common/get_table_data_order/tbl_categories',
            "data": {
                [csrfName]: csrfHash
            },
            "success": function (data, json) {
                $('.txt_csrfname').val(data.token);
                getCategoryData(data.response);
            }
        }
    });
}

/*--------------------------------------------------*/
/*  Load Categories Controls
/*--------------------------------------------------*/
function getCategoryData(data) {
    var table = $('#tbl_categoriesData').DataTable({
        destroy: true,
        data: data,
        "columns": [{
            "data": 'c_name'
        },
        {
            "data": 'c_description'
        },

        {
            "data": null,
            "className": 'center',
            "defaultContent": ''
        },
        {
            "data": null,
            "className": 'center',
            "defaultContent": '<a href="javascript:void(0);" class="editLink"><i title="edit" class="fas fa-edit" aria-hidden="true"></a>'
        },
        {
            "data": null,
            "className": 'center',
            "defaultContent": '<a href="javascript:void(0);" class="deleteLink"><i title="delete" class="fa fa-trash" aria-hidden="true"></a>'
        }

        ],


        "createdRow": function (row, data, dataIndex) {

            if (data.c_thumb !== '') {
                $('td', row).eq(2).html("<img src='" + baseUrl + 'assets/img/categories/' + data.c_thumb + "' class='img-fluid img-thumbnail'> </a>");
            } else {
                $('td', row).eq(2).html("N/A");
            }
        },
        ordering: false,
        scrollX: true,
        scrollCollapse: true,
        autoWidth: true,
        paging: true,
    });
    $('#tbl_categoriesData tbody').off('click', '.deleteLink').on('click', '.deleteLink', function (e) {

        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();
        if (typeof (data_row) != "undefined") {
            if (typeof (data_row) != "undefined") {
                bootboxConfirm(baseUrl + 'common/check_delete_from_table/tbl_categories/id/' + data_row.id +
                    "/tbl_listings", csrfName, csrfHash, data_row.c_name);

            }
        }
    });


    $('#tbl_categoriesData tbody').off('click', '.editLink').on('click', '.editLink', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();
        if (typeof (data_row) != "undefined") {
            $.ajax({
                url: baseUrl + 'common/get_selected_row/tbl_categories/id/' + data_row.id,
                type: 'POST',
                data: {
                    [csrfName]: csrfHash
                },
                dataType: 'json',
                success: function (data, json) {
                    $('.txt_csrfname').val(data.token);
                    document.getElementById("category_name").value = data.response[0].c_name;
                    document.getElementById("category_meta_description").value = data.response[0].c_description;
                    document.getElementById("category_id").value = data.response[0].id;
                    document.getElementById("category_url_slug").value = data.response[0].url_slug;
                    $('.uploadButton-input-cover').next('label').text(data.response[0].c_thumb);
                    $('#category_level').val(data.response[0].c_level);

                    if (data.response[0].metakeywords !== "") {
                        document.getElementById("category_meta_keywords").value = JSON.parse(data.response[0].c_keywords);
                    }

                    $(this).closest('form').find("input[type=text], textarea").val("");
                    $("#btn_save").text("update");
                    $("html, body").animate({
                        scrollTop: 0
                    }, 2000);

                },
                complete: function () { },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(thrownError);
                }
            });
        }
    });

}


/*--------------------------------------------------*/
/*  Load Listing Header Data
/*--------------------------------------------------*/
function loadListingHeaderData() {
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    var table = $('#tbl_ListingsData').DataTable({
        destroy: true,
        "ajax": {
            "type": "GET",
            "url": baseUrl + 'common/get_table_data/tbl_listing_header',
            "data": {
                [csrfName]: csrfHash
            },
            "success": function (data, json) {
                $('.txt_csrfname').val(data.token);
                getListingHeaderData(data.response);
            }
        }
    });
}

/*--------------------------------------------------*/
/*  Load Listing Headers
/*--------------------------------------------------*/
function getListingHeaderData(data) {
    var table = $('#tbl_ListingsData').DataTable({
        destroy: true,
        data: data,
        "columns": [{
            "data": 'listing_name'
        },
        {
            "data": 'listing_type'
        },
        {
            "data": 'listing_price'
        },
        {
            "data": 'listing_discount'
        },
        {
            "data": 'listing_duration'
        },
        {
            "data": null,
            "className": 'center',
            "defaultContent": ''
        },
        {
            "data": null,
            "className": 'center',
            "defaultContent": '<a href="javascript:void(0);" class="editLink"><i title="edit" class="fas fa-edit" aria-hidden="true"></a>'
        }

        ],
        "order": [
            [1, 'asc']
        ],
        dom: 'Bfrtip',
        buttons: ['csv'],

        "createdRow": function (row, data, dataIndex) {
            if (data.status === '1') {
                $('td', row).eq(5).html("<label class='badge badge-success'>ON</label>");
            } else {
                $('td', row).eq(5).html("<label class='badge badge-warning'>OFF</label>");
            }
        },
        scrollX: true,
        scrollCollapse: true,
        autoWidth: true,
        paging: true,
    });


    $('#tbl_ListingsData tbody').off('click', '.deleteLink').on('click', '.deleteLink', function (e) {

        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();
        if (typeof (data_row) != "undefined") {
            if (confirm('Confirm delete')) {

                window.location.href = '#';

                $.ajax({
                    url: baseUrl + 'common/delete_from_table/tbl_listing_header/listing_id/' + data_row.listing_id,
                    type: 'POST',
                    data: {
                        [csrfName]: csrfHash
                    },
                    dataType: 'json',
                    success: function (data) {
                        $('.txt_csrfname').val(data.token);
                        loadListingHeaderData();
                    },
                    complete: function () { },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(thrownError);
                    }
                });
            }
        }
    });


    $('#tbl_ListingsData tbody').off('click', '.editLink').on('click', '.editLink', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();
        if (typeof (data_row) != "undefined") {
            $.ajax({
                url: baseUrl + 'common/get_selected_row/tbl_listing_header/listing_id/' + data_row.listing_id,
                type: 'POST',
                data: {
                    [csrfName]: csrfHash
                },
                dataType: 'json',
                success: function (data, json) {
                    $('.txt_csrfname').val(data.token);
                    document.getElementById("listing_name").value = data.response[0].listing_name;
                    //document.getElementById("tiny-editor").value = data.response[0].listing_description;
                    if (data.response[0].listing_description != "") {
                        //tinyMCE.get('tiny-editor').setContent(data.response[0].listing_description); 
                        tinyMCE.activeEditor.execCommand('mceInsertContent', false, data.response[0].listing_description);
                    }

                    document.getElementById("listing_id").value = data.response[0].listing_id;
                    document.getElementById("listing_price").value = data.response[0].listing_price;
                    document.getElementById("listing_duration").value = data.response[0].listing_duration;
                    document.getElementById("listing_discount").value = data.response[0].listing_discount;
                    $('.uploadButton-input-cover').next('label').text(data.response[0].listing_icon);
                    $('#listing_type').val(data.response[0].listing_type);
                    $('#listing_status').val(data.response[0].status);

                    $(this).closest('form').find("input[type=text], textarea").val("");
                    // loadListingHeaderData();
                    $("#btn_save").text("update");
                    $("html, body").animate({
                        scrollTop: 0
                    }, 2000);
                },
                complete: function () { },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(thrownError);
                }
            });
        }
    });

}


/*--------------------------------------------------*/
/* Load User data
/*--------------------------------------------------*/
function loadUserData() {
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    var table = $('#tbl_userdata').DataTable({
        destroy: true,
        "ajax": {
            "type": "GET",
            "url": baseUrl + 'common/get_table_data/tbl_users',
            "data": {
                [csrfName]: csrfHash
            },
            "success": function (data, json) {
                $('.txt_csrfname').val(data.token);
                getUserControlData(data.response);
            }
        }
    });
}

/*--------------------------------------------------*/
/*  Load User Controls
/*--------------------------------------------------*/

function getUserControlData(data) {
    var table = $('#tbl_userdata').DataTable({
        destroy: true,
        data: data,
        "columns": [{
            "data": 'user_id'
        },
        {
            "data": 'username'
        },
        {
            "data": 'email'
        },
        {
            "data": 'firstname'
        },
        {
            "data": 'user_ip'
        },
        {
            "data": 'user_status'
        },

        {
            "data": null,
            "className": 'center',
            "defaultContent": '<a href="javascript:void(0);" class="banUserClickdsdsdsa"><i class="fa fa-ban" aria-hidden="true"></a>'
        },
        {
            "data": null,
            "className": 'center',
            "defaultContent": '<a href="javascript:void(0);" class="activateClick"><i title="delete" class="fa fa-trash-alt" aria-hidden="true"></a>'
        },
        {
            "data": null,
            "className": 'text-center',
            "defaultContent": '<a href="javascript:void(0);" class="activateClick"><i title="Admin Permission"  aria-hidden="true"></a>'
        },
        {
            "data": null,
            "className": 'text-center',
            "defaultContent": '<a href="javascript:void(0);" class="activateClick"><i title="Membership-Level" aria-hidden="true"></a>'
        }
            ,
        {
            "data": null,
            "className": 'text-center',
            "defaultContent": '<a href="javascript:void(0);" class="activateClick"><i title="User Login" aria-hidden="true"></a>'
        }
        ],
        "order": [
            [1, 'asc']
        ],
        dom: 'Bfrtip',
        buttons: ['csv'],
        "createdRow": function (row, data, dataIndex) {
            if (typeof (data.user_status) !== "undefined") {
                $('td', row).eq(0).html("<a href='javascript:void(0);' onclick='assignBadge(" + data.user_id + ",\"" + data.firstname + "\"," + data.badge_id + ");'>" + data.user_id + "</a>");
                if (data.commission_type == '' || data.commission_type == null) {
                    data.commission_type = 0;
                }
                if (data.admin_commission == '' || data.admin_commission == null) {
                    data.admin_commission = 0
                }
                $('td', row).eq(1).html("<a href='javascript:void(0);' onclick='assignCommission(" + data.user_id + ",\"" + data.firstname + "\"," + data.commission_type + "," + data.admin_commission + ");'>" + data.username + "</a>");
                if (data.user_status == '1') {
                    $('td', row).eq(6).html("<a href='javascript:void(0);' class='banUserClick'><i title='Ban User' class='fa fa-ban'></i></a>");
                    $('td', row).eq(7).html("<a href='javascript:void(0);' class='activateClick'><i title='Activate User' class='fa fa-unlock fa-user-green'></i></a>");
                    $('td', row).eq(5).html("<label class='badge badge-info'>Inactive</label>");
                } else if (data.user_status == '2') {
                    $('td', row).eq(6).html("<a href='javascript:void(0);' class='banUserClick'><i title='Ban User' class='fa fa-ban'></i></a>");
                    $('td', row).eq(7).html("<a href='javascript:void(0);' class='inactiveClick'><i title='deactivate' class='fa fa-lock fa-user-green'></i></a>");
                    $('td', row).eq(5).html("<label class='badge badge-success'>Active</label>");
                } else if (data.user_status == '3') {
                    $('td', row).eq(6).html("<a href='' class='activateClick'><i title='remove ban' class='fas fa fa-check'></i></a>");
                    $('td', row).eq(7).html("<a href='' class='activateClick'><i title='activate' class='fa fa-unlock fa-user-green'></i></a>");
                    $('td', row).eq(5).html("<label class='badge badge-danger'>Banned</label>");
                } else if (data.user_status == '4') {
                    $('td', row).eq(6).html("<a href='javascript:void(0);' class='banUserClick'><i title='Ban User' class='fa fa-ban'></i></a>");
                    $('td', row).eq(7).html("<a href='javascript:void(0);' class='activateClick'><i title='activate' class='fa fa-unlock fa-user-green'></i></a>");
                    $('td', row).eq(5).html("<label class='badge badge-warning'>deactivated</label>");
                }
            }

            $('td', row).eq(8).html("<a href='javascript:void(0);' class='permissionUserClick '><i title='Permission' class='fa fa-user-circle-o'></i></a>");
            $('td', row).eq(9).html("<a href='javascript:void(0);' class='membershipLevel'><i title='Membership Level' class='fa fa-user-plus'></i></a>");

            $('td', row).eq(10).html("<a href='javascript:void(0);' class='userLogin'><i title='User Login' class='fa fa-sign-in'></i></a>");

        },
    });


    $('#tbl_userdata tbody').off('click', '.inactiveClick').on('click', '.inactiveClick', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();
        if (typeof (data_row) != "undefined") {

            if (confirm('Confirm User Deactivation')) {

                window.location.href = '#';
                $.ajax({
                    url: baseUrl + 'common/update_selected_data/tbl_users/user_status/1/user_id/' + data_row.user_id,
                    type: 'POST',
                    data: {
                        [csrfName]: csrfHash
                    },
                    dataType: 'json',
                    success: function (data) {
                        $('.txt_csrfname').val(data.token);
                        loadUserData();
                    },
                    complete: function () { },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(thrownError);
                    }
                });
            }
        }
    });


    $('#tbl_userdata tbody').off('click', '.activateClick').on('click', '.activateClick', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();
        if (typeof (data_row) != "undefined") {
            if (confirm('Confirm User Activation')) {
                window.location.href = '#';
                $.ajax({
                    url: baseUrl + 'common/update_selected_data/tbl_users/user_status/2/user_id/' + data_row.user_id,
                    type: 'POST',
                    data: {
                        [csrfName]: csrfHash
                    },
                    dataType: 'json',
                    success: function (data) {
                        $('.txt_csrfname').val(data.token);
                        loadUserData();
                    },
                    complete: function () { },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(thrownError);
                    }
                });
            }
        }
    });



    $('#tbl_userdata tbody').off('click', '.banUserClick').on('click', '.banUserClick', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();
        if (typeof (data_row) != "undefined") {
            if (confirm('Confirm User Ban')) {

                window.location.href = '#';
                $.ajax({
                    url: baseUrl + 'common/update_selected_data/tbl_users/user_status/3/user_id/' + data_row.user_id,
                    type: 'POST',
                    data: {
                        [csrfName]: csrfHash
                    },
                    dataType: 'json',
                    success: function (data) {
                        $('.txt_csrfname').val(data.token);
                        loadUserData();
                    },
                    complete: function () { },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(thrownError);
                    }
                });
            }
        }
    });


    $('#tbl_userdata tbody').off('click', '.permissionUserClick').on('click', '.permissionUserClick', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();
        if (typeof (data_row) != "undefined") {
            window.location.href = baseUrl + 'admin/admin_permissions/' + data_row['user_id'];
        }
    });

    $('#tbl_userdata tbody').off('click', '.membershipLevel').on('click', '.membershipLevel', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();
        if (typeof (data_row) != "undefined") {
            window.location.href = baseUrl + 'admin/membership-permissions/' + data_row['user_id'];
        }
    });

    $('#tbl_userdata tbody').off('click', '.userLogin').on('click', '.userLogin', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();
        if (typeof (data_row) != "undefined") {

            bootbox.confirm({
                message: 'Do You Want to Login With User Panel',
                buttons: {
                    confirm: {
                        label: 'Yes',
                        className: 'btn-warning'
                    },
                    cancel: {
                        label: 'No',
                        className: 'btn-dark'
                    }
                },
                callback: function (result) {
                    if (result == true) {
                        window.location.href = baseUrl + 'admin/user-login/' + data_row['user_id'];
                    }

                }
            });
        }


    });


}


/*--------------------------------------------------*/
/* Load Announcement Data
/*--------------------------------------------------*/
function loadAnnouncementData() {
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    var table = $('#tbl_announcementdata').DataTable({
        destroy: true,
        "ajax": {
            "type": "GET",
            "url": baseUrl + 'common/get_table_data/tbl_announcement',
            "data": {
                [csrfName]: csrfHash
            },
            "success": function (data, json) {
                $('.txt_csrfname').val(data.token);
                getAnnouncementData(data.response);
            }
        }
    });
}


/*--------------------------------------------------*/
/*  Announcement Data Controls
/*--------------------------------------------------*/
function getAnnouncementData(data) {
    var table = $('#tbl_announcementdata').DataTable({
        destroy: true,
        data: data,
        "columns": [{
            "data": 'id'
        },
        {
            "data": 'announcement_heading'
        },
        {
            "data": 'announcement_type'
        },
        {
            "data": 'group_id'
        },
        {
            "data": 'status'
        },
        {
            "data": null,
            "className": 'center',
            "defaultContent": '<a href="javascript:void(0);" class="activeClick"><i class="fa fa-ban" aria-hidden="true"></a>'
        },
        {
            "data": null,
            "className": 'center',
            "defaultContent": '<a href="javascript:void(0);" class="editLink"><i title="edit" class="fa fa-pencil-square-o" aria-hidden="true"></a>'
        },
        {
            "data": null,
            "className": 'center',
            "defaultContent": '<a href="javascript:void(0);" class="deleteLink"><i title="delete" class="fa fa-trash" aria-hidden="true"></a>'
        }
        ],
        "order": [
            [1, 'asc']
        ],
        dom: 'Bfrtip',
        buttons: ['csv'],
        "createdRow": function (row, data, dataIndex) {
            if (data.status == '1') {
                $('td', row).eq(5).html("<a href='' class='inactiveClick'><i title='deactivate' class='fa fa-lock fa-user-green'></i></a>");
                $('td', row).eq(4).html("<label class='badge badge-success'>Active</label>");
            } else if (data.status == '0') {
                $('td', row).eq(5).html("<a href='' class='activateClick'><i title='activate' class='fa fa-unlock fa-user-green'></i></a>");
                $('td', row).eq(4).html("<label class='badge badge-danger'>Inactive</label>");
            }
        },
    });


    $('#tbl_announcementdata tbody').off('click', '.deleteLink').on('click', '.deleteLink', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();
        if (typeof (data_row) != "undefined") {
            if (confirm('Confirm delete')) {

                window.location.href = '#';

                $.ajax({
                    url: baseUrl + 'common/delete_from_table/tbl_announcement/id/' + data_row.id,
                    type: 'POST',
                    data: {
                        [csrfName]: csrfHash
                    },
                    dataType: 'json',
                    success: function (data) {
                        $('.txt_csrfname').val(data.token);
                        loadAnnouncementData();
                    },
                    complete: function () { },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(thrownError);
                    }
                });
            }
        }
    });


    $('#tbl_announcementdata tbody').off('click', '.inactiveClick').on('click', '.inactiveClick', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();
        if (typeof (data_row) != "undefined") {
            if (confirm('Confirm Deactivation')) {

                window.location.href = '#';

                $.ajax({
                    url: baseUrl + 'common/update_selected_data/tbl_announcement/status/0/id/' + data_row.id,
                    type: 'POST',
                    data: {
                        [csrfName]: csrfHash
                    },
                    dataType: 'json',
                    success: function (data) {
                        $('.txt_csrfname').val(data.token);
                        loadAnnouncementData();
                    },
                    complete: function () { },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(thrownError);
                    }
                });
            }
        }
    });

    $('#tbl_announcementdata tbody').off('click', '.activateClick').on('click', '.activateClick', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();
        if (typeof (data_row) != "undefined") {
            if (confirm('Confirm Activation')) {

                window.location.href = '#';

                $.ajax({
                    url: baseUrl + 'common/update_selected_data/tbl_announcement/status/1/id/' + data_row.id,
                    type: 'POST',
                    data: {
                        [csrfName]: csrfHash
                    },
                    dataType: 'json',
                    success: function (data) {
                        $('.txt_csrfname').val(data.token);
                        loadAnnouncementData();
                    },
                    complete: function () { },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(thrownError);
                    }
                });
            }
        }
    });

    $('#tbl_announcementdata tbody').off('click', '.editLink').on('click', '.editLink', function (e) {
        e.preventDefault();

        var data_row = table.row($(this).closest('tr')).data();
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();
        if (typeof (data_row) != "undefined") {

            $.ajax({
                url: baseUrl + 'common/get_selected_row/tbl_announcement/id/' + data_row.id,
                type: 'POST',
                dataType: 'json',
                data: {
                    [csrfName]: csrfHash
                },
                dataType: 'json',
                success: function (data, json) {
                    $('.txt_csrfname').val(data.token);
                    document.getElementById("txt_announcement_heading").value = data.response[0].announcement_heading;
                    document.getElementById("txt_announcement").value = data.response[0].announcement;
                    document.getElementById("announcement_type").value = data.response[0].announcement_type;
                    dataArr = data.response[0].group_id;
                    if (dataArr.length > 0) {
                        $('#visibility_group').val(dataArr);
                        $('#visibility_group').trigger('change');
                    }
                    $('#visibility_status').val(data.response[0].status);
                    document.getElementById("txt_announcement_id").value = data.response[0].id;
                },
                complete: function () { },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(thrownError);
                }
            });
        }
    });
}

/*--------------------------------------------------*/
/* Load Payments Data
/*--------------------------------------------------*/
function loadPaymentsData() {
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    var table = $('#tbl_paymentsdata').DataTable({
        destroy: true,
        "ajax": {
            "type": "GET",
            "url": baseUrl + 'common/get_table_data/tbl_payments',
            "data": {
                [csrfName]: csrfHash
            },
            "success": function (data, json) {
                $('.txt_csrfname').val(data.token);
                getPaymentsData(data.response);
            }
        }
    });
}

/*--------------------------------------------------*/
/*  Payments Data Controls
/*--------------------------------------------------*/
function getPaymentsData(data) {
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    $.getJSON(baseUrl + 'common/get_table_data/tbl_users', {
        [csrfName]: csrfHash
    }, function (userData) {
        var table = $('#tbl_paymentsdata').DataTable({
            destroy: true,
            data: data,
            "columns": [{
                "data": 'PAYMENT_ID'
            },
            {
                "data": 'USER_ID'
            },
            {
                "data": 'ACK'
            },
            {
                "data": 'AMOUNT'
            },
            {
                "data": 'PLAN_ID'
            },
            {
                "data": 'METHOD'
            },
            {
                "data": 'TIMESTAMP'
            },
            ],
            "order": [
                [1, 'asc']
            ],
            dom: 'Bfrtip',
            buttons: [{
                "extend": 'csv',
                "text": 'CSV',
                "className": 'btn btn-success btn-xs'
            }],
            "createdRow": function (row, data, dataIndex) {
                $('td', row).eq(1).html(userData.response.filter(p => p.user_id === data.USER_ID)[0].username);
                if (data.ACK == 'Success') {
                    $('td', row).eq(2).html("<label class='badge badge-success'>Success</label>");
                } else {
                    $('td', row).eq(2).html("<label class='badge badge-danger'>" + data.ACK + "</label>");
                }
            },
        });
    });
}


/*--------------------------------------------------*/
/* Load Sponsored & Regular Listings
/*--------------------------------------------------*/
function loadAnyListingsData() {
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    var table = $('#tbl_anylistings').DataTable({
        destroy: true,
        "ajax": {
            "type": "GET",
            "url": baseUrl + 'common/get_table_data/tbl_purchases',
            "data": {
                [csrfName]: csrfHash
            },
            "success": function (data, json) {
                $('.txt_csrfname').val(data.token);
                getAnyListingsData(data.response);
            }
        }
    });
}

/*--------------------------------------------------*/
/*  Sponsored & Regular Listings Data Controls
/*--------------------------------------------------*/
function getAnyListingsData(data) {
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    $.getJSON(baseUrl + 'common/get_table_data/tbl_purchases', {
        [csrfName]: csrfHash
    }, function (userData) {
        $('.txt_csrfname').val(data.token);
        var table = $('#tbl_anylistings').DataTable({
            destroy: true,
            data: data,
            "columns": [{
                "data": 'invoice_id'
            },
            {
                "data": 'listing_type'
            },
            {
                "data": 'purchase_date'
            },
            {
                "data": 'expire_date'
            }
            ],
            "order": [
                [1, 'asc']
            ],
            dom: 'Bfrtip',
            buttons: [{
                "extend": 'csv',
                "text": 'CSV',
                "className": 'btn btn-success btn-xs'
            }],
            "createdRow": function (row, data, dataIndex) { },
        });
    });
}


/*--------------------------------------------------*/
/* Load Withdrawals
/*--------------------------------------------------*/
function loadWithdrawalsData(status) {
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    var table = $('#tbl_withdrawals').DataTable({
        destroy: true,
        "ajax": {
            "type": "GET",
            "url": baseUrl + 'common/withdrawals_data/' + status,
            "data": {
                [csrfName]: csrfHash
            },
            "success": function (data, json) {
                $('.txt_csrfname').val(data.token);
                getWithdrawalsData(data.response);
            }
        }
    });
}

/*--------------------------------------------------*/
/*  Withdrawals Data Controls
/*--------------------------------------------------*/
function getWithdrawalsData(data) {
    var table = $('#tbl_withdrawals').DataTable({
        destroy: true,
        data: data,
        "columns": [{
            "data": 'withdrawal_id'
        },
        {
            "data": 'username'
        },
        {
            "data": 'methodw'
        },
        {
            "data": 'final_amount'
        },
        {
            "data": 'fee'
        },
        {
            "data": 'created_date'
        },
        {
            "data": 'statusw'
        },
        {
            "data": null,
            "className": 'center',
            "defaultContent": '<a href="" class="inactiveClick"><i title="Reject Request" class="fa fa-ban" aria-hidden="true"></a>'
        },
        {
            "data": null,
            "className": 'center',
            "defaultContent": '<a href="" class="activeClick"><i title="Mark as Completed" class="fa fa-check" aria-hidden="true"></a>'
        },
        ],
        "order": [
            [1, 'asc']
        ],
        dom: 'Bfrtip',
        buttons: ['csv'],
        "createdRow": function (row, data, dataIndex) {
            $('td', row).eq(2).html("<a href='#' class='viewUser'>" + data.methodw + "</a>");
            if (data.statusw === '0') {
                $('td', row).eq(7).html('<a href="" class="inactiveClick"><i title="Reject Request" class="fa fa-ban" aria-hidden="true"></a>');
                $('td', row).eq(8).html('<a href="" class="activeClick"><i title="Mark as Completed" class="fa fa-check" aria-hidden="true"></a>');
                $('td', row).eq(6).html("<label class='badge badge-info'>Pending for Approval</label>");
            } else if (data.statusw === '2') {
                $('td', row).eq(7).html("");
                $('td', row).eq(8).html("");
                $('td', row).eq(6).html("<label class='badge badge-success'>Paid</label>");
            } else if (data.statusw === '3') {
                $('td', row).eq(7).html("");
                $('td', row).eq(8).html("");
                $('td', row).eq(6).html("<label class='badge badge-danger'>Rejected</label>");
            }
        },
    });

    $('#tbl_withdrawals tbody').off('click', '.viewUser').on('click', '.viewUser', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        if (typeof (data_row) != "undefined") {
            $('#paypal_email').val(data_row.paypal);
            $('#payoneer_email').val(data_row.payoneer);
            $('#bank_accountname').val(data_row.bank_transfer);
            $('#modal-userpaymentinfo').modal('show');
        }
    });


    $('#tbl_withdrawals tbody').off('click', '.inactiveClick').on('click', '.inactiveClick', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();
        if (typeof (data_row) != "undefined") {
            if (confirm('Confirm Withdrawal Request Rejection ?')) {

                window.location.href = '#';
                $('#loaderapp').show();
                $.ajax({
                    url: baseUrl + 'common/update_selected__withdrawal/tbl_withdrawals/status/3/id/' + data_row.id,
                    type: 'POST',
                    data: {
                        [csrfName]: csrfHash
                    },
                    dataType: 'json',
                    success: function (data) {
                        $('.txt_csrfname').val(data.token);
                        $('#loaderapp').hide();
                        loadWithdrawalsData();
                    },
                    complete: function () {
                        $('#loaderapp').hide();
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(thrownError);
                    }
                });
            }
        }
    });

    $('#tbl_withdrawals tbody').off('click', '.activeClick').on('click', '.activeClick', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();
        if (typeof (data_row) != "undefined") {
            if (confirm('Confirm Withdrawal Request Approval ?')) {

                window.location.href = '#';
                $('#loaderapp').show();
                $.ajax({
                    url: baseUrl + 'common/update_selected__withdrawal/tbl_withdrawals/status/2/id/' + data_row.id,
                    type: 'POST',
                    data: {
                        [csrfName]: csrfHash
                    },
                    dataType: 'json',
                    success: function (data) {
                        $('.txt_csrfname').val(data.token);
                        $('#loaderapp').hide();
                        loadWithdrawalsData();
                        $('#loaderapp').hide();
                    },
                    complete: function () { },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(thrownError);
                    }
                });
            }
        }
    });
}


/*--------------------------------------------------*/
/* Load Reported Data
/*--------------------------------------------------*/
function loadReportedData(status) {
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    var table = $('#tbl_ReportedData').DataTable({
        destroy: true,
        "ajax": {
            "type": "GET",
            "url": baseUrl + 'common/get_reported_data/tbl_reports',
            "data": {
                [csrfName]: csrfHash
            },
            "success": function (data, json) {
                $('.txt_csrfname').val(data.token);
                getReportedData(data.response);
            }
        }
    });
}

/*--------------------------------------------------*/
/*  Reported Data Controls
/*--------------------------------------------------*/
function getReportedData(data) {
    var table = $('#tbl_ReportedData').DataTable({
        destroy: true,
        data: data,
        "columns": [{
            "data": 'website_BusinessName'
        },
        {
            "data": 'username'
        },
        {
            "data": 'reason'
        },
        {
            "data": null,
            "className": 'center',
            "defaultContent": '<a href="" class="inactiveClick"><i title="Reject Request" class="fa fa-ban" aria-hidden="true"></a>'
        },
        {
            "data": null,
            "className": 'center',
            "defaultContent": '<a href="" class="activeClick"><i title="Mark as Completed" class="fa fa-check" aria-hidden="true"></a>'
        },
        ],
        "order": [
            [1, 'asc']
        ],
        dom: 'Bfrtip',
        buttons: ['csv'],
        "createdRow": function (row, data, dataIndex) {
            if (data.statusw === '0') {
                $('td', row).eq(7).html('<a href="" class="inactiveClick"><i title="Reject Request" class="fa fa-ban" aria-hidden="true"></a>');
                $('td', row).eq(8).html('<a href="" class="activeClick"><i title="Mark as Completed" class="fa fa-check" aria-hidden="true"></a>');
                $('td', row).eq(6).html("<label class='badge badge-info'>Pending for Approval</label>");
            }

        },
    });


    $('#tbl_ReportedData tbody').off('click', '.inactiveClick').on('click', '.inactiveClick', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();
        if (typeof (data_row) != "undefined") {
            if (confirm('Reject Listing Complaint ?')) {

                window.location.href = '#';

                $.ajax({
                    url: baseUrl + 'common/reject_complaint/' + data_row.id,
                    type: 'POST',
                    data: {
                        [csrfName]: csrfHash
                    },
                    dataType: 'json',
                    success: function (data) {
                        $('.txt_csrfname').val(data.token);
                        loadReportedData();
                    },
                    complete: function () { },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(thrownError);
                    }
                });
            }
        }
    });

    $('#tbl_ReportedData tbody').off('click', '.activeClick').on('click', '.activeClick', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        if (typeof (data_row) != "undefined") {
            if (confirm('Accept Listing Complaint & Delete this listing?')) {

                window.location.href = '#';

                $.ajax({
                    url: baseUrl + 'common/accept_complaint/' + data_row.id,
                    type: 'POST',
                    data: {
                        [csrfName]: csrfHash
                    },
                    dataType: 'json',
                    success: function (data) {
                        $('.txt_csrfname').val(data.token);
                        loadReportedData();
                    },
                    complete: function () { },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(thrownError);
                    }
                });
            }
        }
    });
}

/*--------------------------------------------------*/
/* Load Languages
/*--------------------------------------------------*/
function loadLanguageData() {
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    var table = $('#tbl_languages').DataTable({
        destroy: true,
        "ajax": {
            "type": "GET",
            "url": baseUrl + 'common/get_table_data/tbl_languages',
            "data": {
                [csrfName]: csrfHash
            },
            "success": function (data, json) {
                $('.txt_csrfname').val(data.token);
                getLanguageData(data.response);
            }
        }
    });
}

/*--------------------------------------------------*/
/* Languages Data Controls
/*--------------------------------------------------*/
function getLanguageData(data) {

    var table = $('#tbl_languages').DataTable({
        destroy: true,
        data: data,
        "columns": [{
            "data": 'language'
        },
        {
            "data": 'language_code'
        },
        {
            "data": null,
            "className": 'center',
            "defaultContent": ''
        },
        {
            "data": null,
            "className": 'center',
            "defaultContent": '<a href="" class="editLink"><i class="fa fa-pencil-square-o" aria-hidden="true"></a>'
        },
        {
            "data": null,
            "className": 'center',
            "defaultContent": '<a href="" class="deleteLink"><i class="fa fa fa-trash" aria-hidden="true"></a>'
        },
        {
            "data": null,
            "className": 'center',
            "defaultContent": '<a href="" class="defaultLanguage">Set Default</a>'
        }
        ],
        "order": [
            [1, 'asc']
        ],
        dom: 'Bfrtip',
        buttons: [
            'csv'
        ],
        "createdRow": function (row, data, dataIndex) {

            if (data.language_code !== 'en') {

                if (data.status == '1') {
                    $('td', row).eq(2).html("<label class='badge badge-success'>" + 'Active' + "</label>");
                } else {
                    $('td', row).eq(2).html("<label class='badge badge-danger'>" + 'Inactive' + "</label>");
                }

                if (data.default_status == '1') {
                    $('td', row).eq(5).html("Default");
                }
            } else {
                $('td', row).eq(2).html("<label class='badge badge-success'>" + 'Active' + "</label>");
                $('td', row).eq(3).html("");
                $('td', row).eq(4).html("");

                if (data.default_status == '1') {
                    $('td', row).eq(5).html("Default");
                }
            }
        },
    });


    $('#tbl_languages tbody').off('click', '.deleteLink').on('click', '.deleteLink', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();
        if (typeof (data_row) != "undefined") {
            if (data_row.language_code !== 'en' && data_row.default_status !== '1') {
                if (confirm('Confirm delete post')) {

                    window.location.href = '#';

                    $.ajax({
                        url: baseUrl + 'common/delete__language_from_table/tbl_languages/id/' + data_row.id,
                        type: 'POST',
                        data: {
                            [csrfName]: csrfHash
                        },
                        dataType: 'json',
                        success: function (data) {
                            $('.txt_csrfname').val(data.token);
                            loadLanguageData();
                        },
                        complete: function () {

                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            alert(thrownError);
                        }
                    });
                }
            } else {
                confirm('Sorry !! You Cannot Delete Deafult Language');
            }
        }
    });


    $('#tbl_languages tbody').off('click', '.defaultLanguage').on('click', '.defaultLanguage', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();
        if (typeof (data_row) != "undefined") {
            if (confirm('Set ' + data_row.language + ' language as Default?')) {
                window.location.href = '#';
                $.ajax({
                    url: baseUrl + 'common/set_default_language/' + data_row.id,
                    type: 'POST',
                    data: {
                        [csrfName]: csrfHash
                    },
                    dataType: 'json',
                    success: function (data) {
                        $('.txt_csrfname').val(data.token);
                        loadLanguageData();
                    },
                    complete: function () { },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(thrownError);
                    }
                });
            }
        }
    });


    $('#tbl_languages tbody').off('click', '.editLink').on('click', '.editLink', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();
        if (typeof (data_row) != "undefined") {
            $.ajax({
                url: baseUrl + 'common/get_selected_row/tbl_languages/id/' + data_row.id,
                type: 'POST',
                dataType: 'json',
                data: {
                    [csrfName]: csrfHash
                },
                dataType: 'json',
                success: function (data, json) {
                    $('.txt_csrfname').val(data.token);
                    document.getElementById("language_id").value = data.response[0].id;
                    document.getElementById("language_code").value = data.response[0].language_code;
                    document.getElementById("language_name").value = data.response[0].language;
                    $('#language_active').val(data.response[0].status).change();
                    $('#default_status').val(data.response[0].default_status).change();
                    document.getElementById("language_code").disabled = false;
                    document.getElementById("language_name").disabled = false;
                    document.getElementById("language_icon").disabled = false;
                    document.getElementById("language_active").disabled = false;
                    document.getElementById('language_button').innerHTML = 'Save Changes';

                },
                complete: function () { },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(thrownError);
                }
            });
        }
    });
}


function bootboxConfirm(url, csrfName, csrfHash, loadData) {
    if (loadData == undefined) {
        loadData = '';
    }

    bootbox.confirm({
        message: "Confirm !! Do You Want to Delete" + ":  <b>" + loadData + "<b>",
        buttons: {
            confirm: {
                label: 'Yes',
                className: 'btn-warning'
            },
            cancel: {
                label: 'No',
                className: 'btn-dark'
            }
        },
        callback: function (result) {
            if (result == true) {
                // window.location.href = '#';
                //console.log(url);
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        [csrfName]: csrfHash
                    },
                    dataType: 'json',
                    success: function (data) {
                        console.log(data);
                        $('.txt_csrfname').val(data.token);
                        if (data.response == 1) {
                            bootAlert(deleteRecord + " - <b>" + loadData + "<b>");
                        } else {
                            bootAlert(usedRecord + " - <b>" + data.type + "<b>");
                        }
                    },
                    complete: function () { },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(thrownError);
                    }
                });
            }
        }
    });
}

function bootAlert(message = "", fun = "") {
    bootbox.alert({
        message: message,
        closeButton: false,
        buttons: {
            ok: {
                label: "Ok",
                className: "btn-dark",
            }
        },
        callback: function () {
            location.reload();
        }
    });
}

function loadBadgesData() {
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    var table = $('#tbl_badgesData').DataTable({
        destroy: true,
        "ajax": {
            "type": "GET",
            "url": baseUrl + 'common/get_table_data_order/tbl_badges',
            "data": {
                [csrfName]: csrfHash
            },
            "success": function (data, json) {
                $('.txt_csrfname').val(data.token);
                getBadgeData(data.response);
            }
        }
    });
}
function getBadgeData(data) {
    var table = $('#tbl_badgesData').DataTable({
        destroy: true,
        data: data,
        "columns": [{
            "data": 'name'
        },
        {
            "data": null,
            "className": 'center',
            "defaultContent": ''
        },
        {
            "data": null,
            "className": 'center',
            "defaultContent": '<a href="javascript:void(0);" class="editLink"><i title="edit" class="fas fa-edit" aria-hidden="true"></a>'
        },
        {
            "data": null,
            "className": 'center',
            "defaultContent": '<a href="javascript:void(0);" class="deleteLink"><i title="delete" class="fa fa-trash" aria-hidden="true"></a>'
        }

        ],


        "createdRow": function (row, data, dataIndex) {

            if (data.icon !== '') {
                $('td', row).eq(1).html("<img width='30' src='" + baseUrl + 'assets/img/categories/' + data.icon + "' class='img-fluid img-thumbnail'> </a>");
            } else {
                $('td', row).eq(1).html("N/A");
            }
        },
        ordering: false,
        scrollX: true,
        scrollCollapse: true,
        autoWidth: true,
        paging: true,
    });
    $('#tbl_badgesData tbody').off('click', '.deleteLink').on('click', '.deleteLink', function (e) {

        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();
        if (typeof (data_row) != "undefined") {
            if (typeof (data_row) != "undefined") {
                bootboxConfirm(baseUrl + 'common/check_delete_from_table/tbl_badges/id/' + data_row.id +
                    "/tbl_listings", csrfName, csrfHash, data_row.c_name);

            }
        }
    });

    $('#tbl_badgesData tbody').off('click', '.editLink').on('click', '.editLink', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();
        if (typeof (data_row) != "undefined") {
            $.ajax({
                url: baseUrl + 'common/get_selected_row/tbl_badges/id/' + data_row.id,
                type: 'POST',
                data: {
                    [csrfName]: csrfHash
                },
                dataType: 'json',
                success: function (data, json) {
                    $('.txt_csrfname').val(data.token);
                    document.getElementById("name").value = data.response[0].name;
                    document.getElementById("id").value = data.response[0].id;
                    $("#btn_save").text("update");
                    $("html, body").animate({
                        scrollTop: 0
                    }, 2000);
                },
                complete: function () {
                    $("btn_categorysave").val("Update");
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(thrownError);
                }
            });
        }
    });


}
function assignBadge(userId, userFirstName, badge_id) {
    $('.mdlRdoBtn').removeAttr('checked');
    $('#assignBadgeModalH3').text('Assign Badge to ' + userFirstName);
    $('#modalUserId').val(userId);
    $("#badgeRd" + badge_id).prop("checked", true);
    $('#assignBadgeModal').modal();
}

// check assign commission to user 
function assignCommission(userId, userFirstName, commission_type, admin_commission) {
    // make clear every field 
    $('.commissionRd1').removeAttr('checked');
    $('.commissionRd2').removeAttr('checked');
    $('.submit-field').closest('.modal-body').find('span').remove('span');
    $("#commissionTxt").val('')
    // set value it has
    $('#setCommissionH3').text('Set Commission to ' + userFirstName);
    $('#commissionUserId').val(userId);

    console.log(commission_type);
    console.log(admin_commission);


    if (commission_type != '' && commission_type != null) {
        if (commission_type == 1) {
            $(".commissionRd1").prop("checked", true);
        } else if (commission_type == 2) {
            $(".commissionRd2").prop("checked", true);
        }

    }
    if (admin_commission != '' && admin_commission != null) {
        if (admin_commission != 0) {
            $("#commissionTxt").val(admin_commission)
        }
    }
    $('#setCommission').modal();
}

// form validation in commission submit form
$(document).on('submit', '#commissionForm', function (e) {
    e.preventDefault();
    var form = $(this);
    form.validate();
    if (form.valid()) {
        $('#commissionForm')[0].submit();
    }
    return false;


});


/*manage advertisement module*/
function loadManageAdvertisementsData() {
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    var table = $('#tbl_manageAdvertisementData').DataTable({
        destroy: true,
        "ajax": {
            "type": "GET",
            "url": baseUrl + 'common/get_table_data_order/tbl_advertisement',
            "data": {
                [csrfName]: csrfHash
            },
            "success": function (data, json) {
                $('.txt_csrfname').val(data.token);
                getAdvertData(data.response);
            }
        }
    });
}
function getAdvertData(data) {
    var table = $('#tbl_manageAdvertisementData').DataTable({
        destroy: true,
        data: data,
        "columns": [{
            "data": 'type'
        },
        {
            "data": null,
            "className": 'center',
            "defaultContent": ''
        },
        {
            "data": null,
            "className": 'center',
            "defaultContent": '<a href="javascript:void(0);" class="deleteLink"><i title="delete" class="fa fa-trash" aria-hidden="true"></a>'
        }

        ],


        "createdRow": function (row, data, dataIndex) {

            if (data.type == "text_below_main_menu") {
                $('td', row).eq(1).html(data.text_or_icon);
            } else if (data.text_or_icon !== '') {
                $('td', row).eq(1).html("<img width='100' src='" + baseUrl + 'assets/img/categories/' + data.text_or_icon + "' class='img-fluid img-thumbnail'> </a>");
            } else {
                $('td', row).eq(1).html("N/A");
            }
        },
        ordering: false,
        scrollX: true,
        scrollCollapse: true,
        autoWidth: true,
        paging: true,
    });
    $('#tbl_manageAdvertisementData tbody').off('click', '.deleteLink').on('click', '.deleteLink', function (e) {

        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();
        if (typeof (data_row) != "undefined") {
            if (typeof (data_row) != "undefined") {
                bootboxConfirm(baseUrl + 'common/check_delete_from_table/tbl_advertisement/id/' + data_row.id +
                    "/tbl_listings", csrfName, csrfHash, data_row.c_name);

            }
        }
    });
}
function loadEmailSubscribersData() {
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    var table = $('#tbl_subscribersData').DataTable({
        destroy: true,
        "ajax": {
            "type": "GET",
            "url": baseUrl + 'common/get_table_data_order/tbl_email_subscriber',
            "data": {
                [csrfName]: csrfHash
            },
            "success": function (data, json) {
                $('.txt_csrfname').val(data.token);
                getEmailSubscribersData(data.response);
            }
        }
    });
}
function getEmailSubscribersData(data) {
    var table = $('#tbl_subscribersData').DataTable({
        destroy: true,
        data: data,
        "columns": [{
            "data": 'first_name'
        },
        {
            "data": 'last_name'
        },
        {
            "data": 'email'
        },
        {
            "data": 'created_at'
        },
        {
            "data": null,
            "className": 'center',
            "defaultContent": '<a href="javascript:void(0);" class="deleteLink"><i title="delete" class="fa fa-trash" aria-hidden="true"></a>'
        }

        ],
        "createdRow": function (row, data, dataIndex) {


        },
        ordering: false,
        scrollX: true,
        scrollCollapse: true,
        autoWidth: true,
        paging: true,
    });
    $('#tbl_subscribersData tbody').off('click', '.deleteLink').on('click', '.deleteLink', function (e) {

        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();
        if (typeof (data_row) != "undefined") {
            if (typeof (data_row) != "undefined") {
                bootboxConfirm(baseUrl + 'common/check_delete_from_table/tbl_email_subscriber/id/' + data_row.id +
                    "/tbl_listings", csrfName, csrfHash, data_row.c_name);

            }
        }
    });
}
function loadCouponsData() {
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    var table = $('#tbl_couponsData').DataTable({
        destroy: true,
        "ajax": {
            "type": "GET",
            "url": baseUrl + 'common/get_table_data_order/tbl_coupons',
            "data": {
                [csrfName]: csrfHash
            },
            "success": function (data, json) {
                $('.txt_csrfname').val(data.token);
                getCouponData(data.response);
            }
        }
    });
}
function getCouponData(data) {
    var table = $('#tbl_couponsData').DataTable({
        destroy: true,
        data: data,
        "columns": [

            {
                "data": 'discount_type'
            },
            {
                "data": 'amount'
            },
            {
                "data": 'discount_code'
            },
            {
                "data": null,
                "className": 'center',
                "defaultContent": 'Valid'
            },
            {
                "data": 'status'
            },
            {
                "data": 'created_date'
            },
            {
                "data": null,
                "className": 'center',
                "defaultContent": '<a href="javascript:void(0);" class="editLink"><i title="edit" class="fas fa-edit" aria-hidden="true"></a>'
            },
            {
                "data": null,
                "className": 'center',
                "defaultContent": '<a href="javascript:void(0);" class="deleteLink"><i title="delete" class="fa fa-trash" aria-hidden="true"></a>'
            }
        ],


        "createdRow": function (row, data, dataIndex) {

            $('td', row).eq(5).html(data.valid_from + ' - ' + data.valid_till);

            if (data.discount_type == 1) {
                $('td', row).eq(0).html("Fixed Amount");
            } else {
                $('td', row).eq(0).html("Percentage");
            }

            if (data.status == 1) {
                $('td', row).eq(4).html("On");
            } else {
                $('td', row).eq(4).html("Disabled");
            }
        },
        ordering: false,
        scrollX: true,
        scrollCollapse: true,
        autoWidth: true,
        paging: true,
    });
    $('#tbl_couponsData tbody').off('click', '.deleteLink').on('click', '.deleteLink', function (e) {

        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();
        if (typeof (data_row) != "undefined") {
            if (typeof (data_row) != "undefined") {
                bootboxConfirm(baseUrl + 'common/check_delete_from_table/tbl_coupons/id/' + data_row.id +
                    "/tbl_listings", csrfName, csrfHash, data_row.c_name);

            }
        }
    });

    $('#tbl_couponsData tbody').off('click', '.editLink').on('click', '.editLink', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();
        if (typeof (data_row) != "undefined") {
            $.ajax({
                url: baseUrl + 'common/get_selected_row/tbl_coupons/id/' + data_row.id,
                type: 'POST',
                data: {
                    [csrfName]: csrfHash
                },
                dataType: 'json',
                success: function (data, json) {
                    $('.txt_csrfname').val(data.token);
                    document.getElementById("amount").value = data.response[0].amount;
                    document.getElementById("discount_code").value = data.response[0].discount_code;
                    document.getElementById("valid_from").value = data.response[0].valid_from;
                    document.getElementById("valid_till").value = data.response[0].valid_till;

                    if (data.response[0].discount_type == 0) {
                        $('#discountPercentage').attr('checked', true);
                        $('#discountFixed').attr('checked', false);
                    } else {
                        $('#discountFixed').attr('checked', true);
                        $('#discountPercentage').attr('checked', false);
                    }

                    document.getElementById("id").value = data.response[0].id;
                    $("#btn_save").text("update");
                    $("html, body").animate({
                        scrollTop: 0
                    }, 2000);
                },
                complete: function () {
                    $("btn_categorysave").val("Update");
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(thrownError);
                }
            });
        }
    });


}


function loadPageTagsData() {
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    var table = $('#tbl_pagesTagData').DataTable({
        destroy: true,
        "ajax": {
            "type": "GET",
            "url": baseUrl + 'common/get_user_surfing_pages',
            "data": {
                [csrfName]: csrfHash
            },
            "success": function (data, json) {
                $('.txt_csrfname').val(data.token);
                getPageTagsData(data.response);
            }
        }
    });
}


/*--------------------------------------------------*/
/*  Pages Control
/*--------------------------------------------------*/

function getPageTagsData(data) {
    var table = $('#tbl_pagesTagData').DataTable({
        destroy: true,
        data: data,
        "columns": [{
            "data": 'username'
        },
        {
            "data": 'user_ip'
        },
        {
            "data": 'page'
        },
        {
            "data": 'tags'
        },

        {
            "data": null,
            "className": 'center',
            "defaultContent": '<a href="" class="deleteLink"><i title="delete" class="fa fa-trash" aria-hidden="true"></a>'
        }
        ],


        "order": [
            [1, 'asc']
        ],
        dom: 'Bfrtip',
        buttons: ['csv'],
        bFilter: false,
        bInfo: false,
        "createdRow": function (row, data, dataIndex) {
            if (data.username != '') {
                $('td', row).eq(0).html(data.username);
            } else {
                $('td', row).eq(0).html("Guest");
            }

        },
        ordering: false,
        scrollX: true,
        scrollCollapse: true,
        autoWidth: true,
        paging: true
    });


    $('#tbl_pagesTagData tbody').off('click', '.deleteLink').on('click', '.deleteLink', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val();
        if (typeof (data_row) != "undefined") {
            if (confirm('Confirm delete')) {
                $.ajax({
                    url: baseUrl + 'common/delete_from_table/tbl_user_surfing_pages/id/' + data_row.id,
                    type: 'POST',
                    data: {
                        [csrfName]: csrfHash
                    },
                    dataType: 'json',
                    success: function (data) {
                        $('.txt_csrfname').val(data.token);
                        loadPageTagsData();
                    },
                    complete: function () { },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(thrownError);
                    }
                });
            }
        }
    });
}