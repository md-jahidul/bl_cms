/*
    * Replace space to dash
    * Replace forwardSlash to dash
*/

function convertToSlug(Text)
{
    return Text.toLowerCase().replace(/ /g,'-').replace(/\//g,'-');
}


$(".slug-convert").keyup(function(){
    var text = $(this).val();
    var data = convertToSlug(text);
    $(this).val(data);
});
