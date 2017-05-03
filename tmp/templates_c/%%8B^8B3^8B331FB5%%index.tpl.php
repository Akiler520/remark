<?php /* Smarty version 2.6.18, created on 2017-05-03 17:36:00
         compiled from material/index.tpl */ ?>

<table width="600" border="0" align="center" cellpadding="5" cellspacing="0">
    <tr>
        <td height="22"></td>
    </tr>
</table>

<table width="600" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF" style="border:1px solid #111111;">
    <tr>
        <td height="600">
            <BR><BR>
            <form id="admin-source-form-add" name="admin-source-form-add" method="post">
                <input name="snapshot" type="hidden" id="snapshot">
                <input name="snapshot_hash" type="hidden" id="snapshot_hash">

                <div class="DivUp">

                    <div class="row">
                        <input type="file" name="fileBarSnapshot" style="width: 200px;" id="fileBarSnapshot" multiple="multiple"/>
                        <a id="btn-upload-snapshot" style=" display:none" href="#" class="easyui-linkbutton" data-options="iconCls:'icon-save'">Upload</a>

                    </div>
                    <div id="" style="display: ;">
                        <div id="progress-bar-snapshot" class="easyui-progressbar" style="width: 400px; float: left; display: none;">
                        </div>
                    </div>
                </div>
            </form>
            <BR><BR>
            <BR>
        </td>
    </tr>
</table>

<?php echo '
    <script type="text/javascript">
        $(document).ready(function(){
            AdminSource.snapshotUpload("#admin-source-form-add");
        });
    </script>
'; ?>