$(document).ready(getAll);

function getAll() {
    
    $('#AllInfoButton').click(getAllfromFile);
}
function getAllfromFile() {
    $.ajax({
        url: 'testfile.json',
        dataType: 'text',
        method: 'get',
        success: function(response){
            //debugger;
            //response is string
            //split a string into an array of substrings, and returns the new array
            
            //find {"content_rating" as seperator,
            //replace the seperator as empty string , 
            //seperator left and right side become a substring
            //store in array
            var sections = response.split('{"content_rating"');
            console.log('after split', sections);

            sections.shift();
            console.log('after shift', sections);

            //change string to json obj still store into array
            sections = sections.map( item=> JSON.parse('{"content_rating"' + item));
            console.log('after json.parse', sections);
            insertAlltoDB(sections);
            
        },
        error: function( ){
            console.log('server not response'); 
        }
    });
}//end getAllfromFile()

function insertAlltoDB(allAppData) {
    console.log('isndie insert db', allAppData);

    var url = 'server.php';
    // var newAllInfo = allAppData.map(each => {
    //     return each * 2;
    // });
    var length = allAppData.length;
    //console.log(allAppData[0]['app_name']);
    for(var i=0; i<length; i++) {
        var ajaxData = {
            action: 'insertAPI',
            app_name: allAppData[i]['app_name'],
            id: allAppData[i].id,
            genre: allAppData[i].genre,
            price: allAppData[i].price
        };

        $.ajax({
            url: url,
            method: 'get',
            dataType: 'json',
            data: ajaxData,
            success: function(response) {
                console.log('insert all ajax CALL response is ', response);
            
            },
            error: function () {
                console.log('server not response');    
            }
        });


    }//end for
    
}