$(document).ready(init);

function init() {
    $('#dbInfoButton').click(getData);
    $('#singleApiCallButton').click(insertDBfromAPI);
}

function insertDBfromAPI() {
// alert('hi');
    //var url = "https://api.appmonsta.com/v1/stores/android/details/com.atomicadd.fotos.json?country=US" ;
    var url = "https://api.appmonsta.com/v1/stores/android/details/us.koller.cameraroll.json?country=US";
    $.ajax({
        url: url,
        method: 'get',
        dataType: 'json',
        headers: {
            "Authorization": "Basic YWU1NTliYzc5MWNhZTllNWZmYjFlNGEzMTA4MjI5YzRkZTU3NDRhMzoxMTEx"
        },
        // data: {
        //     action: 'readAll'
        // },
        success: function(APIresponse) {
            console.log('response is ', APIresponse);
            //console.log('name', response['app_name']);
            //generateDOM(response.data);
            insertIntoDB(APIresponse);
        //     for(var i=0; i<response.data.length; i++) {
        //         generateDOM(response.data[i]);          
        //   }
        },
        error: function () {
            console.log('server not response');    
        }
    });

}//end insertDBfromAPI()

function insertIntoDB(APIresponse) {
    console.log('in insert into DB response is', APIresponse);
    console.log(APIresponse.genre);
    console.log('translated_description', APIresponse['translated_description']);
    console.log('game_app_id', APIresponse['id']);
    var url = 'server.php';
    var ajaxData = {
        action: 'insertAPI',
        app_name: APIresponse['app_name'],
        all_rating: APIresponse['all_rating'],
        all_rating_count: APIresponse['all_rating_count'],
        //id: APIresponse.id,
        genre: APIresponse.genre,

        publisher_id: APIresponse['publisher_id'],
        publisher_name: APIresponse['publisher_name'],
        publisher_email: APIresponse['publisher_email'],
        publisher_address: APIresponse['publisher_address'],
        publisher_url: APIresponse['publisher_url'],
        release_date: APIresponse['release_date'],
        game_app_id: APIresponse['id'],
        description: APIresponse.description,
        //translated_description: APIresponse['translated_description'],
        icon_url: APIresponse['icon_url'],
        video_urls: APIresponse['video_urls'],
        screenshot_urls: APIresponse['screenshot_urls'],
        whats_new: APIresponse['whats_new'],
    
        bundle_id: APIresponse['bundle_id'],
        
        price: APIresponse.price,
        status: APIresponse.status,
        downloads: APIresponse.downloads,
        genres: APIresponse.genres,
        iap_price_range: APIresponse['iap_price_range'],
        permissions: APIresponse.permissions,
        price_currency: APIresponse['price_currency'],
        price_value: APIresponse['price_value'],
        related: APIresponse.related,
        more_from_developer: APIresponse['more_from_developer'],
        related_apps: APIresponse['related_apps'],
        requires_os: APIresponse['requires_os'],
       
        store_url: APIresponse['store_url'],
        translated_description: APIresponse['translated_description']
    };

    $.ajax({
        url: url,
        method: 'get',
        dataType: 'json',
        data: ajaxData,
        success: function(response) {
            console.log('AJAX CALL response is ', response);
            //console.log('name', response['app_name']);
            //generateDOM(response.data)
        },
        error: function () {
            console.log('server not response');    
        }
    });
}


function getData() {
   // alert('db Info app ');
    //var url = "https://api.appmonsta.com/v1/stores/android/details/com.atomicadd.fotos.json?country=US" ;
   var url = 'server.php';
    $.ajax({
        url: url,
        method: 'get',
        dataType: 'json',
        // headers: {
        //     "Authorization": "Basic YWU1NTliYzc5MWNhZTllNWZmYjFlNGEzMTA4MjI5YzRkZTU3NDRhMzoxMTEx"
        // },
        data: {
            action: 'readAll'
        },
        success: function(response) {
            console.log('response is ', response);
            //console.log('name', response['app_name']);
            //generateDOM(response.data);

            for(var i=0; i<response.data.length; i++) {
                generateDOM(response.data[i]);          
                //student_array.push(studentRecord.data[i]);
                
          }
        },
        error: function () {
            console.log('server not response');    
        }
    });
}

// Response['app_name']
// id
// description
// genre
// price
// publisher_url
// store_url
// icon_url
// description
// whats_new
function generateDOM(response) {
    console.log('inside dom response is ', response);
   
    //console.log('inside generateDOM des: ', response.description);
    // var description = JSON.stringify(response.description);
    // var text = $('<td>').html(description);
    //console.log('inside generateDOM genre: ', response.genre);
    //console.log('inside generateDOM id: ', response.id);
    var tr = $('<tr>');
    var tdAppName = $('<td>', {
        text: response['app_name']
    });
    
    var tdID = $('<td>', {
        text: response.id
    });
    var tdgenre = $('<td>', {
        text: response.genre
    });
    var tdDescription = $('<td>', {
        //text: text
        text: response.price
    });

    tr.append(tdAppName);
    tr.append(tdID);
    tr.append(tdgenre);
    tr.append(tdDescription);

    $('.app-list tbody').append(tr);
}
