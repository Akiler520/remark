var AdminSource = {
    listID: '#admin-data-source-list'
};

AdminSource.snapshotUpload = function(formID, isUpdate)
{
    var site_path = $("#_yovim_site_path").val();

    var postData = new Array([]);

    var url = site_path+"material/addImage";

    if(isUpdate){
        postData['id'] = $(formID).find("input[name='id']").val();
        url = site_path+"material/editImage";
    }

    $(formID).find('#fileBarSnapshot').YovUpload({
        url         : url,
        mainID      : formID,
        progressBar : '#progress-bar-snapshot',
        triggerBtn  : '#btn-upload-snapshot',
        cancelBtn   : '#progress-cancel-snapshot',
        fileType    : ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'rar'],
        postData    : postData,
        maxSize     : 200,
        isUnique    : true,
        isUpdate    : isUpdate,
        onSuccess   : function(data){
            AdminMessager.show(data.status, data.msg);

            if(data.status == 1){
                $(formID).find('#snapshot').val(data.data.filename);
            }
        },
        uniqueCheck : function(hashCode, callBack){
            AdminSource.uniqueCheck(formID, hashCode, "snapshot", callBack);
        }
    });
};

AdminSource.uniqueCheck = function(formID, hashCode, type, callBack)
{
    var data_check = 'hash='+hashCode+"&type="+type;

    // send md5 hash to server, and check if the file exist, if not exist, upload, or skip
    $.AimsProcess.run({
        name    : AdminSource.listID,
        keyword : 'sourceUniqueCheck',
        url     : Config.rootPath+'material/uniqueCheck/',
        data    : data_check,
        success :function(rs)
        {
            if(rs.status == 1){
                // not exist
                if(rs.data.count <= 0){
                    // set the hash code to the form in order to be submit
                    $(formID).find('#'+type+'_hash').val(hashCode);

                    // call back process
                    callBack();
                }else{
                    // file exist, the new source will use it

                    AdminMessager.show(2, "Oh goodness, you have the same file with SERVER, you can free to use the one on SERVER.");
                }
            }else{
                AdminMessager.show(0, "Unique check error, try again please!");
            }
        }
    });
};