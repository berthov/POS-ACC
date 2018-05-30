$('.searchDiv').on('input', function(){

    var input, filter, ul, li, a, i;
    input = document.getElementById('search-text');
    filter = input.value.toUpperCase();
    div = document.getElementsByClassName("thumbnail");

    for (i = 0; i < div.length; i++) {
        search = div[i].getElementsByTagName("search")[0];
        if(filter == " "){
            $(this).val($(this).data('oldValue'));
        } else {
            if (search.innerHTML.toUpperCase().indexOf(filter) > -1) {
                div[i].style.display = "";
                div[i].closest('.parentSearch').style.position = ""    
            } else {
                div[i].style.display = "none";
                div[i].closest('.parentSearch').style.position = "absolute";
            }
        }
        
    }

})