
var AdminMessager = {};

/**
 * messager
 * type: 0=error, 1=info, 2=warning
 *
 * @param type
 * @param info
 */
AdminMessager.show = function(type, info){
    switch (type){
        case 0: // error info, don't close automatically
            $.messager.alert("Error", info, 'error');
            break;
        case 1: // info, close it in 2 seconds automatically
            $.messager.show({
                title   : "Message",
                msg     : info,
                showType:'slide',
                style   :{
                    right   :'',
                    top     :document.body.scrollTop+document.documentElement.scrollTop,
                    bottom  :''
                }
            });
            break;
        case 2: // warning, don't close automatically
            $.messager.alert('Warning', info,'warning');
            break;
        default :
            $.messager.alert('Warning', info,'warning');
            break;
    }

    $.messager.progress('close');
};